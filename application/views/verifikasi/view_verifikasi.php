<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!--Content-->
<div style="padding-top:20px">
<div class="ui middle aligned center aligned grid">
  <div class="column">
	<?php
	if (isset($_SESSION['msg'])) {
	?>
	<div class="ui info message">
		<i class="close icon"></i>
		<div class="header">
			<?php echo $_SESSION['msg'];?>
		</div>
	</div>
	<?php
	}
	?>
			<h2 class="ui header">
				<?php echo $title;?>
				<div class="sub header"><?php echo $desc;?></div>
			</h2>
<div class="ui stackable one column middle aligned center aligned grid">
	<div class="eight wide column">

	<form action="<?php echo site_url('verifikasi');?>" method="GET">
		<div class="ui fluid action input">
		  <input type="text" name="sk" placeholder="Security Key" value="<?php if (isset($_GET['sk'])) {
		  	echo $_GET['sk'];
		  }?>">
		  <button type="submit" class="ui button">Cari</button>
		</div>
	</form>


<?php
if (isset($_GET['sk'])) {

	$absensi_sk = $_GET['sk'];

	$querysk = $this->db->query("SELECT * FROM absensi INNER JOIN siswa ON absensi.siswa_id=siswa.siswa_id INNER JOIN kelas ON kelas.kelas_id=siswa.kelas_id INNER JOIN guru ON kelas.guru_id=guru.guru_id WHERE absensi.absensi_sk = '$absensi_sk'");
	$jumsk = $querysk->num_rows();



	if ($jumsk == 0) {
?>
	<div class="ui red message">
		<div class="header">
			<i>Security Key</i> tidak ditemukan atau dibatalkan!
		</div>
	</div>
<?php
	}
	else {
		$row = $querysk->row();
?>


		<table class="ui table">
			<tr>
				<td>Nama</td>
				<td><?php echo $row->siswa_nama;?></td>
			</tr>
			<tr>
				<td>Tanggal</td>
				<td><?php echo $row->absensi_waktu;?></td>
			</tr>
			<tr>
				<td>Alasan</td>
				<td>
					<?php
						if ($row->absensi_status == 1) {
							echo "Tanpa Alasan";
						}
						elseif ($row->absensi_status == 2) {
							echo "Sakit";
						}
						elseif ($row->absensi_status == 3) {
							echo "Izin";
						}
					?>
				</td>
			</tr>
			<tr>
				<td>Kelas</td>
				<td><?php echo $row->kelas_nama;?></td>
			</tr>
			<tr>
				<td>Wali Kelas</td>
				<td><?php echo $row->guru_nama;?></td>
			</tr>
			
		</table>

<?php
	}

}
?>
	</div>
</div>

</div>
</div>
</div>