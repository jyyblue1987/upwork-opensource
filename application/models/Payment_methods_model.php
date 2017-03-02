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
}
