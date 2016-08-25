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
	<form action="<?php echo site_url('guru/simpanubah');?>" method="POST" class="ui form">
	<input type="hidden" name="guru_id" value="<?php echo $guru_item['guru_id'];?>">
	<div class="fields">
		<div class="sixteen wide field">
			<label>Nama Lengkap</label>
			<input name="guru_nama" type="text" value="<?php echo $guru_item['guru_nama'];?>">
		</div>
	</div>
	<div class="fields">
		<div class="eight wide field">
			<label>Jenis Kelamin</label>
			<select class="ui dropdown" name="guru_jk">
				<option value="">Pilih jenis kelamin</option>
				<option value="1" <?php if($guru_item['guru_jk']==1){echo "selected='selected'";}?>>Laki-laki</option>
				<option value="2" <?php if($guru_item['guru_jk']==2){echo "selected='selected'";}?>>Perempuan</option>
			</select>
		</div>

		<div class="eight wide field">
			<label>Tanggal Lahir</label>
			<input name="guru_tgllahir" type="date" value="<?php echo $guru_item['guru_tgllahir'];?>">
		</div>
	</div>

	<div class="fields">
		<div class="eight wide field">
			<label>Nomor Telpon (HP)</label>
			<div class="ui input">
			<input name="guru_telp" type="text" value="<?php echo $guru_item['guru_telp'];?>">
			</div>
		</div>
	</div>

	<div class="fields">
		<div class="eight disabled wide field">
			<label>Email</label>
			<input name="guru_email" type="text" value="<?php echo $guru_item['guru_email'];?>">
		</div>
		<div class="eight wide field">
			<label>Level Akun</label>
			<select class="ui dropdown" name="guru_lv">
				<option value="">Pilih Level</option>
				<option value="1" <?php if($guru_item['guru_lv']==1){echo "selected='selected'";}?>>Admin</option>
				<option value="2" <?php if($guru_item['guru_lv']==2){echo "selected='selected'";}?>>Guru</option>
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
	        identifier  : 'guru_nama',
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
	      guru_email: {
	        identifier  : 'guru_email',
	        rules: [
	          {
	            type   : 'empty',
	            prompt : 'Kolom email harus diisi'
	          },
	          {
	            type   : 'email',
	            prompt : 'Kolom email harus diisi dengan benar'
	          }
	        ]
	      },
	      guru_jk: {
	        identifier  : 'guru_jk',
	        rules: [
	          {
	            type   : 'empty',
	            prompt : 'Silakan memilih kolom jenis kelamin'
	          }
	        ]
	      },
	      guru_tgllahir: {
	        identifier  : 'guru_tgllahir',
	        rules: [
	          {
	            type   : 'empty',
	            prompt : 'Kolom tanggal lahir harus diisi'
	          }
	        ]
	      },
	      guru_telp: {
	        identifier  : 'guru_telp',
	        rules: [
	          {
	            type   : 'empty',
	            prompt : 'Kolom nomor telpon harus diisi'
	          },
	          {
	            type   : 'number',
	            prompt : 'Kolom nomor telpon harus diisi dengan benar'
	          },
	          {
	            type   : 'minLength[8]',
	            prompt : 'Kolom nomor telpon harus diisi minimal {ruleValue} karakter'
	          }
	        ]
	      },
	      guru_lv: {
	        identifier  : 'guru_lv',
	        rules: [
	          {
	            type   : 'empty',
	            prompt : 'Silakan memilih kolom jenis kelamin'
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