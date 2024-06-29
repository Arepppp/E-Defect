<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Aduan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('aduan_model');
        $this->load->model('projek_model');
        $this->load->library('form_validation'); // Load form validation library
        $this->load->library('upload'); // Load upload library

        $this->load->library('auth'); // Load the Auth library
        $this->auth->check_login(); // Check login status
    }

    public function upload_form()
    {
        $this->load->view('templates/upload_form');
    }

    public function upload_image()
    {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 40960; // 40MiB
        $config['encrypt_name'] = true; // Optional: encrypt the file name for security

        $this->upload->initialize($config);

        if ($this->upload->do_upload('gambarAduan')) {
            $uploadData = $this->upload->data();
            $image_url = base_url('uploads/' . $uploadData['file_name']);
            $data = ['image_url' => $image_url];
            $this->load->view('templates/display_image', $data);
        } else {
            $error = $this->upload->display_errors();
            $this->load->view('templates/upload_form', ['error' => $error]);
        }
    }

    public function batal_Aduan()
    {
        $NoAduan = $this->input->get('NoAduan'); // Retrieve Projek ID from URL query parameter
        $this->aduan_model->batal_aduan($NoAduan);
        redirect('juruteknik/index');
    }

    public function tambah()
    {
        $NoProjek = $this->input->get('NoProjek'); // Retrieve Projek ID from URL query parameter
        $this->session->set_userdata('noprojek', $NoProjek); // Set noprojek data in session
        $data['kerosakan_list'] = $this->aduan_model->get_all_kerosakan();
        $this->load->view('templates/tambahAduan', $data);
    }

    //AJAX method for detailKerosakan
    public function get_details()
    {
        $kodkerosakan = $this->input->post('kodkerosakan');
        $details = $this->aduan_model->get_detail_kerosakan_by_kod($kodkerosakan);
        log_message('debug', 'Kodkerosakan: ' . $kodkerosakan);
        log_message('debug', 'Details: ' . json_encode($details));

        echo json_encode($details);
    }

    public function tambah_aksi()
    {
        log_message('debug', 'Entering tambah_aksi method');

        $this->_rules();

        if ($this->form_validation->run() == false) {
            log_message('debug', 'Form validation failed');
            $this->tambah();
        } else {
            log_message('debug', 'Form validation succeeded');
            $gambarAduanBlob = null;

            if (!empty($_FILES['gambarAduan']['name'])) {
                log_message('debug', 'File upload detected');
                $config['upload_path'] = './uploads/';
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['max_size'] = 40960; // 40MiB
                $config['encrypt_name'] = true;

                $this->upload->initialize($config);

                if ($this->upload->do_upload('gambarAduan')) {
                    log_message('debug', 'File upload successful');
                    $uploadData = $this->upload->data();
                    $filePath = $uploadData['full_path'];
                    $fileType = $uploadData['file_type'];

                    if (strpos($fileType, 'image') === 0) {
                        $gambarAduanBlob = file_get_contents($filePath);
                    } else {
                        log_message('error', 'Uploaded file is not an image');
                        $this->session->set_flashdata('error', 'Uploaded file is not an image.');
                        redirect('aduan/tambah');
                        return;
                    }
                } else {
                    log_message('error', $this->upload->display_errors());
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('aduan/tambah');
                    return;
                }
            }

            $data = array(
                'KODKEROSKAN' => $this->input->post('jenisKerosakan'),
                'KODDETAIL' => $this->input->post('detailAduan'),
                'TajukAduan' => $this->input->post('tajukAduan'),
                'GambarAduan' => $gambarAduanBlob,
                'Keterangan' => $this->input->post('keterangan'),
                'StatusAduan' => $this->input->post('statusAduan'),
                'NoProjek' => $this->input->post('NoProjek'),
            );

            log_message('debug', 'Data prepared for insertion: ' . print_r($data, true));

            if ($this->aduan_model->insert_data($data, 'aduan')) {
                log_message('debug', 'Data insertion successful');
                $this->session->set_flashdata('pesan', '<div class="alert alert-warning alert-dismissible fade show" role="alert">Data Berhasil Ditambah <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                redirect('adminptj/index');
            } else {
                log_message('error', 'Failed to insert data into the database');
                $this->session->set_flashdata('error', 'Failed to insert data into the database.');
                redirect('aduan/tambah?NoProjek=<?= $projekItem->NoProjek ?>');
            }
        }
    }

    public function aduanSiap_aksi()
    {
        $gambarAduanSiapBlob = null;

        if (!empty($_FILES['GAMBAR_ADUAN_SIAP']['name'])) {
            log_message('debug', 'File upload detected');
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png';
            $config['max_size'] = 40960; // 40MiB
            $config['encrypt_name'] = true;

            $this->upload->initialize($config);

            if ($this->upload->do_upload('GAMBAR_ADUAN_SIAP')) {
                log_message('debug', 'File upload successful');
                $uploadData = $this->upload->data();
                $filePath = $uploadData['full_path'];
                $fileType = $uploadData['file_type'];

                if (strpos($fileType, 'image') === 0) {
                    $gambarAduanSiapBlob = file_get_contents($filePath);
                } else {
                    log_message('error', 'Uploaded file is not an image');
                    $this->session->set_flashdata('error', 'Uploaded file is not an image.');
                    redirect('aduan/tambah');
                    return;
                }
            } else {
                log_message('error', $this->upload->display_errors());
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('aduan/tambah');
                return;
            }
        }
        date_default_timezone_set('Asia/Kuala_Lumpur');
        $data = array(
            'NoAduan' => $this->input->post('noAduan'),
            'StatusAduan' => "Siap Dibaiki",
            'GAMBAR_ADUAN_SIAP' => $gambarAduanSiapBlob,
            'TARIKH_PANGGIL_KONTRAKTOR' => $this->input->post('TARIKH_PANGGIL_KONTRAKTOR'),
            'TARIKH_SIAP_BAIKI' => date('Y-m-d H:i:s'),
            'KOMEN_JT' => $this->input->post('KOMEN_JT'),
            'KOMEN_KONTRAKTOR' => $this->input->post('KOMEN_KONTRAKTOR'),
        );

        $this->aduan_model->update_data($data, 'aduan');
        $this->session->set_flashdata('pesan', '<div class="alert alert-warning alert-dismissible fade show" role="alert">Data Berhasil Diubah <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('juruteknik/index');

    }

    public function resize_image($file_path)
    {
        list($width, $height) = getimagesize($file_path);
        $new_width = 800;
        $new_height = 600;

        $image_p = imagecreatetruecolor($new_width, $new_height);
        $image = imagecreatefromjpeg($file_path);
        imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

        // Save the resized image
        imagejpeg($image_p, $file_path, 75);
    }

    public function edit($NoAduan)
    {
        $this->_rules2();

        date_default_timezone_set('Asia/Kuala_Lumpur');
        $data = array(
            'NoAduan' => $this->input->post('noAduan'),
            'StatusAduan' => $this->input->post('statusAduan'),
            'TarikhStatusDikemaskini' => date('Y-m-d H:i:s'),
        );

        $this->aduan_model->update_data($data, 'aduan');
        $this->session->set_flashdata('pesan', '<div class="alert alert-warning alert-dismissible fade show" role="alert">Data Berhasil Diubah <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('juruteknik/index');

    }

    public function edit2($NoAduan)
    {
        $this->_rules2();


        date_default_timezone_set('Asia/Kuala_Lumpur');
        $data = array(
            'NoAduan' => $this->input->post('noAduan'),
            'KODKEROSKAN' => $this->input->post('jenisKerosakan'),
            'KODDETAIL' => $this->input->post('detailAduan'),
            'TajukAduan' => $this->input->post('tajukAduan'),
            'Keterangan' => $this->input->post('keterangan'),
            'StatusAduan' => $this->input->post('statusAduan'),
            'TarikhStatusDikemaskini' => date('Y-m-d H:i:s'),
        );

        $this->aduan_model->update_data($data, 'aduan');
        $this->session->set_flashdata('pesan', '<div class="alert alert-warning alert-dismissible fade show" role="alert">Data Berhasil Diubah <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('adminptj/index');

    }

    public function delete($NoAduan)
    {
        $where = array('NoAduan' => $NoAduan);
        $this->aduan_model->delete($where, 'aduan');
        $this->session->set_flashdata('pesan', '<div class="alert alert-warning alert-dismissible fade show" role="alert">Data Berhasil Dibuang <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('http://localhost:8080/e-DefectTest/juruteknik/index');
    }

    public function delete2($NoAduan)
    {
        $where = array('NoAduan' => $NoAduan);
        $this->aduan_model->delete($where, 'aduan');
        $this->session->set_flashdata('pesan', '<div class="alert alert-warning alert-dismissible fade show" role="alert">Data Berhasil Dibuang <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('http://localhost:8080/e-DefectTest/adminptj/index');
    }

    public function lihat_aduan()
    {
        //Juruteknik
        $noAduan = $this->input->get('NoAduan');

        // Load the model for accessing the database
        $this->load->model('aduan_model'); // Make sure to load the aduan model

        // Fetch data from the database based on the NoProjek value
        $data['details'] = $this->aduan_model->getDataByNoAduan($noAduan);

        // Load the view to display the details
        $this->load->view('templates/laporanAduanJT', $data);
    }

    public function lihat_aduan2()
    {
        //AdminPusatTanggungjawab
        $noAduan = $this->input->get('NoAduan');

        // Load the model for accessing the database
        $this->load->model('aduan_model'); // Make sure to load the aduan model

        // Fetch data from the database based on the NoProjek value
        $data['details'] = $this->aduan_model->getDataByNoAduan($noAduan);

        // Load the view to display the details
        $this->load->view('templates/laporanAduanAPTJ', $data);
    }

    public function _rules()
    {
        $this->form_validation->set_rules('jenisKerosakan', 'Jenis Kerosakan', 'required', array('required' => '%s Harus Diisi !!'));
        $this->form_validation->set_rules('detailAduan', 'Maklumat Kerosakan', 'required', array('required' => '%s Harus Diisi !!'));
        $this->form_validation->set_rules('tajukAduan', 'Tajuk Aduan', 'required', array('required' => '%s Harus Diisi !!'));
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required', array('required' => '%s Harus Diisi !!'));
    }



    public function _rules2()
    {
        $this->form_validation->set_rules('jenisKerosakan', 'Jenis Kerosakan', 'required', array('required' => '%s Harus Diisi !!'));
        $this->form_validation->set_rules('detailAduan', 'Maklumat Kerosakan', 'required', array('required' => '%s Harus Diisi !!'));
        $this->form_validation->set_rules('tajukAduan', 'Tajuk Aduan', 'required', array('required' => '%s Harus Diisi !!'));
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required', array('required' => '%s Harus Diisi !!'));
        $this->form_validation->set_rules('statusAduan', 'Status Aduan', 'required', array('required' => '%s Harus Diisi !!'));
    }

    public function file_check($str)
    {
        if (empty($_FILES['gambarAduan']['name'])) {
            $this->form_validation->set_message('file_check', 'Gambar Aduan harus diisi.');
            return false;
        }

        if ($_FILES['gambarAduan']['size'] > 41943040) { // 40MiB
            $this->form_validation->set_message('file_check', 'Ukuran Gambar Aduan melebihi batas maksimum.');
            return false;
        }

        $allowed_types = array('image/gif', 'image/jpeg', 'image/png');
        $file_type = $_FILES['gambarAduan']['type'];

        if (!in_array($file_type, $allowed_types)) {
            $this->form_validation->set_message('file_check', 'Tipe file Gambar Aduan tidak didukung (harus gif/jpg/png).');
            return false;
        }

        return true;
    }

    public function error()
    {
        $this->load->view('templates/Error');
    }
}
?>