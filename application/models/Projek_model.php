<?php

class Projek_model extends CI_Model
{
    public function get_data($table)
    {
        return $this->db->get($table);
    }

    public function get_aduan()
    {
        return $this->db->get('aduan');
    }

    public function get_aduan_from_date()
    {
        $this->db->select('*');
        $this->db->from('aduan');
        $this->db->where('DATE(TarikhAduan)', date('Y-m-d'));
        return $this->db->get();
    }

    public function get_aduan_tak_siap()
    {
        $this->db->select('*');
        $this->db->from('aduan');
        $this->db->where_not_in('StatusAduan', ['Siap Dibaiki', 'Aduan Batal']);
        return $this->db->get();
    }

    public function get_aduan_siap()
    {
        $this->db->select('*');
        $this->db->from('aduan');
        $this->db->where('StatusAduan', 'Siap Dibaiki');
        return $this->db->get();
    }

    public function get_aktif()
    {
        $this->db->select('*');
        $this->db->from('projek');
        $this->db->where('StatusProjek', 'Aktif');
        return $this->db->get();
    }

    public function get_tidak_aktif()
    {
        $this->db->select('*');
        $this->db->from('projek');
        $this->db->where('StatusProjek', 'Tamat Tempoh Waranti');
        return $this->db->get();
    }

    public function get_projek_for_juruteknik($idjt)
    {
        $this->db->select('*');
        $this->db->from('projek');
        $this->db->where('IdJT', $idjt);
        return $this->db->get();
    }

    public function get_projek_for_adminptj($idaptj)
    {
        $this->db->select('*');
        $this->db->from('projek');
        $this->db->where('IdAPTJ', $idaptj);
        return $this->db->get();
    }

    public function insert_data($data, $table)
    {
        // Add fields for the image data
        if (isset($data['GambarProjek1'])) {
            $this->db->set('GambarProjek1', $data['GambarProjek1']);
        }
        if (isset($data['GambarProjek2'])) {
            $this->db->set('GambarProjek2', $data['GambarProjek2']);
        }
        if (isset($data['GambarProjek3'])) {
            $this->db->set('GambarProjek3', $data['GambarProjek3']);
        }

        // Insert the rest of the data
        $this->db->insert($table, $data);
    }

    public function insert($data, $table)
    {
        // Insert the rest of the data
        $this->db->insert($table, $data);
    }

    public function update_projek($NoProjek, $data)
    {
        $this->db->where('NoProjek', $NoProjek);
        return $this->db->update('projek', $data);
    }

    public function update_projek_status($NoProjek, $data)
    {
        $this->db->where('NoProjek', $NoProjek);
        $result = $this->db->update('projek', $data);

        // Log database update query and result
        if ($result) {
            error_log('Database update successful. NoProjek: ' . $NoProjek . ', data: ' . json_encode($data));
        } else {
            error_log('Database update failed. NoProjek: ' . $NoProjek . ', data: ' . json_encode($data));
        }

        return $result;
    }

    public function update_SA($data, $table)
    {
        $this->db->where('IdSA', $data['IdSA']);
        $this->db->update($table, $data);
    }
    public function update_JT($data, $table)
    {
        $this->db->where('IdJT', $data['IdJT']);
        $this->db->update($table, $data);
    }
    public function update_APTJ($data, $table)
    {
        $this->db->where('IdAPTJ', $data['IdAPTJ']);
        $this->db->update($table, $data);
    }
    public function update_Perunding($data, $table)
    {
        $this->db->where('IDPERUNDING', $data['IDPERUNDING']);
        $this->db->update($table, $data);
    }
    public function update_Kontraktor($data, $table)
    {
        $this->db->where('IDKONTRAKTOR', $data['IDKONTRAKTOR']);
        $this->db->update($table, $data);
    }
    public function update_Kerosakan($data, $table)
    {
        $this->db->where('KODKEROSKAN', $data['KODKEROSKAN']);
        $this->db->update($table, $data);
    }
    public function update_Detail($data, $table)
    {
        $this->db->where('KODDETAIL', $data['KODDETAIL']);
        $this->db->update($table, $data);
    }

    public function batal_projek($NoProjek)
    {
        $this->db->set('StatusProjek', 'Projek Batal');
        $this->db->where('NoProjek', $NoProjek);
        $this->db->update('projek');
    }

    public function update_status($NoProjek, $StatusProjek)
    {
        $this->db->set('StatusProjek', $StatusProjek);
        $this->db->where('NoProjek', $NoProjek);
        return $this->db->update('projek');
    }

    public function getDataByNoProjek($noProjek, $idJT, $idAPTJ, $IDKONTRAKTOR, $IDPERUNDING1, $IDPERUNDING2, $IDPERUNDING3)
    {
        $projekQuery = $this->db->get_where('projek', array('NoProjek' => $noProjek));
        $juruteknikQuery = $this->db->get_where('juruteknik', array('IdJT' => $idJT));
        $adminptjQuery = $this->db->get_where('adminptj', array('IdAPTJ' => $idAPTJ));
        $kontraktorQuery = $this->db->get_where('kontraktor', array('IDKONTRAKTOR' => $IDKONTRAKTOR));
        $perunding1Query = $this->db->get_where('perunding', array('IDPERUNDING' => $IDPERUNDING1));
        $perunding2Query = $this->db->get_where('perunding', array('IDPERUNDING' => $IDPERUNDING2));
        $perunding3Query = $this->db->get_where('perunding', array('IDPERUNDING' => $IDPERUNDING3));

        // Assuming you want to return an array containing data from each table
        return array(
            'projek' => $projekQuery->row(),
            'juruteknik' => $juruteknikQuery->row(),
            'adminptj' => $adminptjQuery->row(),
            'kontraktor' => $kontraktorQuery->row(),
            'perunding1' => $perunding1Query->row(),
            'perunding2' => $perunding2Query->row(),
            'perunding3' => $perunding3Query->row(),
        );
    }

    public function delete($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }

    public function getNoProjek_JT($idjt)
    {
        $this->db->select('NoProjek');
        $this->db->where('IdJT', $idjt);
        $query = $this->db->get('projek');

        $result = $query->result_array();
        return array_column($result, 'NoProjek');
    }


    public function getNoProjek_APTJ($idaptj)
    {
        $this->db->select('NoProjek');
        $this->db->where('IdAPTJ', $idaptj);
        $query = $this->db->get('projek');

        $result = $query->result_array();
        return array_column($result, 'NoProjek');
    }


    public function get_all_kontraktor()
    {
        $query = $this->db->get('kontraktor'); //table name is 'kontraktor'
        return $query->result_array();
    }

    public function get_all_perunding()
    {
        $query = $this->db->get('perunding'); //table name is 'perunding'
        return $query->result_array();
    }

    public function get_all_sa()
    {
        $query = $this->db->get('superadmin'); //table name is 'superadmin'
        return $query->result_array();
    }
    public function get_all_kerosakan()
    {
        $query = $this->db->get('kerosakan'); //table name is 'kerosakan'
        return $query->result_array();
    }
    public function get_all_detail_kerosakan()
    {
        $query = $this->db->get('detail_kerosakan'); //table name is 'detail_kerosakan'
        return $query->result_array();
    }
}

?>