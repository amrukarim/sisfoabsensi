<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Absensi extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		if (!$this->session->userdata('guru_id'))
		{
			redirect('login');
		}

		$this->load->model('absensi_model');
	}

	public function index()
	{
		$data['title']	= 'Absensi';
		$data['desc']	= 'Untuk melakukan absensi silakan memilih guru dibawah.';
		$this->load->view('temp/head', $data);
		$this->load->view('temp/menu');
		$this->load->view('absensi/view_absensi');
		$this->load->view('temp/foot');
	}
	public function simpan()
	{
		$date = date("Y-m-d");
		$siswa_id = $this->input->post('siswa_id');

		$query = "SELECT 
						siswa_id, 
						absensi_waktu 
					FROM 
						absensi 
					WHERE 
						siswa_id = '$siswa_id' 
					AND 
						DATE(absensi_waktu) = '$date'";

		$result = $this->db->query($query);
		$cekabsen = $result->num_rows();

		if ($cekabsen > 0)
		{
			$this->session->set_flashdata('msg', 'Sudah absen');
			redirect(site_url('kelas/siswa').'/'.$this->input->post('kelas_id'));
		}
		else
		{

			$securitykey = 
					date('ym dH is ') . 
					$this->session->userdata('guru_id') . 
					$this->input->post('kelas_id') . 
					$this->input->post('siswa_id');

			$this->absensi_model->set_absensi($securitykey);

			$nama = $this->input->post('siswa_nama');
			$emailortu = $this->input->post('siswa_emailortu');
			$telportu = $this->input->post('siswa_telportu');

			if ($this->input->post('action') == 'Alpha') {
				$status = 'Tanpa Keterangan';
			}
			elseif ($this->input->post('action') == 'Sakit') {
				$status = 'Sakit';
			}
			elseif ($this->input->post('action') == 'Izin') {
				$status = 'Izin';
			}

			$message = '
				Kepada Yth,<br>
				Orangtua <strong>'. $nama .'</strong> anak anda tidak hadir di sekolah,<br>
				dengan alasan '. $status . '.<br>
				Security Key: '. $securitykey;

			$sms = 'Kepada Yth, Orangtua '. $nama .' anak anda tidak hadir di sekolah, dengan alasan '. $status . ' Security Key: '. $securitykey;

			$sendmessage = htmlspecialchars(urlencode($sms));



			$this->load->library('email');
			$this->email->from('infowirabuana@amrukarim.web.id', 'Info Wira Buana');
			$this->email->to($emailortu);
			$this->email->subject('Info Wira Buana');
			$this->email->message($message);
			$this->email->send();

			$curlHandle = curl_init();
			$url="http://162.211.84.203/sms/smsreguler.php?username=amrukarim&password=ngINw9&key=5c3dd23db626c0a7bfddf9b6563b07ee&number=".$telportu."&message=".$sendmessage;
			curl_setopt($curlHandle, CURLOPT_URL,$url);
			curl_setopt($curlHandle, CURLOPT_HEADER, 0);
			curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curlHandle, CURLOPT_TIMEOUT,120);
			$hasil = curl_exec($curlHandle);
			curl_close($curlHandle);	


			$this->session->set_flashdata('msg', 'Data berhasil disimpan.');
			redirect(site_url('kelas/siswa').'/'.$this->input->post('kelas_id'));
		}

	}

	public function hapus()
	{
		$this->load->model('siswa_model');

		$this->absensi_model->delete_absensi();

		$absensi_id = $this->input->post('absensi_id');
		$data = $this->absensi_model->get_absensidata($absensi_id);

		$sk = $this->input->post('absensi_sk');
		$siswa_id = $this->input->post('siswa_id');

		

		$telportu = $this->input->post('siswa_telportu');
		$emailortu = $this->input->post('siswa_emailortu');

		


		$pesan = 'SecurityKey '. $sk .' dibatalkan, silakan cek keabsahan via s.id/985
';

		$smspesan = htmlspecialchars(urlencode($pesan));


			$this->load->library('email');
			$this->email->from('infowirabuana@amrukarim.web.id', 'Info Wira Buana');
			$this->email->to($emailortu);
			$this->email->subject('Info Wira Buana');
			$this->email->message($pesan);
			$this->email->send();

			$curlHandle = curl_init();
			$url="http://162.211.84.203/sms/smsreguler.php?username=amrukarim&password=ngINw9&key=5c3dd23db626c0a7bfddf9b6563b07ee&number=".$telportu."&message=".$smspesan;
			curl_setopt($curlHandle, CURLOPT_URL,$url);
			curl_setopt($curlHandle, CURLOPT_HEADER, 0);
			curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curlHandle, CURLOPT_TIMEOUT,120);
			$hasil = curl_exec($curlHandle);
			curl_close($curlHandle);	

		$this->session->set_flashdata('msg', 'Data berhasil dihapus.');
		redirect(site_url('kelas/siswa').'/'.$this->input->post('kelas_id'));

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
			
			$this->load->model('absensi_model');
			
			/**
			 * Mengambil Parameter dan Perubahan nilai dari setiap 
			 * aktifitas pada table
			 */
			$datatables  = $_POST;
			$datatables['table']    = 'absensi';
			$datatables['id-table'] = 'absensi_id';

			/**
			 * Kolom yang ditampilkan
			 */
			$datatables['col-display'] = array(
										   'absensi_id',
										   'siswa_id'
										 );

			/**
			 * menggunakan table join
			 */
			//$datatables['join']    = 'INNER JOIN position ON position = id_position';

			$this->absensi_model->Datatables($datatables);
		}
	}
}