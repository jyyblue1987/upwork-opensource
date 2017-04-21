<?php

defined('BASEPATH') OR exit('No direct script access allowed');

use Carbon\Carbon; 

class Messageboard extends Winjob_Controller
{
    
    private $view_datas = array();

    public function __construct()
    {
        parent::__construct();
        
        $this->load_language();
        
        $this->load->model(array(
            'common_mod', 
            'Category', 
            'profile/ProfileModel', 
            'timezone', 
            'webuser_model',
            'conversation_model',
            'process',
        ));
    }
    
    /**
     * Load the appropriate language file
     */
    protected function load_language()
    {
        parent::load_language();
        $this->lang->load('job', $this->get_default_lang());
    }
    
    public function index()
    {
        $this->authorized();
        $user_id = $this->session->userdata(USER_ID);
        
        $all_messages = $this->webuser_model->get_all_messages( $user_id );
        
        if(count($all_messages) > 0 )
        {
            $this->view_datas['messages']      = $all_messages;
            
            $_data = array();
            foreach ($this->view_datas['messages'] as $v) {
                $v = (array) $v;
                if (isset($_data[$v['job_id']])) {
                  continue;
                }
                $_data[$v['job_id']] = $v;
            }
            $this->view_datas['messages'] = array_values($_data);
            
            $query_bid_id = $this->input->get('bid_id');
            if( ! empty( $query_bid_id ) )
            {
                $bid_id    = base64_decode( $query_bid_id );
                $is_ticket = 0;
            } 
            else 
            {
                $bid_id    = $all_messages[0]->bid_id;
                $is_ticket = $all_messages[0]->is_ticket;
            }
            
            $this->load_messages_and_images($user_id, $bid_id, $is_ticket);
            
        }
        
        $this->twig->display("webview/twig/message-board", $this->view_datas);
    }
    
    public function load_details()
    {
        if ( ! $this->Adminlogincheck->checkx() )
        {
            $this->ajax_response(array(
                'message' => $this->lang->line('text_job_no_authorized_to_load_message'),
                'status'  => 'error',
            ));
        }
            
        $bid_id    = $this->input->post('bid_id');
        $is_ticket = $this->input->post('is_ticket');
        $user_id   = $this->session->userdata(USER_ID);
        
        if(empty($bid_id))
        {
            $this->ajax_response(array(
                'message' => $this->lang->line('text_job_conversation_refresh_your_browser') ,
                'status'  => 'error'
            ));
        }
        
        $this->load_messages_and_images($user_id, $bid_id, $is_ticket);
        
        extract($this->view_datas);
        
        $html = $this->twig->render('webview/twig/partials/chat-interview', array(
            'fname'         => $last_message->fname, 
            'lname'         => $last_message->lname, 
            'job_title'     => $last_message->title, 
            'conversation'  => $chat_details, 
            'user_timezone' => $user_timezone, 
            'crt_user_time' => $crt_user_time, 
            'images'        => $images, 
            'bid_id'        => $last_message->bid_id, 
            'job_id'        => $last_message->job_id, 
            'user_id'       => $last_message->r_id, 
            'receiver_id'   => $last_message->r_id, 
            'is_ticket'     => $last_message->is_ticket
        ));
        
        $this->ajax_response(array(
            'message' => $html,
            'status'  => 'success',
        ));
    }
    
    private function load_messages_and_images($user_id, $bid_id, $is_ticket)
    {
        //Get the timezone.
        $webUserContactDetails = $this->common_mod->get(WEB_USER_ADDRESS, null, " AND webuser_id=" . $user_id);
        $timezone              = $this->timezone->get($webUserContactDetails['rows'][0]['timezone']);
        $user_timezone         = get_right_timezone( $timezone['name'] );
        $date                  = Carbon::now( new DateTimeZone( $user_timezone ) );
        $this->view_datas['user_timezone'] = $user_timezone;
        $this->view_datas['crt_user_time'] = $date;
            
        $messages = array();
        $images   = array();

        if ( $is_ticket == 0 ) 
        {
            $this->conversation_model->mark_as_read( $bid_id );
            $messages      = $this->conversation_model->get_conversation( $bid_id );
            $images        = array();

            if( ! empty( $messages ) )
            {
                $all_conv_ids = array();

                foreach ($messages AS $_convo) 
                    $all_conv_ids[] =  $_convo->id;

                $images = $this->process->get_all_images_of_each_message( $all_conv_ids );
            }
        }
        else
        {
            $this->webuser_model->mark_tickets_as_read( $bid_id );
            $messages    = $this->webuser_model->get_all_tickets( $bid_id );
            $images      = array();

            if( ! empty( $messages ) )
            {
                $all_conv_ids = array();

                foreach ($messages AS $_convo) 
                    $all_conv_ids[] =  $_convo->id;

                $images = $this->webuser_model->get_all_images_of_each_ticket( $all_conv_ids );
            }
        }
        
        $this->view_datas['images']       = $images;
        $this->view_datas['chat_details'] = $messages;
        $nb_messages          = count($messages);
        if( $nb_messages > 0)
            $this->view_datas['last_message'] = $messages[count($messages) - 1];
    }
    
    public function post_message()
    {
        $sender_id     = (int)$this->session->userdata(USER_ID);
        $receiver_id   = (int)$this->input->post('receiver_id');
        $job_id        = (int)$this->input->post('job_id');
        $bid_id        = (int)$this->input->post('bid_id');
        $_timezone     = $this->input->post('timezone');
        $timezone      = ! empty($_timezone) ? $_timezone : date_default_timezone_get();
        $message       = rtrim(trim($this->input->post('chat_message')));
        $is_ticket     = $this->input->post( 'is_ticket' );
        
        if(empty($message))
        {
            $this->ajax_response(array(
                'message' => $this->lang->line('text_job_conversation_empty_message') ,
                'status'  => 'error'
            ));
        }
        
        $this->load->model(array('conversation_model', 'job/bids_model', 'webuser_model'));
        
        $current_date = date('Y-m-d H:i:s');
        $images       = array();
        
        if(empty($is_ticket) || $is_ticket == 0)
        {   
            if(empty($receiver_id) || empty($job_id) || empty($bid_id))
            {
                $this->ajax_response(array(
                    'message' => $this->lang->line('text_job_conversation_refresh_your_browser') ,
                    'status'  => 'error'
                ));
            }
            
            $message_item = array(
                "job_id"               => $job_id,
                "bid_id"               => $bid_id,
                "message_conversation" => $message,
                "sender_id"            => $sender_id,
                "receiver_id"          => $receiver_id,
                "created"              => $current_date,
                "have_seen"            => 1,
            );
            
            //Save message of interview.
            $message_item_id = $this->conversation_model->create($message_item);
            
            if(empty($message_item_id))
            {
                $this->ajax_response(array(
                    'message' => $this->lang->line('text_job_conversation_internal_error') ,
                    'status'  => 'error'
                ));
            }
            
            //update the bid state (bid is being in interview process)
            $this->bids_model->update_field($bid_id, 'job_progres_status', 1);
            
            $images = array();        
            if (isset($_FILES['fileupload']) && !empty($_FILES['fileupload'])) 
            {
                $attachment_file = $this->_handle_remove_files_list();
                $images          = $this->_upload_files( $attachment_file, $message_item_id, $is_ticket );
            }
        }
        else
        {
            if(empty($bid_id))
            {
                $this->ajax_response(array(
                    'message' => $this->lang->line('text_job_conversation_refresh_your_browser') ,
                    'status'  => 'error'
                ));
            }
            
            $ticket_item  = array(
                'ticket_id'    => $bid_id,
                'sender_id'    => $sender_id,
                'receiver_id'  => '',
                'message'      => $message,
                'status'       => 'green',
                'created'      => $current_date,
                'have_seen'    => 1,
                'sender'       => 'user',
                'receiver'     => 'support'
            );
            
            $ticket_message_id = $this->webuser_model->save_ticket( $ticket_item );
            
            if(empty($ticket_message_id)){
                $this->ajax_response(array(
                    'message' => $this->lang->line('text_job_conversation_internal_error') ,
                    'status'  => 'error'
                ));
                
                
                $ticket = $this->load_user_ticket( $bid_id );
                if ( !empty($ticket) ) 
                {
                    $body = 'Message from ' . $ticket[0]->fname . ' '. $ticket[0]->lname
                            .'<br>Email : ' . $ticket[0]->email
                            .'<br>Ticket ID# : ' . $bid_id
                            .'<br> ' . nl2br( $message );

                    $this->Sesmailer->sesemail("support@winjob.com","New Message From Winjob", $body);
                }
            }
            
            $images = array();        
            if (isset($_FILES['fileupload']) && !empty($_FILES['fileupload'])) 
            {
                $attachment_file = $this->_handle_remove_files_list();
                $images          = $this->_upload_files( $attachment_file, $ticket_message_id, $is_ticket );
            }
        }
        
        $user_datetime = current_user_datetime($current_date, $timezone);
        $time          = $user_datetime->format('g:i A');
        $client        = $this->webuser_model->load_informations($this->session->userdata(USER_ID));
        
        $html = $this->twig->render('webview/twig/partials/message-item', array(
                    'time'    => $time,
                    'image'   => $client->cropped_image,
                    'fname'   => $client->webuser_fname,
                    'lname'   => $client->webuser_lname,
                    'message' => $message,
                    'images'  => $images,
                ));
        
        $this->ajax_response(array(
            'message' => $html,
            'status'  => 'success',
        ));
    }
    
    private function _upload_files( $attachment_file, $insert_id, $is_ticket )
    {
        $images = array();
        $num_files = count($attachment_file['name']);
        for ($i = 0; $i < $num_files; $i++) {
            if ($attachment_file["error"][$i] > 0) {

            } else {
                $img = $attachment_file["name"][$i];
                $file = explode(".", $img);
                $new_image_name = 'image_' . uniqid() . '.' . 'jpg';
                move_uploaded_file($attachment_file["tmp_name"][$i], 'uploads/' . $new_image_name);
                
                if(empty($is_ticket))
                {
                    $table    = 'job_conversation_files';
                    $img_data = array(
                        'job_conversation_id' => $insert_id,
                        'name'                => $new_image_name,
                        'original_name'       => $img
                    );
                }
                else
                {
                    $table = 'webuser_ticket_message_files';
                    $img_data = array(
                        'message_id'    => $insert_id,
                        'name'          => $new_image_name,
                        'original_name' => $img
                    );
                }
                
                if( $this->db->insert($table, $img_data)){
                    $item       = new stdClass();
                    $item->name = $new_image_name;
                    $images[]   = $item;
                } 
            }
        }
        
        return $images;
    }
    
    private function _handle_remove_files_list()
    {
        $attachment_file  = $_FILES["fileupload"];
        $removed_images   = $this->input->post('removed_files');
        $removed_images   = ! empty( $removed_images ) ? explode(',', $_POST['removed_files']) : array();
        
        if (count($removed_images)) {
            foreach ($removed_images as $index => $value) {
                if (in_array($value, $attachment_file['name'])) {
                    $key = array_search($value, $attachment_file['name']);
                    unset($attachment_file['name'][$key]);
                    unset($attachment_file['tmp_name'][$key]);
                }
            }
        }
        return $attachment_file;
    }

    public function load_new_message(){
        
    }
}
