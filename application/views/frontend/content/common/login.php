<div class="box-login">
  
	
		<form action="" method="post" name="ajaxcontactform" id="ajaxcontactform">

			<br />
				<fieldset>
					<input name="email" type="text" class="text-login" placeholder="Please Insert Your Email" value="<?php echo (set_value('email'))?set_value('email'):""; ?>">
					<?php if(form_error('email') != null) echo "<div class=\"help-inline\" style=\"margin-top:-4%;\"> " . form_error('email') . " </div>"; ?>
				</fieldset>
				<fieldset>
					<input name="password" type="password" class="text-login" placeholder="Please Insert Your Password" value="<?php echo (set_value('password'))?set_value('password'):""; ?>">
					<?php if(form_error('password') != null) echo "<div class=\"help-inline\" style=\"margin-top:-4%;\"> " . form_error('password') . " </div>"; ?>
				</fieldset>
				<fieldset>
					<input name="do" type="submit" class="button-login" value="LOGIN">
					<?php echo anchor("$controller/index", "Back", array("class"=>"button-login2")); ?>
				</fieldset>
			

		</form>

	
	<span class="box-arrow"></span>
  
</div>