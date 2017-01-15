<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Timezone extends CI_Model
{
    public function get_timezones()
    {
        $resultset = $this->db->get('timezones');
        return $resultset->result();
    }

    public function get($id)
    {
        $resultset = $this->db->get_where('timezones', 'id = ' . $id);

        if ($resultset) {
            $result = $resultset->result_array();
            return reset($result);
        } else {
            return [];
        }

    }
}