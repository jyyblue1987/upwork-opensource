<?php
class Invoices extends CI_Model {

    function __construct() {
        parent::__construct();
    }

	  function check($permission) {

		if($this->Adminlogincheck->checkper($permission['invoices'])){
			return true;
		}else{
			redirect(site_url());
			exit();
		}
    }
	  function load($permission,$mod){


		$page=$this->uri->uri_to_assoc();
		$title=$this->Adminforms->getdata("name","usersubpage",$permission['invoices']);

		if(isset($_GET['q'])){
			$q=$_GET['q'];
		}else{
			$q=false;
		}

			$this->db->select('*');
			$this->db->from('webuser');
			$this->db->where('webuser.webuser_type', '1');
			$this->db->where('webuser.isactive', 1);
			$this->db->where('webuser.isdelete',0);
			$query = $this->db->get();
			$result = $query->result();

			$data = array( 'title' => $title, 'permission' => $permission, 'loadpage' => $page['loadpage'], 'subpage' => $page['subpage'],'result' => $result,  );
			$this->Admintheme->loadview($page['loadpage']."/billingrequest",$data);



    }

    public function load_transaction($permission, $mod, $status){
        
        date_default_timezone_set("UTC");
        $page = $this->uri->uri_to_assoc();
        $title = $this->Adminforms->getdata("name", "usersubpage", $permission['transuctionhistory']);
                
        $from      = $this->input->get('from');
        $to        = $this->input->get('to');
        $user_type = $this->input->get('user_type');
        $criteria  = $this->input->get('criteria');
        
        $fields = array(
            'hourly_invoices_items.status',
            'hourly_invoices_items.amount_due',
            'hourly_invoices.updated_at',
            'webuser.webuser_fname as employer_fname',
            'webuser.webuser_lname as employer_lname',
            'webuser.webuser_email as employer_email',
            'webuserx.webuser_fname as freelancer_fname',
            'webuserx.webuser_lname as freelancer_lname',
            'webuserx.webuser_email as freelancer_email',
            'job_bids.bid_amount',
            'job_bids.offer_bid_amount',
            'job_accepted.contact_id'
        );
        
        $this->db->select($fields)
                    ->from('hourly_invoices_items')
                    ->join('hourly_invoices', "hourly_invoices.id = hourly_invoices_items.invoice_id", 'inner')
                    ->join('job_accepted', "job_accepted.bid_id = hourly_invoices_items.bid_id", 'inner')
                    ->join('job_bids', "job_bids.id = hourly_invoices_items.bid_id", 'inner')
                    ->join('webuser', "webuser.webuser_id = job_accepted.buser_id", 'inner')
                    ->join('webuser as webuserx', "webuserx.webuser_id = job_accepted.fuser_id", 'inner')
                    ->where('hourly_invoices_items.status', $status);
        
        if(!empty($criteria)){
            switch($user_type){
                case 1://ID
                    $this->db->group_start();
                    $this->db->or_where(array("transaction_id" => $criteria, "contact_id" => $criteria));
                    $this->db->group_end();
                break;
                case 2://Email
                    $this->db->group_start();
                    $this->db->or_like(array("webuser.webuser_email" => $criteria, "webuserx.webuser_email" => $criteria));
                    $this->db->group_end();
                break;
                case 3://Username
                    $this->db->group_start();
                    $this->db->or_like(array(
                        "webuser.webuser_fname"   => $criteria, 
                        "webuser.webuser_lname"   => $criteria,
                        "webuserx.webuser_fname" => $criteria, 
                        "webuserx.webuser_lname" => $criteria,
                    ));
                    $this->db->group_end();
                break;
            }
        }
        
        if(!empty($from))
            $this->db->where('hourly_invoices.updated_at >=', date('Y-m-d 00:00:00', strtotime($from)));
          
        if(!empty($to))
            $this->db->where('hourly_invoices.updated_at <=', date('Y-m-d 00:00:00', strtotime($to)));
        
        $query = $this->db->order_by('hourly_invoices.updated_at')->get();
                
        $data = array(
            'title'      => 'Invoices', 
            'permission' => $permission, 
            'loadpage'   => $page['loadpage'], 
            'subpage'    => $page['subpage'], 
            'txns'       => $query->result(),
            'from'       => $from,
            'to'         => $to,
            'user_type'  => $user_type,
            'criteria'   => $criteria,
        );
        $this->Admintheme->loadview($page['loadpage'] . "/billingrequest" , $data);
    }
}
