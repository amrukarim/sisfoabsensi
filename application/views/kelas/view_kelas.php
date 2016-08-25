<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


<!--Content-->
<div class="ui container">
	<div class="ui stackable two column grid">
		<div class="thirteen wide column">
			<h2 class="ui header">
				<?php echo $title;?>
				<div class="sub header"><?php echo $desc;?></div>
			</h2>			
		</div>
		<div class="three wide column">
			<a href="<?php echo site_url('kelas/baru');?>" class="fluid ui green button">Kelas Baru</a>
		</div>
	</div>

	<div class="ui divider"></div>

	<table id="example" class="ui selectable fixed single line unstackable table" cellspacing="0" width="100%">
	  <thead>
		  <tr>
		  		<th>#ID</th>
				<th>Nama Kelas</th>
				<th>Wali Kelas</th>
				<th></th>
		  </tr>
	  </thead>
	  
	</table>
</div>

  <script>
 /**
  * Gunaknan ini jika TIDAK ingin menggunakan pencarian perkolom
  */
  // $(document).ready(function() {
  //    $('#example').DataTable({
  //        "processing": true,
  //        "serverSide": true,
  //        "ajax": {
  //            "url": "<?php echo base_url('kelas/datatables_ajax');?>",
  //            "type": "POST"
  //        }
  //    });
  //  });
	
  
  /**
   * Gunaknan ini jika ingin menggunakan pencarian perkolom 
   */
  $(document).ready(function() {

	// DataTable
	var table = $('#example').DataTable({

					"processing": true,
					"serverSide": true,
					"fnRowCallback": function( nRow, aData, iDisplayIndex ) {

						$('td:eq(2)', nRow).html('<a href="<?php echo site_url('kelas/siswa');?>/' + aData[3] +'" rel="nofollow" style="text-align:right" class="ui blue mini button">Pilih</a>');
						return nRow;
					},
					
					"ajax": {
						"url": "<?php echo base_url('kelas/datatables_ajax');?>",
						"type": "POST"
					},
					"language": {
					   "lengthMenu": 'Menampilkan _MENU_ data',
						"paginate": {
							"previous": "Sebelumnya",
							"next": "Selanjutnya"
						  }
					},
					"columnDefs": [
						{
							"targets": [ 0 ],
							"visible": false
						},
						{
							"className" : "right",
							"targets": [ 3 ]
						}]
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