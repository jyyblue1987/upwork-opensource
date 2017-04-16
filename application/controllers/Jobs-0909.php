<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Jobs extends CI_Controller
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

    public function create()
    {
        if ($this->Adminlogincheck->checkx())
        {
            $data = array('js' => array('vendor/jquery.form.js', 'internal/job_create.js'),);
            $this->Admintheme->webview("jobs/create_job", $data);
        }
        if ($this->input->post('title'))
        {

            if (isset($_FILES['userfile']['name']) && ($_FILES['userfile']['name'] != ''))
            {
                $ext = pathinfo($_FILES['userfile']['name'], PATHINFO_EXTENSION);
                $newFileName = time() . rand(0000, 9999) . $this->session->userdata('id') . '.' . $ext;
                $source = $_FILES['userfile']['tmp_name'];
                $dest = './uploads/' . $newFileName;
                if (move_uploaded_file($source, $dest))
                {
                    $dbPath = '/uploads/' . $newFileName;
                } else
                {
                    $rs = array('code' => '0', 'msg' => '<div class="alert alert-danger">
  <strong>Error!</strong> Error in uploading file.
</div>');
                    echo json_encode($rs);
                    die;
                }
            }
            if ($this->input->post('submitbtn') == '0')
            {
                $data = $this->input->post();
                if (isset($dbPath))
                    $data['userfile'] = $dbPath;
                $data['user_id'] = $this->session->userdata('id');
                $this->session->set_userdata('preview', $data);
                $rs = array('code' => '1', 'id' => '0');
                echo json_encode($rs);
            }
            else
            {
                //save
                $data = $this->input->post();
                if (isset($dbPath))
                    $data['userfile'] = $dbPath;
                $data['user_id'] = $this->session->userdata('id');
                unset($data['submitbtn']);
                if ($this->db->insert('jobs', $data))
                {
                    $insert_id = $this->db->insert_id();
                    $rs = array('code' => '0', 'id' => base64_encode($insert_id), 'type' => $data['job_type']);
                    echo json_encode($rs);
                } else
                {
                    $rs = array('code' => '0', 'msg' => '<div class="alert alert-danger">
  <strong>Error!</strong> Error occured.Try again.
</div>');
                    echo json_encode($rs);
                }
            }
            die();
        }
    }

    public function savePostSession()
    {

        $data = $this->session->userdata('preview');
        unset($data['submitbtn']);
        if ($this->input->post('submitbtn'))
        {
            if ($this->db->insert('jobs', $data))
            {
                $insert_id = $this->db->insert_id();
                redirect("/jobs/view_" . $data['job_type'] . "/" . base64_encode($insert_id));
            }
        }
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function find($offsetId = null)
    {
        if ($this->Adminlogincheck->checkx())
        {
            $id = $this->session->userdata(USER_ID);
            //get users job category//
            $user_categories = $this->Category->get_user_subcategories($this->session->userdata('id'));
            if (sizeof($user_categories) > 0)
            {
                $sql = " AND subcat_id IN (";
                foreach ($user_categories as $sub)
                {
                    $sql .=$sub->subcat_id . ",";
                }
                $sql = substr($sql, 0, strlen($sql) - 1) . ") ";

                $subCateList = $this->Common_mod->getColsVal(SUBCATEGORY_TABLE, array("subcategory_name"), $sql);
            }

            $limit = 10;
            if ($this->input->is_ajax_request())
            {
                $offset = $offsetId * $limit;
            } else
            {
                $offset = 0;
            }
            $records = array();
            $this->db->join('webuser', 'webuser.webuser_id=jobs.user_id', 'left');
            $this->db->order_by("jobs.id", "desc");
            $query = $this->db->get_where('jobs', array('1' => '1'), $limit, $offset);
            if ($query->num_rows() > 0)
                $records = $query->result();
            if ($this->input->is_ajax_request())
            {
                $data = array('records' => $records, 'limit' => $limit);
                $this->load->view('webview/jobs/content', $data);
            } else
            {
				
				
				$user_id = $this->session->userdata('id');			
				$this->db->select('*');
				$this->db->from('job_bids');
				$this->db->join('jobs', 'jobs.id=job_bids.job_id', 'inner');
				$this->db->join('job_conversation', 'job_conversation.job_id=jobs.id', 'inner');
				$this->db->where('job_bids.user_id',$user_id);
				$this->db->where('job_bids.status',0);
				$this->db->group_by('job_conversation.job_id');
				$query=$this->db->get();
				$intervier_no = $query->num_rows();
				//$record = $query->result();
				
				
				
                $data = array('js' => array('internal/find_job.js'), 'records' => $records, 'limit' => $limit, 'no_of_interview'=>$intervier_no);
                if (isset($subCateList) && !empty($subCateList))
                {
                    $data['subCateList'] = $subCateList['rows'];
                } else
                {
                    $data['subCateList'] = "";
                }
                $this->Admintheme->webview("jobs/find-jobs", $data);
            }
        } else
        {
            redirect(site_url("signin"));
        }
    }

    public function apply_hourly()
    {
        if ($this->Adminlogincheck->checkx())
        {
            $data = [];
            $this->Admintheme->webview("jobs/apply_hourly", $data);
        }
    }

    public function apply_fixed()
    {
        if ($this->Adminlogincheck->checkx())
        {
            $data = [];
            $this->Admintheme->webview("jobs/apply_fixed", $data);
        }
    }

    public function preview_fixed()
    {
        if ($this->Adminlogincheck->checkx() && $this->session->userdata('preview'))
        {
            $data = array('data' => $this->session->userdata('preview'));
            $this->Admintheme->webview("jobs/job_preview_fixed", $data);
        }
    }

    public function preview_hourly()
    {
        if ($this->Adminlogincheck->checkx() && $this->session->userdata('preview'))
        {
            $data = array('data' => $this->session->userdata('preview'));
            $this->Admintheme->webview("jobs/job_preview_hourly", $data);
        }
    }

    public function status()
    {
        if ($this->Adminlogincheck->checkx())
        {
            $id = $this->session->userdata('id');
            $this->db->join('webuser', 'webuser.webuser_id=jobs.user_id', 'left');
            $this->db->order_by("jobs.id", "desc");
            $query = $this->db->get_where('jobs', array('user_id' => $id));
            $records = $query->result();
            $data = array('records' => $records);
            $this->Admintheme->webview("jobs/job_status", $data);
        }
    }

    public function view_hourly()
    {
        if ($this->Adminlogincheck->checkx())
        {
            $data = [];
            $this->Admintheme->webview("jobs/view_hourly", $data);
        }
    }

    public function view_fixed()
    {
        if ($this->Adminlogincheck->checkx())
        {
            $data = array('data' => $this->session->userdata('preview'));
            $this->Admintheme->webview("jobs/view_fixed", $data);
        }
    }

    public function view($title = null, $postId = null)
    {
        if ($this->Adminlogincheck->checkx())
        {
              $postId = base64_decode($postId);
             $id = $this->session->userdata('id');
     
        
            $this->db->join('webuser', 'webuser.webuser_id=jobs.user_id', 'left');
            $this->db->order_by("jobs.id", "desc");
            $query = $this->db->get_where('jobs', array('id' => $postId));
            $record = $query->row();
            $query = $this->db->get_where('job_bids', array('job_id' => $postId, 'user_id' => $id, 'status!=1' => null));
            $bids_details = $query->row();
            $is_applied  = $query->num_rows();
            
            
            //conversation
            $conversation_count = 0;
            $conversation = array();
            
            if( $is_applied ){     
                $this->db->select('*');
                $this->db->from('job_conversation');
                $this->db->where('job_conversation.receiver_id', $id);
                $this->db->where('job_conversation.job_id', $postId);
                $this->db->where('job_conversation.bid_id', $bids_details->id);
                
                $query=$this->db->get();// assign to a variable
                $conversation_count = $query->num_rows();// then use num rows
     
                
               
                if( $conversation_count ){
                
                    $this->db->select('job_conversation.*,webuser.*');
                    $this->db->from('job_conversation');
                    $this->db->join('webuser', 'job_conversation.sender_id = webuser.webuser_id', 'inner');
                    $this->db->where('job_conversation.job_id', $postId);
                    $this->db->where('job_conversation.bid_id', $bids_details->id);
                    $this->db->order_by("job_conversation.id", "ASC");
                    $query_conversation=$this->db->get();
                    $conversation =  $query_conversation->result();
                }
            }
			   
            $data = array('value' => $record, 'applied' => $is_applied, 'conversations' => $conversation, 'conversation_count' => $conversation_count, 'bid_details'=>$bids_details);
            $this->Admintheme->webview("jobs/view", $data);
        }
    }

    public function apply($title = null, $postId = null)
    {
        if ($this->Adminlogincheck->checkx())
        {
            if ($this->input->post('job_id'))
            {
                $id = $this->session->userdata('id');
                $check = $this->db->get_where('job_bids', array('job_id' => $this->input->post('job_id'), 'user_id' => $id, 'status!=1' => null));
                if ($check->num_rows() > 0)
                {
                    $rs = array('code' => '0', 'msg' => '<div class="alert alert-warning">
                    <strong>Warning!</strong> You have already applied for this job.
                  </div>');
                    echo json_encode($rs);
                    die;
                }
                $data = $this->input->post();
                $data['user_id'] = $this->session->userdata('id');
                $title = $data['job_title'];
                unset($data['job_title']);
                $data['bid_fee'] = round($data['bid_amount'] / 10, 2);
                $data['bid_earning'] = $data['bid_amount'] - $data['bid_fee'];
                if ($this->db->insert('job_bids', $data))
                {
                    $insert_id = $this->db->insert_id();
                    if (isset($_FILES['file']['name']) && (!empty($_FILES['file']['name'])))
                    {
                        for ($i = 0; $i < count($_FILES['file']['name']); $i++)
                        {
                            $ext = pathinfo($_FILES['file']['name'][$i], PATHINFO_EXTENSION);
                            $newFileName = time() . rand(0000, 9999) . $this->session->userdata('id') . '.' . $ext;
                            $source = $_FILES['file']['tmp_name'][$i];
                            $dest = './uploads/' . $newFileName;
                            move_uploaded_file($source, $dest);
                            $dbPath = '/uploads/' . $newFileName;
                            $dataAttach = array('job_bid_id' => $insert_id, 'path' => $dbPath);
                            $this->db->insert('job_bid_attachments', $dataAttach);
                        }
                    }
                    $rs = array('code' => '1', 'msg' => '');
                    $this->session->set_flashdata('msg', 'You have successfully submitted proposal for ' . $title);
                    echo json_encode($rs);
                } else
                {
                    $rs = array('code' => '0', 'msg' => '<div class="alert alert-warning">
                    <strong>Warning!</strong>Something went wrong.
                  </div>');
                    echo json_encode($rs);
                }
                die;
            }
            $postId = base64_decode($postId);
            //$id = $this->session->userdata('id');
            $this->db->select(array('*', 'jobs.id as job_id'));
            $this->db->join('webuser', 'webuser.webuser_id=jobs.user_id', 'left');
            $this->db->join('webuser_basic_profile', 'webuser_basic_profile.webuser_id=jobs.user_id', 'left');
            $this->db->order_by("jobs.id", "desc");
            $query = $this->db->get_where('jobs', array('jobs.id' => $postId));
            //echo $this->db->last_query();
            $record = $query->row();
            $data = array('value' => $record, 'js' => array('dropzone.js', 'vendor/jquery.form.js', 'internal/job_apply.js'));
            $this->Admintheme->webview("jobs/apply", $data);
        }
    }

    public function bids_list()
    {
        if ($this->Adminlogincheck->checkx())
        {
            $records = array();
            $id = $this->session->userdata('id');
            $this->db->select(array('job_bids.*', 'jobs.title', 'jobs.user_id as client_id', '(select webuser_company from webuser where webuser_id=jobs.user_id) as company'));
            $this->db->join('jobs', 'jobs.id=job_bids.job_id', 'left');
            $this->db->order_by("job_bids.id", "desc");
            $query = $this->db->get_where('job_bids', array('job_bids.user_id' => $id));
            if ($query->num_rows() > 0)
                $records = $query->result();
            $data = array('records' => $records);
            $this->Admintheme->webview("jobs/my-bids", $data);
        }
    }

    public function edit($postId = null)
    {
        if ($this->Adminlogincheck->checkx() && $this->session->userdata('type') == '1')
        {
            if ($this->input->post('title'))
            {

                if (isset($_FILES['userfile']['name']) && ($_FILES['userfile']['name'] != ''))
                {
                    $ext = pathinfo($_FILES['userfile']['name'], PATHINFO_EXTENSION);
                    $newFileName = time() . rand(0000, 9999) . $this->session->userdata('id') . '.' . $ext;
                    $source = $_FILES['userfile']['tmp_name'];
                    $dest = './uploads/' . $newFileName;
                    if (move_uploaded_file($source, $dest))
                    {
                        $dbPath = '/uploads/' . $newFileName;
                        @unlink('/uploads/' . $this->input->post('oldUserFile'));
                    } else
                    {
                        $rs = array('code' => '0', 'msg' => '<div class="alert alert-danger">
  <strong>Error!</strong> Error in uploading file.
</div>');
                        echo json_encode($rs);
                        die;
                    }
                }
                //save
                $data = $this->input->post();
                unset($data['userfile']);
                if (isset($dbPath))
                    $data['userfile'] = $dbPath;
                $data['user_id'] = $this->session->userdata('id');
                unset($data['oldUserFile']);
                if ($data['job_type'] == 'hourly')
                {
                    unset($data['budget']);
                } else
                {
                    unset($data['hours_per_week']);
                }
                $this->db->where('id', $this->input->post('id'));
                if ($this->db->update('jobs', $data))
                {
                    $rs = array('code' => '1', 'type' => $data['job_type']);
                    $this->session->set_flashdata('msg', $data['title'] . ' has been updated');
                    echo json_encode($rs);
                } else
                {
                    $rs = array('code' => '0', 'msg' => '<div class="alert alert-danger">
  <strong>Error!</strong> Error occured.Try again.
</div>');
                    echo json_encode($rs);
                }
                die;
            }
            $postId = base64_decode($postId);
            $id = $this->session->userdata('id');
            $this->db->join('webuser', 'webuser.webuser_id=jobs.user_id', 'left');
            $this->db->order_by("jobs.id", "desc");
            $query = $this->db->get_where('jobs', array('user_id' => $id, 'id' => $postId));
            $record = $query->row();
            $data = array('value' => $record, 'js' => array('vendor/jquery.form.js', 'internal/job_edit.js'),);
            $this->Admintheme->webview("jobs/edit", $data);
        }
    }

    public function browse()
    {
        if ($this->Adminlogincheck->checkx())
        {
            $data = [];
            $this->Admintheme->webview("jobs/browse", $data);
        }
    }

    public function fixed_client_view()
    {
        if ($this->Adminlogincheck->checkx())
        {
            $data = [];
            $this->Admintheme->webview("jobs/fixed_client_view", $data);
        }
    }

    public function fixed_freelancer_view()
    {
        if ($this->Adminlogincheck->checkx())
        {
            $data = [];
            $this->Admintheme->webview("jobs/fixed_freelancer_view", $data);
        }
    }

    public function hourly_freelancer_view()
    {
        if ($this->Adminlogincheck->checkx())
        {
            $data = [];
            $this->Admintheme->webview("jobs/hourly_freelancer_view", $data);
        }
    }

    public function hourly_client_view()
    {
        if ($this->Adminlogincheck->checkx())
        {
            $data = [];
            $this->Admintheme->webview("jobs/hourly_client_view", $data);
        }
    }

    public function applied($jobId = null)
    {
        if ($this->Adminlogincheck->checkx())
        {
            $jobId = base64_decode($jobId);

			$sender_id = $this->session->userdata(USER_ID);
			$this->db->select('*');
			$this->db->from('job_conversation');
			$this->db->where('job_conversation.sender_id', $sender_id);
			$this->db->where('job_conversation.job_id', $jobId);
			$this->db->group_by('bid_id'); 
			$query=$this->db->get();
			$conversation_count = $query->num_rows();
			
            $records = array();
            $this->db->join('webuser', 'webuser.webuser_id=job_bids.user_id', 'left');
            $this->db->order_by("job_bids.id", "desc");
            $query = $this->db->get_where('job_bids', array('job_id' => $jobId, 'status!=1' => null));
            if ($query->num_rows() > 0)
                $records = $query->result();
            $this->db->where('id', $jobId);
            $q = $this->db->get('jobs');
            $jobDetails = $q->row();
            $data = array('jobId' => $jobId, 'records' => $records,'jobDetails'=>$jobDetails,'interview_count'=>$conversation_count);
            $this->Admintheme->webview("jobs/applied", $data);
        }
    }

	 public function interviews($jobId = null)
		{
			if ($this->Adminlogincheck->checkx())
			{
				$jobId = base64_decode($jobId);
				
				
				$sender_id = $this->session->userdata(USER_ID);
				$this->db->select('*');
				$this->db->from('job_conversation');
				$this->db->where('job_conversation.sender_id', $sender_id);
				$this->db->where('job_conversation.job_id', $jobId);
				$this->db->group_by('bid_id'); 
				$query=$this->db->get();
				$conversation_count = $query->num_rows();
				
				
				$records = array();
				$this->db->join('webuser', 'webuser.webuser_id=job_bids.user_id', 'left');
				$this->db->order_by("job_bids.id", "desc");
				$query = $this->db->get_where('job_bids', array('job_id' => $jobId, 'status!=1' => null));
				if ($query->num_rows() > 0)
					$records = $query->result();
				$this->db->where('id', $jobId);
				$q = $this->db->get('jobs');
				$jobDetails = $q->row();
				$data = array('jobId' => $jobId, 'records' => $records,'jobDetails'=>$jobDetails,'interview_count'=>$conversation_count);
				$this->Admintheme->webview("jobs/applied", $data);
			}
		}
	
    public function accept_hourly()
    {
        if ($this->Adminlogincheck->checkx())
        {
            $jobId = base64_decode($_GET['fmJob']);
             $user_id = $this->session->userdata('id');
             
            $this->db->select('jobs.*, job_bids.*,jobs.user_id AS offerduser_id,job_bids.status AS bid_status,jobs.job_duration AS jobduration,job_bids.id AS bid_id,job_bids.created AS bid_created');
             
            $this->db->join('job_bids', 'jobs.id=job_bids.job_id', 'inner');
           $this->db->where('job_bids.user_id',$user_id);
           $this->db->where('job_bids.job_id',$jobId);
            $this->db->where('job_bids.hired','1');
            $this->db->where('job_bids.status',0);
            $query=$this->db->get('jobs');
             $job_details = $query->result();
             
           
             $this->db->select('webuser.*, webuser_basic_profile.*');
             $this->db->join('webuser_basic_profile', 'webuser.webuser_id=webuser_basic_profile.webuser_id', 'inner');
             $this->db->where('webuser.webuser_id',$user_id);
            $user_details=$this->db->get('webuser');
            $user_details = $user_details->row();
           
            
            $this->db->select('webuser.*, webuser_basic_profile.*');
             $this->db->join('webuser_basic_profile', 'webuser.webuser_id=webuser_basic_profile.webuser_id', 'inner');
             $this->db->where('webuser.webuser_id',$job_details[0]->offerduser_id);
             $query_offerduser=$this->db->get('webuser');
             $offerduser_details = $query_offerduser->row();  
              
            $data = array('job_details' => $job_details,'offerduser_details' => $offerduser_details,'user_details' => $user_details);
            $this->Admintheme->webview("jobs/accept_hourly", $data);
        }
    }

    public function accept_fixed()
    {
        if ($this->Adminlogincheck->checkx())
        {
            $data = [];
            $this->Admintheme->webview("jobs/accept_fixed", $data);
        }
    }
	
	 public function accept_offer()
    {
        if ($this->Adminlogincheck->checkx())
        {
			parse_str($_POST['form'], $form);	
			//print_r($form); die;
			
			
			//mail send After accept the mail
            $client_id =$form['client_id'];
            $client_name = $form['client_name'];
            $client_email = $form['client_email'];
            $user_email = $form['user_email'];
            $user_id = $form['user_id'];
            $user_name = $form['user_name'];
            $job_name = $form['job_name'];
            $message = $form['confo_notes'];
			$jobId = $form['job_id'];
			$Bid_id = $form['bid_id'];
            
			  //$this->load->library('email');
			  //$this->email->from($user_email, $user_name);
			 // $this->email->to('anik.infotechsolz@gmail.com');
			  //$this->email->cc('another@another-example.com');
			  //$this->email->bcc('them@their-example.com');
			  //$this->email->subject('Offer accepted :'.$job_name);
			  //$this->email->message('message');
			 // if($this->email->send()){
				
				  $offer_confo_data = array(
						'fuser_id' =>$user_id,
						'job_id' => $jobId,
						'buser_id' => $client_id,
						'bid_id' =>$Bid_id,
						'comments' => $message,
					 ); 

				 $this->db->insert('job_accepted',$offer_confo_data);
			  //}
			  
			$sql = "UPDATE  job_bids set hired = '0' WHERE user_id ='".$user_id."' AND job_id = '".$jobId."'";
			$this->db->query($sql);
			$response['success'] = true; 
			print_r(json_encode($response));
		
		}
			 

    }
  
	
    public function accept()
    {
        if ($this->Adminlogincheck->checkx())
        {
           $jobId = base64_decode($_GET['fmJob']);
           $Bid_id = base64_decode($_GET['fmBiD']);
           $user_id = $this->session->userdata('id');
            
             
            $this->db->select('webuser.*, webuser_basic_profile.*');
            $this->db->join('webuser_basic_profile', 'webuser.webuser_id=webuser_basic_profile.webuser_id', 'inner');
            $this->db->where('webuser.webuser_id',$user_id);
            $user_details=$this->db->get('webuser');
            $user_details = $user_details->row();
            
            $this->db->select('jobs.*,webuser.*, webuser_basic_profile.*');
            $this->db->join('webuser', 'jobs.user_id=webuser.webuser_id', 'inner');
            $this->db->join('webuser_basic_profile', 'webuser.webuser_id=webuser_basic_profile.webuser_id', 'inner');
            $this->db->where('jobs.id',$jobId);
            $query_offerduser=$this->db->get('jobs');
            //$this->db->last_query();
             $offerduser_details = $query_offerduser->row();
         
             $data = array('user_details' => $user_details,'offerduser_details'=>$offerduser_details);
            $this->Admintheme->webview("jobs/accept", $data);
        }
    }

    public function paypal()
    {
        if ($this->Adminlogincheck->checkx())
        {
            $data = [];
            $this->Admintheme->webview("jobs/paypal", $data);
        }
    }

    public function mystaff()
    {
        if ($this->Adminlogincheck->checkx())
        {
			$data = [];
			
			$user_id = $this->session->userdata('id');
            $this->db->select('*');
			$this->db->from('job_accepted');
			$this->db->join('webuser', 'webuser.webuser_id=job_accepted.fuser_id', 'inner');
			$this->db->join('webuser_basic_profile', 'webuser_basic_profile.webuser_id=webuser.webuser_id', 'inner');
			$this->db->join('job_bids', 'job_bids.id=job_accepted.bid_id', 'inner');
			$this->db->join('jobs', 'jobs.id=job_bids.job_id', 'inner');
			$this->db->join('country', 'country.country_id=webuser.webuser_country', 'inner');
            $this->db->where('job_accepted.buser_id',$user_id);
			$this->db->where('job_bids.hired', '0' );
			
            $query=$this->db->get();
			$result = $query->result();
			
			
			//print_r($result); die;
            //$this->db->select('jobs.*,webuser.*, webuser_basic_profile.*');
            //$this->db->join('webuser', 'jobs.user_id=webuser.webuser_id', 'inner');
            //$this->db->join('webuser_basic_profile', 'webuser.webuser_id=webuser_basic_profile.webuser_id', 'inner');
            //$this->db->where('jobs.id',$jobId);
            //$query_offerduser=$this->db->get('jobs');
			
            $data['all_data'] = $result;
            $this->Admintheme->webview("jobs/mystaff", $data);
        }
    }
    public function pasthire()
    {
        if ($this->Adminlogincheck->checkx())
        {
            $data = [];
            $this->Admintheme->webview("jobs/pasthire", $data);
        }
    }
    public function offersent()
    {
        if ($this->Adminlogincheck->checkx())
        {
             $user_id = $this->session->userdata('id');
            
            $this->db->select('*,job_bids.id as bid_id');
            $this->db->from('job_bids');
            $this->db->join('webuser', 'webuser.webuser_id = job_bids.user_id', 'inner');
            $this->db->join('country', 'country.country_id = webuser.webuser_country', 'inner');
            $this->db->join('jobs', 'jobs.id=job_bids.job_id', 'inner');
            $this->db->where('job_bids.status', 0);
            $this->db->where('jobs.user_id', $user_id);
            $this->db->where('job_bids.hired', '1');
            $this->db->group_by('bid_id'); 
            $query=$this->db->get();
            $offer_count = $query->num_rows();
            $result = $query->result();
					
          //$this->db->last_query();
            
            
            
            
             $data = array('messages' => $result,'offer_count'=>$offer_count);
            $this->Admintheme->webview("jobs/offersent", $data);
        }
    }

    public function send_invitation()
    {
        if ($this->Adminlogincheck->checkx())
        {
            $data = [];
            $this->Admintheme->webview("jobs/send_invitation", $data);
        }
    }

    public function withdraw_system($bidId = null)
    {
        if ($this->Adminlogincheck->checkx())
        {
            if ($this->input->post('proposal'))
            {
                $data = array();
                $data['bid_amount'] = $this->input->post('bid_amount');
                $bidId = $this->input->post('bid_id');
                $data['bid_fee'] = round($data['bid_amount'] / 10, 2);
                $data['bid_earning'] = $data['bid_amount'] - $data['bid_fee'];
                $this->db->where('id', $bidId);
                if ($this->db->update('job_bids', $data))
                {
                    $rs = array('code' => '1', 'modal' => '#myModal2', 'amt' => '1', 'msg' => '<div class="alert alert-success">
                    <strong>Success!</strong> You proposal has been revised.
                  </div>');
                } else
                {
                    $rs = array('code' => '0', 'msg' => '<div class="alert alert-danger">
                    <strong>Warning!</strong> Something went wrong.
                  </div>');
                }
                echo json_encode($rs);
                die;
            }
            if ($this->input->post('withdraw'))
            {
                $data = array();
                $data['status'] = '1';
                $bidId = $this->input->post('bid_id');
                $this->db->where('id', $bidId);
                if ($this->db->update('job_bids', $data))
                {
                    $rs = array('code' => '1', 'modal' => '#myModal', 'amt' => '0', 'msg' => '<div class="alert alert-success">
                    <strong>Success!</strong> You have successfully withdraw with this job.
                  </div>');
                } else
                {
                    $rs = array('code' => '0', 'msg' => '<div class="alert alert-danger">
                    <strong>Warning!</strong> Something went wrong.
                  </div>');
                }
                echo json_encode($rs);
                die;
            }
            $bidId = base64_decode($bidId);
            $id = $this->session->userdata('id');
            $this->db->select(array('job_bids.*', 'jobs.title', 'jobs.job_type',
                'jobs.budget', 'jobs.hours_per_week', 'jobs.job_duration',
                'jobs.experience_level', 'jobs.skills', 'jobs.job_description'));
            $this->db->join('jobs', 'jobs.id=job_bids.job_id', 'left');
            $this->db->order_by("job_bids.id", "desc");
            $query = $this->db->get_where('job_bids', array('job_bids.user_id' => $id, 'job_bids.id' => $bidId));
            if ($query->num_rows() > 0)
                $value = $query->row();
            else
                redirect('/jobs/my-bids');

            $data = array('value' => $value, 'js' => array('vendor/jquery.form.js', 'internal/job_withdraw.js'));
            $this->Admintheme->webview("jobs/withdraw_system", $data);
        }
    }
    public function confirm_hired_fixed()
    {
        if ($this->Adminlogincheck->checkx())
        {
			$data = [];
			if(isset($_GET['user_id']) && isset($_GET['job_id'])){
				
				$applier_id = $_GET['user_id'];
				$job_id = $_GET['job_id'];
				$this->db->select('*');
				$this->db->from('jobs');
				$this->db->where('jobs.id', base64_decode($job_id)); 
				$query=$this->db->get();
				$result = $query->result();

				$this->db->select('*');
				$this->db->from('webuser');
				$this->db->join('webuser_basic_profile', 'webuser_basic_profile.webuser_id = webuser.webuser_id', 'inner');
				$this->db->where('webuser.webuser_id', base64_decode($applier_id)); 
				$query=$this->db->get();
				$result1 = $query->result();
				
				$this->db->select('*');
				$this->db->from('job_bids');
				$this->db->where('job_bids.user_id', base64_decode($applier_id)); 
				$this->db->where('job_bids.job_id', base64_decode($job_id));
				$query=$this->db->get();
				$result3 = $query->result();
			
			$data = array('applier_id' => $applier_id, 'job_id' => $job_id,'job_details' =>$result, 'user_details' => $result1, 'bid_details' => $result3);
				
			} else {
				redirect('/jobs-home');
			}
			
            
            $this->Admintheme->webview("jobs/confirm_hired_fixed", $data);
        }
    }
    public function confirm_hired_hourly()
    {
        if ($this->Adminlogincheck->checkx())
        {
             if ($this->input->post('proposal'))
            {
                $data = array();
                $data['offer_bid_amount'] = $this->input->post('bid_amount');
                $bidId = $this->input->post('bid_id');
                $data['offer_bid_fee'] = round($data['offer_bid_amount'] / 10, 2);
                $data['offer_bid_earning'] = $data['offer_bid_amount'] - $data['offer_bid_fee'];
                $this->db->where('id', $bidId);
                if ($this->db->update('job_bids', $data))
                {
                    $rs = array('code' => '1', 'modal' => '#myModal2', 'amt' => '1', 'msg' => '<div class="alert alert-success">
                    <strong>Success!</strong> You proposal has been revised.
                  </div>');
                    
                   
                    
                } else
                {
                    $rs = array('code' => '0', 'msg' => '<div class="alert alert-danger">
                    <strong>Warning!</strong> Something went wrong.
                  </div>');
                }
                echo json_encode($rs);
                
                die;
            }
            
            
			
			$data = [];
			if(isset($_GET['user_id']) && isset($_GET['job_id'])){
				
				$applier_id = $_GET['user_id'];
				$job_id = $_GET['job_id'];
				
					
				$this->db->select('*');
				$this->db->from('jobs');
				$this->db->where('jobs.id', base64_decode($job_id)); 
				$query=$this->db->get();
				$result = $query->result();

				$this->db->select('*');
				$this->db->from('webuser');
				$this->db->join('webuser_basic_profile', 'webuser_basic_profile.webuser_id = webuser.webuser_id', 'inner');
				$this->db->where('webuser.webuser_id', base64_decode($applier_id)); 
				$query=$this->db->get();
				$result1 = $query->result();
				
				$this->db->select('*');
				$this->db->from('job_bids');
				$this->db->where('job_bids.user_id', base64_decode($applier_id)); 
				$this->db->where('job_bids.job_id', base64_decode($job_id));
				$query=$this->db->get();
				$result3 = $query->result();
				
				
			$data = array('applier_id' => $applier_id, 'job_id' => $job_id, 'job_details' =>$result, 'user_details' => $result1, 'bid_details' => $result3,'js' => array('vendor/jquery.form.js'));
				
			} else {
				redirect('/jobs-home');
			}
			
            $this->Admintheme->webview("jobs/confirm_hired_hourly", $data);
        }
    }
	public function confirm_hired()
    {
        parse_str($_POST['form'], $form);
		
		
        $response['success'] = false;
		$applier_id = $form['applier_id'];
		$job_id = $form['job_id'];
		$title = $form['title'];
        if($title == "") {
			$title = $form['default_title'];
		} 
		$message = $form['message'];
		$start_date = $form['start_date'];
		
		if(isset($form['budget']) && isset($form['budget_type'])){
            
            $budget = $form['budget'];
            $budget_type = $form['budget_type'];
            
            $sql = "UPDATE  job_bids set hired = '1', hire_title = '".$title."', hire_message = '".$message."',fixedpay_amount = '".$budget."',fixed_pay_status= '".$budget_type."', start_date = '".$start_date."' WHERE user_id ='".$applier_id."' AND job_id = '".$job_id."'";
            
        }else{
            
            $weekly_limit = $form['limit'];
            if(isset($form['allow_freelancer'])){
                $allow_freelancer = $form['allow_freelancer'];
            } else {
                $allow_freelancer = 0;
            }
            
            $sql = "UPDATE  job_bids set hired = '1', hire_title = '".$title."', hire_message = '".$message."', weekly_limit = '".$weekly_limit."', allow_freelancer = '".$allow_freelancer."', start_date = '".$start_date."' WHERE user_id ='".$applier_id."' AND job_id = '".$job_id."'";
        }
        
		if( $this->db->query($sql) ){
            $response['success'] = true;
            $response['message'] = 'Well done! You have successfully hired this person.';
        }
        else{
            $response['message'] = 'Opps! Something went wrong please try again.';
        }
        
        
		echo json_encode( $response );
		
	}
}
