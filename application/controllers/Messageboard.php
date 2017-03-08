<?php

defined('BASEPATH') OR exit('No direct script access allowed');
// require_once './vendor/google-api-php-client/src/Google/autoload.php';

class Messageboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        //$this->load->model(array('Category', 'Common_mod'));
        //$this->load->model("Category");
        //$this->load->model("Common_mod");
        $this->load->model(array('common_mod', 'Category', 'profile/ProfileModel'));
        $this->load->model(array('timezone'));
    }

    public function index()
    {

		if($this->Adminlogincheck->checkx()) {
			$user_id = $this->session->userdata('id');
			$this->db->select('jc.id, jc.job_id, jc.bid_id, jc.message_conversation, jc.sender_id, jc.receiver_id, jc.created, jc.have_seen,'
					.'webuser.webuser_fname, webuser.webuser_lname, webuser.cropped_image, webuser.webuser_email,'
					.'jobs.title, 0 as is_ticket');
			$this->db->from('job_conversation jc');
			$this->db->join('webuser', 'jc.sender_id = webuser.webuser_id', 'inner');
			$this->db->join('jobs', 'jobs.id = jc.job_id', 'inner');
			$this->db->where('jc.receiver_id', $user_id);
			//$this->db->where('job_conversation.have_seen', 1);

			//added by Sergey
			// $this->db->order_by("job_conversation.id", "desc");
			//$this->db->group_by('bid_id');


			$query_job = $this->db->get_compiled_select();

			// select ticket message
			$this->db->select('wtm.id, wtm.ticket_id as job_id, wtm.ticket_id as bid_id, wt.subject as message_conversation,'
						.'wtm.sender_id, wtm.receiver_id, wtm.created, wtm.have_seen,'
						.' "" as webuser_fname, '
						.'"" as webuser_lname,'
						.'if(wtm.sender="user", webuser.cropped_image, "") as cropped_image,'
						.'if(wtm.sender="user", webuser.webuser_email, user.email) as webuser_email, "Support" as title, '
						.'1 as is_ticket');
			$this->db->from('webuser_ticket_messages wtm');
			$this->db->join('user', 'wtm.sender_id = user.id and sender = "support" ', 'left');
			$this->db->join('webuser', 'wtm.sender_id = webuser.webuser_id and sender = "user" ', 'left');
			$this->db->join('webuser_tickets wt', 'wt.id = wtm.ticket_id', 'inner');
			$this->db->where('wt.webuser_id', $user_id);
			$query_ticket = $this->db->get_compiled_select();

			$query = $this->db->query($query_job . ' UNION ALL ' . $query_ticket . ' Order by 7 desc, 1 desc');

			//$query=$this->db->get();
			$conversation_count = $query->num_rows();
			$result = $query->result();
			$data['messages'] = $result;

		if(!empty($result)) {

			$condition = " AND webuser_id=" . $this->session->userdata(USER_ID);
			$webUserContactDetails = $this->common_mod->get(WEB_USER_ADDRESS,null,$condition);
            $timezone = $this->timezone->get($webUserContactDetails['rows'][0]['timezone']);
            $data['timezone'] = $timezone;

			if(isset($_GET['bid_id'])){

				$bid_id = base64_decode($_GET['bid_id']);

			} else {

				$bid_id = $result['0']->bid_id;
				$is_ticket = $result['0']->is_ticket;
			}

			// modify by Sergey start
			if ( $is_ticket == 0 ) {
				$sql = "update job_conversation set have_seen = 0 where bid_id = '".$bid_id."'";
				$query = $this->db->query($sql);


				$this->db->select('job_conversation.*,webuser.*,jobs.title,wu.webuser_fname as fname,wu.webuser_lname as lname,'
							.'wu.webuser_id as r_id,job_conversation.created created, 0 as is_ticket');
				$this->db->from('job_conversation');
				$this->db->join('webuser', 'job_conversation.sender_id = webuser.webuser_id', 'inner');
				$this->db->join('jobs', 'jobs.id = job_conversation.job_id', 'inner');
				$this->db->join('webuser as wu', 'jobs.user_id = wu.webuser_id', 'inner');
				//$this->db->where('job_conversation.receiver_id', $user_id);
				$this->db->where('job_conversation.bid_id', $bid_id);
				//$this->db->where('job_conversation.sender_id', $sender_id);
				//$this->db->where('job_conversation.have_seen', 1);
				$this->db->order_by("job_conversation.id", "desc");
				//$this->db->group_by('bid_id');
				$query=$this->db->get();
				$conversation_count = $query->num_rows();
				$result1 = $query->result();
				// added by Armen start
				// get images
				foreach ($result1 as $key => $value) {
					$this->db->select('*');
					$this->db->from('job_conversation_files');
					$this->db->where('job_conversation_id', $value->id);
					$query = $this->db->get();
					$images = $query->result();
					$result1[$key]->images_array = $images;
				}
				// added by Armen end

			} else {
				$sql = "update webuser_ticket_messages set have_seen = 0 where ticket_id = '".$bid_id."'";
				$query = $this->db->query($sql);

				$this->db->select('wtm.id, wtm.ticket_id as job_id, wtm.ticket_id as bid_id, wtm.message as message_conversation,'
					.'wtm.sender_id, wtm.receiver_id, wtm.created, wtm.have_seen,'
					.' "Support" as fname, if(wtm.sender="user", webuser.webuser_fname, "Support") as webuser_fname,'
					. ' webuser.webuser_lname, webuser.cropped_image,  wt.subject as title, '
					.'wtm.created as created, 1 as is_ticket');
				$this->db->from('webuser_ticket_messages wtm');
				$this->db->join('user', 'wtm.sender_id = user.id and sender = "support" ', 'left');
				$this->db->join('webuser', 'wtm.sender_id = webuser.webuser_id and sender = "user"', 'left');
				$this->db->join('webuser_tickets wt', 'wt.id = wtm.ticket_id', 'inner');
				$this->db->where('wtm.ticket_id', $bid_id);
				$this->db->order_by("wtm.id", "desc");

				$query=$this->db->get();
				$conversation_count = $query->num_rows();
				$result1 = $query->result();
				// added by Armen start
				// get images
				foreach ($result1 as $key => $value) {
					$this->db->select('*');
					$this->db->from('webuser_ticket_message_files');
					$this->db->where('message_id', $value->id);
					$query = $this->db->get();
					$images = $query->result();
					$result1[$key]->images_array = $images;
				}
				// added by Armen end



			}

			// modify by Sergey end


			$data['chat_details'] = $result1;

		}


			$this->Admintheme->webview("message_board", $data);
		} else {
			redirect('/');
		}

    }

	public function chatdetails()

    {
			$bid_id = $this->input->post('bid_id');
			//$sender_id = $this->input->post('sender_id');

			//added by Sergey start
			$is_ticket = $this->input->post('is_ticket');

			if ( $is_ticket == 0 ) {
				$sql = "update job_conversation set have_seen = 0 where bid_id = '".$bid_id."'";
				$query = $this->db->query($sql);

				$user_id = $this->session->userdata('id');
				$this->db->select('job_conversation.*,webuser.*,jobs.title,wu.webuser_fname as fname,wu.webuser_lname as lname,'
							.'wu.webuser_id as r_id, job_conversation.created created, 0 as is_ticket');
				$this->db->from('job_conversation');
				$this->db->join('webuser', 'job_conversation.sender_id = webuser.webuser_id', 'inner');
				$this->db->join('jobs', 'jobs.id = job_conversation.job_id', 'inner');
				$this->db->join('webuser as wu', 'jobs.user_id = wu.webuser_id', 'inner');
				//$this->db->where('job_conversation.receiver_id', $user_id);
				$this->db->where('job_conversation.bid_id', $bid_id);
				//$this->db->where('job_conversation.sender_id', $sender_id);
				//$this->db->where('job_conversation.have_seen', 1);
				$this->db->order_by("job_conversation.id", "desc");
				//$this->db->group_by('bid_id');
				$query=$this->db->get();
				$conversation_count = $query->num_rows();
				$result = $query->result();
				//$data['messages'] = $result;
				//print_r($result); die;
			} else {
				$sql = "update webuser_ticket_messages set have_seen = 0 where ticket_id = '".$bid_id."'";
				$query = $this->db->query($sql);

				$this->db->select('wtm.id, wtm.ticket_id as job_id, wtm.ticket_id as bid_id, wtm.message as message_conversation,'
					.'wtm.sender_id, wtm.receiver_id, wtm.created, wtm.have_seen,'
					.' "Support" as fname, if(wtm.sender="user", webuser.webuser_fname, "Support") as webuser_fname,'
					. ' webuser.webuser_lname, webuser.cropped_image,  wt.subject as title, '
					.'wtm.created as created, 1 as is_ticket');
				$this->db->from('webuser_ticket_messages wtm');
				$this->db->join('user', 'wtm.sender_id = user.id and sender = "support" ', 'left');
				$this->db->join('webuser', 'wtm.sender_id = webuser.webuser_id and sender = "user"', 'left');
				$this->db->join('webuser_tickets wt', 'wt.id = wtm.ticket_id', 'inner');
				$this->db->where('wtm.ticket_id', $bid_id);
				$this->db->order_by("wtm.id", "desc");

				$query=$this->db->get();
				$conversation_count = $query->num_rows();
				$result = $query->result();
			}


			$html = '';

			$html .='<div class="chat-details-topbar">';
			$html .='<h3>'.$result[0]->fname.' '.$result[0]->lname.'</h3>';
			$html .='<h5>'.$result[0]->title.'</h5>';
			$html .='<p></p>';
			$html .='</div>';
			$html .='<div class="chat-details">';
			$html .='<ul id="scroll-ul">';

			$result = array_reverse($result);
			$group_time = false;
			$current_date = strtotime(date("d-m-Y"));
			$date ='';$temp_date ='';

			$condition = " AND webuser_id=" . $this->session->userdata(USER_ID);
			$webUserContactDetails = $this->common_mod->get(WEB_USER_ADDRESS,null,$condition);
            $timezone = $this->timezone->get($webUserContactDetails['rows'][0]['timezone']);


			foreach($result as $data){

			if (!empty($timezone)) {
			$date2 =  new DateTime(date('Y-m-d h:i:s',strtotime($data->created)), new DateTimezone('UTC'));
			$date2->setTimezone(new \DateTimezone($timezone['gmt']));

			$time = $date2->format('g:i A');
			} else {
			$time = date('g:i A',strtotime($data->created));
			}
				if(($data->cropped_image) == "") {
					$src = site_url("assets/user.png");
			 	} else {
					$src = $data->cropped_image;
			 	}
			 	$temp_date = date("d-m-Y", strtotime($data->created));
				if($date != strtotime($temp_date)){
					$date = strtotime($temp_date);
					$group_time = true;
				}
				else {
					$group_time = false;
				}
				// added by Armen start
				if ( $is_ticket == 0 ) {
					// get images to show
			        $this->db->select("name");
					$this->db->from("job_conversation_files");
					$this->db->where("job_conversation_id",$data->id);
					$query=$this->db->get();
					$images = $query->result_array();
				}else{
					// get images to show
			        $this->db->select("name");
					$this->db->from("webuser_ticket_message_files");
					$this->db->where("message_id",$data->id);
					$query=$this->db->get();
					$images = $query->result_array();
				}
				// added by Armen end


			 	if($group_time) {

					if($date == $current_date) {
						$grp_dt = "Today";
					} else {
						$grp_dt = date("l, F j, Y", $date);
					}

					$html .='<li>';
					$html .='<span class="group-date">'.$grp_dt.'</span>';
					$html .='</li>';
			 	}

				$html .='<li>';
				$html .='<span class="name"><img src="'.$src.'"> '.$data->webuser_fname.' '.$data->webuser_lname.' </span>';
				$html .='<span class="chat-date">'.$time.'</span>';
				$html .='<span class="details">'.$data->message_conversation.'</span>';


				// added by Armen start
				if(isset($images) && !empty($images)){
					foreach ($images as $key => $value) {
						$html .= '<div class = "chat_image"><a target = "blank" download href = "'.base_url().'uploads/'.$value['name'].'">'.$value['name'].'</a></div>';
					}
				}
				// added by Armen end

				$html .='</li>';
			}
				$html .='</ul>';
				$html .='</div>';

				$html .='<div class="chat-bar">';
				$html .='<form id="chat_form" action="">';
				$html .='<input type="hidden" id="job_id" name="job_id" value="'.$result[0]->job_id.'">';
				$html .='<input type="hidden" id="bid_id" name="bid_id" value="'.$result[0]->bid_id.'">';
				$html .='<input type="hidden" id="bid_id" name="r_id" value="'.$result[0]->r_id.'">';
				$html .='<input type="hidden" id="is_ticket" name="is_ticket" value="'.$result[0]->is_ticket.'">';
				$html .='<div class="textarea_wrapper" style="width:80%;float: left;height: 100px;">';
				$html .='<div class = "attach_icon">';
				$html .='<i class="fa fa-paperclip" aria-hidden="true"></i>';
				$html .='</div>';
				$html .='<div class = "uploaded_files">';
				$html .='</div>';
				$html .='<input type = "hidden" name = "removed_files" value = "" id = "removed_files">';
				$html .='<input type="file" name="fileupload[]" class = "hidden" value="fileupload" id="fileupload" multiple>';
				$html .='<textarea name="chat-input" class="form-control" required="" id="chat-input"></textarea>';
				$html .='</div>';
				$html .='<div style="width:20%;float: left;height: 100px;"><a href="" id="chat-btn">SEND</a></div>';
				$html .='</form>';
				$html .='</div>';

			print_r(json_encode($html)); die;
	}
	function chatinsert() {

		// parse_str($_POST['form'], $form);
		$form = $_POST;
		$user_id = $this->session->userdata('id');

		//added by Sergey start
		$is_ticket =  $form['is_ticket'];

		if ($is_ticket == 0 ) {

			$data = "INSERT INTO job_conversation set job_id = '".$form['job_id']."', bid_id = '".$form['bid_id']."',  message_conversation = '".$form['chat-input']."', sender_id = '".$user_id."', receiver_id = '".$form['r_id']."', have_seen = 1 ";

			$this->db->query($data);
			$msg_id = $this->db->insert_id();

			$this->db->select('job_conversation.*, job_conversation.created as conversation_date,webuser.*,jobs.title,wu.webuser_fname as fname,wu.webuser_lname as lname,wu.webuser_id as r_id');
			$this->db->from('job_conversation');
			$this->db->join('webuser', 'job_conversation.sender_id = webuser.webuser_id', 'inner');
			$this->db->join('jobs', 'jobs.id = job_conversation.job_id', 'inner');
			$this->db->join('webuser as wu', 'jobs.user_id = wu.webuser_id', 'inner');
			//$this->db->where('job_conversation.receiver_id', $user_id);
			$this->db->where('job_conversation.bid_id', $form['bid_id']);
			//$this->db->where('job_conversation.sender_id', $sender_id);
			//$this->db->where('job_conversation.have_seen', 1);
			$this->db->order_by("job_conversation.id", "desc");
			//$this->db->group_by('bid_id');
			$query=$this->db->get();
			$conversation_count = $query->num_rows();
			$result = $query->result();

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
                    	$this->db->insert('job_conversation_files',array(
							'job_conversation_id' => $msg_id,
							'name' => $new_image_name,
							'original_name' => $img
						));
	                }
	            }
	            // get images to show
		        $this->db->select("name");
				$this->db->from("job_conversation_files");
				$this->db->where("job_conversation_id",$msg_id);
				$query=$this->db->get();
				$images = $query->result_array();
	        }

			// added by Armen end



		} else {

			// insert ticket message
			$this->db->insert('webuser_ticket_messages',array(
				'ticket_id' => $form['bid_id'],
				'sender_id' => $user_id,
				'receiver_id' => '',
				'message' => $form['chat-input'],
				'status' => 'green',
				'created' => date("Y-m-d H:m:s"),
				'have_seen' => 1,
				'sender' => 'user',
				'receiver' => 'support'
			));
			$ticketMessageID = $this->db->insert_id();

			// added by Armen start

			if (isset($_FILES['fileupload']) && !empty($_FILES['fileupload'])) {
				$attachment_file = $_FILES["fileupload"];
	            $no_files = count($attachment_file['name']);
	            for ($i = 0; $i < $no_files; $i++) {
	                if ($attachment_file["error"][$i] > 0) {
	                    // echo "Error: " . $attachment_file["error"][$i] . "<br>";
	                } else {
	                	$img = $attachment_file["name"][$i];
	                	$file = explode(".",$img);
	                	$new_image_name = 'image_' . uniqid() .'.'. end($file);
                        move_uploaded_file($attachment_file["tmp_name"][$i], 'uploads/' . $new_image_name);
                    	$this->db->insert('webuser_ticket_message_files',array(
							'message_id' => $ticketMessageID,
							'name' => $new_image_name,
							'original_name' => $img
						));
	                }
	            }
	           	// get images to show
		        $this->db->select("name");
				$this->db->from("webuser_ticket_message_files");
				$this->db->where("message_id",$ticketMessageID);
				$query=$this->db->get();
				$images = $query->result_array();
	        }


			// added by Armen end



			$this->db->select("fname, lname, email, subject");
			$this->db->from("webuser_tickets");
			$this->db->where("id",$form['bid_id']);
			$query=$this->db->get();
			$ticket = $query->result();

			if ( !empty($ticket) ) {
				$body = 'Message from '.$ticket[0]->fname.' '.$ticket[0]->lname
					.'<br>Email : '.$ticket[0]->email
					.'<br>Ticket ID# : '.$form['bid_id']
					.'<br> '.nl2br($form['chat-input']);
				$email = "support@winjob.com";
				$response=$this->Sesmailer->sesemail($email,"New Message From Winjob", $body);
			}

			$this->db->select('wtm.id, wtm.ticket_id as job_id, wtm.ticket_id as bid_id, wtm.message as message_conversation,'
				.'wtm.sender_id, wtm.receiver_id, wtm.created, wtm.have_seen,'
				.' "Support" as fname, if(wtm.sender="user", webuser.webuser_fname, "Support") as webuser_fname,'
				. ' webuser.webuser_lname, webuser.cropped_image,  wt.subject as title, '
				.'wtm.created as conversation_date, 1 as is_ticket');
			$this->db->from('webuser_ticket_messages wtm');
			$this->db->join('user', 'wtm.sender_id = user.id and sender = "support" ', 'left');
			$this->db->join('webuser', 'wtm.sender_id = webuser.webuser_id and sender = "user"', 'left');
			$this->db->join('webuser_tickets wt', 'wt.id = wtm.ticket_id', 'inner');
			$this->db->where('wtm.ticket_id', $form['bid_id']);
			$this->db->order_by("wtm.id", "desc");

			$query=$this->db->get();
			$conversation_count = $query->num_rows();
			$result = $query->result();
		}


			$condition = " AND webuser_id=" . $this->session->userdata(USER_ID);
			$webUserContactDetails = $this->common_mod->get(WEB_USER_ADDRESS,null,$condition);
            $timezone = $this->timezone->get($webUserContactDetails['rows'][0]['timezone']);
			if (!empty($timezone)) {
				$date2 =  new DateTime(date('Y-m-d h:i:s',strtotime($result[0]->conversation_date)), new DateTimezone('UTC'));
				$date2->setTimezone(new \DateTimezone($timezone['gmt']));

				$time = $date2->format('g:i A');
			} else {
				$time = date('g:i A',strtotime($result[0]->conversation_date));
			}

		//added by Sergey end
		$html = '';
		if(($result[0]->cropped_image) == "") {
			$src = site_url("assets/user.png");
	 	} else {
			$src = $result[0]->cropped_image;
	 	}
		$html .='<li>';
		$html .='<span class="name"><img src="'.$src.'"> '.$result[0]->webuser_fname.' '.$result[0]->webuser_lname.' </span>';
		$html .='<span class="chat-date">'.$time.'</span>';
		$html .='<span class="details">'.$result[0]->message_conversation.'</span>';
		// added by Armen start
		if(isset($images) && !empty($images)){
			foreach ($images as $key => $value) {
				$html .= '<div class = "chat_image"><a target = "blank" download href = "'.base_url().'uploads/'.$value['name'].'">'.$value['name'].'</a></div>';
			}
		}
		// added by Armen end
		$html .='</li>';

		print_r(json_encode($html)); die;
	}

}
