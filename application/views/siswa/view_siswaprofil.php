<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!--Content-->
<div class="ui container" style="padding-top:13px">
	<div class="ui stackable two column grid">
		<div class="ten wide column">
			<h2 class="ui header">
				<?php echo $title;?>
				<div class="sub header"><a href="#" onclick="window.history.back()">Kembali</a></div>
			</h2>			
		</div>
		<div class="three wide column">
			<a href="<?php echo site_url('siswa/ubah/'); echo "/".$siswa_item['siswa_id'];?>" class="fluid ui yellow button">Ubah Data</a>
		</div>
		<div class="three wide column">
			<a href="<?php echo site_url('siswa/hapus/'); echo "/".$siswa_item['siswa_id'];?>" class="fluid ui red button" onclick='swal({   title: "Are you sure?",   text: "Your will not be able to recover this imaginary file!",   type: "warning",   showCancelButton: true,   confirmButtonColor: "#DD6B55"   confirmButtonText: "Yes, delete it!" });'>Hapus Data</a>
		</div>
	</div>

	<div class="ui divider"></div>

	<div class="ui stackable two column grid">
		<div class="eight wide column">
			<div class="ui segment" style="margin-top:15px">
				<h3 class="ui header">
					<div class="sub header">Nama Lengkap</div>
					<?php echo $siswa_item['siswa_nama'];?>
				</h3>
				<h3 class="ui header">
					<div class="sub header">Jenis Kelamin</div>
					<?php
					if ($siswa_item['siswa_jk'] == 1) {
						echo "Laki-laki";
					}
					else {
						echo "Perempuan";
					}
					?>
				</h3>
				<h3 class="ui header">
					<div class="sub header">Telpon Orangtua</div>
					<?php echo $siswa_item['siswa_telportu'];?>
				</h3>
				<h3 class="ui header">
					<div class="sub header">Email Orangtua</div>
					<?php echo $siswa_item['siswa_emailortu'];?>
				</h3>
				<h3 class="ui header">
					<div class="sub header">Kelas</div>
					<?php echo $siswa_item['kelas_nama'];?>
				</h3>
			</div>

			<table class="ui selectable fixed single line stackable table" cellspacing="0" width="100%">
				<tr>
					<td>
						<strong>Semester Aktif</strong>
					</td>
					<td>
					<?php echo $semester_item['semester_nama'];?>
					<?php echo date('F');?> - 
					<?php
					if ($semester_item['semester_tipe']=='1') {
						echo "Ganjil";
					} else {
						echo "Genap";
					}
					?>						
					</td>
				</tr>
				<tr>
					<td>
						<strong>Sakit</strong>
					</td>
					<td>
						<?php echo $jumsa;?>
					</td>
				</tr>
				<tr>
					<td>
						<strong>Izin</strong>
					</td>
					<td>
						<?php echo $jumiz;?>
					</td>
				</tr>
				<tr>
					<td>
						<strong>Tanpa Keterangan</strong>
					</td>
					<td>
						<?php echo $jumtk;?>
					</td>
				</tr>
				<tr>
					<td>
						<strong>Jumlah Tidak Hadir</strong>
					</td>
					<td>
						<?php echo $jumth = $jumtk+$jumsa+
$jumiz;?>
					</td>
				</tr>
				<tr>
					<td>
						<strong>Jumlah Hari Efektif</strong>
					</td>
					<td>
						<?php echo $jumhari;?>
					</td>
				</tr>
				<tr>
					<td>
						<strong>Jumlah Hadir</strong>
					</td>
					<td>
						<?php echo $jumhari-$jumth;?>
					</td>
				</tr>
			</table>

		</div>

	<div class="eight wide column">
		<table class="ui selectable fixed single line stackable table" cellspacing="0" width="100%" id="example">
			<thead>
				<tr>
					<th>Tanggal</th>
					<th>Alasan</th>
				</tr>
			</thead>
			<tbody>
		<?php foreach ($absensisiswa as $absensisiswa_item): ?>
			<tr>
				<td>
					<?php 
					
		$datestring = '%d - %M - %Y';
		$time = strtotime($absensisiswa_item['absensi_waktu']);
		echo mdate($datestring, $time);
					?>
				</td>
				<td>
					<?php
						if ($absensisiswa_item['absensi_status'] == 1) {
							echo "Tanpa Keterangan";
						}
						elseif ($absensisiswa_item['absensi_status'] == 2) {
							echo "Sakit";
						}
						elseif ($absensisiswa_item['absensi_status'] == 3) {
							echo "Izin";
						}
					?>
				</td>
			</tr>
		<?php endforeach;?>
			</tbody>
		</table>

		<a href="<?php echo site_url('siswa/printprofil')."/".$siswa_item['siswa_id'];?>" class="ui yellow button" target="_NEW">Print</a>
	</div>
</div>


	

</div>

<script>
$(document).ready(function() {
 $('#example').DataTable({
 "processing": true,
 "responsive": true,
 });
 });
 </script>