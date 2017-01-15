<?php
class Contactcheck extends CI_Model {

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
        $message=$_POST['message'];

        $user_id = $this->session->userdata('id');

        if (empty($ticket_id)) {
            redirect(site_url('administrator/userpage/loadpage/contactmanagement/subpage/contactsupport?error=Not found ticket ID'));
            return false;
        }

        if (empty($message)) {
            redirect(site_url('administrator/userpage/loadpage/contactmanagement/subpage/contactsupport?error=Empty message text'));
            return false;
        }

        if (empty($email)) {
            redirect(site_url('administrator/userpage/loadpage/contactmanagement/subpage/contactsupport?error=Empty email'));
            return false;
        }

        // insert ticket message
        $this->db->insert('webuser_ticket_messages',array(
            'ticket_id' => $ticket_id,
            'sender_id' => $user_id,
            'receiver_id' => $webuser_id,
            'message' => $message,
            'status' => 'red',
            'created' => date("Y-m-d H:m:s"),
            'sender' => 'support',
            'receiver' => 'user'
        ));
        $ticketMessageID = $this->db->insert_id();

        // $update_data['have_seen'] = '0';

        // $where = array('ticket_id' => $ticket_id, 'sender_id !=' => $user_id, 'have_seen' => '1');
        // $this->db->where($where);
        // $this->db->update('webuser_ticket_messages', $update_data);

        // added by Armen start

        if (isset($_FILES['fileupload']) && !empty($_FILES['fileupload'])) {
            $attachment_file = $_FILES["fileupload"];
            $removed_images = (isset($_POST['removed_files']) && !empty($_POST['removed_files'])) ? explode(',', $_POST['removed_files']) : array();
            if(count($removed_images) <= 1 && !empty($removed_images)){
                if (in_array($removed_images[0], $attachment_file['name']))
                {
                    $key = array_search ($removed_images[0], $attachment_file['name']);
                    unset($attachment_file['name'][$key]);
                    unset($attachment_file['tmp_name'][$key]);
                }
            }else if(count($removed_images) > 1 && !empty($removed_images)){
                foreach ($removed_images as $index => $value) {
                   if (in_array($value, $attachment_file['name']))
                    {
                        $key = array_search ($value, $attachment_file['name']);
                        unset($attachment_file['name'][$key]);
                        unset($attachment_file['tmp_name'][$key]);
                    }
                }
            }
            $no_files = count($attachment_file['name']);
            for ($i = 0; $i < $no_files; $i++) {
                if ($attachment_file["error"][$i] > 0) {
                    // echo "Error: " . $attachment_file["error"][$i] . "<br>";
                } else {
                    $img = $attachment_file["name"][$i];
                    $file = explode(".",$img);
                    $new_image_name = 'image_' . uniqid() .'.'. 'jpg';
                    move_uploaded_file($attachment_file["tmp_name"][$i], 'uploads/' . $new_image_name);
                    $this->db->insert('webuser_ticket_message_files',array(
                        'message_id' => $ticketMessageID,
                        'name' => $new_image_name,
                        'original_name' => $img
                    ));
                }
            }
        }

        
        // added by Armen end





        if (empty($ticketMessageID)) {
            redirect(site_url('administrator/userpage/loadpage/contactmanagement/subpage/contactsupport?error=Error create ticket message row'));
            return false;
        }
        $body = nl2br($message);
        $response=$this->Sesmailer->sesemailfromsupport($email,"Reply on ticket #$ticket_id",$body);
        redirect(site_url('administrator/userpage/loadpage/contactmanagement/subpage/contactsupport'));
    }
}

?>
