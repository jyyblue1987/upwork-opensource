<?php
class Payment_methods_model extends CI_Model
{
  function __construct()
  {
    parent::__construct();
  }

  public function get_email_by_user_and_method($user, $method)
  {
    $this->db->where('webuser_id', $user);
    $this->db->where('payment_method_name', $method);

    $query = $this->db->get('webuser_payment_methods');

    if($query->num_rows() > 0 )
      return $query->row();
    else
      return array();
  }
  
  /**
   * Check if a client has a primary method payment setted.
   * 
   * @param  int   $user_id employer identifier
   * @return mixed payment method or null
   */
    public function get_primary_method_payment( $user_id )
    {
        $query = $this->db->select('service_name')
                    ->from('payment_services')
                    ->where('user_id', $user_id)
                    ->where('is_primary', true)
                    ->get();
        
        $method = $query->row();
        
        return ! empty( $method ) ? $method->service_name : null;
    }
    
    /**
   * Check if a client has a primary method payment setted.
   * 
   * @param  int   $user_id employer identifier
   * @return mixed payment method or null
   */
    public function get_primary( $user_id )
    {
        $query = $this->db->select('*')
                    ->from('payment_services')
                    ->where('user_id', $user_id)
                    ->where('is_primary', true)
                    ->get();
        
        return $query->row();
    }
    
    public function get_method_payment( $user_id, $service_payer_id )
    {
        $query = $this->db->select('*')
                    ->from('payment_services')
                    ->where('user_id', $user_id)
                    ->where('service_payer_id', $service_payer_id)
                    ->get();
        
        $method = $query->row();
        
        return ! empty( $method ) ? $method : null;
    }
    
    public function set_primary_method_payment( $user_id, $service_payer_id )
    {
        $this->db
            ->where('user_id', $user_id)
            ->where('service_payer_id', $service_payer_id);
        
        return $this->db->update('payment_services', array( 'is_primary' => true )); 
    }
    
    public function soft_delete_payment_method( $user_id, $service_payer_id )
    {
        $this->db
            ->where('user_id', $user_id)
            ->where('service_payer_id', $service_payer_id);
        
        return $this->db->update('payment_services', array( 'is_deleted' => true )); 
    }
    
    public function reset_primary_method_payment( $user_id )
    {
        $this->db
            ->where('user_id', $user_id)
            ->where('is_primary', true);
        
        return $this->db->update('payment_services', array( 'is_primary' => false )); 
    }
    
    public function save_method(  $service_datas )
    {
        return $this->db->insert('payment_services', $service_datas);
    }
    
    public function update_method( $user_id, $service_payer_id, $data)
    {
        $this->db
            ->where('user_id', $user_id)
            ->where('service_payer_id', $service_payer_id);
        
        return $this->db->update('payment_services', $data); 
    }
    
    public function get_all( $user_id ){
        
        $query = $this->db->select('*')
                    ->from('payment_services')
                    ->where('user_id', $user_id)
                    ->where('is_deleted', false)
                    ->order_by('service_name')
                    ->get();
        
        return $query->result();
    }
    
    public function get_freelancer_withdraw_method( $user_id )
    {
        $query = $this->db
                    ->select('DISTINCT(payment_method_name) as payment_method_name')
                    ->from(WB_PAYMENT_METHODS)
                    ->where('webuser_id', $user_id)
                    ->where('current_status', 'active')
                    ->get();
        
        // 1 = paypal, 2 = skrill, 3 = payneer.
        $methods = $query->result();
        
        if( ! empty( $methods ) )
        {
            $result = array(); 
            
            foreach($methods as $key => $method)
            {
                switch( strtolower($method->payment_method_name) )
                {
                    case WITHDRAW_PAYPAL:
                        $result[] = array(
                            'id' => 1, 
                            'method' => $method->payment_method_name
                        );
                    break;
                
                    case WITHDRAW_SKRILL:
                        $result[] = array(
                            'id' => 2, 
                            'method' => $method->payment_method_name
                        );
                    break;
                
                    case WITHDRAW_PAYONEER:
                        $result[] = array(
                            'id' => 3, 
                            'method' => $method->payment_method_name
                        );
                    break;
                }
            }
            
            return $result;
        }
        
        return null;
    }
}
