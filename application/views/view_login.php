<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
  <style type="text/css">
    body {
      background-color: #DADADA;
    }
    body > .grid {
      height: 100%;
    }
    .image {
      margin-top: -100px;
    }
    .column {
      max-width: 450px;
    }
  </style>
  <script>
  $(document)
    .ready(function() {
      $('.ui.form')
        .form({
          fields: {
            email: {
              identifier  : 'email',
              rules: [
                {
                  type   : 'empty',
                  prompt : 'Please enter your e-mail'
                },
                {
                  type   : 'email',
                  prompt : 'Please enter a valid e-mail'
                }
              ]
            },
            password: {
              identifier  : 'password',
              rules: [
                {
                  type   : 'empty',
                  prompt : 'Please enter your password'
                },
                {
                  type   : 'length[6]',
                  prompt : 'Your password must be at least 6 characters'
                }
              ]
            }
          }
        })
      ;
    })
  ;
  </script>
<div class="ui middle aligned center aligned grid">
  <div class="column">
	<h2 class="ui teal image header">
	  <div class="content">
		Masuk ke akun anda
	  </div>
	</h2>
	<form action="<?php echo base_url('login/process');?>" method="POST" class="ui large form">
	 
		<div class="field">
		  <div class="ui left icon input">
			<i class="user icon"></i>
			<input type="text" name="email" placeholder="Alamat Email">
		  </div>
		</div>
		<div class="field">
		  <div class="ui left icon input">
			<i class="lock icon"></i>
			<input type="password" name="password" placeholder="Kata kunci">
		  </div>
		</div>
		<div class="ui fluid large teal submit button">Login</div>
	 

	  <div class="ui error message"></div>

	</form>
  </div>
</div>