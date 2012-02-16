<?php
  if (!isset($folder) || !isset($process) || !isset($form_action)) {
    exit();
  }
  $parent_folder = Wiki::getParentFolder($folder);
  $hidden_path  =  $folder;
  $hidden_folders = array(trim($parent_folder,'/').'/');
  $folders_list = Wiki::listAllFolders($hidden_path,$hidden_folders);
?> 
<form name="movefolderform" action="<?php echo $form_action; ?>" method="POST">
  <input name="process" type="hidden" value="<?php echo $process; ?>" />
  <input name="folder" type="hidden" value="<?php echo $folder; ?>" />
<?php
  if (!empty($folders_list)) {
?> 
    <p>
      <?php echo sprintf(WK_MOVE_DIR_LABEL_TARGET,$folder); ?> 
    </p>
    <p>
					
      <select name="target_folder">
<?php
        foreach ($folders_list as $k => $folder) {
?> 
          <option value="<?php echo $folder; ?>" <?php echo ($k==0) ? 'selected="selected"': ''; ?>><?php echo $folder; ?></option>
<?php
        }
?> 
      </select>
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
    <input type="button" class="btn" value="<?php echo WK_LABEL_CANCEL; ?>" onclick="document.location='<?php echo $page_list_url.'?folder='.$folder; ?>';return false;" />
  </p>
</form>
