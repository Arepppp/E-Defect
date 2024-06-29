<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Adminptj extends CI_Controller
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
		$this->load->model('adminptj_model');
		$this->load->model('aduan_model');

		$this->load->library('auth'); // Load the Auth library
		$this->auth->check_login(); // Check login status 
	}
	public function index()
	{
		$idaptj = $this->session->userdata('id');
		$data['user_name'] = $this->adminptj_model->get_user_name($idaptj);
		$data['projek'] = $this->projek_model->get_projek_for_adminptj($idaptj)->result();
		$data['noprojek'] = $this->projek_model->getNoProjek_APTJ($idaptj);

		$data['aduan'] = $this->aduan_model->get_aduan_from_projek($data['noprojek']);
		$data['kerosakan'] = $this->aduan_model->get_all_kerosakan(); // Fetch kerosakan list
		$data['detail_kerosakan'] = $this->aduan_model->get_all_detail_kerosakan(); // Fetch all detail kerosakan

		$data['count_today'] = $this->session->userdata('count_today');
		$data['count_total'] = $this->session->userdata('count_total');

		$this->load->view('templates/mainPage3', $data);
	}

	public function index2()
	{
		$idaptj = $this->session->userdata('id');
		$data['user_name'] = $this->adminptj_model->get_user_name($idaptj);
		$data['projek'] = $this->projek_model->get_projek_for_adminptj($idaptj)->result();
		$data['noprojek'] = $this->projek_model->getNoProjek_APTJ($idaptj);

		$date = date('Y-m-d'); // Example date, you can change this to any date you need
		$data['aduan'] = $this->aduan_model->get_aduan_from_date($data['noprojek'], $date);

		$data['count_today'] = $this->session->userdata('count_today');
		$data['count_total'] = $this->session->userdata('count_total');

		$this->load->view('templates/mainPage3', $data);
	}

	public function index3()
	{
		$idaptj = $this->session->userdata('id');
		$data['user_name'] = $this->adminptj_model->get_user_name($idaptj);
		$data['projek'] = $this->projek_model->get_projek_for_adminptj($idaptj)->result();
		$data['noprojek'] = $this->projek_model->getNoProjek_APTJ($idaptj);

		$data['aduan'] = $this->aduan_model->get_aduan_tak_siap($data['noprojek']);

		$data['count_today'] = $this->session->userdata('count_today');
		$data['count_total'] = $this->session->userdata('count_total');

		$this->load->view('templates/mainPage3', $data);
	}

	public function index4()
	{
		$idaptj = $this->session->userdata('id');
		$data['user_name'] = $this->adminptj_model->get_user_name($idaptj);
		$data['projek'] = $this->projek_model->get_projek_for_adminptj($idaptj)->result();
		$data['noprojek'] = $this->projek_model->getNoProjek_APTJ($idaptj);

		$data['aduan'] = $this->aduan_model->get_aduan_siap($data['noprojek']);

		$data['count_today'] = $this->session->userdata('count_today');
		$data['count_total'] = $this->session->userdata('count_total');

		$this->load->view('templates/mainPage3', $data);
	}

	// AJAX method to handle detail kerosakan based on jenis kerosakan
	public function get_detail_kerosakan_by_kod()
	{
		$kodkerosakan = $this->input->post('kodkerosakan');
		$result = $this->aduan_model->get_detail_kerosakan_by_kod($kodkerosakan);
		echo json_encode($result);
	}

}