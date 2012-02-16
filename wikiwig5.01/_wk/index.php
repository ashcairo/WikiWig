<?php
/*
 * Created on 21 nov. 2004
 */
 
 // avoid the listing of current directory
 header('Location: http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/'.'wk_liste.php');
 exit();
?>
