<?php

use Carbon\Carbon;

/**
 * Description of invoice_model
 *
 * @author Hermannovich <donfack.hermann@gmail.com>
 */
class invoice_model extends CI_Model 
{
    private $table = 'hourly_invoices'; 
    
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
}
