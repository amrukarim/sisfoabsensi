<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<body onload="window.print()" onfocus="window.close()">
<div class="ui container" style="padding-top:15px">
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


	<h2><?php echo $title;?> <?php echo $kelas_item['kelas_nama'];?></h2>
	<p><?php echo $desc;?></p>

	<table id="example" border="1" cellspacing="0" width="100%">
	  <thead>
			<tr>
				<th>No</th>
				<th>Nama</th>
				<th>Tanpa Keterangan</th>
				<th>Sakit</th>
				<th>Izin</th>
				<th>Jumlah tidak hadir</th>
			</tr>
	  </thead>
	  <tbody>
	  		<?php
		  		// Menentukan Semester Aktif
		        $querysem = $this->db->query("SELECT semester_id, semester_nama, semester_hari FROM semester WHERE semester_status = 1");
		        $row = $querysem->row();

		        $semester_id = $row->semester_id;
	        ?>
			<?php $no = 1; foreach ($siswa as $siswa_item): ?>
			
			<tr>
				<td align="center"><?php echo $no;?></td>
				<td><?php echo $siswa_item['siswa_nama']; ?></td>
				<td align="center">
				<?php
					$siswa_id = $siswa_item['siswa_id'];
					$queryjumtk = $this->db->query("SELECT absensi_id FROM absensi WHERE absensi_status = 1 AND siswa_id = '$siswa_id' AND semester_id = '$semester_id'");
        			$jumtk = $queryjumtk->num_rows();

        			echo $jumtk;
				?>
				</td>
				<td align="center">
				<?php
					$siswa_id = $siswa_item['siswa_id'];
					$queryjumsa = $this->db->query("SELECT absensi_id FROM absensi WHERE absensi_status = 2 AND siswa_id = '$siswa_id' AND semester_id = '$semester_id'");
        			$jumsa = $queryjumsa->num_rows();

        			echo $jumsa;
				?>
				</td>
				<td align="center">
				<?php
					$siswa_id = $siswa_item['siswa_id'];
					$queryjumiz = $this->db->query("SELECT absensi_id FROM absensi WHERE absensi_status = 3 AND siswa_id = '$siswa_id' AND semester_id = '$semester_id'");
        			$jumiz = $queryjumiz->num_rows();

        			echo $jumiz;
				?>
				</td>
				<td align="center">
					<?php echo $jumiz+$jumsa+$jumtk; ?>
				</td>
			</tr>

			<?php $no++; endforeach; ?>
	  </tbody>
	  
	</table>
</div>

  <script>
$(document).ready(function() {
 $('#example').DataTable({
 "processing": true,
 "responsive": true,
 });
 });

 $('#example1').DataTable({
 "processing": true,
 "responsive": true,
 });
 });
  </script>
</body>