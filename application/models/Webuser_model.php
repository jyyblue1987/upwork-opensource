<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Description of Webuser_model
 *
 * @author Hermannovich <donfack.hermann@gmail.com>
 */
class Webuser_model extends CI_Model {
    
    public function load_informations($id, $with_skill = false) {
        
        $this->db->select('*');
        $this->db->from('webuser');
        $this->db->where('webuser.webuser_id', $id);
        
        $query_status = $this->db->get();
        return $query_status->row();
    }
    
    public function activated_all( $ids, $reason = null )
    {
        if(empty($ids)) return;
        
        $data = array(
                    'isactive'       => true,
                    'suspend_reason' => $reason
                );
        
        $this->db
            ->where_in('webuser_id', $ids )
            ->update('webuser', $data );
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
        $username = '';
        
        if(isset($webuser)){
            $username = $webuser->{$field_name};
        }
        
        return $username;
        
    }
    
    public function get_username( $user_id ){
        return $this->get_field('webuser_username', $user_id);
    }
    
    public function get_total_rating( $user_id ){
        
        $rating_total_times_amount = 0.0;
        $amount_total              = 0.0;
        
        //load all fixed job's contract with their paid and the feedback rating.
        $fixed_contract_rating_score  = $this->get_fixed_contract_rating_score( $user_id );
        $hourly_contract_rating_score = $this->get_hourly_contract_rating_score( $user_id );
        
        if( $fixed_contract_rating_score !== null ){
            $rating_total_times_amount = $fixed_contract_rating_score['rating_times_amount'];
            $amount_total              = $fixed_contract_rating_score['total_amount'];
        }
        
        if( $hourly_contract_rating_score !== null ){
            $rating_total_times_amount += $hourly_contract_rating_score['rating_times_amount'];
            $amount_total              += $hourly_contract_rating_score['total_amount'];
        }
        
        $average_rating = (string) ( $amount_total > 0 ? ( $rating_total_times_amount / $amount_total ) : 0.0 );
        
        if($average_rating > 0.0){
            $mark_pos       = strpos($average_rating, '.');
            if($mark_pos !== null )
                $average_rating = substr ($average_rating, 0, ($mark_pos + 2));
        }
        
        return $average_rating;
    }
    
    /**
     * return an array of rating and total amount for all fixed contract or null
     * 
     * @param int $user_id
     * @return mixed
     */
    private function get_fixed_contract_rating_score( $user_id ){
        
        $query = $this->db
                    ->select('SUM(fixedpay_amount * feedback_score) as fixed_rating_score, SUM(fixedpay_amount) as total_amount')
                    ->from('job_bids')
                    ->join('jobs', 'jobs.id=job_bids.job_id', 'inner')
                    ->join('job_feedback', 'job_feedback.feedback_job_id=jobs.id', 'inner')
                    ->join('job_accepted', 'job_accepted.job_id=job_feedback.feedback_job_id', 'inner')
                    ->where('job_bids.user_id', $user_id)
                    ->where('job_feedback.sender_id !=', $user_id)
                    ->where('job_feedback.feedback_userid', $user_id)
                    ->where('job_feedback.feedback_score > ', 0)
                    ->where('job_bids.jobstatus', JOB_ENDED)
                    ->where('jobs.job_type', FIXED_JOB_TYPE)
                    ->get();
        
        $result = $query->row();
        
        if( ! empty( $result ))
            return array('rating_times_amount' => $result->fixed_rating_score, 'total_amount' => $result->total_amount );
        
        return null;
    }
    
    /**
     * return an array of rating and total amount for all hourly contract or null
     * 
     * @param int $user_id
     * @return mixed
     */
    public function get_hourly_contract_rating_score( $user_id ){
        
        $query = $this->db
                    ->select('job_bids.offer_bid_amount, job_bids.bid_amount, feedback_score, SUM(job_workdairy.total_hour) as total_hour')
                    ->from('job_bids')
                    ->join('jobs', 'jobs.id=job_bids.job_id', 'inner')
                    ->join('job_feedback', 'job_feedback.feedback_job_id=jobs.id', 'inner')
                    ->join('job_accepted', 'job_accepted.job_id=job_feedback.feedback_job_id', 'inner')
                    ->join('job_workdairy', 'job_workdairy.jobid=jobs.id', 'inner')
                    ->where('job_bids.user_id', $user_id)
                    ->where('job_feedback.sender_id !=', $user_id)
                    ->where('job_feedback.feedback_userid', $user_id)
                    ->where('job_feedback.feedback_score > ', 0)
                    ->where('job_bids.jobstatus', JOB_ENDED)
                    ->where('jobs.job_type', HOURLY_JOB_TYPE)
                    ->group_by('job_bids.id')
                    ->get();
        
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
        
        return null;
    }
}
