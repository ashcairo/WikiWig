<?php
  require_once '../wk_config.php';
  require_once '../lib/Wiki.php';

  if(isset($_GET['folder']))
    $rep = $_GET['folder'];
  elseif(isset($_POST['folder']))
    $rep = $_POST['folder'];
  else
    $rep = "";

  $errors = '';
  $new_file_name = '';
  if (isset($_GET['caller'])) {
    $caller = $_GET['caller'];
  } else if (isset($_POST['caller'])) {
    $caller = $_POST['caller'];
  }

  $here = 'http://'. $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/' ;
  if (isset($caller)) {
    $on_cancel = $here . $caller .  '?folder=' . $rep;
    if (isset($_POST['new_file_name'])) {
      $on_cancel .=  '&new_file=' . $_POST['new_file_name'];
    }
  } else {
    $on_cancel = $here . '../wk_liste.php?folder=' . $rep;
  }
    
  if(isset($_POST['folder']) && isset($_POST['new_file_name'])){
    // attempt to create the page
    $content = Wiki::getTplContent($_POST['template']);
    $page = Wiki::createPage($_POST['folder'], $_POST['new_file_name'], $content);
    if(is_array($page)){
      // errors occured creating the file
      $errors = '-'.implode('<br/>-',$page);
    } else {
      if (isset($caller)) {
        header("Location: $here" . $caller . 
               '?folder=' . $_POST['folder'] .
               '&new_file=' . $_POST['new_file_name']);
      } else {
        header("Location: $here" . '../wk_liste.php?folder=' . $_POST['folder']);
      }
      exit();
    }
}
  $ar_templates = Wiki::getPageTemplates();

// Getting avalaible templates to create new files
// $ar_templates = $fs->getUserTemplatesList();

?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <title><?php echo WK_CREATE_FILE_HEAD_TITLE; ?></title>
    <link href="../wk_style.css" rel="stylesheet" type="text/css">
    <script language="javascript" src="../js/dreamweaver.js"></script>
    <script type="text/javascript">
      window.onload = function (){
        document.form1.new_file_name.focus();
        }
    </script>
  </head>
	
  <body class="actions">
    <div id="header"><?php echo sprintf(WK_CREATE_FILE_BODY_TITLE,$rep); ?>&nbsp;&nbsp;<span class="errors"><?php echo $errors;?></span></div>
    <div id="content">
      <form name="form1" method="post" action="wk_creation_fichier.php"  onsubmit="MM_validateForm('nom','','R');return document.MM_returnValue">
        <table width="300"  border="00" cellspacing="0" cellpadding="0">
          <tr>
            <td height="29"><?php echo WK_LABEL_NEW_FILE; ?> : </td>
            <td style="text-align:left;">
              <input class="chps" name="new_file_name" type="text" maxlength="255" value="<?php echo $new_file_name; ?>">
              <input name="folder" type="hidden" value="<?php echo $rep; ?>">
<?php
              if (isset($caller)) {
?>
                <input name="caller" type="hidden" value="<?php echo $caller; ?>">
<?php
              }
?>
            </td>
          </tr>
          <tr>
            <td height="29" valign="top"><?php echo WK_LABEL_FILE_TEMPLATE; ?> : </td>
            <td style="text-align:left;">
              <input id="template_vide"
                     name="template"
                     type="radio"
                     value=""
                     checked="checked"
                     style="position:relative;top:3px;">
              <label for="template_vide"><?php echo WK_LABEL_FILE_EMPTY_TEMPLATE; ?></label><br />
<?php 
              if(!empty($ar_templates)) {
                foreach($ar_templates as $id_tpl => $tpl) {
                  echo '<input id="template_'.$tpl.
                      '" type="radio" name="template" value="'.
                      $tpl.
                      '" style="position:relative;top:3px;"><label for="template_'.$tpl.
                      '">'.
                      ucfirst(str_replace('.html','',$tpl)).
                      '</label><br />';
                }
              }
?> 
            </td>
          </tr>
          <tr>
            <td colspan="2" style="text-align:center;">
              <input class="btn" type="submit" name="Submit" value="<?php echo WK_LABEL_CREATE; ?>" />
              <input class="btn"
                     type="button"
                     name="annuler"
                     value="<?php echo WK_LABEL_CANCEL; ?>" 
                     onclick="document.location='<?php echo $on_cancel; ?>';return false;" />
            </td>
          </tr>
        </table>
      </form>
    </div>
  </body>
</html>
