<?php
class ContactUpdateCount extends CI_Model {

    function __construct() {
        parent::__construct();
    }

	function check($permission) {

        if($this->Adminlogincheck->checkper($permission['contactsupport'])){
            return true;
        }else{
            redirect(site_url());
            exit();
        }
    }
	function load($permission,$mod){

		$ticket_id = $_POST['ticket_id'];
		$user_id = $this->session->userdata('id');
		$update_data['have_seen'] = '0';
        $where = array('ticket_id' => $ticket_id, 'sender_id !=' => $user_id, 'have_seen' => '1');
        $this->db->where($where);
        $response = $this->db->update('webuser_ticket_messages', $update_data);

        $res = array('success' => $response);
        print_r(json_encode($res)); die;
    }



}

?>
