<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
	<!--Menu-->
	<div class="ui container stackable menu" style="margin-top:25px; margin-bottom:10px">
		<div class="header item">SIABSENSI</div>
		<a href="<?php echo site_url();?>" class="item"><i class="home icon"></i> Beranda</a>
		<div class="ui dropdown item">
			<i class="database icon"></i> Data <i class="dropdown icon"></i>
			<div class="menu">
				<a href="<?php echo site_url('siswa');?>" class="item"><i class="student icon"></i> Siswa</a>
				<a href="<?php echo site_url('kelas');?>" class="item"><i class="student icon"></i> Kelas</a>
				<a href="<?php echo site_url('guru');?>" class="item"><i class="student icon"></i> Guru / Admin</a>
				<a href="<?php echo site_url('semester');?>" class="item"><i class="student icon"></i> Semester</a>
			</div>
		</div>

		<a href="<?php echo site_url('laporan');?>" class="item"><i class="book icon"></i> Laporan</a>

		<div class="right menu">
			<div class="ui dropdown item">
				<i class="user icon"></i> <?php echo $this->session->userdata('guru_nama');?> <i class="dropdown icon"></i>
				<div class="menu">
					<a class="item" href="<?php echo site_url('logout');?>"><i class="sign out icon"></i> Keluar</a>
				</div>
			</div>
		</div>
	</div>

	