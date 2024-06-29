<?php

class Aduan_model extends CI_Model
{
    // Get all aduan for a specific projek
    // Get aduan from specific projects
    public function get_aduan_from_projek($projekid)
    {
        // Check if $projekid is an array and not empty
        if (is_array($projekid) && !empty($projekid)) {
            // Use where_in for array of values
            $this->db->where_in('NoProjek', $projekid);
        } else if (!empty($projekid)) {
            // Handle single value (string or integer) properly
            $this->db->where('NoProjek', $projekid);
        } else {
            // Handle cases where $projekid is empty or invalid
            // Optionally, you can log an error or handle it accordingly
            log_message('error', 'Invalid or empty $projekid provided to get_aduan_from_projek method.');
            return []; // Return an empty array or handle as needed
        }

        // Apply ordering
        $this->db->order_by('NoAduan', 'DESC');

        // Execute the query
        $query = $this->db->get('aduan');

        // Return the results
        return $query->result();
    }


    // Get aduan from specific projects on a particular date
    public function get_aduan_from_date($projekid, $date)
    {
        $this->db->select('*');
        if (is_array($projekid)) {
            $this->db->where_in('NoProjek', $projekid);
        } else {
            $this->db->where('NoProjek', $projekid);
        }
        $this->db->where('DATE(TarikhAduan)', $date);
        $this->db->order_by('NoAduan', 'DESC');
        $query = $this->db->get('aduan');
        return $query->result();
    }

    // Get unfinished aduan from specific projects
    public function get_aduan_tak_siap($projekid)
    {
        $this->db->select('*');
        if (is_array($projekid)) {
            $this->db->where_in('NoProjek', $projekid);
        } else {
            $this->db->where('NoProjek', $projekid);
        }
        $this->db->where('StatusAduan !=', 'Siap Dibaiki');
        $this->db->order_by('NoAduan', 'DESC');
        $query = $this->db->get('aduan');
        return $query->result();
    }

    // Get finished aduan from specific projects
    public function get_aduan_siap($projekid)
    {
        $this->db->select('*');
        if (is_array($projekid)) {
            $this->db->where_in('NoProjek', $projekid);
        } else {
            $this->db->where('NoProjek', $projekid);
        }
        $this->db->where('StatusAduan', 'Siap Dibaiki');
        $this->db->order_by('NoAduan', 'DESC');
        $query = $this->db->get('aduan');
        return $query->result();
    }

    // Example method in your model to fetch jenis kerosakan name
    public function getJenisKerosakanName($kodKeroskan)
    {
        // Perform a query to get the name from your kerosakan table based on $kodKeroskan
        $query = $this->db->select('JENISKEROSAKAN')->from('kerosakan')->where('KODKEROSKAN', $kodKeroskan)->get();
        if ($query->num_rows() > 0) {
            return $query->row()->JENISKEROSAKAN;
        } else {
            return 'Unknown Jenis Kerosakan'; // Handle if no matching record found
        }
    }

    // Example method to fetch keterangan detail name
    public function getKeteranganDetailName($kodDetail)
    {
        // Query to get the name from detail_kerosakan table based on $kodDetail
        $query = $this->db->select('KETERANGANDETAIL')->from('detail_kerosakan')->where('KODDETAIL', $kodDetail)->get();
        if ($query->num_rows() > 0) {
            return $query->row()->KETERANGANDETAIL;
        } else {
            return 'Unknown Keterangan Detail'; // Handle if no matching record found
        }
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

    public function getDataByNoAduan($noAduan)
    {
        $aduanQuery = $this->db->get_where('aduan', array('NoAduan' => $noAduan));
        // Assuming you want to return an array containing data from the table
        return array(
            'aduan' => $aduanQuery->row(),
        );
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