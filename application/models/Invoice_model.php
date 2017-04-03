<?php

use Carbon\Carbon;

/**
 * Description of invoice_model
 *
 * @author Hermannovich <donfack.hermann@gmail.com>
 */
class invoice_model extends CI_Model 
{
    public function make_invoice( $contract_id ) 
    {
        $dt         = Carbon::now();
        $start_week = $dt->copy()->startOfWeek();
        $end_week   = $dt->copy()->endOfWeek();
        
        $query = $this->db
                    ->select('*')
                    ->from('hourly_invoices')
                    ->join('job_workdiary', '', 'inner')
                    ->where('created_at >= ',  $start_week->timestamp )
                    ->where('updated_at <= ',  $end_week->timestamp )
                    ->get();
        
        $invoice = $query->row();
        
        if(empty($invoice))//draft an invoice
        {
            $invoice = new stdClass();
            //$invoice->
        }
        else//update the current invoice.
        {
            
        }
    }
}
