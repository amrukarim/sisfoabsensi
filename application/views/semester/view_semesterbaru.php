<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!--Content-->
<div class="ui container">
	<h2 class="ui header">
		<?php echo $title;?>
		<div class="sub header"><?php echo $desc;?></div>
	</h2>           
<div class="ui grid">
<div class="sixteen wide mobile nine wide tablet six wide computer column">
	<form action="<?php echo site_url('semester/simpan');?>" method="POST" class="ui form">
	<div class="fields">
		<div class="sixteen wide field">
			<label>Tipe Semester</label>
			<select class="ui dropdown" name="semester_tipe">
				<option value="">Pilih Tipe Semester</option>
				<option value="1">Ganjil</option>
				<option value="2">Genap</option>
			</select>
		</div>
	</div>
	<div class="fields">
		<div class="sixteen wide field">
			<label>Tahun</label>
			<select class="ui dropdown" name="semester_tahunawal">
				<option value="">Pilih Tipe Semester</option>
				<?php $a=date('Y')-4; for($i=date('Y')+2; $i>$a; $i--): ?>
				<option value="<?php echo $i;?>"><?php echo $i;?> / <?php echo $i+1;?></option>
				<?php endfor; ?>
			</select>
		</div>
	</div>

	<div class="fields">
		<div class="sixteen wide field">
			<label>Hari Efektif</label>
			<input name="semester_hari">
		</div>
	</div>

		<div class="inline field">
			<div class="ui checkbox">
				<input type="checkbox" name="checkbox">
				<label>Saya telah memeriksa masukan data diatas telah diisi dengan benar.</label>
			</div>
		</div>

		<a href="<?php echo site_url('kelas');?>" class="ui negative deny right labeled icon button">Batal
			<i class="remove icon"></i>
		</a>
		<button class="ui positive right labeled icon submit button" type="submit">
			Simpan
			<i class="checkmark icon"></i>
		</button>
		<div class="ui error message"></div>
	</form>

</div>
</div>
</div>

<script type="text/javascript">
	$(document)
		.ready(function() {
			$('.ui.dropdown')
				.dropdown({
					on: 'click'
				})
			;
		})
	;

$(document).ready(function(){
	$('.ui.form')
	  .form({
		on: 'blur',
		fields: {
		  semester_hari: {
			identifier  : 'semester_hari',
			rules: [
			  {
				type   : 'empty',
				prompt : 'Kolom hari harus diisi'
			  },
			  {
				type   : 'minLength[3]',
				prompt : 'Kolom nama harus diisi minimal {ruleValue} karakter'
			  },
			  {
				type   : 'maxLength[3]',
				prompt : 'Kolom nama harus diisi maximal {ruleValue} karakter'
			  }
			]
		  },
		  semester_tipe: {
			identifier  : 'semester_tipe',
			rules: [
			  {
				type   : 'empty',
				prompt : 'Silakan memilih tipe semester'
			  }
			]
		  },
		  semester_tahunawal: {
			identifier  : 'semester_tahunawal',
			rules: [
			  {
				type   : 'empty',
				prompt : 'Silakan memilih tahun'
			  }
			]
		  },
		  checkbox: {
			identifier  : 'checkbox',
			rules: [
			  {
				type   : 'checked',
				prompt : 'Please check the checkbox'
			  }
			]
		  }
		}
	  })
	;
});
</script>