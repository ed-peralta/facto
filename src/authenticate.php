<?php
session_start();
if(empty($_SESSION["authenticated"]) || $_SESSION["authenticated"] != 'true') {
  $temp['records']='no user';
  $temp['authenticated']=false;
  $temp['session']=$_SESSION;
  echo json_encode($temp);
}else{

  
  //$temp["user_id"]=$_SESSION['userId'];
  //$temp["user_username"]=$_SESSION['username'];
  //$temp["user_name"]=$_SESSION['name'];
  //$temp["user_lastname"]=$_SESSION['lastname'];
  //$temp["user_mail"]=$_SESSION['mail'];
  //$temp['auth']=$_SESSION['authenticated'];
  //$temp['user_level']=$_SESSION['level'];
  
  echo json_encode($_SESSION);
}
?>
