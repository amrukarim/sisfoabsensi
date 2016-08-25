<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!--Content-->
<body onload="window.print()" onfocus="window.close()">

<h2>Laporan Absensi</h2>
	<div class="ui stackable two column grid">
		<div class="eight wide column">
			<div class="ui segment" style="margin-top:15px">
				<p>
					<div class="sub header">Nama Lengkap</div>
					<?php echo $siswa_item['siswa_nama'];?>
				</p>
				<p>
					<div class="sub header">Jenis Kelamin</div>
					<?php
					if ($siswa_item['siswa_jk'] == 1) {
						echo "Laki-laki";
					}
					else {
						echo "Perempuan";
					}
					?>
				</p>
				<p>
					<div class="sub header">Telpon Orangtua</div>
					<?php echo $siswa_item['siswa_telportu'];?>
				</p>
				<p>
					<div class="sub header">Email Orangtua</div>
					<?php echo $siswa_item['siswa_emailortu'];?>
				</p>
				<p>
					<div class="sub header">Kelas</div>
					<?php echo $siswa_item['kelas_nama'];?>
				</p>
			</div>

			<table  cellspacing="0" width="100%" border="1">
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

<h2>Detail Absensi</h2>
	<div class="eight wide column">
		<table  cellspacing="0" width="100%" border="1">
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
	</div>
</div>


	

</div>



</body>

