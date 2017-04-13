<?php

use Carbon\Carbon;

/**
 * Description of invoice_model
 *
 * @author Hermannovich <donfack.hermann@gmail.com>
 */
class invoice_model extends CI_Model 
{
    private $table = 'hourly_invoices_items'; 
    
    public function get_invoice( $contract_id ) 
    {
        $dt         = Carbon::now();
        $start_week = $dt->copy()->startOfWeek();
        $end_week   = $dt->copy()->endOfWeek();
        
        $query = $this->db
                    ->select('*')
                    ->from( $this->table )
                    ->where('created_at >= ',  date('Y-m-d H:i:s', $start_week->timestamp ) )
                    ->where('updated_at <= ',  date('Y-m-d H:i:s', $end_week->timestamp) )
                    ->where('bid_id',  $contract_id )
                    ->get();
        
        return $query->row_array();
    }
    
    public function create( $data )
    {
        $this->db->insert( $this->table, $data);
    }
    
    public function update( $data )
    {
        $this->db->where('id', $data['id']);
        unset( $data['id'] );
        
        return $this->db->update( $this->table, $data ); 
    }
    
    public function get_invoices_in_processing_failure()
    {
        $query = $this->db->select('hourly_invoices.*, webuser.webuser_id, hourly_invoices_items.*')
                    ->from('hourly_invoices')
                    ->join('hourly_invoices_items', "hourly_invoices_items.invoice_id = hourly_invoices.id", 'inner')
                    ->join('job_accepted', "job_accepted.bid_id = hourly_invoices_items.bid_id", 'inner')
                    ->join('webuser', "webuser.webuser_id = job_accepted.buser_id", 'inner')
                    ->where('hourly_invoices.status', INVOICE_PROCESSING_PAID)
                    ->get();
        
        return $query->result();
    }
    
    public function set_status($id, $transaction_id, $status)
    {
        //set invoice status
        $this->db->where('id', $id);
        $this->db->update('hourly_invoices', array('status' => $status, 'transaction_id' => $transaction_id) ); 
        
        //set invoices item status
        $this->db->where('invoice_id', $id);
        $this->db->update('hourly_invoices_items', array('status' => $status) ); 
    }
    
    public function load_all_unpaid($start, $end)
    {        
        return $this->load_all($start, $end, INVOICE_UNPAID );
    }
    
    public function load_all($start, $end, $status )
    {
        $query = $this->db->select('hourly_invoices_items.*, webuser.webuser_id')
                    ->from('hourly_invoices_items')
                    ->join('job_accepted', "job_accepted.bid_id = hourly_invoices_items.bid_id", 'inner')
                    ->join('webuser', "webuser.webuser_id = job_accepted.buser_id", 'inner')
                    ->where('hourly_invoices_items.status', $status)
                    ->where('hourly_invoices_items.created_at >= ', $start)
                    ->where('hourly_invoices_items.created_at <= ', $end)
                    ->order_by('webuser_id')
                    ->get();
        
        return $query->result();   
    }
    
    public function save_invoice( $data )
    {
        $this->db->insert('hourly_invoices', $data);
        return $this->db->insert_id();
    }
    
    public function update_invoice($id, $data){
        $this->db->where('id', $id);
        $this->db->update('hourly_invoices', $data);
    }
    
    public function update_items($id, $data){
        $this->db->where('invoice_id', $id);
        $this->db->update('hourly_invoices_items', $data);
    }
    
    public function update_invoices_items($start, $end, $bid_ids, $invoice_service_id, $status)
    {
        //set invoices item status
        $this->db->where('created_at >= ', $start);
        $this->db->where('created_at <= ', $end);
        $this->db->where_in('bid_id', $bid_ids);
        $this->db->where('status', INVOICE_UNPAID);
        
        $this->db->update('hourly_invoices_items', array(
            'status'     => $status, 
            'invoice_id' => $invoice_service_id,
            'updated_at' => date('Y-m-d H:i:s') 
        ));
    }
}
