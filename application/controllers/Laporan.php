<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		if (!$this->session->userdata('guru_id'))
		{
			redirect('login');
		}
		
		$this->load->model('siswa_model');
	}

	public function index()
	{
		$data['title']	= 'Laporan';
		$data['desc']	= 'Untuk membuat laporan silakan memilih kelas dibawah.';
		$this->load->view('temp/head', $data);
		$this->load->view('temp/menu');
		$this->load->view('laporan/view_kelas');
		$this->load->view('temp/foot');
	}

	public function siswa($kelas_id)
	{
		$this->load->model('siswa_model');
		$data['siswa'] = $this->siswa_model->get_siswakelas($kelas_id);

		$this->load->model('absensi_model');
		$data['absensi'] = $this->absensi_model->get_absensikelas($kelas_id);

		$this->load->model('kelas_model');
		$data['kelas_item'] = $this->kelas_model->get_kelas($kelas_id);

		$this->load->model('semester_model');
		$data['semester_item'] = $this->semester_model->get_semesteraktif();
		if ($data['semester_item']['semester_tipe'] == 1) {
			$semester_tipe = 'Ganjil';
		}
		elseif ($data['semester_item']['semester_tipe'] == 2) {
			$semester_tipe = 'Genap';
		}

		$data['title']	= 'Laporan Kelas';
		$data['desc']	= 'Semester '.$semester_tipe.' '.$data['semester_item']['semester_nama'];
		$this->load->view('temp/head', $data);
		$this->load->view('temp/menu');
		$this->load->view('laporan/view_kelassiswa');
		$this->load->view('temp/foot');
	}

	public function printsiswa($kelas_id)
	{
		$this->load->model('siswa_model');
		$data['siswa'] = $this->siswa_model->get_siswakelas($kelas_id);

		$this->load->model('absensi_model');
		$data['absensi'] = $this->absensi_model->get_absensikelas($kelas_id);

		$this->load->model('kelas_model');
		$data['kelas_item'] = $this->kelas_model->get_kelas($kelas_id);

		$this->load->model('semester_model');
		$data['semester_item'] = $this->semester_model->get_semesteraktif();
		if ($data['semester_item']['semester_tipe'] == 1) {
			$semester_tipe = 'Ganjil';
		}
		elseif ($data['semester_item']['semester_tipe'] == 2) {
			$semester_tipe = 'Genap';
		}

		$data['title']	= 'Laporan Kelas';
		$data['desc']	= 'Semester '.$semester_tipe.' '.$data['semester_item']['semester_nama'];
		//$this->load->view('temp/head');
		//$this->load->view('temp/menu');
		$this->load->view('laporan/view_printkelassiswa', $data);
		//$this->load->view('temp/foot');
	}
}