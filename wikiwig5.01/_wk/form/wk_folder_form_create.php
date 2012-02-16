<p>
  <?php echo WK_CREATE_DIR_SUMMARY; ?> 
</p>
<form name="deletefolderform" action="<?php echo $form_action; ?>" method="POST">
  <input name="process" type="hidden" value="<?php echo $process; ?>" />
  <input name="folder" type="hidden" value="<?php echo $folder; ?>" />
  <table width="300"  border="00" cellspacing="0" cellpadding="0">
    <tr>
      <td height="29"><?php echo WK_LABEL_NEW_DIR; ?> : </td>
      <td>
        <input class="chps" name="new_folder" type="text" maxlength="255" value="<?php if(isset($_POST['new_folder'])) echo $_POST['new_folder'];?>" />
        <input name="folder" type="hidden" value="<?php echo $folder; ?>" />
      </td>
    </tr>
    <tr>
      <td colspan="2" style="text-align:center;">
        <input class="btn" type="submit" name="Submit" value="<?php echo WK_LABEL_CREATE; ?>" />
        <input class="btn" type="button" name="annuler" value="<?php echo WK_LABEL_CANCEL; ?>" onclick="document.location='<?php echo $page_list_url.'?folder='.$folder; ?>';return false;" />
      </td>
    </tr>
  </table>
</form>
