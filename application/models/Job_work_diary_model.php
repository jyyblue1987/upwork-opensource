<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Job_work_diary_model
 *
 * @author Hermannovich <donfack.hermann@gmail.com>
 */
class Job_work_diary_model extends CI_Model {
    
    public function exits($contract_id, Datetime $start_time, Datetime $end_time){
        
        $starting_date = $start_time->format('Y-m-d H:i:s');
        $ending_date   = $end_time->format('Y-m-d H:i:s');
        
        $query = $this->db->select('workdairy_id')
                    ->from('job_workdairy')
                    ->where('bid_id', $contract_id)
                    ->where(" ( " . "starting_hour >= '" . $starting_date . "' AND starting_hour < '" . $ending_date . "' ) ")
                    ->or_where(" ( " . "ending_hour > '" . $starting_date . "' AND ending_hour <= '" . $ending_date . "' ) ")
                    ->get();
        
        
        $result = $query->result_array();
        
        if( ! empty( $result ) ){
            return true;
        }
        return false;
    }
    
    public function insert( $data ){
        $this->db->insert('job_workdairy', $data);
    }
    
    public function update_work_tracker( $data ){
        
        $current_time      = $data['starting_hour'];        
        $nb_capture_screen = round(((strtotime( $data['ending_hour'] ) - strtotime($data['starting_hour'])) / 360));
        
        for ($i = 1; $i <= $nb_capture_screen; $i++) {
            $capturetime = date('Y-m-d H:i:s', strtotime("+6 minutes", strtotime($current_time)));
            $job_track = array(
                'jobid'        => $data['jobid'],
                'bid_id'       => $data['bid_id'],
                'cuser_id'     => $data['cuser_id'],
                'fuser_id'     => $data['fuser_id'],
                'cpture_image' => ( ! empty($data['cpture_image']) ? $data['cpture_image'] : NULL ),
                'capture_time' => $capturetime,
                'working_date' => $data['working_date'],
            );

            $this->db->insert('workdairy_tracker', $job_track);
            $current_time = $capturetime;
        }
                
    }
    
    public function get_work_hours($fuser_id, $job_id){
        $this->db
                ->select('total_hour')
                ->from('job_workdairy')
                ->where('fuser_id', $fuser_id)
                ->where('jobid', $job_id);
        $query = $this->db->get();
        return $query->result();
    }
    
    public function get_hour_work_for( $client_id )
    {
        $query = $this->db->select('SUM(total_hour) as total_hour')
                    ->from('job_workdairy')
                    ->where_in('cuser_id', $client_id)
                    ->get();
        
        $workedhours = $query->row();
        
        if( !empty( $workedhours ) )
            return  $workedhours->total_hour;
        
        return 0;
    }
}
