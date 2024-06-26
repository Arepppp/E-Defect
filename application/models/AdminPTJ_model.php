<?php

class AdminPTJ_model extends CI_Model
{
    public function get_user_name($idaptj) {
        $this->db->select('NamaPenuhAPTJ'); // Assuming the column name is 'name'
        $this->db->where('IdAPTJ', $idaptj); // Assuming 'id' is the user ID column
        $query = $this->db->get('adminptj'); // Assuming 'users' is the table name
        return $query->row('NamaPenuhAPTJ'); // Assuming 'name' is the column containing the user's name
    }

    public function get_all_aptj()
    {
        $query = $this->db->get('adminptj'); //table name is 'adminptj'
        return $query->result_array();
    }

}

?>