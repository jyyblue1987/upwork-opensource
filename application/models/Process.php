<?php

/**
 * Queries for application, decline, interview, job offers, withdrawal processes
 *
 * @author avillanueva
 */
class Process extends CI_Model {

    function get_applications($user_id) {
        $this->db
                ->select('*')
                ->from('job_bids')
                ->where(array('bid_reject' => 0, 'status!=1' => null))
                ->where('user_id', $user_id)
                ->where('job_progres_status', 0)
                ->where(array('withdrawn' => NULL));
        $query = $this->db->get();

        $return_array = array();
        $return_array['rows'] = $query->num_rows();
        if ($return_array['rows'] > 0) {
            $return_array['data'] = $query->result();
        }
        return $return_array;
    }

    function get_rejected($user_id) {
        $this->db
                ->select('*')
                ->from('job_bids')
                ->where('user_id', $user_id)
                ->where("(withdrawn=1 OR bid_reject=1 OR withdrawn IS NULL)");
        $query = $this->db->get();

        $return_array = array();
        $return_array['rows'] = $query->num_rows();
        if ($return_array['rows'] > 0) {
            $return_array['data'] = $query->result();
        }
        return $return_array;
    }

    function get_interviews($sender_id, $job_id) {
        $this->db
                ->select('*')
                ->from('job_conversation')
                ->join('job_bids', 'job_conversation.bid_id=job_bids.id', 'inner')
                ->where('job_conversation.sender_id', $sender_id)
                ->where('job_conversation.job_id', $job_id)
                ->where('job_bids.bid_reject', 0)
                ->where('job_bids.job_progres_status', 1)
                ->where(array('job_bids.withdrawn' => NULL))
                ->group_by('job_conversation.bid_id');
        $query = $this->db->get();

        $return_array = array();
        $return_array['rows'] = $query->num_rows();
        if ($return_array['rows'] > 0) {
            $return_array['data'] = $query->result();
        }
        return $return_array;
    }

    function get_offers($job_id) {
        $this->db
                ->select('*')
                ->from('job_bids')
                ->db->where('job_bids.job_progres_status', 2)
                ->where(array('job_bids.withdrawn' => NULL))
                ->where(array('job_id' => $job_id, 'bid_reject' => 0, 'hired' => '1'));
        $query = $this->db->get();

        $return_array = array();
        $return_array['rows'] = $query->num_rows();
        if ($return_array['rows'] > 0) {
            $return_array['data'] = $query->result();
        }
        return $return_array;
    }
    
    function get_hires($jobId, $sender_id){
        $this->db
                ->select('*')
                ->from('job_accepted')
                ->join('job_bids', 'job_bids.id=job_accepted.bid_id', 'inner')
                ->where('job_accepted.buser_id', $sender_id)
                ->where('job_accepted.job_id', $jobId)
                ->where('job_bids.hired', '0')
                ->where('job_bids.jobstatus', '0')
                ->where('job_bids.job_progres_status', 3)
                ->where(array('job_bids.withdrawn' => NULL));
        $query = $this->db->get();

        $return_array = array();
        $return_array['rows'] = $query->num_rows();
        if ($return_array['rows'] > 0) {
            $return_array['data'] = $query->result();
        }
        return $return_array;
    }

}
