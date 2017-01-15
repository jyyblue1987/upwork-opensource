<?php

class Changepassword extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }


		function check()
    {
		$oldpassword=md5($_POST['oldpassword']);
		$newpassword=md5($_POST['newpassword']);


 $this->db->select('id');
 $this->db->from('user');
 $this->db->where('id', $this->session->userdata('id'));
 $this->db->where('password', $oldpassword);
 $this->db->where('status', "1");
 $this->db->limit(1);

   $query = $this -> db -> get();

if($query -> num_rows() == 1)
{
   foreach ($query->result() as $row)
   {
 $return=$query->result()[0];

$data = array(
   'password' => $newpassword,
);

$this->db->where('id', $return->id);
$this->db->update('user', $data);

  		return "11";
   }
}else{
		return "22";
}


    }



}

?>
