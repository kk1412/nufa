<?php
  $image = array(
    'name'  =>  'userfile',
    'id'    =>  'userfile',
    );
     
  $submit = array(
    'name'  => 'submit',
    'id'    => 'submit',
    'value' => 'Upload'
    );
?>
<?php echo form_open_multipart('upload/upload_image', 'id=upload_file'); ?>
<?php echo form_upload($image); ?>
<?php echo form_submit($submit); ?>
<?php echo form_close(); ?>