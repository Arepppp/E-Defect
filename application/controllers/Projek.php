<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Projek extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/userguide3/general/urls.html
     */

    public function __construct()
    {
        parent::__construct();
        $this->load->model('projek_model');
        $this->load->model('aduan_model');
        $this->load->model('juruteknik_model');
        $this->load->model('adminptj_model');
    }
    public function index()
    {
        $data['projek'] = $this->projek_model->get_data('projek')->result();
        $this->session->set_userdata('count_total', $this->aduan_model->count_all_aduan());
        $this->load->view('templates/mainPage', $data);
    }

    public function index2()
    {
        $data['projek'] = $this->projek_model->get_aktif()->result();
        $this->load->view('templates/mainPage', $data);
    }

    public function index3()
    {
        $data['projek'] = $this->projek_model->get_tidak_aktif()->result();
        $this->load->view('templates/mainPage', $data);
    }

    public function index4()
    {
        $data['aduan'] = $this->projek_model->get_aduan_from_date()->result();
        $this->session->set_userdata('count_today', $this->aduan_model->count_aduan_today());
        $this->load->view('templates/mukaAduanSuperadmin', $data);
    }

    public function index5()
    {
        $data['aduan'] = $this->projek_model->get_aduan_tak_siap()->result();
        $this->session->set_userdata('count_belum_siap', $this->aduan_model->count_aduan_belum_siap());
        $this->load->view('templates/mukaAduanSuperadmin', $data);
    }

    public function index6()
    {
        $data['aduan'] = $this->projek_model->get_aduan_siap()->result();
        $this->session->set_userdata('count_siap', $this->aduan_model->count_aduan_siap());
        $this->load->view('templates/mukaAduanSuperadmin', $data);
    }

    public function index7()
    {
        $data['aduan'] = $this->projek_model->get_aduan()->result();
        $this->session->set_userdata('count_total', $this->aduan_model->count_all_aduan());
        $this->load->view('templates/mukaAduanSuperadmin', $data);
    }

    public function aduanSiap()
    {
        $this->load->view('templates/aduanSiap');
    }

    public function batal()
    {
        $NoProjek = $this->input->get('NoProjek'); // Retrieve Projek ID from URL query parameter
        $this->projek_model->batal_projek($NoProjek);
        redirect('projek/index');
    }

    public function login()
    {
        $this->form_validation->set_rules(
            'email',
            'Email',
            'required|trim|valid_email',
            array(
                'required' => '%s Harus Diisi !!'
            )
        );
        $this->form_validation->set_rules(
            'psw',
            'Password',
            'required|trim',
            array(
                'required' => '%s Harus Diisi !!'
            )
        );
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/loginPage');
        } else {
            $email = $this->input->post('email');
            $password = $this->input->post('psw');

            // Check email
            $superadmin = $this->db->get_where('superadmin', ['EmelSA' => $email])->row_array();
            $juruteknik = $this->db->get_where('juruteknik', ['EmelJT' => $email])->row_array();
            $adminptj = $this->db->get_where('adminptj', ['EmelAPTJ' => $email])->row_array();

            if ($superadmin) {
                if ($password == $superadmin['NoKP_SA']) {
                    // Define count variables for superadmin
                    $count_today = $this->aduan_model->count_aduan_today();
                    $count_total = $this->aduan_model->count_all_aduan();
                    $count_belum_siap = $this->aduan_model->count_aduan_belum_siap();
                    $count_siap = $this->aduan_model->count_aduan_siap();

                    $data = [
                        'count_today' => $count_today,
                        'count_total' => $count_total,
                        'count_belum_siap' => $count_belum_siap,
                        'count_siap' => $count_siap
                    ];

                    $this->session->set_userdata($data);
                    redirect('projek/index');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password salah!</div>');
                    redirect('projek/login');
                }
            } else if ($juruteknik) {
                if ($password == $juruteknik['NoKP_JT']) {
                    $id = $juruteknik['IdJT'];
                    $projek_ids = $this->db->select('NoProjek')->from('projek')->where('IdJT', $id)->get()->result_array();
                    $projek_ids = array_column($projek_ids, 'NoProjek');

                    if (!empty($projek_ids)) {
                        $count_today = $this->db->where_in('NoProjek', $projek_ids)->where('DATE(TarikhAduan)', date('Y-m-d'))->count_all_results('aduan');
                        $count_total = $this->db->where_in('NoProjek', $projek_ids)->count_all_results('aduan');

                        $count_belum_siap = $this->aduan_model->count_aduan_belum_siap($projek_ids);
                        $count_siap = $this->aduan_model->count_aduan_siap($projek_ids);

                        $data = [
                            'id' => $juruteknik['IdJT'],
                            'role_id' => 'Juruteknik',
                            'count_today' => $count_today,
                            'count_total' => $count_total,
                            'count_belum_siap' => $count_belum_siap,
                            'count_siap' => $count_siap
                        ];

                        $this->session->set_userdata($data);
                        redirect('juruteknik/index');
                    } else {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Tiada projek didaftarkan</div>');
                        redirect('projek/login');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password salah!</div>');
                    redirect('projek/login');
                }
            } else if ($adminptj) {
                if ($password == $adminptj['NoKP_APTJ']) {
                    $id = $adminptj['IdAPTJ'];
                    $projek_ids = $this->db->select('NoProjek')->from('projek')->where('IdAPTJ', $id)->get()->result_array();
                    $projek_ids = array_column($projek_ids, 'NoProjek');

                    if (!empty($projek_ids)) {
                        $this->db->where_in('NoProjek', $projek_ids);
                        $this->db->where('DATE(TarikhAduan)', date('Y-m-d'));
                        $count_today = $this->db->count_all_results('aduan');

                        $this->db->where_in('NoProjek', $projek_ids);
                        $count_total = $this->db->count_all_results('aduan');

                        $count_belum_siap = $this->aduan_model->count_aduan_belum_siap($projek_ids);
                        $count_siap = $this->aduan_model->count_aduan_siap($projek_ids);

                        $data = [
                            'id' => $adminptj['IdAPTJ'],
                            'role_id' => 'Admin Pusat Tanggungjawab',
                            'count_today' => $count_today,
                            'count_total' => $count_total,
                            'count_belum_siap' => $count_belum_siap,
                            'count_siap' => $count_siap
                        ];

                        $this->session->set_userdata($data);
                        redirect('adminptj/index');
                    } else {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Tiada projek didaftarkan</div>');
                        redirect('projek/login');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password salah!</div>');
                    redirect('projek/login');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Emel tidak didaftarkan</div>');
                redirect('projek/login');
            }
        }
    }


    public function lihat_projek()
    {
        //SUPERADMIN
        $noProjek = $this->input->get('NoProjek');
        $idJT = $this->input->get('IdJT');
        $idAPTJ = $this->input->get('IdAPTJ');
        $IDKONTRAKTOR = $this->input->get('IdKontraktor');
        $IDPERUNDING1 = $this->input->get('IdPerunding1');
        $IDPERUNDING2 = $this->input->get('IdPerunding2');
        $IDPERUNDING3 = $this->input->get('IdPerunding3');

        // Load the model for accessing the database
        $this->load->model('projek_model');
        $this->load->model('aduan_model'); // Make sure to load the aduan model

        // Fetch data from the database based on the NoProjek value
        $data['details'] = $this->projek_model->getDataByNoProjek($noProjek, $idJT, $idAPTJ, $IDKONTRAKTOR, $IDPERUNDING1, $IDPERUNDING2, $IDPERUNDING3);

        // Count the number of aduan for the project
        $data['count_total'] = $this->aduan_model->count_aduan_by_project($noProjek);

        // Count the number of aduan made today for the project
        $data['count_today'] = $this->aduan_model->count_aduan_today_by_project($noProjek);

        // Load the view to display the details
        $this->load->view('templates/maklumatProjek', $data);
    }

    public function lihat_projek2()
    {
        //JURUTEKNIK
        $noProjek = $this->input->get('NoProjek');
        $idJT = $this->input->get('IdJT');
        $idAPTJ = $this->input->get('IdAPTJ');
        $IDKONTRAKTOR = $this->input->get('IdKontraktor');
        $IDPERUNDING1 = $this->input->get('IdPerunding1');
        $IDPERUNDING2 = $this->input->get('IdPerunding2');
        $IDPERUNDING3 = $this->input->get('IdPerunding3');

        // Load the model for accessing the database
        $this->load->model('projek_model');
        $this->load->model('aduan_model'); // Make sure to load the aduan model

        // Fetch data from the database based on the NoProjek value
        $data['details'] = $this->projek_model->getDataByNoProjek($noProjek, $idJT, $idAPTJ, $IDKONTRAKTOR, $IDPERUNDING1, $IDPERUNDING2, $IDPERUNDING3);

        // Count the number of aduan for the project
        $data['count_total'] = $this->aduan_model->count_aduan_by_project($noProjek);

        // Count the number of aduan made today for the project
        $data['count_today'] = $this->aduan_model->count_aduan_today_by_project($noProjek);

        // Load the view to display the details
        $this->load->view('templates/maklumatProjek2', $data);
    }

    public function lihat_projek3()
    {
        //ADMINPTJ
        $noProjek = $this->input->get('NoProjek');
        $idJT = $this->input->get('IdJT');
        $idAPTJ = $this->input->get('IdAPTJ');
        $IDKONTRAKTOR = $this->input->get('IdKontraktor');
        $IDPERUNDING1 = $this->input->get('IdPerunding1');
        $IDPERUNDING2 = $this->input->get('IdPerunding2');
        $IDPERUNDING3 = $this->input->get('IdPerunding3');

        // Load the model for accessing the database
        $this->load->model('projek_model');
        $this->load->model('aduan_model'); // Make sure to load the aduan model

        // Fetch data from the database based on the NoProjek value
        $data['details'] = $this->projek_model->getDataByNoProjek($noProjek, $idJT, $idAPTJ, $IDKONTRAKTOR, $IDPERUNDING1, $IDPERUNDING2, $IDPERUNDING3);

        // Count the number of aduan for the project
        $data['count_total'] = $this->aduan_model->count_aduan_by_project($noProjek);

        // Count the number of aduan made today for the project
        $data['count_today'] = $this->aduan_model->count_aduan_today_by_project($noProjek);

        // Load the view to display the details
        $this->load->view('templates/maklumatProjek3', $data);
    }

    public function tambah()
    {
        $data['jt_list'] = $this->juruteknik_model->get_all_jt();
        $data['aptj_list'] = $this->adminptj_model->get_all_aptj();
        $data['kontraktor_list'] = $this->projek_model->get_all_kontraktor();
        $data['perunding_list'] = $this->projek_model->get_all_perunding();
        $this->load->view('templates/tambahProjek', $data);

    }
    public function tambah_aksi()
    {
        $this->_rules();

        if ($this->form_validation->run() == false) {
            $this->tambah();
        } else {
            $gambarProjek1Blob = $this->upload_image('gambarProjek1');
            $gambarProjek2Blob = $this->upload_image('gambarProjek2');
            $gambarProjek3Blob = $this->upload_image('gambarProjek3');

            $data = array(
                'NamaProjek' => $this->input->post('namaProjek'),
                'StatusProjek' => $this->input->post('statusProjek'),
                'TarikhMulaWaranti' => $this->input->post('tarikhMulaWaranti'),
                'TarikhTamatWaranti' => $this->input->post('tarikhTamatWaranti'),
                'IdJT' => $this->input->post('IdJT'),
                'IdAPTJ' => $this->input->post('IdAPTJ'),
                'GambarProjek1' => $gambarProjek1Blob,
                'GambarProjek2' => $gambarProjek2Blob,
                'GambarProjek3' => $gambarProjek3Blob,
                'IDKONTRAKTOR' => $this->input->post('IdKontraktor'),
                'IDPERUNDING1' => $this->input->post('IdPerunding1'),
                'IDPERUNDING2' => $this->input->post('IdPerunding2'),
                'IDPERUNDING3' => $this->input->post('IdPerunding3'),
            );

            $this->projek_model->insert_data($data, 'projek');
            $this->session->set_flashdata('pesan', '<div class="alert alert-warning alert-dismissible fade show" role="alert">Data Berhasil Ditambah <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('projek/index');
        }
    }

    private function upload_image($field_name)
    {
        if (!empty($_FILES[$field_name]['name'])) {
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png';
            $config['max_size'] = 40960; // 40MiB
            $config['encrypt_name'] = true;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload($field_name)) {
                $uploadData = $this->upload->data();
                $filePath = $uploadData['full_path'];
                $fileType = $uploadData['file_type'];

                // Resize the image if necessary (optional)
                if ($uploadData['file_size'] > 40960) { // 40MiB
                    $this->resize_image($filePath);
                }

                if (strpos($fileType, 'image') === 0) {
                    return file_get_contents($filePath);
                } else {
                    $this->session->set_flashdata('error', 'Uploaded file is not an image.');
                    redirect('projek/tambah');
                    return null;
                }
            } else {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('projek/tambah');
                return null;
            }
        }
        return null;
    }

    public function edit($NoProjek)
    {
        $this->_rules();

        if ($this->form_validation->run() == false) {
            $this->index();
        } else {
            $data = array(
                'NoProjek' => $NoProjek,
                'NamaProjek' => $this->input->post('namaProjek'),
                'StatusProjek' => $this->input->post('statusProjek'),
                'TarikhMulaWaranti' => $this->input->post('tarikhMulaWaranti'),
                'TarikhTamatWaranti' => $this->input->post('tarikhTamatWaranti'),
                'IdJT' => $this->input->post('IdJT'),
                'IdAPTJ' => $this->input->post('IdAPTJ'),
            );

            $this->projek_model->update_data($data, 'projek');
            $this->session->set_flashdata('pesan', '<div class=<div class="alert alert-warning alert-dismissible fade show" role="alert">
            Data Berhasil Diubah <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span></button></div>');
            redirect('projek/index');
        }
    }

    public function delete($NoProjek)
    {
        $where = array('NoProjek' => $NoProjek);
        $this->projek_model->delete($where, 'projek');
        $this->session->set_flashdata('pesan', '<div class=<div class="alert alert-warning alert-dismissible fade show" role="alert">
            Data Berhasil Dibuang <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span></button></div>');
        redirect('projek/index');
    }

    public function update_status()
    {
        // Get data from the AJAX request
        $NoProjek = $this->input->post('NoProjek');
        $StatusProjek = $this->input->post('StatusProjek');

        // Load the model
        $this->load->model('Projek_model');

        // Call the update function in the model
        $result = $this->Projek_model->update_status($NoProjek, $StatusProjek);

        // Send a response back to the AJAX call
        if ($result) {
            echo json_encode(['status' => 'success', 'message' => 'Status updated successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to update status']);
        }
    }


    public function _rules()
    {

        $this->form_validation->set_rules(
            'namaProjek',
            'Nama Projek',
            'required',
            array(
                'required' => '%s Harus Diisi !!'
            )
        );
        $this->form_validation->set_rules(
            'statusProjek',
            'Status Siswa',
            'required',
            array(
                'required' => '%s Harus Diisi !!'
            )
        );
        $this->form_validation->set_rules(
            'tarikhMulaWaranti',
            'Tarikh Mula Waranti',
            'required',
            array(
                'required' => '%s Harus Diisi !!'
            )
        );
        $this->form_validation->set_rules(
            'tarikhTamatWaranti',
            'Tarikh Tamat Waranti',
            'required',
            array(
                'required' => '%s Harus Diisi !!'
            )
        );
        $this->form_validation->set_rules(
            'IdJT',
            'ID Juruteknik Projek',
            'required',
            array(
                'required' => '%s Harus Diisi !!'
            )
        );
        $this->form_validation->set_rules(
            'IdAPTJ',
            'ID Admin Pusat Tanggungjawab',
            'required',
            array(
                'required' => '%s Harus Diisi !!'
            )
        );

    }

    public function error()
    {
        $this->load->view('templates/error');
    }

}