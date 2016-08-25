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
	<form action="<?php echo site_url('siswa/simpanubah');?>" method="POST" class="ui form">
	<input type="hidden" name="siswa_id" value="<?php echo $siswa_item['siswa_id'];?>">
	<div class="fields">
		<div class="sixteen wide field">
			<label>Nama Lengkap</label>
			<input name="siswa_nama" type="text" value="<?php echo $siswa_item['siswa_nama'];?>">
		</div>
	</div>
	<div class="fields">
		<div class="sixteen wide field">
			<label>Jenis Kelamin</label>
			<select class="ui dropdown" name="siswa_jk">
				<option value="">Pilih jenis kelamin</option>
				<option value="1" <?php if($siswa_item['siswa_jk']==1){echo "selected='selected'";}?>>Laki-laki</option>
				<option value="2" <?php if($siswa_item['siswa_jk']==2){echo "selected='selected'";}?>>Perempuan</option>
			</select>
		</div>
	</div>

	<div class="fields">
		<div class="eight wide field">
			<label>Nomor Telpon (HP)</label>
			<div class="ui input">
			<input name="siswa_telportu" type="text" value="<?php echo $siswa_item['siswa_telportu'];?>">
			</div>
		</div>
		<div class="eight wide field">
			<label>Email</label>
			<input name="siswa_emailortu" type="text" value="<?php echo $siswa_item['siswa_emailortu'];?>">
		</div>
	</div>

	<div class="fields">
		<div class="sixteen wide field">
			<label>Kelas</label>
			<select name="kelas_id" class="ui search dropdown">
				<option value="">Kelas</option>
				<?php foreach ($kelas as $kelas_item): ?>
				<option value="<?php echo $kelas_item['kelas_id']; ?>" <?php if($kelas_item['kelas_id'] == $siswa_item['kelas_id']) {echo "selected='selected'";} ?>><?php echo $kelas_item['kelas_nama']; ?></option>
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

		<a href="<?php echo site_url('siswa');?>/profil/<?php echo $siswa_item['siswa_id'];?>" class="ui negative deny right labeled icon button">Batal
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
	      siswa_nama: {
	        identifier  : 'siswa_nama',
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
	      siswa_telportu: {
	        identifier  : 'siswa_telportu',
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
	          },
	          {
	            type   : 'maxLength[14]',
	            prompt : 'Kolom nomor telpon harus diisi maximal {ruleValue} karakter'
	          }
	        ]
	      },
	      siswa_jk: {
	        identifier  : 'siswa_jk',
	        rules: [
	          {
	            type   : 'empty',
	            prompt : 'Silakan memilih kolom jenis kelamin'
	          }
	        ]
	      },
	      siswa_emailortu: {
	        identifier  : 'siswa_emailortu',
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
	      kelas_id: {
	        identifier  : 'kelas_id',
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