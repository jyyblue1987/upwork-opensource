<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Description of Webuser_model
 *
 * @author Hermannovich <donfack.hermann@gmail.com>
 */
class Webuser_model extends CI_Model {
    
    public function load_informations($id) {
        
        $this->db->select('*');
        $this->db->from('webuser');
        $this->db->where('webuser.webuser_id', $id);
        
        $query_status = $this->db->get();
        return $query_status->row();
    }
    
    public function load_address($id) {
        
        $query = $this->db->select('*')
                    ->from('webuseraddresses')
                    ->where('webuseraddresses.webuser_id', $id)
                    ->get();
        
        return $query->row();
    }
    
    public function load_tax_informations($id) {
        
        $query = $this->db->select('*')
                    ->from('webuser_tax_information')
                    ->where('webuser_tax_information.webuser_id', $id)
                    ->get();
        
        return $query->row();
    }
    
    public function load_profile($id)
    {
        $this->db->select(
                'webuser.*, webuser_basic_profile.tagline, '
              . 'webuser_basic_profile.work_experience_year, '
              . 'webuser_basic_profile.work_experience_month, '
              . 'webuser_basic_profile.overview, '
              . 'webuser_basic_profile.hourly_rate')
             ->from('webuser')
             ->join('webuser_basic_profile', 'ON webuser_basic_profile.webuser_id = webuser.webuser_id', 'inner')
             ->where('webuser.webuser_id', $id);
        
        $query = $this->db->get();
        return $query->row();
    }
    
    public function activated_all( $ids, $reason = null )
    {
        if(empty($ids)) return;
        
        $this->db
            ->where_in('webuser_id', $ids )
            ->update('webuser', array(
                    'isactive'       => true,
                    'suspend_reason' => $reason
                ) );
    }
    
    public function deactivated_all( $user_ids )
    {
        $this->set_field($user_ids, "isactive", false);
    }
    
    public function desactived( $user_id, $reason = null ){
        
        $data = array(
                    'isactive'       => 0,
                    'suspend_reason' => $reason
                );
        
        $this->db
            ->where('webuser_id', $user_id )
            ->update('webuser', $data );
    }
    
    public function set_field($user_ids, $field, $value)
    {
        if(empty($user_ids)) return;
                
        if(is_array($user_ids))
            $this->db->where_in('webuser_id', $user_ids );
        else
            $this->db->where('webuser_id', $user_ids );
        
        $this->db->update('webuser', array( $field => $value ) );
    }
    
    public function is_active( $user_id ){
        return $this->get_status($user_id) == 1;
    }
    
    public function get_status( $user_id ){
        return $this->get_field( 'isactive', $user_id );
    }
    
    public function get_field( $field_name, $user_id ){
        
        $query = $this->db
                    ->select( $field_name )
                    ->from('webuser')
                    ->where('webuser.webuser_id', $user_id)
                    ->get();
        
        $webuser  = $query->row();
        $field_value = '';
        
        if(isset($webuser)){
            $field_value = $webuser->{$field_name};
        }
        
        return $field_value;
        
    }
    
    public function get_address_field( $field_name, $user_id ){
        
        $query = $this->db
                    ->select( $field_name )
                    ->from('webuseraddresses')
                    ->where('webuseraddresses.webuser_id', $user_id)
                    ->get();
        
        $address  = $query->row();
        $field_value = '';
        
        if(isset($address)){
            $field_value = $address->{$field_name};
        }
        
        return $field_value;
        
    }
    
    public function get_username( $user_id ){
        return $this->get_field('webuser_username', $user_id);
    }
    
    public function get_total_rating( $user_id, $is_employer = false ){
        
        $rating_total_times_amount = 0.0;
        $amount_total              = 0.0;
        
        //load all fixed job's contract with their paid and the feedback rating.
        $fixed_contract_rating_score  = $this->get_fixed_contract_rating_score( $user_id, $is_employer );
        $hourly_contract_rating_score = $this->get_hourly_contract_rating_score( $user_id, $is_employer );
        
        if( $fixed_contract_rating_score !== null ){
            $rating_total_times_amount = $fixed_contract_rating_score['rating_times_amount'];
            $amount_total              = $fixed_contract_rating_score['total_amount'];
        }
        
        if( $hourly_contract_rating_score !== null ){
            $rating_total_times_amount += $hourly_contract_rating_score['rating_times_amount'];
            $amount_total              += $hourly_contract_rating_score['total_amount'];
        }
        
        $average_rating = (string) ( $amount_total > 0 ? ( $rating_total_times_amount / $amount_total ) : 0.0 );
        
        if($average_rating > 0.0)
        {
            $mark_pos       = strpos($average_rating, '.');
            if($mark_pos !== null )
                $average_rating = substr ($average_rating, 0, ($mark_pos + 2));
        }
        
        return $average_rating;
    }
    
    public function get_all_contract_ids( $user_id, $job_status, $bids_status, $is_employer = false )
    {
        //Get all contract id which is ended.
        $this->db
            ->select('DISTINCT(job_bids.id)')
            ->from('job_bids')
            ->join('job_accepted', 'job_accepted.job_id=job_bids.job_id', 'inner')
            ->join('jobs', 'jobs.id=job_bids.job_id', 'inner')
            ->where('job_bids.jobstatus', $bids_status)
            ->where('jobs.job_type', $job_status);
        
        if($is_employer)
            $this->db->where('job_accepted.buser_id', $user_id);
        else
            $this->db->where('job_accepted.fuser_id', $user_id);
        
        $query = $this->db->get();
        
        $results = $query->result();
        
        $ids = array();
        if( ! empty( $results )){
            foreach($results as $result)
            {
                $ids[] = $result->id;
            }
        }
        return $ids; 
    }
    
    public function get_all_employer_fixed_ended_contract( $user_id )
    {
        return $this->get_all_contract_ids($user_id, FIXED_JOB_TYPE, JOB_ENDED, true);
    }
    
    public function get_all_freelancer_fixed_ended_contract( $user_id )
    {
        return $this->get_all_contract_ids($user_id, FIXED_JOB_TYPE, JOB_ENDED, false);
    }
    
    public function get_all_employer_hourly_ended_contract( $user_id )
    {
        return $this->get_all_contract_ids($user_id, HOURLY_JOB_TYPE, JOB_ENDED, true);
    }
    
    public function get_all_freelancer_hourly_ended_contract( $user_id )
    {
        return $this->get_all_contract_ids($user_id, HOURLY_JOB_TYPE, JOB_ENDED, false);
    }
    
    
    
    /**
     * return an array of rating and total amount for all fixed contract or null
     * 
     * @param int $user_id
     * @return mixed
     */
    private function get_fixed_contract_rating_score( $user_id, $is_employer = false ){
        
        if($is_employer)
        {
            $contract_ids = $this->get_all_employer_fixed_ended_contract( $user_id );
        }
        else
        {
            $contract_ids = $this->get_all_freelancer_fixed_ended_contract( $user_id );
        }    
        
        if( ! empty( $contract_ids ) )
        {
            $this->db
                ->select('SUM(fixedpay_amount * feedback_score) as fixed_rating_score, SUM(fixedpay_amount) as total_amount')
                ->from('job_bids')
                ->join('jobs', 'jobs.id=job_bids.job_id', 'inner')
                ->join('job_feedback', 'job_feedback.feedback_job_id=job_bids.job_id', 'inner')
                ->where('job_feedback.sender_id !=', $user_id);
            
            if($is_employer)
                $this->db->where('job_feedback.feedback_clientid', $user_id);
            else
                $this->db->where('job_feedback.feedback_userid', $user_id);
            
            $this->db
                ->where('job_feedback.feedback_score > ', 0)
                ->where_in('job_bids.id', $contract_ids);
            
            $query =  $this->db->get();
        
            $result = $query->row();

            if( ! empty( $result ) )
                return array('rating_times_amount' => $result->fixed_rating_score, 'total_amount' => $result->total_amount );
         }
        
        
        return null;
    }
    
    /**
     * return an array of rating and total amount for all hourly contract or null
     * 
     * @param int $user_id
     * @return mixed
     */
    public function get_hourly_contract_rating_score( $user_id, $is_employer = false ){
        
        if($is_employer)
        {
            $contract_ids = $this->get_all_employer_hourly_ended_contract( $user_id );
        }
        else
        {
            $contract_ids = $this->get_all_freelancer_hourly_ended_contract( $user_id );
        }  
        
        if( ! empty( $contract_ids ) )
        {
            $this->db
                ->select('job_bids.offer_bid_amount, job_bids.bid_amount, feedback_score, SUM(job_workdairy.total_hour) as total_hour')
                ->from('job_bids')
                ->join('jobs', 'jobs.id=job_bids.job_id', 'inner')
                ->join('job_feedback', 'job_feedback.feedback_job_id=job_bids.job_id', 'inner')
                ->join('job_workdairy', 'job_workdairy.jobid=job_bids.job_id', 'inner')
                ->where('job_feedback.sender_id !=', $user_id);
            
            if($is_employer)
                $this->db->where('job_feedback.feedback_clientid', $user_id);
            else
                $this->db->where('job_feedback.feedback_userid', $user_id);
            
            $this->db
                ->where('job_feedback.feedback_score > ', 0)
                ->where_in('job_bids.id', $contract_ids)
                ->group_by('job_bids.id');
            
            $query =  $this->db->get();
            
            $result = $query->result();
        
            $rating       = 0;
            $total_amount = 0;

            if(!empty($result)){
                foreach($result as $key => $item){
                    if( ! empty( $item->offer_bid_amount ) ){
                        $amount = $item->offer_bid_amount;
                    }else{
                        $amount = $item->bid_amount;
                    }

                    $amount       = $item->total_hour * $amount;
                    $rating       = $rating + ($item->feedback_score * $amount);
                    $total_amount = $total_amount + $amount;
                }

                return array('rating_times_amount' => $rating, 'total_amount' => $total_amount );
            }
        }
        
        return null;
    }
    
    public function get_all_messages( $user_id )
    {
        $fields = array(
            'jc.id', 
            'jc.job_id', 
            'jc.bid_id', 
            'jc.message_conversation', 
            'jc.sender_id', 
            'jc.receiver_id', 
            'jc.created  as created', 
            'jc.have_seen',
            'webuser.webuser_fname', 
            'webuser.webuser_lname', 
            'webuser.cropped_image', 
            'webuser.webuser_email', 
            'jobs.title', 
            '0 as is_ticket'
        );
        
        $this->db
            ->select($fields)
            ->from('job_conversation jc')
            ->join('webuser', 'jc.sender_id = webuser.webuser_id', 'inner')
            ->join('jobs', 'jobs.id = jc.job_id', 'inner')
            ->where('jc.receiver_id', $user_id);
                        
        $query_one = $this->db->get_compiled_select();
        
        $fields = array(
            'wtm.id', 
            'wtm.ticket_id as job_id', 
            'wtm.ticket_id as bid_id', 
            'wt.subject as message_conversation',
            'wtm.sender_id', 
            'wtm.receiver_id', 
            'wtm.created as created', 
            'wtm.have_seen',
            '"" as webuser_fname', 
            '"" as webuser_lname',  
            'if(wtm.sender="user", webuser.cropped_image, "") as cropped_image',
            'if(wtm.sender="user", webuser.webuser_email, user.email) as webuser_email', 
            '"Support" as title', 
            '1 as is_ticket'
        );
        
        $this->db
            ->select( $fields )
            ->from('webuser_ticket_messages wtm')
            ->join('user', 'wtm.sender_id = user.id and sender = "support" ', 'left')
            ->join('webuser', 'wtm.sender_id = webuser.webuser_id and sender = "user" ', 'left')
            ->join('webuser_tickets wt', 'wt.id = wtm.ticket_id', 'inner')
            ->where('wtm.receiver_id', $user_id);
        
	$query_two = $this->db->get_compiled_select();
        
        $query = $this->db->query($query_one . ' UNION ALL ' . $query_two . ' ORDER BY created DESC');
        
        return  $query->result();
    }
    
    public function mark_tickets_as_read( $bid_id )
    {
        $this->db->where('ticket_id', $bid_id);
	$this->db->update('webuser_ticket_messages', array('have_seen' => 0));
    }
    
    public function get_all_tickets( $bid_id )
    {
        $fields = array(
            'wtm.id', 
            'wtm.ticket_id as job_id', 
            'wtm.ticket_id as bid_id', 
            'wtm.message as message_conversation',
            'wtm.sender_id', 
            'wtm.receiver_id', 
            'wtm.created', 
            'wtm.have_seen',
            ' "Support" as fname', 
            'if(wtm.sender="user", webuser.webuser_fname, "Support") as webuser_fname',
            'webuser.webuser_lname', 
            'webuser.cropped_image', 
            'wt.subject as title',
            'wtm.created as created', 
            '1 as is_ticket'
        );
        
        $query = $this->db->select( $fields )
                ->from('webuser_ticket_messages wtm')
                ->join('user', 'wtm.sender_id = user.id and sender = "support" ', 'left')
                ->join('webuser', 'wtm.sender_id = webuser.webuser_id and sender = "user"', 'left')
                ->join('webuser_tickets wt', 'wt.id = wtm.ticket_id', 'inner')
                ->where('wtm.ticket_id', $bid_id)
                ->order_by("wtm.id", "asc")
                ->get();
        
        return $query->result();
    }
    
    public function get_all_images_of_each_ticket( $ids )
    {
        $query = $this->db
                    ->select('*')
                    ->from('webuser_ticket_message_files')
                    ->where_in('message_id', $ids)
                    ->order_by('message_id')
                    ->get();
        
        $result = $query->result();
        
        $images = array();
        if( ! empty($result) )
        {
            foreach($result as $item)
            {
                $image_item = new stdClass;
                $image_item->name = $item->name;
                $images[ $item->job_conversation_id ][] = $image_item;
            }
        }
        return $images;
    }
    
    public function save_ticket( $ticket )
    {
        if($this->db->insert('webuser_ticket_messages', $ticket))
           return $this->db->insert_id();
        return null;
    }
    
    public function load_user_ticket( $bid_id )
    {
        $query = $this->db->select("fname, lname, email, subject")
                    ->from("webuser_tickets")
                    ->where("id", $bid_id)
                    ->get();
        
        return $query->result();
    }
}
