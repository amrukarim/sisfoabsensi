<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Beranda extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		//date_default_timezone_set('Asia/Jakarta');

		if (!$this->session->userdata('guru_id'))
		{
			redirect('login');
		}

		$this->load->model('semester_model');
	}

	public function index()
	{
		$date = date("Y-m-d");
		$querycekabsen = $this->db->query("SELECT absensi_waktu FROM absensi WHERE DATE(absensi_waktu) = '$date'");
		$cekabsen = $querycekabsen->num_rows();

		$queryjumsis = $this->db->query("SELECT siswa_id FROM siswa");
		$jumsis = $queryjumsis->num_rows();

		$queryjumgur = $this->db->query("SELECT guru_id FROM guru");
		$jumgur = $queryjumgur->num_rows();

		$data['semester_item'] = $this->semester_model->get_semesteraktif();

		$data['title']	= 'Pilih Kelas';
		$data['desc']	= 'Untuk melakukan absensi silakan memilih kelas dibawah.';
		$data['cekabsen'] = $cekabsen;
		$data['jumsis'] = $jumsis;
		$data['jumgur'] = $jumgur;

		$this->load->view('temp/head', $data);
		$this->load->view('temp/menu');
		$this->load->view('temp/stats');
		$this->load->view('kelas/view_kelas');
		$this->load->view('temp/foot');
	}
}
