<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Canceloffer extends CI_Controller {
	
	  public function __construct()
    {
        parent::__construct();
        $this->load->model(array('Category', 'Common_mod'));
      
    }
	

	public function index() {

		if ($this->Adminlogincheck->checkx()){
			
			if(isset($_GET['bid_id']) && isset($_GET['job_id'])){
				$bid_id = $_GET['bid_id'];
				$job_id = $_GET['job_id'];
				$data = array();

				$this->db->select('*');
				$this->db->from('job_bids');
				$this->db->where('job_bids.id', base64_decode($bid_id)); 
				$query=$this->db->get();
				$bid_details = $query->result();
				
				$this->db->select('*');
				$this->db->from('jobs');
				$this->db->where('jobs.id', $bid_details[0]->job_id); 
				$query=$this->db->get();
				$job_details = $query->result();
				
				$this->db->select('*');
				$this->db->from('webuser');
				$this->db->where('webuser.webuser_id', $job_details[0]->user_id);
				$this->db->join('webuser_basic_profile', 'webuser_basic_profile.webuser_id = webuser.webuser_id', 'inner');
				$query=$this->db->get();
				$client_details = $query->result();
				
				$this->db->select('*');
				$this->db->from('webuser');
				$this->db->where('webuser.webuser_id', $bid_details[0]->user_id); 
				$this->db->join('webuser_basic_profile', 'webuser_basic_profile.webuser_id = webuser.webuser_id', 'inner');
				$query=$this->db->get();
				$freelancer_details = $query->result();

				$data = array('bid_details' => $bid_details, 'job_details' => $job_details, 'client_details' => $client_details,'freelancer_details' => $freelancer_details);	
				
				
			} else {	
				redirect(site_url().'jobs-home');
			}		
             $this->Admintheme->webview("cancel-offer", $data);	
        }

	}
	
	public function decline(){
		$bid_id = $_POST['bid_id'];
		$sql = "UPDATE  job_bids set hired = '0' WHERE id ='".$bid_id."' ";
		$this->db->query($sql);
		$response['success'] = true;
		$response['message'] = 'Well done! You have successfully decline offer.';
		echo json_encode( $response );
		
	}
}
