<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of ContractValidator
 *
 * @author Hermannovich <donfack.hermann@gmail.com>
 */
class ContractValidator extends CI_Model {
      
  private $error = null; 
  
  public function __construct() 
  {
      $this->ci = get_instance(); 
  }
   
  public function is_valid_contract( $contract_id )
  {    
        $this->error = null;
        
        if( empty( $contract_id ) || ! is_numeric( base64_decode($contract_id) )){
            $this->error = app_lang('text_job_invalid_contract_id');
            return false;
        }

        $this->ci->load->model('contracts_model');
        $contract_id = base64_decode($contract_id);

        $contract = $this->ci->contracts_model->find( $contract_id );

        if( empty( $contract )){
            $this->error = app_lang('text_job_contract_not_found');
            return false;
        }

        return $contract;
  }
  
  public function user_can_access_current_contract( $contract )
  {
    $this->error = null;
    $current_user_data = app_user_data();
    
    $user_type = $current_user_data['type'];
    $user_id   = $current_user_data['id'];
    
    if($user_type == FREELANCER){
        if( $contract->fuser_id != $user_id){
            $this->error = app_lang('text_job_contract_not_authorized');
        }
    }else if($user_type == EMPLOYER){
        if( $contract->buser_id != $user_id){
            $this->error = app_lang('text_job_contract_not_authorized');
        }
    }else{
        $this->error = app_lang('text_job_contract_not_authorized');
    }
    
    $error = $this->error;
    return empty( $error );
  }
  
  public function get_error_message(){
      return $this->error;
  }
  
}
