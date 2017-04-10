<?php
class Billingrequest extends CI_Model {

    function __construct() {
        parent::__construct();
    }

	  function check($permission) {

		if($this->Adminlogincheck->checkper($permission['billingrequest'])){
			return true;
		}else{
			redirect(site_url());
			exit();
		}
    }
	  function load($permission,$mod){


		$page=$this->uri->uri_to_assoc();
		$title=$this->Adminforms->getdata("name","usersubpage",$permission['billingrequest']);

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

			$this->Admintheme->loadview($page['loadpage']."/".$page['subpage'],$data);



    }

    public function load_transaction($permission, $mod, $status){
        
        date_default_timezone_set("UTC");
        $page = $this->uri->uri_to_assoc();
        $title = $this->Adminforms->getdata("name", "usersubpage", $permission['transuctionhistory']);
        
        /*$fixed_fields = array(
            "payments.payment_create as updated_at",
            "jobs.title",
            "payments.des",
            "webuser.webuser_fname as employer_fname",
            "webuser.webuser_lname as employer_lname",
            "webuser.webuser_email as employer_email",
            'webuserx.webuser_fname as freelancer_fname',
            'webuserx.webuser_lname as freelancer_lname',
            'webuserx.webuser_email as freelancer_email',
            "payments.payment_gross ",
        );*/

        
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
        
        $query = $this->db->select($fields)
                    ->from('hourly_invoices_items')
                    ->join('hourly_invoices', "hourly_invoices.id = hourly_invoices_items.invoice_id", 'inner')
                    ->join('job_accepted', "job_accepted.bid_id = hourly_invoices_items.bid_id", 'inner')
                    ->join('job_bids', "job_bids.id = hourly_invoices_items.bid_id", 'inner')
                    ->join('webuser', "webuser.webuser_id = job_accepted.buser_id", 'inner')
                    ->join('webuser as webuserx', "webuserx.webuser_id = job_accepted.fuser_id", 'inner')
                    ->where('hourly_invoices_items.status', $status)
                    ->order_by('hourly_invoices.updated_at')
                    ->get();
        
        $data = array(
            'title'      => $title, 
            'permission' => $permission, 
            'loadpage'   => $page['loadpage'], 
            'subpage'    => $page['subpage'], 
            'txns'       => $query->result(),
        );
        $this->Admintheme->loadview($page['loadpage'] . "/" . $page['subpage'], $data);
    }


}

?>
