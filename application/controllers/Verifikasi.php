<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Verifikasi extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('absensi_model');
	}

	public function index()
	{
		$data['title']	= 'Verifikasi';
		$data['desc']	= '<p>Ketikan <i>Security Key</i> pada kolom dibawah ini <strong>dengan menggunakan spasi pemisah</strong></p>';
		$this->load->view('temp/head', $data);
		//$this->load->view('temp/menu');
		$this->load->view('verifikasi/view_verifikasi');
		$this->load->view('temp/foot');
	}

}