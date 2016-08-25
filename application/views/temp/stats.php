<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="ui container">
	<?php
	if (isset($_SESSION['msg'])) {
	?>
	<div class="ui warning message">
		<i class="close icon"></i>
		<div class="header">
			<?php echo $_SESSION['msg'];?>
		</div>
	</div>
	<?php
	}
	?>
<div class="ui four column doubling grid" style="margin-bottom:0px; margin-top:0px">
	<div class="column">
    	<div class="ui segment">
			<h1 class="ui red header">
				<i class="warning sign icon"></i>
				<div class="content">
					<?php echo $cekabsen;?>
					<div class="sub header">Siswa Tidak hadir</div>
				</div>
			</h1>
    	</div>
	</div>
	<div class="column">
    	<div class="ui segment">
			<h1 class="ui header">
				<i class="student icon"></i>
				<div class="content">
					<?php echo $jumsis;?>
					<div class="sub header">Total Siswa</div>
				</div>
			</h1>
    	</div>
	</div>
	<div class="column">
    	<div class="ui segment">
			<h1 class="ui header">
				<i class="student icon"></i>
				<div class="content">
					<?php echo $jumgur;?>
					<div class="sub header">Total Guru</div>
				</div>
			</h1>
    	</div>
	</div>
	<div class="column">
    	<div class="ui segment">
			<h1 class="ui header">
				<i class="calendar icon"></i>
				<div class="content" style="text-overflow: ellipsis;">
					<?php echo $semester_item['semester_nama'];?>
					<div class="sub header"><?php echo date('F');?> - 
					<?php
					if ($semester_item['semester_tipe']=='1') {
						echo "Ganjil";
					} else {
						echo "Genap";
					}
					?>
					</div>
				</div>
			</h1>
    	</div>
	</div>
</div>
</div>