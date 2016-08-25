<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelas extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		if (!$this->session->userdata('guru_id'))
		{
			redirect('login');
		}
		
		$this->load->model('kelas_model');
	}

	public function index()
	{
		$data['title']	= 'Kelas';
		$data['desc']	= 'Untuk melakukan absensi silakan memilih kelas dibawah.';
		$this->load->view('temp/head', $data);
		$this->load->view('temp/menu');
		$this->load->view('kelas/view_kelas');
		$this->load->view('temp/foot');
	}

	public function siswa($kelas_id)
	{
		$this->load->model('siswa_model');
		$data['siswa'] = $this->siswa_model->get_siswakelas($kelas_id);

		$this->load->model('absensi_model');
		$data['absensi'] = $this->absensi_model->get_absensikelas($kelas_id);

		$data['kelas_item'] = $this->kelas_model->get_kelas($kelas_id);

		$data['title']	= 'Kelas';
		$data['desc']	= 'Untuk melakukan absensi silakan memilih kelas dibawah.';
		$this->load->view('temp/head', $data);
		$this->load->view('temp/menu');
		$this->load->view('kelas/view_kelassiswa');
		$this->load->view('temp/foot');
	}


	function datatables_ajax()
	{
		/** AJAX Handle */
		if(
			isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
			!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
			strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
			)
		{
			
			$this->load->model('kelas_model');
			
			/**
			 * Mengambil Parameter dan Perubahan nilai dari setiap 
			 * aktifitas pada table
			 */
			$datatables  = $_POST;
			$datatables['table']    = 'kelas';
			$datatables['id-table'] = 'kelas_id';

			/**
			 * Kolom yang ditampilkan
			 */
			$datatables['col-display'] = array(
										   'kelas_id',
										   'kelas_nama',
										   'guru_nama',
										   'kelas_id'
										 );

			/**
			 * menggunakan table join
			 */
			$datatables['join']    = 'INNER JOIN guru ON kelas.guru_id = guru.guru_id';

			$this->kelas_model->Datatables($datatables);
		}

		return;
	}

	public function baru()
	{
		if ($this->session->userdata('guru_lv') != 1)
		{
			$this->session->set_flashdata('msg', 'Anda tidak berhak mengakses halaman ini.');
			redirect(site_url());
		}

		$this->load->model('guru_model');
		$data['guru'] = $this->guru_model->get_guru();

		$data['title']	= 'Kelas Baru';
		$data['desc']	= 'Untuk meng-input data kelas baru silakan lengkapi formulir dibawah.';
		$this->load->view('temp/head', $data);
		$this->load->view('temp/menu');
		$this->load->view('kelas/view_kelasbaru', $data);
		$this->load->view('temp/foot');
	}

	public function simpan()
	{
		if ($this->session->userdata('guru_lv') != 1)
		{
			$this->session->set_flashdata('msg', 'Anda tidak berhak mengakses halaman ini.');
			redirect(site_url());
		}
		
		$this->kelas_model->set_kelas();
		$this->session->set_flashdata('msg', 'Data berhasil disimpan.');
		redirect(site_url('kelas'));

	}
}
