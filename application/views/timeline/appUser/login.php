<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>css/style.css" />
</head>
<body>

<div id="container">
	<h1>Welcome to CodeIgniter!</h1>

	<div id="body">
		<?php
			echo form_open('TimeLine/login/');
			echo form_label('username', 'username') . form_input('username',  set_value('username', '')) . form_error('username') . "<br />";
			echo form_label('password', 'password') . form_password('password', '') . form_error('password') . "<br />" . $statusLogin . "<br />";
			echo form_submit('submit', 'Login');
			echo form_close();
		?>
		
	</div>

	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>

</body>
</html>