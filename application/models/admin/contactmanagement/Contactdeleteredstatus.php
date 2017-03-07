<?php
class Contactdeleteredstatus extends CI_Model {

    function __construct()
    {
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

	function load()
    {

		$ticket_id=$_POST['ticket_id'];
		$webuser_id=$_POST['webuser_id'];
        $email=$_POST['email'];

        $message="Your issue has been Solved! \r\nThank you for contact with us.";

        $user_id = $this->session->userdata('id');

        $response = array();

        if (empty($ticket_id)) {
            $response['success'] = false;
            $response['error'] = "Not founf ticket_id";
            echo json_encode( $response );
            return false;
        }

        if (empty($email)) {
            $response['success'] = false;
            $response['error'] = "Empty email";
            echo json_encode( $response );
            return false;
        }

        // insert ticket message
        $this->db->insert('webuser_ticket_messages',array(
            'ticket_id' => $ticket_id,
            'sender_id' => $user_id,
            'receiver_id' => $webuser_id,
            'message' => $message,
            'status' => 'green',
            'created' => date("Y-m-d H:m:s"),
            'sender' => 'support',
            'receiver' => 'user'
        ));
        $ticketMessageID = $this->db->insert_id();

        if (empty($ticketMessageID)) {
            $response['success'] = false;
            $response['error'] = "Error save message";
            echo json_encode( $response );
            return false;
        }
        $body = nl2br($message);
        $result=$this->Sesmailer->sesemailfromsupport($email,"Reply on ticket #$ticket_id",$body);

        // get conversation on ticket
        $this->db->select("sender_id, receiver_id, message, status, created");
        $this->db->from("webuser_ticket_messages wtm");
        $this->db->where("ticket_id = ", $ticket_id);
        $this->db->order_by("wtm.id");
        $query = $this->db->get();
        $conversation = $query->result();

        $response['success'] = true;
        $response['conversation'] = $conversation;
        echo json_encode( $response );
    }
}

?>
