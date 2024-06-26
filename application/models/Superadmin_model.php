<?php

class Aduan_model extends CI_Model
{
    public function get_data($table)
    {
        return $this->db->get($table);
    }

}

?>