<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Description of Work_diary
 *
 * @author Hermannovich <donfack.hermann@gmail.com>
 */
class Work_diary extends Winjob_Controller{
    
    private $_view_data = array();
    
    public function __construct() {
        parent::__construct();
        $this->load_language();
    }
    
    protected function load_language(){
        parent::load_language();
        $this->lang->load('job', $this->get_default_lang());
    }
    
private function common_data( $contract ){
    
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
            'employer_is_not_active'   => $this->webuser_model->is_active( $contract->buser_id ),
        );
    }
    
    private function _client_work_diary( $contract ){
        
        $user_lists  = $this->contracts_model->get_all_freelancer_in_hourly_contract( $contract->job_id );
                
        $this->_view_data += array( 'user_lists' => $user_lists );
    }
    
    
    public function index() {
        
        $default_timezone = date_default_timezone_get();
        
        //set timezone to UTC
        date_default_timezone_set("UTC");
        
        $this->authorized();
        
        $contract_id = base64_decode($this->input->get('fmJob'));
        
        //If contract identifier is not valid redirect to referrer.
        if(empty($contract_id) && !is_numeric($contract_id)){
            $this->session->set_flashdata('error', $this->lang->line('text_job_invalid_contract'));
            return redirect( back( ) );
        }
        
        //Load contracts model
        $this->load->model( array('contracts_model', 'webuser_model') );
                
        $contract           = $this->contracts_model->find( $contract_id, false );
        
        if( empty( $contract ) || $contract->contract_status == JOB_ENDED ){
            $this->session->set_flashdata('error', $this->lang->line('text_job_contract_not_found'));
            redirect( back( ) );
        }
                
        $user_type = $this->session->userdata('type');
        
        if(in_array($user_type, array(FREELANCER, EMPLOYER))){
            
            $this->common_data($contract);
            
            if ( $user_type == FREELANCER ) {
                $this->_freelancer_work_diary( $contract );
            }elseif( $user_type == EMPLOYER ){
                $this->_client_work_diary( $contract );
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
                
                $this->job_work_diary_model->insert( $job_work_diary_data );
                $this->job_work_diary_model->update_work_tracker( $job_work_diary_data );
                
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
        $end_time     = date_create($data['end_hour']);

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
            'jobid'         => $job_id,
            'bid_id'        => $bid_id,
            'cuser_id'      => $clientid,
            'fuser_id'      => $user_id,
            'starting_hour' => $start_time->format('Y-m-d H:i:s'),
            'ending_hour'   => $endind_time,
            'total_hour'    => $total_hour,
            'working_date'  => date('Y-m-d'),
            'end_work'      => $endind_time,
        );
                
    }
}
