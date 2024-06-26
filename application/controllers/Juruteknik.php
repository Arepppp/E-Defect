<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Juruteknik extends CI_Controller
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
		$this->load->model('juruteknik_model');
		$this->load->model('aduan_model');
	}
	public function index()
	{
		$idjt = $this->session->userdata('id');
		$data['user_name'] = $this->juruteknik_model->get_user_name($idjt);
		$data['projek'] = $this->projek_model->get_projek_for_juruteknik($idjt)->result();
		$data['noprojek'] = $this->projek_model->getNoProjek_JT($idjt);
		$data['aduan'] = $this->aduan_model->get_aduan_from_projek($data['noprojek']);
		$data['count_today'] = $this->session->userdata('count_today');
		$data['count_total'] = $this->session->userdata('count_total');
		$this->load->view('templates/mainPage2', $data);
	}
	public function index2()
	{
		$idjt = $this->session->userdata('id');
		$data['user_name'] = $this->juruteknik_model->get_user_name($idjt);
		$data['projek'] = $this->projek_model->get_projek_for_juruteknik($idjt)->result();
		$data['noprojek'] = $this->projek_model->getNoProjek_JT($idjt);
		$data['aduan'] = $this->aduan_model->get_aduan_from_date($data['noprojek']);
		$data['count_today'] = $this->session->userdata('count_today');
		$data['count_total'] = $this->session->userdata('count_total');
		$this->load->view('templates/mainPage2', $data);
	}
	public function index3()
	{
		$idjt = $this->session->userdata('id');
		$data['user_name'] = $this->juruteknik_model->get_user_name($idjt);
		$data['projek'] = $this->projek_model->get_projek_for_juruteknik($idjt)->result();
		$data['noprojek'] = $this->projek_model->getNoProjek_JT($idjt);
		$data['aduan'] = $this->aduan_model->get_aduan_tak_siap($data['noprojek']);
		$data['count_today'] = $this->session->userdata('count_today');
		$data['count_total'] = $this->session->userdata('count_total');
		$this->load->view('templates/mainPage2', $data);
	}
	public function index4()
	{
		$idjt = $this->session->userdata('id');
		$data['user_name'] = $this->juruteknik_model->get_user_name($idjt);
		$data['projek'] = $this->projek_model->get_projek_for_juruteknik($idjt)->result();
		$data['noprojek'] = $this->projek_model->getNoProjek_JT($idjt);
		$data['aduan'] = $this->aduan_model->get_aduan_siap($data['noprojek']);
		$data['count_today'] = $this->session->userdata('count_today');
		$data['count_total'] = $this->session->userdata('count_total');
		$this->load->view('templates/mainPage2', $data);
	}


}