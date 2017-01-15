<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Jobconvrsation extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('Category', 'Common_mod'));
        //$this->load->model("Category");
        //$this->load->model("Common_mod");
    }

    public function index()
    {
        
    }
     public function add_conversetion(){
        parse_str($_POST['form'], $form);
        $response = array();
        $response['success'] = false;
      
       $data = array(
        'job_id'  =>  $form['job_id'] ,
        'bid_id'   =>  $form['bid_id'],
        'message_conversation'   =>  $form['usermsg'],
        'sender_id'   =>  $form['sender_id'],
        'receiver_id'   =>  $form['receiver_id'],
       );

        $this->db->insert('job_conversation', $data);
        $insert_id = $this->db->insert_id();
        if($insert_id){
            $response['success'] = true;
        }
         echo json_encode( $response );

    }
    //public function add_conversetion(){
    //    
    //  
    //   $data = array(
    //    'job_id'  =>  $_POST['job_id'] ,
    //    'bid_id'   =>  $_POST['bid_id'],
    //    'message_conversation'   =>  $_POST['usermsg'],
    //    'sender_id'   =>  $_POST['sender_id']
    //   );
    //
    //    $this->db->insert('job_conversation', $data);
    //    echo $insert_id = $this->db->insert_id();
    //
    //     
    //    
    //   
    //}
    public function current_conversetion(){
       $lastid = $_REQUEST['lastid'];
       
       $this->db->select('job_conversation.*,webuser.*');
        $this->db->from('job_conversation');
        $this->db->join('webuser', 'job_conversation.sender_id = webuser.webuser_id', 'inner');
        $this->db->where('id', $lastid);
        $this->db->order_by("job_conversation.id", "ASC");
        $query_conversation=$this->db->get();
        $conversation =  $query_conversation->row();
        
         $result ='<li><div class="chat-identity"> <img src="'.site_url($conversation->webuser_picture).'" width="60px" class="img-circle"/><h4>'.$conversation->webuser_fname.'&nbsp;'.$conversation->webuser_lname.'</h4><b>'. date(' F j, Y g:i A', strtotime($conversation->created)).'</b></div><div>'.$conversation->message_conversation.'</div></li>';

        echo $result;
  
   }
   
   
     public function message_from_superhero(){
        
            $response = array();
            $job_bid_id = $_REQUEST['job_bid_id'];
            $user_id = $_REQUEST['user_id'];
            $job_id = $_REQUEST['job_id'];
            $bidder_id = $this->session->userdata('id');
            
            //conversation
            $conversation_count = 0;
            $conversation = array();
            
            if( $bidder_id ){     
                $this->db->select('*');
                $this->db->from('job_conversation');
               // $this->db->where('job_conversation.sender_id', $bidder_id);
                $this->db->where('job_conversation.job_id', $job_id);
                $this->db->where('job_conversation.bid_id', $job_bid_id);
                
                $query=$this->db->get();// assign to a variable
                $conversation_count = $query->num_rows();// then use num rows
     
                if( $conversation_count ){
                
                    $this->db->select('job_conversation.*,webuser.*');
                    $this->db->from('job_conversation');
                    $this->db->join('webuser', 'job_conversation.sender_id = webuser.webuser_id', 'inner');
                    $this->db->where('job_conversation.job_id', $job_id);
                    $this->db->where('job_conversation.bid_id', $job_bid_id);
                    $this->db->order_by("job_conversation.id", "DESC");
                    $query_conversation=$this->db->get();
                    $conversation =  $query_conversation->result();
                }
            }
            
            $result = '<ul class="m_list scroll-ul">';   
            foreach($conversation as $data){
                 $pic = $this->Adminforms->getdatax("picture", "webuser", $data->sender_id);
                 if ($pic == "")
                 {
                     $profile_pic = '<img src="'.site_url("assets/user.png").'" width="64" height="64" class="img-circle">';
                 } else
                 {
                     $profile_pic = '<img src="'.site_url($pic).'" width="64" height="64" class="img-circle">';
                 }
                 $result .='<li><div class="chat-identity"> '.$profile_pic.'<h4>'.$data->webuser_fname.'&nbsp;'.$data->webuser_lname.'</h4><b>'. date(' F j, Y g:i A', strtotime($data->created)).'</b></div><div>'.nl2br($data->message_conversation).'</div></li>';
            }
            $result .= '</ul>';
            $response['html'] = $result;
            echo json_encode( $response );
        }
        
        function xyz()
        {
            echo "hjhjhjh";
            die;
        }


}
