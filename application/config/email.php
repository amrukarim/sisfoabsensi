<?php
/* application/config/email.php */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|--------------------------------------------------------------------------
| SendGrid Setup
|--------------------------------------------------------------------------
|
| All we have to do is configure CodeIgniter to send using the SendGrid
| SMTP relay:
*/
$config['protocol']		= 'smtp';
$config['smtp_port']	= '587';
$config['smtp_host']	= 'smtp.sendgrid.net';
$config['smtp_user']	= 'amrukarim';
$config['smtp_pass']	= 'Sangatrahasia1';
$config['mailtype']		= 'html';
$config['crlf'] 		= '\r\n';
$config['newline'] 		= '\r\n';