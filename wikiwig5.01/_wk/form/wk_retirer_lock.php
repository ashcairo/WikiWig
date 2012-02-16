<?php
  require_once '../wk_config.php';

  require_once '../lib/Wiki.php';
  Wiki::unlockPage($_POST['page']);
  // errors management could be done here
  // ....
?>
<html>
  <head>
    <title><?php echo WK_FILE_UNLOCK_TITLE; ?></title>
    <script type="text/javascript">
      window.onload = function() {
	if(top && top.unlocked) {
	  top.unlocked();
	} else {
	  // If we ended up in a new window, different from the opener (i.e. no top)
	  // then run unlocked and get out of here.
	  // this is kind of lame though be better if it just ended up in the original window
	  if(opener && opener.unlocked) {
	    self.close();
	    opener.unlocked();
	  }
	}
      }
    </script>
  </head>
  <body>
    <a href="#" onclick="self.close();return false;"><?php echo WK_LABEL_CLOSE_WINDOW; ?></a>
  </body>
</html>