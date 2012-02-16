<?php
  require_once dirname(__FILE__).'/../wk_config.php';
  require_once dirname(__FILE__).'/../lib/Wiki.php';
  // require_once dirname(__FILE__).'/../lib/Wiki_DB.php';
  // require_once dirname(__FILE__).'/../lib/Wiki_User.php';

  // _POST['page'] -> path (relative) to edited file
  // _POST['wikiwig'] -> new contents of the file

  if (isset($_POST['page']))  {
    $res_update = Wiki::updatePage($_POST['page'], $_POST['wikiwig']);
    if(is_array($res_update)){
      $errors = implode("\n",$res_update);
    }
  }

?>
<html>
  <head>
    <title><?php echo WK_FILE_SAVE_TITLE;?></title>
    <script language="javascript">
      window.onload = function init() {
        var save_ok = true;
<?php
        if(isset($errors)) {
?>
          alert('<?php echo addslashes($errors); ?>');
          save_ok = false;
<?php
        }
?>
        if (top && top.editorSaved) {
          top.editorSaved(save_ok);
          self.close();
          // If we ended up in a new window, different from the opener (i.e. no top)
          // then run unlocked and get out of here.
          // this is kind of lame though be better if it just ended up in the original window
        } else if (opener && opener.editorSaved) {
          self.close();
          opener.editorSaved(save_ok);
        } else {
          alert("no save?");
        }
      }
    </script>
  </head>
  <body>
  <?php echo sprintf(WK_FILE_SAVED,$_POST['page']); ?><br />
    crap
  <a href="#" onclick="self.close()"><?php echo WK_LABEL_CLOSE_WINDOW; ?></a>
  </body>
</html>
