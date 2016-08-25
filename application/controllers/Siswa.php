<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa extends CI_Controller {

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
		$data['title']	= 'Siswa';
		$data['desc']	= 'Untuk melihat data silakan memilih siswa dibawah.';
		$this->load->view('temp/head', $data);
		$this->load->view('temp/menu');
		$this->load->view('siswa/view_siswa');
		$this->load->view('temp/foot');
	}

	public function profil($siswa_id = NULL)
	{
		$this->load->helper('date');
		$this->load->model('semester_model');
		

        $data['siswa_item'] = $this->siswa_model->get_siswa($siswa_id);

        $this->load->model('absensi_model');
        $data['absensisiswa'] = $this->absensi_model->get_absensi($siswa_id);

        // Menentukan Semester Aktif
        $querysem = $this->db->query("SELECT semester_id, semester_nama, semester_hari FROM semester WHERE semester_status = 1");
        $row = $querysem->row();

        $semester_id = $row->semester_id;
        $data['semester_item'] = $this->semester_model->get_semesteraktif();



        // Mencari Jumlah Ketidakhadiran tanpa keterangan
        $queryjumtk = $this->db->query("SELECT absensi_id FROM absensi WHERE absensi_status = 1 AND siswa_id = '$siswa_id' AND semester_id = '$semester_id'");
        $data['jumtk'] = $queryjumtk->num_rows();

        // Mencari Jumlah Ketidakhadiran sakit
        $queryjumsa = $this->db->query("SELECT absensi_id FROM absensi WHERE absensi_status = 2 AND siswa_id = '$siswa_id' AND semester_id = '$semester_id'");
        $data['jumsa'] = $queryjumsa->num_rows();

        // Mencari Jumlah Ketidakhadiran izin
        $queryjumiz = $this->db->query("SELECT absensi_id FROM absensi WHERE absensi_status = 3 AND siswa_id = '$siswa_id' AND semester_id = '$semester_id'");
        $data['jumiz'] = $queryjumiz->num_rows();

        
        

        // Mengambil jumlah hari efektif dari database
        
        $data['jumhari'] = $row->semester_hari;

        if (empty($data['siswa_item']))
        {
                show_404();
        }

		$data['title']	= 'Profil Siswa';
		$data['desc']	= 'Untuk melakukan absensi silakan memilih siswa dibawah.';
		$this->load->view('temp/head', $data);
		$this->load->view('temp/menu');
		$this->load->view('siswa/view_siswaprofil');
		$this->load->view('temp/foot');
	}

	public function printprofil($siswa_id = NULL)
	{
		$this->load->helper('date');
		$this->load->model('semester_model');
		

        $data['siswa_item'] = $this->siswa_model->get_siswa($siswa_id);

        $this->load->model('absensi_model');
        $data['absensisiswa'] = $this->absensi_model->get_absensi($siswa_id);

        // Menentukan Semester Aktif
        $querysem = $this->db->query("SELECT semester_id, semester_nama, semester_hari FROM semester WHERE semester_status = 1");
        $row = $querysem->row();

        $semester_id = $row->semester_id;
        $data['semester_item'] = $this->semester_model->get_semesteraktif();



        // Mencari Jumlah Ketidakhadiran tanpa keterangan
        $queryjumtk = $this->db->query("SELECT absensi_id FROM absensi WHERE absensi_status = 1 AND siswa_id = '$siswa_id' AND semester_id = '$semester_id'");
        $data['jumtk'] = $queryjumtk->num_rows();

        // Mencari Jumlah Ketidakhadiran sakit
        $queryjumsa = $this->db->query("SELECT absensi_id FROM absensi WHERE absensi_status = 2 AND siswa_id = '$siswa_id' AND semester_id = '$semester_id'");
        $data['jumsa'] = $queryjumsa->num_rows();

        // Mencari Jumlah Ketidakhadiran izin
        $queryjumiz = $this->db->query("SELECT absensi_id FROM absensi WHERE absensi_status = 3 AND siswa_id = '$siswa_id' AND semester_id = '$semester_id'");
        $data['jumiz'] = $queryjumiz->num_rows();

        
        

        // Mengambil jumlah hari efektif dari database
        
        $data['jumhari'] = $row->semester_hari;

        if (empty($data['siswa_item']))
        {
                show_404();
        }

		
		$this->load->view('siswa/view_printsiswaprofil', $data);
	}

	public function ubah($siswa_id = NULL)
	{
		if ($this->session->userdata('guru_lv') != 1)
		{
			$this->session->set_flashdata('msg', 'Anda tidak berhak mengakses halaman ini.');
			redirect(site_url());
		}

        $data['siswa_item'] = $this->siswa_model->get_siswa($siswa_id);

        $this->load->model('kelas_model');
		$data['kelas'] = $this->kelas_model->get_kelas();

        if (empty($data['siswa_item']))
        {
                show_404();
        }

		$data['title']	= 'Ubah Profil Siswa';
		$data['desc']	= 'Untuk mengubah data siswa baru silakan lengkapi formulir dibawah.';
		$this->load->view('temp/head', $data);
		$this->load->view('temp/menu');
		$this->load->view('siswa/view_siswaubah');
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
			
			$this->load->model('siswa_model');
			
			/**
			 * Mengambil Parameter dan Perubahan nilai dari setiap 
			 * aktifitas pada table
			 */
			$datatables  = $_POST;
			$datatables['table']    = 'siswa';
			$datatables['id-table'] = 'siswa_id';

			/**
			 * Kolom yang ditampilkan
			 */
			$datatables['col-display'] = array(
										   'siswa_id',
										   'siswa_nama',
										   'kelas_nama'
										 );

			/**
			 * menggunakan table join
			 */
			//$datatables['join']    = 'INNER JOIN position ON position = id_position';
			$datatables['join']    = 'INNER JOIN kelas ON siswa.kelas_id = kelas.kelas_id';

			$this->siswa_model->Datatables($datatables);
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

		$this->load->model('kelas_model');
		$data['kelas'] = $this->kelas_model->get_kelas();

		$data['title']	= 'Siswa Baru';
		$data['desc']	= 'Untuk meng-input data siswa baru silakan lengkapi formulir dibawah.';

		$this->load->view('temp/head', $data);
		$this->load->view('temp/menu');
		$this->load->view('siswa/view_siswabaru');
		$this->load->view('temp/foot');
	}

	public function simpan()
	{
		
		$this->siswa_model->set_siswa();
		$this->session->set_flashdata('msg', 'Data berhasil disimpan.');
		redirect(site_url('siswa'));

	}

	public function simpanubah()
	{
		
		$this->siswa_model->update_siswa();
		$this->session->set_flashdata('msg', 'Data berhasil diubah.');
		redirect(site_url('siswa'));

	}

	public function hapus($siswa_id)
	{
		
		$this->siswa_model->delete_siswa($siswa_id);
		$this->session->set_flashdata('msg', 'Data berhasil dihapus.');
		redirect(site_url('siswa'));

	}
}
