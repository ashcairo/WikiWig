<?php
  if (!isset($folder) || !isset($process) || !isset($form_action)) {
    // exit();
  }
  $parent_folder = Wiki::getParentFolder($folder);
  // $hidden_path  =  $folder;
  // $hidden_folders = array(trim($parent_folder,'/').'/');
  $folders_list = Wiki::listAllFolders();
?> 
<form name="movefileform" action="<?php echo $form_action; ?>" method="POST">
  <input name="process" type="hidden" value="<?php echo $process; ?>" />
  <input name="folder" type="hidden" value="<?php echo $folder; ?>" />
<?php
  if (!empty($folders_list)) {
?> 
    <p>
      <?php echo sprintf(WK_MOVE_FILE_LABEL_TARGET, $folder); ?> 
    </p>
    <p>
					
      <select name="target_folder">
<?php
        foreach ($folders_list as $k => $f) {
        if (strpos($f, "/") != 0) {
          $f = "/" . $f;
        }
?> 
          <option value="<?php echo $f; ?>" <?php echo ($f==$folder) ? 'selected="selected"': ''; ?>><?php echo $f; ?></option>
<?php
        }
?> 
      </select>
<?php
        if (isset($files) && count($files) == 1) {
          $nm = str_replace(".html", '', basename(array_shift($_POST['Mid'])));
?>
          <input name="old_name" type="hidden" value="<?php echo $nm; ?>" />
          <br>
          New Name: &nbsp;
          <input name="new_name" type="text" class="chps" value="<?php echo $nm; ?>" maxlength="255">
<?php
        } else {
          if (isset($files)) {
            $files = implode($files, ";");
          } else {
            $files = '';
          }
?>
          <input name="files" type="hidden" value="<?php echo $files; ?>">
<?php
        }
?>
    </p>
<?php
  }
?>
  <p style="text-align:center">
<?php
    if (!empty($folders_list)) {
?> 
      <input type="submit" class="btn" value="<?php echo WK_LABEL_VALIDATE; ?>" onclick="this.form.submit();" />
<?php
    }
?> 
    <input type="button" class="btn" value="<?php echo WK_LABEL_CANCEL; ?>" onclick="document.location='<?php echo $page_list_url; ?>';return false;" />
  </p>
</form>
