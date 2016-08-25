<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!--Content-->
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
		<div class="thirteen wide column">
			<h2 class="ui header">
				<?php echo $title;?>
				<div class="sub header"><?php echo $desc;?></div>
			</h2>			
		</div>
		<div class="three wide column">
			<a href="<?php echo site_url('semester/baru');?>" class="fluid ui green button">Semester Baru</a>
		</div>
	</div>

	<div class="ui divider"></div>

	<table id="example" class="ui selectable fixed single line unstackable table" cellspacing="0" width="100%">
	  <thead>
		  <tr>
				<th>Semester</th>
				<th>Hari Efektif</th>
				<th>Status</th>
				<th></th>
		  </tr>
	  </thead>
	  <tbody>
	  <?php foreach ($semester as $semester_item): ?>
			
			<tr>
				<td>
					<?php
						echo $semester_item['semester_nama'];

						if ($semester_item['semester_tipe']==1) {
						echo ' - Ganjil';
						}
						else {
						echo ' - Genap';
						}
					?>
				</td>
				<td><?php echo $semester_item['semester_hari']; ?></td>
				<td>
					<?php
						if ($semester_item['semester_status']==0) {
					?>
						<a href="<?php echo site_url('semester/aktivasi').'/'.$semester_item['semester_id'];?>"  class="negative ui button">Tidak Aktif</a>
					<?php
						}
						elseif ($semester_item['semester_status']==1) {
					?>
						<button class="positive ui button">Aktif</button>
					<?php
						}
					?>
					
				</td>
				<td>
					
					<a href="<?php echo site_url('semester/hapus/'); echo "/".$semester_item['semester_id'];?>" class="fluid ui red button" onclick="return confirm('Yakin?')">Hapus Data</a>

				</td>
			</tr>

			<?php endforeach; ?>
	  </tbody>
	</table>
</div>

  <script>
	
  $(document).ready(function() {

	// DataTable
	var table = $('#example').DataTable({

					"processing": true,
					
					"language": {
					   "lengthMenu": 'Menampilkan _MENU_ data',
						"paginate": {
							"previous": "Sebelumnya",
							"next": "Selanjutnya"
						  }
					}
				});
 

} );


  </script>
<script type="text/javascript">
$('.message .close')
  .on('click', function() {
	$(this)
	  .closest('.message')
	  .transition('fade')
	;
  })
;

</script>

</div>