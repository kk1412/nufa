<?php echo form_open_multipart('upload/upload_array_files');?>
     <label for="url">Upload Files: </label><br />
          <input type="file" name="files[]" value="" /><br />
          <input type="file" name="files[]" value="" /><br />
          <input type="file" name="files[]" value="" /><br />
     <input type="submit" value="Save Article/s">
<?php echo form_close(); ?>
