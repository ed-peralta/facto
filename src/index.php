<?php
session_start();
 //$_SESSION["authenticated"] =false;
 echo $_SESSION["authenticated"];
if(empty($_SESSION["authenticated"]) || $_SESSION["authenticated"] != 'true') {
    header('Location: login.php');
}else {
  header('Location: app.php');
//echo "string";

}
 ?>
