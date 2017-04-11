<?php
//error_reporting(E_ALL);
defined('BASEPATH') OR exit('No direct script access allowed');

class Interview extends CI_Controller{

    private $process;
    private $user_id;
    private $employer;
    
    public function __construct(){
        parent::__construct();
        $this->load->model(array('common_mod', 'Category', 'profile/ProfileModel', 'timezone', 'Webuser_model', 'Process', 'Employer', 'Job_work_diary_model'));
        $this->process = new Process();
        $this->user_id = $this->session->userdata('id');
        $this->employer = new Employer($this->user_id);
    }

    public function index(){
        if ($this->Adminlogincheck->checkx()) {
            if(isset($_GET['user_id'])){
                $user_id = base64_decode($_GET['user_id']);
            } else {
                $user_id = $this->session->userdata(USER_ID);
            }

            if(isset($_GET['job_id'])){
                $job_id = base64_decode($_GET['job_id']);
            }

            if(isset($_GET['bid_id'])){
                $bid_id = base64_decode($_GET['bid_id']);
            }

            $budget = 0;
            $total_work = 0;
            $feedbackScore = 0;
            
            $ended_jobs = $this->process->cnt_ended_jobs($user_id);
            $withdrawn = $this->process->get_withdrawn_by($user_id, $bid_id, $job_id);
            $freelancer_profile = $this->ProfileModel->get_profile($user_id);
            $accepted_jobs = $this->process->accepted_jobs($user_id);
            $freelancer = $this->Webuser_model->load_informations($user_id);
            $pic = $this->Adminforms->getdatax("picture", "webuser", $user_id);
            $country = $this->ProfileModel->get_country($freelancer->webuser_country);
            $skills = $this->ProfileModel->get_skills($user_id);
            $user_rating = $this->Webuser_model->get_total_rating($user_id);
            $_pic = $pic != "" ? $pic : "assets/user.png";
            $conversation = $this->process->get_conversation($job_id, $bid_id);
            $status = $this->Webuser_model->is_active($user_id);

            foreach($conversation['data'] AS $_convo){
                $images = $this->process->get_convo_images($_convo->id);
            }

            foreach($accepted_jobs AS $a_jobs){
                $feedbacks = $this->process->get_feedbacks($a_jobs->fuser_id, $a_jobs->job_id);
                $diary = $this->Job_work_diary_model->get_work_hours($a_jobs->fuser_id, $a_jobs->job_id);

                foreach($diary AS $_diary){
                    $total_work += $_diary->total_hour;
                }

                if($a_jobs->jobstatus == 1){
                    if(!empty($feedbacks)){
                        if($a_jobs->job_type == 'fixed'){
                            $price = $a_jobs->fixedpay_amount;
                            $feedbackScore += ($feedbacks['feedback_score'] * $price);
                            $budget += $price;
                        }else{

                            if($a_jobs->offer_bid_amount){
                                $amount = $a_jobs->offer_bid_amount;
                            }else{
                                $amount = $a_jobs->bid_amount;
                            }

                            $price = $a_jobs->fixedpay_amount * $amount;
                            $feedbackScore += ($feedbacks['feedback_score'] * $price);
                            $budget += $price;
                        }
                    }
                }
            }

            $condition = " AND webuser_id=" . $this->session->userdata(USER_ID);
            $webUserContactDetails = $this->common_mod->get(WEB_USER_ADDRESS,null,$condition);
            $timezone = $this->timezone->get($webUserContactDetails['rows'][0]['timezone']);
            $params['timezone'] = $timezone;

            if(isset($_GET['job_id'])){
                $job_info = $this->process->get_job_info($user_id, $job_id);
            }
            
            $this->db->select("*");
            $this->db->from("job_bid_attachments");
            $this->db->where("job_bid_id = ", $bid_id);
            $query = $this->db->get();
            $attachments = $query->result_array();

            if(!empty($freelancer)){
                if(!empty($freelancer_profile)){
                    $params = array(
                        'ended_jobs' => $ended_jobs,
                        'budget' => $budget,
                        'feedback_score' => $feedbackScore,
                        'total_work' => $total_work,
                        'tagline' => ucfirst($freelancer_profile['tagline']),
                        'country' => ucfirst($country['country_name']),
                        'status' => $status,
                        'title' => 'Interviews - Winjob',
                        'slag' => strtolower(str_replace(' ', '-', $freelancer->webuser_fname .'-'. $freelancer->webuser_lname)),
                        'fname' => $freelancer->webuser_fname,
                        'lname' => $freelancer->webuser_lname,
                        'cropped_img' => $freelancer->cropped_image,
                        'freelancer_id' => $freelancer->webuser_id,
                        'skills' => $skills,
                        'job_info' => $job_info,
                        'rating' => $user_rating,
                        'conversation' => $conversation,
                        'hourly_rate' => $freelancer_profile['hourly_rate'],
                        'exp' => $freelancer_profile['work_experience_year'],
                        'f_attachments' => $attachments,
                        'f_id' => $freelancer->webuser_id
                    );

                    $this->Admintheme->webview2("interview", $params);
                }else{
                    redirect(site_url("profile/basic"));
                }
            }
        }else{
            redirect(site_url("signin"));
        }
    }

	

	public function insert_message(){

		$sender_id = $this->session->userdata(USER_ID);

		$freelancer_id = $this->input->post('receiver_id');

		$job_id = $this->input->post('job_id');

		$bid_id = $this->input->post('bid_id');

		$messsage = $this->input->post('chat-input');
		$form = $_POST;
		

		if($bid_id == 0){

			

			$this->db->select('*');

			$this->db->from('job_bids');

			$this->db->where('job_bids.user_id', $freelancer_id);

			$this->db->where('job_bids.job_id', $job_id); 

			$query=$this->db->get();

			$job_bid_details = $query->result();

			$bid_id = $job_bid_details[0]->id;

		}

		



		$data = "INSERT INTO job_conversation set job_id = '".$job_id."', bid_id = '".$bid_id."',  message_conversation = '".$messsage."', sender_id = '".$sender_id."', receiver_id = '".$freelancer_id."', have_seen = 1 ";

		$this->db->query($data);

		$insert_id = $this->db->insert_id();

		// added by jahid start 
                
               $data_up = "UPDATE job_bids SET job_progres_status=1  WHERE id=$bid_id;";
	       $this->db->query($data_up);
                
                // added by jahid end 



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
                    	$this->db->insert('job_conversation_files',array(
							'job_conversation_id' => $insert_id,
							'name' => $new_image_name,
							'original_name' => $img
						));
	                }
	            }
	            // get images to show
		        $this->db->select("name");
				$this->db->from("job_conversation_files");
				$this->db->where("job_conversation_id",$insert_id);
				$query=$this->db->get();
				$images = $query->result_array();
	        }

		

		

		$this->db->select('job_conversation.*,job_conversation.created as conversation_date,webuser.*,jobs.title,wu.webuser_fname as fname,wu.webuser_lname as lname,wu.webuser_id as r_id');

		$this->db->from('job_conversation');

		$this->db->join('webuser', 'job_conversation.sender_id = webuser.webuser_id', 'inner');

		$this->db->join('jobs', 'jobs.id = job_conversation.job_id', 'inner');

		$this->db->join('webuser as wu', 'jobs.user_id = wu.webuser_id', 'inner');

		$this->db->where('job_conversation.bid_id', $bid_id);

		$this->db->order_by("job_conversation.id", "desc"); 

		$query=$this->db->get();

		$conversation_count = $query->num_rows();

		$result = $query->result();

		/*$condition = " AND webuser_id=" . $this->session->userdata(USER_ID);
		$webUserContactDetails = $this->common_mod->get(WEB_USER_ADDRESS,null,$condition);
        $timezone = $this->timezone->get($webUserContactDetails['rows'][0]['timezone']);
		if (!empty($timezone)) {
			$date2 =  new DateTime(date('Y-m-d h:i:s',strtotime($result[0]->conversation_date)), new DateTimezone('UTC'));
			$date2->setTimezone(new \DateTimezone($timezone['gmt']));

			$time = $date2->format('g:i A');
		} else {
			$time = date('g:i A',strtotime($result[0]->conversation_date));
		}*/

		
                $time = date('g:i A',strtotime($result[0]->conversation_date));
		$html = '';

		if(($result[0]->cropped_image) == "") { 

				$src = site_url("assets/user.png");

			 } else { 

				$src = $result[0]->cropped_image;

			 } 

			$html .='<li style="padding:20px">';

			$html .='<span class="name"><img src="'.$src.'"> '.$result[0]->webuser_fname.' '.$result[0]->webuser_lname.' </span>';

			$html .='<span class="chat-date">'.$time.'</span>';

			$html .='<span class="details">'.$result[0]->message_conversation.'</span>';


			if(isset($images) && !empty($images)){
				foreach ($images as $key => $value) {
					$html .= '<div class = "chat_image"><a target = "blank" download href = "'.base_url().'uploads/'.$value['name'].'">'.$value['name'].'</a></div>';
				}
			}

			$html .='</li>';


		print_r(json_encode($html)); die;

		

	}

	

	

	

}



?>