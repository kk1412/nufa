<div class="box-login" style="text-align:center;margin-top:10%;" >
  
	
		<form action="" method="post" name="ajaxcontactform" id="ajaxcontactform">

			<br/>
				<fieldset>
					<input name="email" type="text" id="name" class="text-login" placeholder="email" value="<?php echo (set_value('email'))?set_value('email'):""; ?>">
					<?php if(form_error('email') != null) echo "<div class=\"help-inline\" style=\"color:#ff0000;margin-top:-0.5%;\"> " . form_error('email') . " </div>"; ?>
				</fieldset>
				<fieldset>
					<input name="password" type="password" id="name" class="text-login" placeholder="password" value="<?php echo (set_value('password'))?set_value('password'):""; ?>">
					<?php if(form_error('password') != null) echo "<div class=\"help-inline\" style=\"color:#ff0000;margin-top:-0.5%;margin-bottom:1%\"> " . form_error('password') . " </div>"; ?>
				</fieldset>
				<fieldset>
					<input name="do" type="submit" id="submit" class="button-login" value="LOGIN">
					<?php echo anchor("$controller/index", "<input type=\"button\" id=\"submit\" value=\"BACK\"/>", array("class"=>"button-login2"), array("id"=>"submit")); ?>
				</fieldset>
			

		</form>

	
	<span class="box-arrow"></span>
  
</div>