<?php
  include_once dirname(__FILE__).'/wk_config.php';
  include_once dirname(__FILE__).'/lib/Wiki.php';
  include_once dirname(__FILE__).'/lib/Wiki_PageDir.php';

  // Find the current page url from the sequence number
  $entry = false;
  if(isset($_GET['seq'])){
    if (ctype_digit($_GET['seq'])) {
      $entry = Wiki_PageDir::findBySeq($_GET['seq']);
      if ($entry === false) {
        // bogus page sequence number
      } else if ($entry->active()) {
        $redirection_url = rtrim($WK['wkHTTPPath'], "/") . $entry->path();
        // error_log("lookup: $redirection_url");
        header("Location: ".$redirection_url);
        exit;
      }
    }
  }
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
  <head>
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="-1" />
    <meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate" />
    <meta name="description" content="Wikiwig4 the powerfull wysiwyg wiki">
    <meta name="keywords" content="wikiwig,wysiwyg wiki,wiki,wikiwig4,wikiwig 4">
    <title>{head_title}   - wikiwig4</title>
    <link rel="stylesheet" type="text/css" href="wk_style.css" />
    <script language="javascript" type="text/javascript" src="wk_dyn_pages.php?js"></script>
  </head>
  <body>
    <br>
    <h1>&nbsp;<?php echo $WK['wkName']; ?></h1>
    <table>
      <tr>
        <td>&nbsp;&nbsp;&nbsp;&nbsp; </td>
        <td>
<?php
          if ($entry === false) {
            echo WK_LOOKUP_404;
          } else {
            $msg = "&nbsp;&nbsp;&nbsp;" . sprintf(WK_LOOKUP_DELETE, $entry->path());
            print $msg;
            $history = Wiki_History::findBySeq($entry->seq());
            if ($history !== false) {
              $newest = false;
              foreach ($history as $h) {
                if ($h->action() == 'DELETED') {
                  if ($newest === false) {
                    $newest = $h;
                  } else if ($newest->when() < $h->when()) {
                    $newest = $h;
                  }
                }
              }
              $newest = WK_DELETED . strftime("%c", $newest->when()) . WK_BY . $newest->who();
              $newest = "<br>&nbsp;<a href='"  . $WK['wkHTTPPath'] . "_wk/wk_history.php?seq=" . $entry->seq() . "'>" . $newest . "</a>";
              print $newest;
            } else {
              echo WK_LOOKUP_DELETED;
            }
          }
?>
        </td>
      </tr>
    </table>
  </body>
</html>
