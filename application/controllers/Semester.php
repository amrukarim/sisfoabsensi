<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Semester extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		if (!$this->session->userdata('guru_id'))
		{
			redirect('login');
		}
		
		if ($this->session->userdata('guru_lv') != 1)
		{
			$this->session->set_flashdata('msg', 'Anda tidak berhak mengakses halaman ini.');
			redirect(site_url());
		}
		
		$this->load->model('semester_model');
	}

	public function index()
	{
		$data['title']	= 'Semester';
		$data['desc']	= 'Data semester';

		$data['semester'] = $this->semester_model->get_semester();

		$this->load->view('temp/head', $data);
		$this->load->view('temp/menu');
		$this->load->view('semester/view_semester');
		$this->load->view('temp/foot');
	}

	public function baru()
	{
		$data['title']	= 'Semester Baru';
		$data['desc']	= 'Untuk meng-input data semester baru silakan lengkapi formulir dibawah.';


		$this->load->view('temp/head', $data);
		$this->load->view('temp/menu');
		$this->load->view('semester/view_semesterbaru');
		$this->load->view('temp/foot');
	}

	public function simpan()
	{
		$semester_tipe = $this->input->post('semester_tipe');
		$semester_tahunawal = $this->input->post('semester_tahunawal');
		$query = $this->db->query("SELECT semester_id, semester_tipe, semester_tahunawal FROM semester WHERE semester_tipe = '$semester_tipe' AND semester_tahunawal = '$semester_tahunawal'");
		$ceksemester = $query->num_rows();

		if ($ceksemester > 0) {
			$this->session->set_flashdata('msg', 'Sudah ada');
			redirect(site_url('semester'));
		} else {
		
			$this->semester_model->set_semester();
			$this->session->set_flashdata('msg', 'Data berhasil disimpan.');
			redirect(site_url('semester'));

		}

	}

	public function hapus($semester_id)
	{
		
		$this->semester_model->delete_semester($semester_id);
		$this->session->set_flashdata('msg', 'Data berhasil dihapus.');
		redirect(site_url('semester'));

	}

	public function aktivasi($semester_id)
	{
		
		$this->semester_model->aktivasi_semester($semester_id);
		$this->semester_model->nonaktivasi_semester($semester_id);
		$this->session->set_flashdata('msg', 'Semester berhasil diaktivasi');
		redirect(site_url('semester'));

	}

}