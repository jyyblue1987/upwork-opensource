<?php

defined('BASEPATH') OR exit('No direct script access allowed');

use Carbon\Carbon; 

class Applicants extends Winjob_Controller {

    private $user_id;
    private $employer;

    public function __construct() {
        parent::__construct();
        
        $this->load_language();
        
        $this->load->model(array(
            'common_mod', 
            'Category', 
            'profile/ProfileModel', 
            'timezone', 
            'webuser_model', 
            'process', 
            'Employer',
            'job_work_diary_model'
        ));
        
        $this->user_id  = $this->session->userdata('id');
        $this->employer = new Employer($this->user_id);
    }
    
    /**
     * Load the appropriate language file
     */
    protected function load_language(){
        parent::load_language();
        $this->lang->load('job', $this->get_default_lang());
    }

    public function index() {
        
        $this->authorized(); 
        
        $view_user_id = $this->input->get('user_id');
        if( ! empty( $view_user_id ) )
        {
            $user_id = base64_decode( $view_user_id );
        }

        $view_job_id = $this->input->get('job_id');
        if ( ! empty( $view_job_id ) ) 
        {
            $job_id = base64_decode( $view_job_id );
        }

        $view_bid_id = $this->input->get('bid_id');
        if ( ! empty( $view_bid_id ) ) 
        {
            $bid_id = base64_decode( $view_bid_id );
        }
        
        if(empty($user_id) || empty($job_id) || empty($bid_id))
        {
            $this->session->set_flashdata('error', $this->lang->line('text_app_invalid_application_parameter'));
            redirect( home_url() );
        }
        
        //Load freelancer informations.
        $freelancer   = $this->webuser_model->load_profile( $user_id );
        
        if( empty( $freelancer ) ){
            $this->session->set_flashdata('error', $this->lang->line('text_app_runtime_no_freelancer'));
            redirect( home_url() );
        }        

        $ended_jobs         = $this->process->cnt_ended_jobs($user_id);
        $country            = $this->ProfileModel->get_country($freelancer->webuser_country);
        $skills             = $this->ProfileModel->get_skills($user_id);
        $user_rating        = $this->webuser_model->get_total_rating($user_id);
        $accepted_jobs      = $this->process->accepted_jobs($user_id);
        $conversation       = $this->process->get_conversation($job_id, $bid_id);
        $job_info           = $this->process->get_job_info($user_id, $job_id);
        
        if( ! empty( $conversation['data'] ) )
        {
            $all_conv_ids = array();
            
            foreach ($conversation['data'] AS $_convo) 
            {
                $all_conv_ids[] =  $_convo->id;
            }

            $images = $this->process->get_all_images_of_each_message( $all_conv_ids );
        }

        $total_work         = 0;
        foreach ($accepted_jobs AS $a_jobs) 
        {
            $diary     = $this->job_work_diary_model->get_work_hours($a_jobs->fuser_id, $a_jobs->job_id);

            foreach ($diary AS $_diary) 
            {
                $total_work += $_diary->total_hour;
            }
        }

        //Get the timezone.
        $client_id             = $this->session->userdata(USER_ID);
        $webUserContactDetails = $this->common_mod->get(WEB_USER_ADDRESS, null, " AND webuser_id=" . $client_id);
        $timezone              = $this->timezone->get($webUserContactDetails['rows'][0]['timezone']);
        $user_timezone         = get_right_timezone( $timezone['name'] );
        $date                  = Carbon::now( new DateTimeZone( $user_timezone ) );
        
        $params = array(
            'crt_user_time'   => $date, //Current time from user timezone
            'user_timezone'   => $user_timezone,
            'ended_jobs'      => $ended_jobs,
            'total_work'      => $total_work,
            'images'          => $images,
            'tagline'         => ucfirst($freelancer->tagline),
            'country'         => ucfirst($country['country_name']),
            'status'          => $freelancer->isactive,
            'slag'            => strtolower(str_replace(' ', '-', $freelancer->webuser_fname . '-' . $freelancer->webuser_lname)),
            'fname'           => $freelancer->webuser_fname,
            'lname'           => $freelancer->webuser_lname,
            'cropped_img'     => $freelancer->cropped_image,
            'freelancer_id'   => $freelancer->webuser_id,
            'skills'          => $skills,
            'job_info'        => $job_info,
            'rating'          => $user_rating,
            'conversation'    => $conversation,
            'hourly_rate'     => $freelancer->hourly_rate,
            'exp'             => $freelancer->work_experience_year,
            'f_attachments'   => $this->process->get_attachments($bid_id),
            'f_id'            => $freelancer->webuser_id,
            'job_id'          => $this->input->get('job_id'),
            'v_job_id'        => $view_job_id,
            'v_bid_id'        => $view_bid_id,
            'v_user_id'       => $view_user_id
        );
        
        $this->twig->display('webview/twig/applicant', $params);
    }
    
    public function post_message()
    {   
        $sender_id     = (int)$this->session->userdata(USER_ID);
        $freelancer_id = (int)$this->input->post('receiver_id');
        $job_id        = (int)$this->input->post('job_id');
        $bid_id        = (int)$this->input->post('bid_id');
        $_timezone     = $this->input->post('timezone');
        $timezone      = ! empty($_timezone) ? $_timezone : date_default_timezone_get();
        $message       = rtrim(trim($this->input->post('chat_message')));
        
        if(empty($freelancer_id) || empty($job_id) || empty($bid_id))
        {
            $this->ajax_response(array(
                'message' => $this->lang->item('text_job_conversation_refresh_your_browser') ,
                'status'  => 'error'
            ));
        }
        
        if(empty($message))
        {
            $this->ajax_response(array(
                'message' => $this->lang->item('text_job_conversation_empty_message') ,
                'status'  => 'error'
            ));
        }
        
        $this->load->model(array('conversation_model', 'job/bids_model', 'webuser_model'));
        
        $current_date = date('Y-m-d H:i:s');
        $message_item = array(
            "job_id"               => $job_id,
            "bid_id"               => $bid_id,
            "message_conversation" => $message,
            "sender_id"            => $sender_id,
            "receiver_id"          => $freelancer_id,
            "created"              => $current_date,
            "have_seen"            => 1,
        );
        
        //Save message of interview.
        $message_item_id = $this->conversation_model->create($message_item);
        //update the bid state (bid is being in interview process)
        $this->bids_model->update_field($bid_id, 'job_progres_status', 1);
        
        $images = array();        
        if (isset($_FILES['fileupload']) && !empty($_FILES['fileupload'])) 
        {
            $attachment_file = $this->_handle_remove_files_list();
            $images          = $this->_upload_files( $attachment_file, $message_item_id );
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
    
    private function _upload_files( $attachment_file, $insert_id )
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
                if( $this->db->insert('job_conversation_files', array(
                    'job_conversation_id' => $insert_id,
                    'name'                => $new_image_name,
                    'original_name'       => $img
                ))){
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

    public function insert_message() {
        $sender_id = $this->session->userdata(USER_ID);
        $freelancer_id = $this->input->post('receiver_id');
        $job_id = $this->input->post('job_id');
        $bid_id = $this->input->post('bid_id');
        $messsage = $this->input->post('chat-input');
        $form = $_POST;

        if ($bid_id == 0) {
            $this->db->select('*');
            $this->db->from('job_bids');
            $this->db->where('job_bids.user_id', $freelancer_id);
            $this->db->where('job_bids.job_id', $job_id);
            $query = $this->db->get();
            $job_bid_details = $query->result();
            $bid_id = $job_bid_details[0]->id;
        }

        $data = "INSERT INTO job_conversation set job_id = '" . $job_id . "', bid_id = '" . $bid_id . "',  message_conversation = '" . $messsage . "', sender_id = '" . $sender_id . "', receiver_id = '" . $freelancer_id . "', have_seen = 1 ";
        $this->db->query($data);
        $insert_id = $this->db->insert_id();
        $data_up = "UPDATE job_bids SET job_progres_status=1  WHERE id=$bid_id;";
        $this->db->query($data_up);

        if (isset($_FILES['fileupload']) && !empty($_FILES['fileupload'])) {
            $attachment_file = $_FILES["fileupload"];
            $removed_images = (isset($_POST['removed_files']) && !empty($_POST['removed_files'])) ? explode(',', $_POST['removed_files']) : array();
            if (count($removed_images) <= 1 && !empty($removed_images)) {
                if (in_array($removed_images[0], $attachment_file['name'])) {
                    $key = array_search($removed_images[0], $attachment_file['name']);
                    unset($attachment_file['name'][$key]);
                    unset($attachment_file['tmp_name'][$key]);
                }
            } else if (count($removed_images) > 1 && !empty($removed_images)) {
                foreach ($removed_images as $index => $value) {
                    if (in_array($value, $attachment_file['name'])) {
                        $key = array_search($value, $attachment_file['name']);
                        unset($attachment_file['name'][$key]);
                        unset($attachment_file['tmp_name'][$key]);
                    }
                }
            }
            $no_files = count($attachment_file['name']);
            for ($i = 0; $i < $no_files; $i++) {
                if ($attachment_file["error"][$i] > 0) {

                } else {
                    $img = $attachment_file["name"][$i];
                    $file = explode(".", $img);
                    $new_image_name = 'image_' . uniqid() . '.' . 'jpg';
                    move_uploaded_file($attachment_file["tmp_name"][$i], 'uploads/' . $new_image_name);
                    $this->db->insert('job_conversation_files', array(
                        'job_conversation_id' => $insert_id,
                        'name' => $new_image_name,
                        'original_name' => $img
                    ));
                }
            }

            $this->db->select("name");
            $this->db->from("job_conversation_files");
            $this->db->where("job_conversation_id", $insert_id);
            $query = $this->db->get();
            $images = $query->result_array();
        }





        $this->db->select('job_conversation.*,job_conversation.created as conversation_date,webuser.*,jobs.title,wu.webuser_fname as fname,wu.webuser_lname as lname,wu.webuser_id as r_id');

        $this->db->from('job_conversation');

        $this->db->join('webuser', 'job_conversation.sender_id = webuser.webuser_id', 'inner');

        $this->db->join('jobs', 'jobs.id = job_conversation.job_id', 'inner');

        $this->db->join('webuser as wu', 'jobs.user_id = wu.webuser_id', 'inner');

        $this->db->where('job_conversation.bid_id', $bid_id);

        $this->db->order_by("job_conversation.id", "desc");

        $query = $this->db->get();

        $conversation_count = $query->num_rows();

        $result = $query->result();

        /* $condition = " AND webuser_id=" . $this->session->userdata(USER_ID);
          $webUserContactDetails = $this->common_mod->get(WEB_USER_ADDRESS,null,$condition);
          $timezone = $this->timezone->get($webUserContactDetails['rows'][0]['timezone']);
          if (!empty($timezone)) {
          $date2 =  new DateTime(date('Y-m-d h:i:s',strtotime($result[0]->conversation_date)), new DateTimezone('UTC'));
          $date2->setTimezone(new \DateTimezone($timezone['gmt']));

          $time = $date2->format('g:i A');
          } else {
          $time = date('g:i A',strtotime($result[0]->conversation_date));
          } */


        $time = date('g:i A', strtotime($result[0]->conversation_date));
        $html = '';

        if (($result[0]->cropped_image) == "") {

            $src = site_url("assets/user.png");
        } else {

            $src = $result[0]->cropped_image;
        }

        $html .= '<li style="padding:20px">';

        $html .= '<span class="name"><img src="' . $src . '"> ' . $result[0]->webuser_fname . ' ' . $result[0]->webuser_lname . ' </span>';

        $html .= '<span class="chat-date">' . $time . '</span>';

        $html .= '<span class="details">' . $result[0]->message_conversation . '</span>';


        if (isset($images) && !empty($images)) {
            foreach ($images as $key => $value) {
                $html .= '<div class = "chat_image"><a target = "blank" download href = "' . base_url() . 'uploads/' . $value['name'] . '">' . $value['name'] . '</a></div>';
            }
        }

        $html .= '</li>';


        print_r(json_encode($html));
        die;
    }
}