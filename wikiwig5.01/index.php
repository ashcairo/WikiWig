<?php
if(!@is_file('index.html')){
    header('Location: http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/_wk/setup/index.php');
    exit();
}
else {
    header('Location: http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/index.html');
    exit();
}
?>
