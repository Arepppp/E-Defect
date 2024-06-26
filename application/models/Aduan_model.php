<?php

class Aduan_model extends CI_Model
{
    // Get all aduan for a specific projek
    public function get_aduan_from_projek($projekid)
    {
        $this->db->select('*');
        $this->db->where('NoProjek', $projekid);
        $this->db->order_by('NoAduan', 'DESC'); // Add order by clause
        $query = $this->db->get('aduan');
        return $query->result();
    }

    // Get aduan for a specific projek from today's date
    public function get_aduan_from_date($projekid)
    {
        $this->db->select('*');
        $this->db->where('NoProjek', $projekid);
        $this->db->where('DATE(TarikhAduan)', date('Y-m-d')); // Use DATE function for comparison
        $this->db->order_by('NoAduan', 'DESC');
        return $this->db->get('aduan')->result();
    }

    // Get aduan that are not completed for a specific projek
    public function get_aduan_tak_siap($projekid)
    {
        $this->db->select('*');
        $this->db->where('NoProjek', $projekid);
        $this->db->where_not_in('StatusAduan', ['Siap Dibaiki', 'Aduan Batal']);
        $this->db->order_by('NoAduan', 'DESC'); // Add order by clause
        return $this->db->get('aduan')->result();
    }

    // Get aduan that are completed for a specific projek
    public function get_aduan_siap($projekid)
    {
        $this->db->select('*');
        $this->db->where('NoProjek', $projekid);
        $this->db->where_in('StatusAduan', ['Siap Dibaiki', 'Aduan Batal']);
        $this->db->order_by('NoAduan', 'DESC'); // Add order by clause
        return $this->db->get('aduan')->result();
    }

    public function delete($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }

    public function update_data($data, $table)
    {
        $this->db->where('NoAduan', $data['NoAduan']);
        $this->db->update($table, $data);
    }

    public function count_aduan_by_project($noProjek)
    {
        $this->db->where('NoProjek', $noProjek);
        return $this->db->count_all_results('aduan');
    }

    public function count_aduan_today_by_project($noProjek)
    {
        $this->db->where('NoProjek', $noProjek);
        $this->db->where('DATE(TarikhAduan)', date('Y-m-d'));
        return $this->db->count_all_results('aduan');
    }

    public function count_aduan_today($projek_ids = [])
    {
        if (!empty($projek_ids)) {
            $this->db->where_in('NoProjek', $projek_ids);
        }
        $this->db->where('DATE(TarikhAduan)', date('Y-m-d'));
        return $this->db->count_all_results('aduan');
    }

    public function count_all_aduan($projek_ids = [])
    {
        if (!empty($projek_ids)) {
            $this->db->where_in('NoProjek', $projek_ids);
        }
        return $this->db->count_all_results('aduan');
    }

    public function count_aduan_belum_siap($projek_ids = [])
    {
        if (!empty($projek_ids)) {
            $this->db->where_in('NoProjek', $projek_ids);
        }
        $this->db->where('StatusAduan !=', 'Siap Dibaiki');
        return $this->db->count_all_results('aduan');
    }

    public function count_aduan_siap($projek_ids = [])
    {
        if (!empty($projek_ids)) {
            $this->db->where_in('NoProjek', $projek_ids);
        }
        $this->db->where('StatusAduan', 'Siap Dibaiki');
        return $this->db->count_all_results('aduan');
    }

    public function batal_aduan($NoAduan)
    {
        $this->db->set('StatusAduan', 'Aduan Batal');
        $this->db->where('NoAduan', $NoAduan);
        $this->db->update('Aduan');
    }

    public function get_all_kerosakan()
    {
        $query = $this->db->get('kerosakan'); //table name is 'kerosakan'
        return $query->result_array();
    }

    //AJAX method for detailKerosakan
    public function get_detail_kerosakan_by_kod($kodkerosakan)
    {
        $this->db->where('kodkerosakan', $kodkerosakan);
        $query = $this->db->get('detail_kerosakan');
        return $query->result_array();
    }

    public function insert_data($data, $table)
    {
        // Insert the data into the table
        if ($this->db->insert($table, $data)) {
            return true;
        } else {
            return false;
        }
    }


}

?>