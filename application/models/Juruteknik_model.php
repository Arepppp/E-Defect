<?php

class Juruteknik_model extends CI_Model
{
    public function get_user_name($idjt) {
        $this->db->select('NamaPenuhJT'); // Assuming the column name is 'name'
        $this->db->where('IdJT', $idjt); // Assuming 'id' is the user ID column
        $query = $this->db->get('juruteknik'); // Assuming 'users' is the table name
        return $query->row('NamaPenuhJT'); // Assuming 'name' is the column containing the user's name
    }

    public function get_all_jt()
    {
        $query = $this->db->get('juruteknik'); //table name is 'juruteknik'
        return $query->result_array();
    }
}

?>