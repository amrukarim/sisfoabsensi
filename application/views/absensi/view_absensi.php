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
			<a href="<?php echo site_url('siswa/baru');?>" class="fluid ui green button">Siswa Baru</a>
		</div>
	</div>

	<div class="ui divider"></div>

	<table id="example" class="ui selectable fixed single line unstackable table" cellspacing="0" width="100%">
	  <thead>
		  <tr>
				<th>Absensi ID</th>
				<th>Siswa ID</th>
		  </tr>
	  </thead>
	  <tfoot>
		  <tr>
				<th>Absensi ID</th>
				<th>Siswa ID</th>
		  </tr>
	  </tfoot>
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
  //            "url": "<?php echo base_url('absensi/datatables_ajax');?>",
  //            "type": "POST"
  //        }
  //    });
  //  });
	
  
  /**
   * Gunaknan ini jika ingin menggunakan pencarian perkolom 
   */
  $(document).ready(function() {
	// Setup - add a text input to each footer cell
	$('#example tfoot th').each( function () {
		var title = $(this).text();
		var inp   = '<div class="ui fluid input"><input type="text" class="form-control" placeholder="Cari berdasarkan '+ title +'" ></div>';
		$(this).html(inp);
	} );
 
	// DataTable
	var table = $('#example').DataTable({

					"processing": true,
					"serverSide": true,
					"ajax": {
						"url": "<?php echo base_url('absensi/datatables_ajax');?>",
						"type": "POST"
					},
					"language": {
					   "lengthMenu": 'Menampilkan _MENU_ data',
						"paginate": {
							"previous": "Sebelumnya",
							"next": "Selanjutnya"
						  }
					 }
				});
 
	// Apply the search
	table.columns().every( function () {
		var that = this;
 
		$( 'input', this.footer() ).on( 'keyup change', function () {
			if ( that.search() !== this.value ) {
				that
					.search( this.value )
					.draw();
			}
		} );
	} );
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