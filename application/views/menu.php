<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
	<!--Menu-->
	<div class="ui container stackable menu" style="margin-top:25px; margin-bottom:0px">
		<div class="header item">SIABSENSI</div>
		<a href="<?php echo site_url();?>" class="item"><i class="home icon"></i> Beranda</a>
		<div class="ui simple dropdown item">
			<i class="database icon"></i> Data <i class="dropdown icon"></i>
			<div class="menu">
				<a href="<?php echo site_url('absensi');?>" class="item"><i class="book icon"></i> Absensi</a>
				<div class="divider"></div>
				<a href="<?php echo site_url('siswa');?>" class="item"><i class="student icon"></i> Siswa</a>
				<a href="<?php echo site_url('kelas');?>" class="item"><i class="student icon"></i> Kelas</a>
				<a href="<?php echo site_url('guru');?>" class="item"><i class="student icon"></i> Guru / Admin</a>
			</div>
		</div>
		<a class="item"><i class="user icon"></i> Akun</a>
		<div class="right menu">
			<div class="item">
				<a href="<?php echo site_url('logout');?>" class="ui red button"><i class="sign out icon"></i> Keluar</a>
			</div>
		</div>
	</div>