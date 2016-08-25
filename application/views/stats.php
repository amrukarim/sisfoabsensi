<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
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
<div class="ui four column doubling fluid container grid statistics" style="margin-bottom:1px; padding-top:0px">
	<div class="column">
    	<div class="ui segment">
			<h1 class="ui red header">
				<i class="warning sign icon"></i>
				<div class="content">
					30
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
					700
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
					48
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
					16/17
					<div class="sub header">Juni - Sem. Genap</div>
				</div>
			</h1>
    	</div>
	</div>
</div>