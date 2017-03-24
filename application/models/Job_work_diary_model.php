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
    
    public function exits($contract_id, $start_time, $end_time){
        
        $query = $this->db->select('workdairy_id')
                    ->from('job_workdairy')
                    ->where('bid_id', $contract_id)
                    ->where("starting_hour BETWEEN $start_time AND $end_time")
                    ->or_where("ending_hour BETWEEN $start_time AND $end_time")
                    ->get();
        
        return $query->result()->num_rows > 0;
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
                'jobid'        => $data['job_id'],
                'bid_id'       => $data['bid_id'],
                'cuser_id'     => $data['clientid'],
                'fuser_id'     => $data['user_id'],
                'cpture_image' => ( ! empty($data['cpture_image']) ? $data['cpture_image'] : NULL ),
                'capture_time' => $capturetime,
                'working_date' => $data['working_date'],
            );

            $this->db->insert('workdairy_tracker', $job_track);
            $current_time = $capturetime;
        }
                
    }
}
