<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<title>User Create</title>

<link href="<?php echo base_url(); ?>style/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
	<div class="content">
		<h1><?php echo $title; ?></h1>
		<?php echo $message; ?>
		<?php echo validation_errors(); ?>
<?php echo form_open($action); ?>
		<div class="data">
		<table>
			<tr>
				<td valign="top">username<span style="color:red;">*</span></td>
				<td><input type="text" name="username" class="text" value="<?php echo (set_value('username'))?set_value('username'):$user['username']; ?>"/>
				<?php echo form_error('username'); ?></td>
			</tr>
			<tr>
				<td valign="top">password</td>
				<td><input type="password" name="password" class="text" value="<?php echo set_value('password')?set_value('password'):$user['password']; ?>"/>
				<?php echo form_error('password'); ?></td>
			</tr>
			<tr>
				<td valign="top">full name</td>
				<td><input type="text" name="full_name" class="text" value="<?php echo set_value('full_name')?set_value('full_name'):$user['full_name']; ?>"/>
				<?php echo form_error('full_name'); ?></td>
			</tr>
			<tr>
				<td valign="top">email</td>
				<td><input type="email" name="email" class="text" value="<?php echo set_value('email')?set_value('email'):$user['email']; ?>"/>
				<?php echo form_error('email'); ?></td>
			</tr>
			<tr>
				<td valign="top">Role<span style="color:red;">*</span></td>
				<td>
					<input type="radio" name="id_role" value="1" <?php echo set_radio('id_role', '1', TRUE); ?>/> Admin
					<input type="radio" name="id_role" value="2" <?php echo set_radio('id_role', '2'); ?>/> Employee
					<?php echo form_error('id_role'); ?>
				</td>
			</tr>
			<tr>
				<td valign="top">category division</td>
				<td>
					<select name="id_category">
					<?php 
						foreach($categories as $category) {
							echo "<option value='$category->id_category'>" . $category->name_category . "</option>";
						}
					?>
					</select>
				<?php echo form_error('email'); ?></td>
			</tr>
			<tr>
				<td valign="top">Is Active<span style="color:red;">*</span></td>
				<td>
					<input type="radio" name="is_active" value="1" <?php echo set_radio('id_role', '1', TRUE); ?>/> Active
					<input type="radio" name="is_active" value="0" <?php echo set_radio('id_role', '0'); ?>/> Not Active
					<?php echo form_error('id_role'); ?>
				</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td><input type="submit" value="Save"/></td>
			</tr>
		</table>
		</div>

	</form>


		<br />
		<?php echo $link_back; ?>
	</div>
</body>
</html>