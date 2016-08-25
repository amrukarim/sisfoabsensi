<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!--Content-->
<div class="ui container">
	<div class="ui stackable two column grid">
		<div class="ten wide column">
			<h2 class="ui header">
				<?php echo $title;?>
				<div class="sub header"><a href="<?php echo site_url('guru');?>">Kembali</a></div>
			</h2>			
		</div>
		<div class="three wide column">
			<a href="<?php echo site_url('guru/ubah/'); echo "/".$guru_item['guru_id'];?>" class="fluid ui yellow button">Ubah Data</a>
		</div>
		<div class="three wide column">
			<a href="<?php echo site_url('guru/hapus/'); echo "/".$guru_item['guru_id'];?>" class="fluid ui red button">Hapus Data</a>
		</div>
	</div>

	<div class="ui divider"></div>
		<h3 class="ui header">
			<div class="sub header">Nama Lengkap</div>
			<?php echo $guru_item['guru_nama'];?>
		</h3>
		<h3 class="ui header">
			<div class="sub header">Jenis Kelamin</div>
			<?php
			if ($guru_item['guru_jk'] == 1) {
				echo "Laki-laki";
			}
			else {
				echo "Perempuan";
			}
			?>
		</h3>
		<h3 class="ui header">
			<div class="sub header">Tanggal Lahir</div>
			<?php echo $guru_item['guru_tgllahir'];?>
		</h3>
		<h3 class="ui header">
			<div class="sub header">Email</div>
			<?php echo $guru_item['guru_email'];?>
		</h3>
		<h3 class="ui header">
			<div class="sub header">Nomor Telpon</div>
			<?php echo $guru_item['guru_telp'];?>
		</h3>
		<h3 class="ui header">
			<div class="sub header">Level</div>
			<?php
			if ($guru_item['guru_lv'] == 1) {
				echo "Admin";
			}
			else {
				echo "Guru";
			}
			?>
		</h3>




</div>