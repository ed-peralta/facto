<?php
require_once('../dbase/conn.php');
$data = json_decode(file_get_contents("php://input"),true);
 //var_dump($data);
 //echo file_get_contents("php://input");
if(isset($data->activity)){
$activity=$data->activity;
}else {
  $activity="x";
}
//echo $data->activity;
//echo "here we go";
//echo $activity;
//echo "\n";
switch ($activity) {
  case 'insert':
    $name = $data->name;
    $last_paterno = $data->paterno;
    $last_materno = $data->materno;
    $username = $data->username;
    $password = $data->password;
    $mail = $data->mail;
    
    echo  "hola";
  //  $sql = "INSERT INTO users (user_name, user_lastname_paterno,user_lastname_materno, user_mail,user_username,user_password)
  //  VALUES ('".$name."', '".$last_paterno."','".$last_materno."', '".$mail."','".$username."','".$password."')";
    if (mysqli_query($db, $sql)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($db);
    }
  break;
  case 'update':
    $name = $data->user_name;
    $last = $data->user_last;
    $mail = $data->user_mail;
    $id = $data->user_id;
    $sql = "UPDATE users SET user_name='".$name."', user_lastname='".$last."', user_mail='".$mail."' WHERE user_id=".$id;
    if (mysqli_query($db, $sql)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($db);
    }
  break;
  case 'delete':
    $id = $data->user_id;
    $sql = "DELETE FROM users WHERE user_id=".$id;
    if (mysqli_query($db, $sql)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($db);
    }
  break;
  default:
    $results=mysqli_query($db,"SELECT * FROM users ORDER BY user_name ASC");
    
    while ($row = mysqli_fetch_object($results)){
      $users[]=$row;
    }
    $temp['records']=$users;
    echo json_encode($temp);
  break;
}
mysqli_close($db);
?>
