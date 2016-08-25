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
	<form action="<?php echo site_url('kelas/simpan');?>" method="POST" class="ui form">
	<div class="fields">
		<div class="sixteen wide field">
			<label>Nama Kelas</label>
			<input name="kelas_nama" type="text">
		</div>
	</div>
	<div class="fields">
		<div class="sixteen wide field">
			<label>Wali Kelas</label>
			<select name="guru_id" class="ui search dropdown">
				<option value="">Wali Kelas</option>
				<?php foreach ($guru as $guru_item): ?>
				<option value="<?php echo $guru_item['guru_id']; ?>"><?php echo $guru_item['guru_nama']; ?></option>
				<?php endforeach; ?>
			</select>
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
		  guru_nama: {
			identifier  : 'kelas_nama',
			rules: [
			  {
				type   : 'empty',
				prompt : 'Kolom Nama harus diisi'
			  },
			  {
				type   : 'minLength[3]',
				prompt : 'Kolom nama harus diisi minimal {ruleValue} karakter'
			  }
			]
		  },
		  guru_id: {
			identifier  : 'guru_id',
			rules: [
			  {
				type   : 'empty',
				prompt : 'Silakan memilih wali kelas'
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