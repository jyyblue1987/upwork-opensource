<?php

defined('BASEPATH') OR exit('No direct script access allowed');

use Carbon\Carbon; 

/**
 * Description of Work_diary
 *
 * @author Hermannovich <donfack.hermann@gmail.com>
 */
class Work_diary extends Winjob_Controller{
    
    private $_view_data = array();
    
    public function __construct()
    {
        parent::__construct();
        $this->load_language();
    }
    
    protected function load_language()
    {
        parent::load_language();
        $this->lang->load('job', $this->get_default_lang());
    }
    
    private function common_data( $contract )
    {
        $date               = $this->input->get('date');
        $date               = ( ! empty( $date ) ) ? date('Y-m-d', strtotime( $date ) ) : date('Y-m-d');
        $current_date       = ( ! empty( $date ) ) ? date('D, M j, Y', strtotime( $date ) ) : date('D, M j, Y'); 
        $contract_id        = $contract->bid_id;

        $total_hours_worked = $this->contracts_model->get_total_hour_worked_at( $contract_id, $date );
        $total_hours_week   = $this->contracts_model->get_hours_worked_this_week( $contract_id );
        $tracker_captures   = $this->contracts_model->get_work_diary( $contract_id, $date );

        $this->_view_data = $data = array(
            'current_contract_id'      => $contract_id,
            'contract_details'         => $contract, 
            'current_date'             => $current_date,
            'total_hour_worked'        => $total_hours_worked,
            'total_hours_week'         => $total_hours_week,
            'captures'                 => $tracker_captures,
        );
    }
    
    private function _freelancer_work_diary( $contract ){
        
        $hourly_contracts   = $this->contracts_model->get_all_hourly_freelancer_contracts( $contract->fuser_id );
        
        $this->_view_data  += array(
            'hourly_contracts'         => $hourly_contracts,
            'employer_is_not_active'   => ! $this->webuser_model->is_active( $contract->buser_id ),
        );
    }
    
    private function _client_work_diary(  )
    {   
        $employer_id           = $this->session->userdata('id');
        $current_freelancer_id = $this->input->get('fuser_id');
        $current_contract_id   = $this->input->get('fmJob');
        
        $user_lists  = $this->contracts_model->get_all_freelancer_in_hourly_contract( $employer_id );
        
        
        if( ! empty($current_freelancer_id) )
        {
            $current_freelancer_id = base64_decode ($current_freelancer_id);
        }
        
        if( ! empty($current_contract_id) )
        {
            $current_contract_id   = base64_decode( $current_contract_id );
            $contract              = $this->_validate_contract($current_contract_id, $current_freelancer_id);
            $current_freelancer_id = $contract->fuser_id;
        }
        else if( ! empty( $current_freelancer_id ) &&  ! empty( $user_lists ) )
        {
            //check that current freelancer is inside the user_lists array
            if( ! array_key_value_exists('webuser_id', $current_freelancer_id, $user_lists) )
            {
                $this->session->set_flashdata('error', $this->lang->line('text_job_invalid_freelancer_with_hourly_contract'));
                redirect( back() );
            }            
        }
        else if( ! empty( $user_lists ) )
        {
            $current_freelancer_id = $user_lists[0]->webuser_id;
        }
        else
        {   
            $this->session->set_flashdata('error', $this->lang->line('text_job_employer_no_hourly_contract'));
            redirect( back() );
        }
        
        $freelancer_contracts_lists = $this->contracts_model->get_hourly_contract_with_employer($employer_id, $current_freelancer_id);
        
        if( !empty( $freelancer_contracts_lists ) && empty($contract))
            $contract = $this->contracts_model->find( $freelancer_contracts_lists[0]->bid_id, false );
        
        $this->common_data($contract);
        
        $this->_view_data += array( 
            'user_lists'                 => $user_lists, 
            'freelancer_contracts_lists' => $freelancer_contracts_lists,
            'current_freelancer_id'      => $current_freelancer_id,
            'current_contract_id'        => $current_contract_id
        );
    }
    
    
    public function index() {
        
        $default_timezone = date_default_timezone_get();
        
        //set timezone to UTC
        date_default_timezone_set("UTC");
        
        $this->authorized();
                
        $user_type = $this->session->userdata('type');
        
        if(in_array($user_type, array(FREELANCER, EMPLOYER)))
        {   
            //Load necessary model
            $this->load->model( array('contracts_model', 'webuser_model') );
            
            if ( $user_type == FREELANCER ) {
                
                $contract_id = base64_decode($this->input->get('fmJob'));
        
                //If contract identifier is not valid redirect to referrer.
                if(empty($contract_id) && !is_numeric($contract_id))
                {
                    $this->session->set_flashdata('error', $this->lang->line('text_job_invalid_contract'));
                    return redirect( back( ) );
                }

                $contract = $this->_validate_contract( $contract_id );
                $this->common_data($contract);
                $this->_freelancer_work_diary( $contract );
                
            }elseif( $user_type == EMPLOYER ){
                $this->_client_work_diary();
            }
            
        }else{
            redirect( home_url() );
        }
        
        $this->twig->display('webview/jobs/twig/work-diary', $this->_view_data);
        
        date_default_timezone_set($default_timezone);
    }
    
    public function save_worked_hour(){
        
        if($this->input->is_ajax_request()){
            if(  $this->Adminlogincheck->checkx() ){
                
                date_default_timezone_set("UTC");
                
                $job_work_diary_data = $this->_ajax_data_validation();
                
                $contract_id         = $job_work_diary_data['contract_id'];
                $contract_amount     = $job_work_diary_data['contract_amount'];
                $total_hour          = $job_work_diary_data['total_hour'];
                unset($job_work_diary_data['contract_id']);
                unset($job_work_diary_data['contract_amount']);
                        
                $this->job_work_diary_model->insert( $job_work_diary_data );
                $this->job_work_diary_model->update_work_tracker( $job_work_diary_data );
                
                //create or update an invoice.
                $this->load->model( array( 'payment_methods_model', 'invoice_model' ) );
                
                //get the invoice of the current contract for the current week
                $amount_due = $contract_amount * $total_hour;
                $now        = Carbon::now()->timezone( new DateTimeZone( 'UTC' ) ); 
                $desc       = ( $total_hour > 1 ? 'text_app_payment_fors' : 'text_app_payment_for' );
                $invoice    = array(
                    'description' => sprintf($this->lang->line( $desc ), $contract_id, $total_hour, $contract_amount),
                    'amount_due'  => $amount_due,
                    'bid_id'      => $job_work_diary_data['bid_id'],
                    'status'      => INVOICE_UNPAID,
                    'created_at'  => date('Y-m-d H:i:s', $now->timestamp),
                    'updated_at'  => date('Y-m-d H:i:s',$now->timestamp)
                );
                
                $this->invoice_model->create( $invoice );
                
                $this->ajax_response( array(
                    'status'    => 'success', 
                    'message'   => $this->lang->line('text_job_work_diary_hour_added'), 
                    'todaywork' => $total_hour 
                ) );                
                
            }else{
                $result = array('message' => $this->lang->line('text_job_work_diary_not_allowed'), 'status' => 'error');
            }
            
        }else{
            redirect( home_url() );
        }
        
        $this->ajax_response( $result );
    }
    
    
    private function _ajax_data_validation(){
        
        parse_str($this->input->post('form'), $data);
                
        //validate data
        $start_time = date_create($data['staring_hour']);
        $end_time   = date_create($data['end_hour']);

        if($start_time == false ) {
            $this->ajax_response( array('message' => $this->lang->line('text_job_invalid_start_time'), 'status' => 'error') );
        }

        if($end_time == false){
            $this->ajax_response( array('message' => $this->lang->line('text_job_invalid_end_time'), 'status' => 'error') );
        }

        //validate identifiers value
        extract($data);                                
        if(  empty($job_id)   || !is_numeric($job_id) || 
             empty($bid_id)   || !is_numeric($bid_id) || 
             empty($clientid) || !is_numeric($clientid) || 
             empty($user_id)  || !is_numeric($user_id) ) {
            $this->ajax_response( array('message' => $this->lang->line('text_job_work_diary_missing_data'), 'status' => 'error') );
        }

        $this->load->model(array('job_work_diary_model', 'contracts_model'));

        if( $this->job_work_diary_model->exits($bid_id, $start_time, $end_time) ){
            $this->ajax_response( array('message' => sprintf($this->lang->line('text_job_work_diary_time_already_provide'), $start_time->format('H:i:s'), $end_time->format('H:i:s')), 'status' => 'error') );
        }

        //load contract 
        $contract = $this->contracts_model->find( $bid_id );

        if( empty($contract ) || 
                $contract->fuser_id != $user_id  || 
                $contract->buser_id != $clientid || 
                $contract->job_id   != $job_id   ){
            $this->ajax_response( array('message' => $this->lang->line('text_job_work_diary_missing_data'), 'status' => 'error') );
        }
        
        $endind_time = $end_time->format('Y-m-d H:i:s');
        
        return array(
            'jobid'           => $job_id,
            'bid_id'          => $bid_id,
            'cuser_id'        => $clientid,
            'fuser_id'        => $user_id,
            'starting_hour'   => $start_time->format('Y-m-d H:i:s'),
            'ending_hour'     => $endind_time,
            'total_hour'      => $total_hour,
            'working_date'    => date('Y-m-d'),
            'end_work'        => $endind_time,
            'contract_id'     => $contract->contact_id,
            'contract_amount' => ( ! empty( $contract->offer_bid_amount) ? $contract->offer_bid_amount : $contract->bid_amount )
        );
                
    }
    
    private function _validate_contract( $contract_id, $current_freelancer_id = null ){
                
        $contract           = $this->contracts_model->find( $contract_id, false );
        
        if( empty( $contract ) || $contract->contract_status == JOB_ENDED )
        {
            $this->session->set_flashdata('error', $this->lang->line('text_job_contract_not_found'));
            redirect( back( ) );
        }
        
        
        if( !empty( $current_freelancer_id ) && $contract->fuser_id != $current_freelancer_id )
        {   
            $this->session->set_flashdata('error', $this->lang->line('text_job_contract_not_own_by_current_freelancer'));
            redirect( back( ) );
        }
        
        return $contract;
    }
}
