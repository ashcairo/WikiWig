<p>
  <?php echo WK_DELETE_DIR_SUMMARY; ?> 
</p>
<form name="deletefolderform" action="<?php echo $form_action; ?>" method="POST">
  <input name="process" type="hidden" value="<?php echo $process; ?>" />
  <input name="folder" type="hidden" value="<?php echo $folder; ?>" />
  <input name="confirm" type="hidden" value="1" />
  <p style="text-align:center">
    <input type="submit" class="btn" value="<?php echo WK_LABEL_VALIDATE; ?>" onclick="this.form.submit();" />
    <input type="button" class="btn" value="<?php echo WK_LABEL_CANCEL; ?>" onclick="document.location='<?php echo $page_list_url.'?folder='.$folder; ?>';return false;" />
  </p>
</form>
