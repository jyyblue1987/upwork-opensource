<?php

defined('BASEPATH') OR exit('No direct script access allowed');

use Carbon\Carbon;

/**
 * Description of Payment_model
 *
 * @author Hermannovich <donfack.hermann@gmail.com>
 */
class Payment_model extends CI_Model {
    
    public function load_job_transactions($sender_id, $user_id, $job_id) {
        $this->db->select('*');
        $this->db->from('payments');
        $this->db->where('payments.buser_id', $sender_id);
        $this->db->where('payments.user_id', $user_id);
        $this->db->where('payments.job_id', $job_id);
        $this->db->order_by("payment_create", "DESC");
        $query = $this->db->get();
        return $query->result();
    }
    
    public function save_job_transaction($job_id, $fuser_id, $buser_id, $amount, $action = 'payment') {
        $this->db->insert('payments', array(
            'job_id'        => $job_id,
            'user_id'       => $fuser_id,
            'buser_id'      => $buser_id,
            'des'           => ( $action == 'payment' ? 'Payment' : 'Milestone' ),
            'payment_gross' => $amount,
        ));
    }
    
    /**
     * Retreive all amount in progress for the current user
     * 
     * @param type $user_id
     */
    public function get_amount_in_progress( $user_id ){
        
        $dt            = Carbon::now();
        $dt->timezone  = new DateTimeZone('UTC');
        $start_of_week = date('Y-m-d H:i:s', $dt->startOfWeek()->timestamp);
        $end_of_week   = date('Y-m-d H:i:s', $dt->endOfWeek()->timestamp);
                
        return $this->hourly_amount_to_paid_in_a_week($user_id, $start_of_week, $end_of_week);
    }
    
    /**
     * Retreive all the pending amount for the current freelancer.
     * 
     * @param  int $user_id freelancer identifier
     * @return double       pending amount to receive next week.
     */
    public function get_amount_pending( $user_id )
    {        
        return  $this->fixed_amount_pending( $user_id ) + $this->hourly_amount_pending( $user_id );   
    }
    
    /**
     * Retreive all the fixed contract pending amount to withdraw next week.
     * 
     * @param  int $user_id  freelancer identifier
     * @return double        fixed contract pending amount.
     */
    public function fixed_amount_pending( $user_id )
    {
        $dt                 = Carbon::now();
        $dt->timezone       = new DateTimeZone('UTC');
        $last_paid_from_now = date('Y-m-d H:i:s', $dt->copy()->subDays(7)->timestamp);
        $now                = date('Y-m-d H:i:s', $dt->timestamp);
        
        
        return $this->fixed_amount_paid_last_week($user_id, $last_paid_from_now, $now);
        
    }
    
    /**
     * Retreive all the hourly contract pending amount to withdraw next week.
     * 
     * @param  int    $user_id freelancer identifier
     * @return double          hourly contract pending amount.
     */
    public function hourly_amount_pending( $user_id )
    {   
        $dt                 = Carbon::now();
        $dt->timezone       = new DateTimeZone('UTC');
        $last_week          = $dt->copy()->subWeek();
        $start_of_last_week = date('Y-m-d H:i:s', $last_week->startOfWeek()->timestamp);
        $end_of_last_week   = date('Y-m-d H:i:s', $last_week->endOfWeek()->timestamp);
        
        return  $this->hourly_amount_to_paid_in_a_week($user_id, $start_of_last_week, $end_of_last_week);
    }
    
    
    public function get_amount_available( $user_id )
    {
        return ( $this->hourly_amount_available( $user_id ) + $this->fixed_amount_available( $user_id ) ) - $this->get_week_withdraw();
    }
    
    public function hourly_amount_available( $user_id ){
        $dt                 = Carbon::now();
        $dt->timezone       = new DateTimeZone('UTC');
        $two_week_before    = $dt->copy()->subWeeks(2);
        
        $start_of_two_week_before = date('Y-m-d H:i:s', $two_week_before->startOfWeek()->timestamp);
        $end_of_two_week_before   = date('Y-m-d H:i:s', $two_week_before->endOfWeek()->timestamp);
        
        return  $this->hourly_amount_to_paid_in_a_week($user_id, $start_of_two_week_before, $end_of_two_week_before);
    }
    
    public function get_week_withdraw( $user_id ) {
        return 0.0;
    }
    
    public function fixed_amount_available( $user_id ){
        
        $now                 = Carbon::now();
        $now->timezone       = new DateTimeZone('UTC');
        
        $seven_day_from_now  = $now->copy()->subDays(7);
        $to   = date('Y-m-d H:i:s', $seven_day_from_now->timestamp);
        $from = date('Y-m-d H:i:s', $seven_day_from_now->hour(0)->minute(0)->second(0)->timestamp);
                
        return $this->fixed_amount_paid_last_week( $user_id, $from, $to);
    }
    
    /**
     * return the amount a freelancer should get from the previous week fixed contract paid.
     * 
     * @param int $user_id
     * @param int $start_of_week
     * @param int $end_of_week
     * @return double
     */
    private function fixed_amount_paid_last_week( $user_id, $begin, $end){
        
        $query = $this->db->select('SUM(payment_gross) as payment_gross')
                    ->from('payments')
                    ->where('user_id', $user_id)
                    ->where('buser_id > ', 0)
                    ->where('payment_create >', $begin)
                    ->where('payment_create <=', $end)
                    ->group_by( array( 'bid_id' ) )
                    ->get();
        
        $amount_infos = $query->row();
        
        if( ! empty( $amount_infos ))
            return $amount_infos->payment_gross;
        
        return 0.0;
    }


    /**
     * return the amount a freelancer should get from his hourly contract
     * in a week.
     * 
     * @param int  $user_id        freelancer identifier
     * @param type $start_of_week  start day of the week Monday 00:00:00
     * @param type $end_of_week    end of a week Sunday 12:59:59
     * @return real                amount freelancer should receive.
     */
    private function hourly_amount_to_paid_in_a_week( $user_id, $start_of_week, $end_of_week){
        
        $query = $this->db->select('SUM(total_hour) as total_hour, offer_bid_amount, bid_amount')
                    ->from('job_workdairy')
                    ->join('job_bids', 'job_bids.id=job_workdairy.bid_id', 'inner')
                    ->where('fuser_id', $user_id)
                    ->where('working_date >=', $start_of_week)
                    ->where('working_date <=', $end_of_week)
                    ->group_by( array( 'job_bids.id' ) )
                    ->get();
        
        $amount_infos = $query->result();
        
        if( ! empty( $amount_infos ) )
        {
            $amount = 0.0;
            
            foreach( $amount_infos as $key => $info)
            {
                $amount += ( (double) $info->total_hour * ( ! empty( $info->offer_bid_amount ) ? $info->offer_bid_amount : $info->bid_amount) );
            }
            
            return $amount;
        }
        
        return 0.0;
        
    }
}