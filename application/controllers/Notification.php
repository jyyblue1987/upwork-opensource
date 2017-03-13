<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Notification extends CI_Controller {

    public function check($notif_id = null) {
        if ($this->Adminlogincheck->checkx()) {
            if ($notif_id != null) {
                $this->db->select('*');
                $this->db->from('notification');
                $this->db->where('id_notification', $notif_id);
                $this->db->order_by("date desc");
                $query = $this->db->get();
                $result = $query->row();


                $update_data['read_status'] = 1;
                $this->db->where('id_notification', $notif_id);
                $this->db->update('notification', $update_data);
                redirect($result->link);
            }
        }
    }

    public function read_all($userid) {
        if ($this->Adminlogincheck->checkx()) {
            $this->db->select('*');
            $this->db->from('notification');
            $this->db->where('user_id', $userid);
            $query = $this->db->get();
            $result = $query->row();
        }

        $data = array(
            'read_status' => 1
        );

        $this->db->where('user_id', $userid);
        $this->db->update('notification', $data);
        redirect(site_url().'jobs-home');
    }

}
