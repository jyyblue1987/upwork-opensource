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
                
        return $this->hourly_amount_to_paid($user_id, $start_of_week, $end_of_week);
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
        
        return $this->fixed_amount_to_paid($user_id, $last_paid_from_now, $now);
        
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
        $end_of_last_week   = date('Y-m-d H:i:s', $last_week->endOfWeek()->timestamp);
        
        return  $this->hourly_amount_to_paid($user_id, null, $end_of_last_week, array(INVOICE_PROCESSING_PAID, INVOICE_UNPAID));
    }
    
    
    public function get_amount_available( $user_id )
    {
        return ( $this->hourly_amount_available( $user_id ) + $this->fixed_amount_available( $user_id ) ) - $this->get_withdraw( $user_id );
    }
    
    public function hourly_amount_available( $user_id )
    {
        $dt                 = Carbon::now();
        $dt->timezone       = new DateTimeZone('UTC');
        $last_week          = $dt->copy()->subWeek();
        
        $end_of_last_week   = date('Y-m-d H:i:s', $last_week->endOfWeek()->timestamp);
        
        return  $this->hourly_amount_to_paid($user_id, null, $end_of_last_week, INVOICE_PAID);
    }
    
    public function fixed_amount_available( $user_id )
    {        
        $now                 = Carbon::now();
        $now->timezone       = new DateTimeZone('UTC');
        
        $seven_day_from_now  = $now->copy()->subDays(7);
        $to   = date('Y-m-d H:i:s', $seven_day_from_now->timestamp);
        $from = date('Y-m-d H:i:s', $seven_day_from_now->hour(0)->minute(0)->second(0)->timestamp);
                
        return $this->fixed_amount_to_paid( $user_id, null, $to);
    }
    
    public function get_withdraw( $user_id )
    {        
        $query = $this->db->select('SUM(amount) as amount, SUM(processingfees) as fees')
                ->from('withdraw')
                ->where('userid', $user_id)
                ->group_by(array('userid'))
                ->get();
        
        $withdraws_resume = $query->row();
        
        if( !empty($withdraws_resume) )
            return ( $withdraws_resume->amount + $withdraws_resume->fees );
        
        return 0.0;
    }
    
    /**
     * return the amount a freelancer should get from the previous week fixed contract paid.
     * 
     * @param int $user_id
     * @param int $start_of_week
     * @param int $end_of_week
     * @return double
     */
    private function fixed_amount_to_paid( $user_id, $begin = null, $end = null){
        
        $this->db->select('SUM(payment_gross) as payment_gross')
                    ->from('payments')
                    ->where('user_id', $user_id)
                    ->where('buser_id != ', 0);
        
        if($begin !== null)
            $this->db->where('payment_create >', $begin);
        
        if($end !== null)
            $this->db->where('payment_create <=', $end);
                
        $query = $this->db->group_by( array( 'bid_id' ) )->get();
        
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
    private function hourly_amount_to_paid( $user_id, $start_of_week = null, $end_of_week = null, $invoice_state = INVOICE_UNPAID){
        
        $this->db->select('SUM(amount_due) as amount')
            ->from('hourly_invoices')
            ->join('job_bids', 'job_bids.id=hourly_invoices.bid_id', 'inner')
            ->where('user_id', $user_id);
        
        if( is_array( $invoice_state ) )
            $this->db->where_in('hourly_invoices.status ', $invoice_state);
        else
            $this->db->where('hourly_invoices.status', $invoice_state);
                
        if($start_of_week != null)
            $this->db->where('created_at >=', $start_of_week);
        
        if($end_of_week != null)
            $this->db->where('created_at <=', $end_of_week);
        
                    
        $query =  $this->db->group_by( array( 'job_bids.id' ) )->get();
        
        $amount_infos = $query->result();
        
        if( ! empty( $amount_infos ) )
        {
            $amount = 0.0;
            
            foreach( $amount_infos as $key => $info)
            {
                $amount += (double) $info->amount;
            }
            
            return $amount;
        }
        
        return 0.0;
    }
    
    public function all_user_involved_in_txn( $user_id, $get_freelancer = false )
    {
        $user_ids =  array();
        
        $payment_field       = 'buser_id';
        $payment_field_where = 'user_id';
        $invoice_field       = 'buser_id';
        $invoice_field_where = 'fuser_id';
            
        if($get_freelancer)
        {
            $payment_field       = 'user_id';
            $payment_field_where = 'buser_id';
            $invoice_field       = 'fuser_id';
            $invoice_field_where = 'buser_id';
        }
        
        $query = $this->db->select('DISTINCT(webuser.webuser_id) as webuser_id')
                    ->from('webuser')
                    ->join('payments', "payments.{$payment_field} = webuser.webuser_id", 'inner')
                    ->where("payments.{$payment_field_where}", $user_id)
                    ->get();
        
        $result1 = $query->result();
        
        if( ! empty( $result1 ))
        {
            foreach( $result1 as $user )
            {
                $user_ids[$user->webuser_id] = $user->webuser_id;
            }
        }
        
        $query = $this->db->select('DISTINCT(webuser.webuser_id) as webuser_id')
                    ->from('job_accepted')
                    ->join('webuser', "webuser.webuser_id = job_accepted.{$invoice_field}", 'inner')
                    ->join('hourly_invoices', 'hourly_invoices.bid_id = job_accepted.bid_id', 'inner')
                    ->where("job_accepted.{$invoice_field_where}", $user_id)
                    ->get();
        
        $result2 = $query->result();
        
        if( ! empty( $result2 ))
        {
            foreach( $result2 as $user )
            {
                $user_ids[$user->webuser_id] = $user->webuser_id;
            }
        }
        
        if( ! empty( $user_ids ) )
        {
            $query = $this->db->select('webuser.webuser_id, webuser.webuser_fname, webuser.webuser_lname ')
                    ->from('webuser')
                    ->where_in('webuser_id', $user_ids)
                    ->order_by('webuser_fname asc, webuser_lname asc')
                    ->get();
        
            return $query->result();
        }
        
        return null;
    }
    
    public function get_payment_list( $user_id )
    {
        $fixed_fields = 
                "jobs.job_type, "
                . "payments.payment_create,"
                . "jobs.title,"
                . "payments.des,"
                . "webuser.webuser_fname,"
                . "webuser.webuser_lname,"
                . "payments.payment_gross ";


        $hourly_fields = 
                "'" . HOURLY_JOB_TYPE . "' AS job_type, "
                . "invx.created_at as payment_create, "
                . "'' as title, "
                . "invx.description as des,"
                . "u.webuser_fname,"
                . "u.webuser_lname,"
                . "invx.amount_due as payment_gross ";
        
        $sql = 
           "SELECT $fixed_fields
            FROM payments
            JOIN webuser ON webuser.webuser_id = payments.buser_id
            JOIN jobs ON jobs.id = payments.job_id
            JOIN job_accepted ON job_accepted.job_id = payments.job_id
            JOIN job_bids ON job_bids.job_id = payments.job_id
            WHERE job_bids.user_id = payments.user_id
            AND job_accepted.fuser_id = payments.user_id
            AND payments.user_id = $user_id

            UNION ALL SELECT  $hourly_fields 
            FROM hourly_invoices as invx
            INNER JOIN job_accepted as ja ON ja.bid_id = invx.bid_id 
            INNER JOIN webuser u ON u.webuser_id = ja.buser_id 
            WHERE ja.fuser_id = $user_id AND invx.status = '" .  INVOICE_PAID ."'" 
         . "ORDER BY payment_create DESC";
        
        $query = $this->db->query($sql);
        
        return $query->result();
    }
    
    
    public function get_payment_list_of_employer( $user_id )
    {
        
        $fixed_fields = 
                "jobs.job_type, "
                . "payments.payment_create,"
                . "jobs.title,"
                . "payments.des,"
                . "webuser.webuser_fname,"
                . "webuser.webuser_lname,"
                . "payments.payment_gross ";


        $hourly_fields = 
                "'" . HOURLY_JOB_TYPE . "' AS job_type, "
                . "invx.created_at as payment_create, "
                . "'' as title, "
                . "invx.description as des,"
                . "u.webuser_fname,"
                . "u.webuser_lname,"
                . "invx.amount_due as payment_gross ";
        
        
        $sql = 
           "SELECT $fixed_fields
            FROM payments
            JOIN webuser ON webuser.webuser_id = payments.user_id
            JOIN jobs ON jobs.id = payments.job_id
            JOIN job_accepted ON job_accepted.job_id = payments.job_id
            JOIN job_bids ON job_bids.job_id = payments.job_id
            WHERE 
            job_accepted.buser_id = payments.buser_id
            AND payments.buser_id = $user_id

            UNION ALL SELECT  $hourly_fields 
            FROM hourly_invoices as invx
            INNER JOIN job_accepted as ja ON ja.bid_id = invx.bid_id 
            INNER JOIN webuser u ON u.webuser_id = ja.fuser_id 
            WHERE ja.buser_id = $user_id AND invx.status = '" .  INVOICE_PAID ."'" 
         . "ORDER BY payment_create DESC";
        
        $query = $this->db->query($sql);
        
        return $query->result();
    }
}