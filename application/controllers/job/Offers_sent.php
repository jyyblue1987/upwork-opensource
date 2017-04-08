<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Offers_sent
 *
 * @author Hermannovich <donfack.hermann@gmail.com>
 */
class Offers_sent extends Winjob_Controller {
    
    public function __construct() {
        parent::__construct();
        
        // added by (Donfack Zeufack Hermann) start 
        // load the default language for the current user.
        $this->load_language();
        // added by (Donfack Zeufack Hermann) end
    }
    
    protected function load_language(){
        parent::load_language();
        $this->lang->load('job', $this->get_default_lang());
    }
    
    
    public function index() {
        
        $this->checkForEmployer();

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
        $query = $this->db->get();
        $offer_count = $query->num_rows();
        $result = $query->result();


        $this->db->select('*');
        $this->db->from('job_accepted');
        $this->db->join('job_bids', 'job_bids.id=job_accepted.bid_id', 'inner');
        $this->db->where('job_accepted.buser_id', $user_id);
        $this->db->where('job_bids.hired', '0');
        $this->db->where('job_bids.jobstatus', '0');
        $query_myhire = $this->db->get();
        $myhire_count = $query_myhire->num_rows();

        $this->db->select('*');
        $this->db->from('job_accepted');
        $this->db->join('job_bids', 'job_bids.id=job_accepted.bid_id', 'inner');
        $this->db->where('job_accepted.buser_id', $user_id);
        $this->db->where('job_bids.hired', '0');
        $this->db->where('job_bids.jobstatus', '1');
        $query = $this->db->get();
        $past_hire = $query->num_rows();


        $data = array('messages' => $result, 'offer_count' => $offer_count, 'myhire_count' => $myhire_count, 'past_hire' => $past_hire);

        $this->twig->display('webview/jobs/twig/offers-sent', $data);
    }
}
