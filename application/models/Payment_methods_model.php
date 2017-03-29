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
   * @param int $user_id employer identifier
   * @return bool
   */
    public function get_primary_method_payment( $user_id )
    {
        $query = $this->db->select('paymentMethod')
                    ->from('billingmethodlist')
                    ->where('billingmethodlist.belongsTo', $user_id)
                    ->where('billingmethodlist.isPrimary', "1")
                    ->get();
        
        $method = $query->row();
        
        return ! empty( $method ) ? $method->paymentMethod : null;
    }
}
