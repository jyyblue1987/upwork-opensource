<?php
session_start();
class Contactsupport extends CI_Model {

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

		$page=$this->uri->uri_to_assoc();
		$title=$this->Adminforms->getdata("name","usersubpage",$permission['contactsupport']);

		if(isset($_GET['q'])){
			$q=$_GET['q'];
		}else{
			$q=false;
		}

		$this->db->select('wt.id as ticket_id, wt.webuser_id, wt.fname, wt.lname, wt.email, wt.subject,'
			.'wtm_first.id as message_id, wtm_first.message, wtm_last.status, webuser.webuser_picture');
		$this->db->from('webuser_tickets wt');
	 	$this->db->join('webuser', 'wt.webuser_id = webuser.webuser_id', 'left');
		$this->db->join('webuser_ticket_messages wtm_first','wtm_first.id = ( '
			.'SELECT id FROM webuser_ticket_messages WHERE ticket_id = wt.id ORDER BY id LIMIT 1)','left');
	  	$this->db->join('webuser_ticket_messages wtm_last','wtm_last.id = ( '
		  .'SELECT id FROM webuser_ticket_messages WHERE ticket_id = wt.id ORDER BY id DESC LIMIT 1)','left');
		$query = $this->db->get();
		$result = $query->result();

		foreach($result as &$ticket) {
			$this->db->select("sender_id, receiver_id, have_seen, message, status, created, sender, receiver, wtm.id as message_id");
			$this->db->from("webuser_ticket_messages wtm");
			$this->db->where("ticket_id", $ticket->ticket_id);

			$this->db->order_by("wtm.id");
			$query = $this->db->get();
			$conversation = $query->result();
			// Added by Armen start
			$unread_count = 0;
			foreach ($conversation as &$value) {
				$this->db->select("name");
				$this->db->from("webuser_ticket_message_files wtmf");
				$this->db->where("message_id = ", $value->message_id);
				$query_files = $this->db->get();
				$files = $query_files->result();
				$value->files = $files;

				if($value->have_seen == '1' && $value->sender_id != $_SESSION['id']){
					$unread_count++;
				}
			}
			// Added by Armen End
			$ticket->conversation = $conversation;
			$ticket->unread_messages = $unread_count;
		}
		unset($ticket);
		$data = array( 'title' => $title, 'permission' => $permission, 'loadpage' => $page['loadpage'], 'subpage' => $page['subpage'],'result' => $result);
		$this->Admintheme->loadview($page['loadpage']."/".$page['subpage'],$data);

    }



}

?>
