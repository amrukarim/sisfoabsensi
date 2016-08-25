<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

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


	<div class="ui stackable two column grid">
		<div class="thirteen wide column">
			<h2 class="ui header">
				<?php echo $title;?> <?php echo $kelas_item['kelas_nama'];?>
				<div class="sub header"><?php echo $desc;?></div>
			</h2>			
		</div>
		<div class="three wide column">
			<a href="<?php echo site_url('laporan/printsiswa')."/".$kelas_item['kelas_id'];?>" class="fluid ui yellow button" target="_NEW">Cetak</a>
		</div>
	</div>

	<div class="ui warning message">
		<p>Klik nama siswa untuk melihat laporan detail.</p>
	</div>

	<table id="example" class="ui selectable fixed single line stackable table" cellspacing="0" width="100%">
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
				<td><?php echo $no;?></td>
				<td><a href="<?php echo site_url('siswa/profil');?>/<?php echo $siswa_item['siswa_id']; ?>"><?php echo $siswa_item['siswa_nama']; ?></a></td>
				<td>
				<?php
					$siswa_id = $siswa_item['siswa_id'];
					$queryjumtk = $this->db->query("SELECT absensi_id FROM absensi WHERE absensi_status = 1 AND siswa_id = '$siswa_id' AND semester_id = '$semester_id'");
        			$jumtk = $queryjumtk->num_rows();

        			echo $jumtk;
				?>
				</td>
				<td>
				<?php
					$siswa_id = $siswa_item['siswa_id'];
					$queryjumsa = $this->db->query("SELECT absensi_id FROM absensi WHERE absensi_status = 2 AND siswa_id = '$siswa_id' AND semester_id = '$semester_id'");
        			$jumsa = $queryjumsa->num_rows();

        			echo $jumsa;
				?>
				</td>
				<td>
				<?php
					$siswa_id = $siswa_item['siswa_id'];
					$queryjumiz = $this->db->query("SELECT absensi_id FROM absensi WHERE absensi_status = 3 AND siswa_id = '$siswa_id' AND semester_id = '$semester_id'");
        			$jumiz = $queryjumiz->num_rows();

        			echo $jumiz;
				?>
				</td>
				<td>
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
	 	dom: "Bfrtip",
	        buttons: [
	            'excelHtml5'
	        ],
		"processing": true,
		"responsive": true,
		"iDisplayLength": 50
 	});
 });

  </script>