<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="ui container">
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
		<div class="sixteen wide column">
			<h2 class="ui header">
				<?php echo $title;?> <?php echo $kelas_item['kelas_nama'];?>
				<div class="sub header"><?php echo $desc;?></div>
			</h2>			
		</div>
	</div>

	<div class="ui divider"></div>

	<table class="ui selectable fixed single line stackable table" cellspacing="0" width="100%">
	  <thead>
			<tr>
				<th>#ID</th>
				<th>Nama</th>
				<th>Absen</th>
				<th></th>
			</tr>
	  </thead>
	  <tbody>
			<?php $no = 1; foreach ($absensi as $absensi_item): ?>
			
			<tr>
				<td><?php echo $absensi_item['absensi_id']; ?></td>
				<td><?php echo $absensi_item['siswa_nama']; ?></td>
				<td>
					<?php
					if ($absensi_item['absensi_status']=='1') {
						echo "Tanpa Keterangan";
					}
					elseif ($absensi_item['absensi_status']=='2') {
						echo "Sakit";
					}
					elseif ($absensi_item['absensi_status']=='3') {
						echo "Izin";
					}
					?>
				</td>
				<td>
					<form action="<?php echo site_url('absensi/hapus');?>" method="POST">
						<input type="hidden" name="absensi_id" value="<?php echo $absensi_item['absensi_id']; ?>">
						<input type="hidden" name="siswa_id" value="<?php echo $absensi_item['siswa_id']; ?>">
						<input type="hidden" name="absensi_sk" value="<?php echo $absensi_item['absensi_sk']; ?>">
						<input type="hidden" name="siswa_emailortu" value="<?php echo $absensi_item['siswa_emailortu']; ?>">
						<input type="hidden" name="siswa_telportu" value="<?php echo $absensi_item['siswa_telportu']; ?>">
						<input type="hidden" name="kelas_id" value="<?php echo $absensi_item['kelas_id']; ?>">
						<input type="submit" class="ui fluid mini red button" value="Batalkan">
					</form>
				</td>
			</tr>

			<?php $no++; endforeach; ?>
	  </tbody>
	  
	</table>

	<table id="example" class="ui selectable fixed single line stackable table" cellspacing="0" width="100%">
	  <thead>
			<tr>
				<th>No</th>
				<th>Nama</th>
				<th></th>
			</tr>
	  </thead>
	  <tbody>
			<?php $no = 1; foreach ($siswa as $siswa_item): ?>
			
			<tr>
				<td><?php echo $no; ?></td>
				<td><a href="<?php echo site_url('siswa/profil');?>/<?php echo $siswa_item['siswa_id']; ?>"><?php echo $siswa_item['siswa_nama']; ?></a></td>
				<td>
					<form action="<?php echo site_url('absensi/simpan');?>" method="POST">

					
						<input type="hidden" name="siswa_id" value="<?php echo $siswa_item['siswa_id'];?>">
						<input type="hidden" name="siswa_nama" value="<?php echo $siswa_item['siswa_nama'];?>">
						<input type="hidden" name="kelas_id" value="<?php echo $kelas_item['kelas_id'];?>">
						<input type="hidden" name="siswa_emailortu" value="<?php echo $siswa_item['siswa_emailortu'];?>">
						<input type="hidden" name="siswa_telportu" value="<?php echo $siswa_item['siswa_telportu'];?>">
						
						<div class="three ui buttons">
							<input type="submit" class="ui red button" name="action" value="Alpha" onclick="return confirm('<?php echo $siswa_item['siswa_nama'];?>, Alpha')">
							<input type="submit" class="ui orange button" name="action" value="Sakit" onclick="return confirm('<?php echo $siswa_item['siswa_nama'];?>, Sakit')">
							<input type="submit" class="ui yellow button" name="action" value="Izin" onclick="return confirm('<?php echo $siswa_item['siswa_nama'];?>, Izin')">
						</div>
					</form>
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