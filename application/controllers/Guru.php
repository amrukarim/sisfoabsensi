<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Guru extends CI_Controller {

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
		
		$this->load->model('guru_model');
	}

	public function index()
	{
		$data['title']	= 'Guru';
		$data['desc']	= 'Untuk melihat data guru silakan memilih guru dibawah.';
		$this->load->view('temp/head', $data);
		$this->load->view('temp/menu');
		$this->load->view('guru/view_guru');
		$this->load->view('temp/foot');
	}

	public function profil($guru_id = NULL)
	{

        $data['guru_item'] = $this->guru_model->get_guru($guru_id);

        if (empty($data['guru_item']))
        {
                show_404();
        }

		$data['title']	= 'Profil Guru';
		$data['desc']	= 'Untuk meng-input data guru baru silakan lengkapi formulir dibawah.';
		$this->load->view('temp/head', $data);
		$this->load->view('temp/menu');
		$this->load->view('guru/view_guruprofil');
		$this->load->view('temp/foot');
	}

	public function ubah($guru_id = NULL)
	{

        $data['guru_item'] = $this->guru_model->get_guru($guru_id);

        if (empty($data['guru_item']))
        {
                show_404();
        }

		$data['title']	= 'Ubah Profil Guru';
		$data['desc']	= 'Untuk mengubah data siswa baru silakan lengkapi formulir dibawah.';
		$this->load->view('temp/head', $data);
		$this->load->view('temp/menu');
		$this->load->view('guru/view_guruubah');
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
			
			$this->load->model('guru_model');
			
			/**
			 * Mengambil Parameter dan Perubahan nilai dari setiap 
			 * aktifitas pada table
			 */
			$datatables  = $_POST;
			$datatables['table']    = 'guru';
			$datatables['id-table'] = 'guru_id';

			/**
			 * Kolom yang ditampilkan
			 */
			$datatables['col-display'] = array(
										   'guru_id',
										   'guru_nama',
										   'guru_email',
										   'guru_telp'
										 );

			/**
			 * menggunakan table join
			 */
			//$datatables['join']    = 'INNER JOIN position ON position = id_position';

			$this->guru_model->Datatables($datatables);
		}

		return;
	}

	public function baru()
	{

		$data['title']	= 'Guru Baru';
		$data['desc']	= 'Untuk melakukan absensi silakan memilih guru dibawah.';

		$this->load->view('temp/head', $data);
		$this->load->view('temp/menu');
		$this->load->view('guru/view_gurubaru');
		$this->load->view('temp/foot');
	}

	public function simpan()
	{
		

		

		$guru_email = $this->input->post('guru_email');
		$guru_nama = $this->input->post('guru_nama');


			$message = '
				Terima Kasih,<br>
				<strong>'. $guru_nama .'</strong> anda telah terdaftar di sistem absensi SMK Wira Buana 1,<br>
				Untuk menggunakan sistem anda dapat mengakses <a href="http://skripsi.amrukarim.web.id">skripsi.amrukarim.web.id</a>, dengan menggunakan email ='.$guru_email.' dan tanggal lahir anda sebagai password dengan format YYYY-MM-DD ';



			$this->load->library('email');
			$this->email->from('infowirabuana@amrukarim.web.id', 'Info Wira Buana');
			$this->email->to($guru_email);
			$this->email->subject('Info Wira Buana');
			$this->email->message($message);

			$cek_email = $this->guru_model->cek_email($guru_email);

			if ($cek_email == 1) {
				$this->session->set_flashdata('msg', 'Email guru sudah terdaftar.');
				redirect(site_url('guru/baru'));
			}
			else
			{
				$this->guru_model->set_guru();
				$this->email->send();
				$this->session->set_flashdata('msg', 'Data berhasil disimpan.');
				redirect(site_url('guru'));
			}
			


	}

	public function simpanubah()
	{
		
		$this->guru_model->update_guru();
		$this->session->set_flashdata('msg', 'Data berhasil diubah.');
		redirect(site_url('guru'));

	}

	public function hapus($guru_id)
	{
		
		$this->guru_model->delete_guru($guru_id);
		$this->session->set_flashdata('msg', 'Data berhasil dihapus.');
		redirect(site_url('guru'));

	}
}
