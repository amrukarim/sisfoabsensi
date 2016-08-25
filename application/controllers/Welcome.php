<?php
class Welcome extends CI_Controller {
	/* application/controllers/welcome.php */
	public function index()
	{
		$this->load->library('email');
		$this->email->from('amrukarimde@gmail.com', 'Karim Amrullah');
		$this->email->to('zayus29@gmail.com');
		$this->email->subject('Test Email using SendGrid');
		$this->email->message('This email was delivered by your friends at SendGrid');
		$this->email->send();
		//$this->load->view('welcome_message');

		if ($this->email->send()) {
			echo "Berhasil";
		}
		else {
			echo "Gagal";
		}
	}
}