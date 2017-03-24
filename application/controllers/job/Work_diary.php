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
    
    private function _freelancer_work_diary( $contract_id ){
        
        $date               = $this->input->get('date');
        $date               = ( ! empty( $date ) ) ? date('Y-m-d', strtotime( $date ) ) : date('Y-m-d');
        $current_date       = ( ! empty( $date ) ) ? date('D, M j, Y', strtotime( $date ) ) : date('D, M j, Y');   
        $contract           = $this->contracts_model->find( $contract_id, false );
        
        if( empty( $contract ) || $contract->contract_status == HOURLY_JOB_TYPE ){
            $this->session->set_flashdata('error', $this->lang->line('text_job_contract_not_found'));
            redirect( back( ) );
        }
        
        $hourly_contracts   = $this->contracts_model->get_all_hourly_freelancer_contracts( $contract->fuser_id );
        $total_hours_worked = $this->contracts_model->get_total_hour_worked_at( $contract_id, $date );
        $total_hours_week   = $this->contracts_model->get_hours_worked_this_week( $contract_id );
        $tracker_captures   = $this->contracts_model->get_work_diary( $contract_id, $date );
        
        $this->_view_data = $data = array(
            'current_contract_id'      => $contract_id,
            'contract_details'         => $contract, 
            'hourly_contracts'         => $hourly_contracts,
            'current_date'             => $current_date,
            'total_hour_worked'        => $total_hours_worked,
            'total_hours_week'         => $total_hours_week,
            'employer_is_not_active'   => ( $this->webuser_model->get_status( $contract->buser_id ) == 0 ),
            'captures'                 => $tracker_captures,
        );
    }
    
    public function _client_work_diary(){
        
    }
    
    
    public function index() {
        
        $default_timezone = date_default_timezone_get();
        
        //set timezone to UTC
        date_default_timezone_set("UTC");
        
        $this->authorized();
        
        $contract_id = base64_decode($_GET['fmJob']);
        
        //If contract identifier is not valid redirect to referrer.
        if(empty($contract_id) && !is_numeric($contract_id)){
            $this->session->set_flashdata('error', $this->lang->line('text_job_invalid_contract'));
            return redirect( back( ) );
        }
        
        //Load contracts model
        $this->load->model( array('contracts_model', 'webuser_model') );
        
        $user_type = $this->session->userdata('type');
        if ( $user_type == FREELANCER ) {
            $this->_freelancer_work_diary( $contract_id );
        }elseif( $user_type == EMPLOYER ){
            $this->_client_work_diary( $contract_id );
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
                
                parse_str($this->input->post('form'), $data);
                
                //validate data
                if(empty($data['staring_hour']) || verify_date($data['staring_hour'])){
                    
                }
                
                $date       = date('Y-m-d');
                $start_time = date('Y-m-d H:i:s', strtotime($data['staring_hour']));
                $end_time   = date('Y-m-d H:i:s', strtotime($data['end_hour']));
                
            }else{
                $result = array('message' => 'Not allowed', 'code' => _AJAX_ERROR_NOT_CONNECTED);
            }
        }else{
            $result = array('message' => 'Only ajax request is accepted for this action', 'code' => _AJAX_ERROR_NOT_CONNECTED);
        }
        
        echo json_encode( $result );
        die;
    }
}
