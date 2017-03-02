<?php
class Withdraw_model extends CI_Model
{

  function __construct()
  {
    parent::__construct();
  }

  public function get_all_by_user($userid, $lastone = false)
  {
    $this->db->select("
      webuser.webuser_email AS email,
      withdraw.amount,
      withdraw.status,
      withdraw.operation_date,
      (CASE
        WHEN withdraw.payment_type = '1' THEN 'Paypal'
        WHEN withdraw.payment_type= '2' THEN 'Skrill'
        WHEN withdraw.payment_type= '3' THEN 'Payoneer'
      END) AS payment_type,
      withdraw.processingfees", FALSE);

    $this->db->where('userid', $userid);

    if($lastone)
      $this->db->order_by('date DESC');
    else
      $this->db->order_by('date');

    $this->db->join('webuser', 'webuser.webuser_id = withdraw.userid');

    $query = $this->db->get('withdraw');

    if ($query->num_rows() > 0 && $lastone)
      return $query->row_array();
    elseif($query->num_rows() > 0)
      return $query->result_array();
    else
      return array();
  }

  public function get_by_all_user($status)
  {
    $this->db->select("
      webuser.webuser_id,
      webuser.webuser_email AS email,
      withdraw.amount,
      withdraw.id,
      withdraw.date,
      withdraw.status AS status_payment,
      CONCAT(webuser.webuser_fname, ' ', webuser.webuser_lname) AS name,
      webuser.webuser_username,
      (CASE
        WHEN withdraw.payment_type = '1' THEN 'Paypal'
        WHEN withdraw.payment_type= '2' THEN 'Skrill'
        WHEN withdraw.payment_type= '3' THEN 'Payoneer'
      END) AS payment_type,
      withdraw.processingfees", FALSE);

      $this->db->where('status', $status);

      $this->db->order_by('date');

    $this->db->join('webuser', 'webuser.webuser_id = withdraw.userid');

    $query = $this->db->get('withdraw');

    if($query->num_rows() > 0 )
      return $query->result_array();
    else
      return array();
  }
}
