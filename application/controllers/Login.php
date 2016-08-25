<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('login_model');
	}

	public function process()
	{
		if ($this->session->userdata('guru_id'))
		{
			redirect(site_url());
		}

		$email = $this->input->post('email');
		$password = md5($this->input->post('password'));

		$periksadata = $this->login_model->periksa_dataguru($email, $password);

		if ($periksadata->num_rows()  == 1)
		{
			foreach ($periksadata->result() as $data)
			{
				$sess_data['guru_id'] = $data->guru_id;
				$sess_data['guru_nama'] = $data->guru_nama;
				$sess_data['guru_lv'] = $data->guru_lv;
				$this->session->set_userdata($sess_data);
			}

			redirect(site_url());
		}
		else
		{
			redirect('login');
		}
	}

	public function index()
	{
		if ($this->session->userdata('guru_id'))
		{
			redirect(site_url());
		}

		$data['title']	= 'Login';
		$data['desc']	= 'Untuk melakukan absensi silakan memilih guru dibawah.';
		$this->load->view('temp/head', $data);
		//$this->load->view('temp/menu');
		$this->load->view('view_login');
		$this->load->view('temp/foot');
	}

	public function logout()
	{
		if (!$this->session->userdata('guru_id'))
		{
			redirect('login');
		}

		$this->session->sess_destroy();
		redirect('login');
	}
}