
<?php
require_once('../dbase/conn.php');
$data = json_decode(file_get_contents("php://input"));
if(isset($data->activity)){
$activity=$data->activity;
}else {
  $activity="x";
}
switch ($activity) {
  case 'insert':
      $name = $data->mvc_name;
      $view = $data->mvc_view;
      $parent = $data->mvc_parent;
      $class = $data->mvc_class;
      $roll = $data->mvc_roll;
      $icon = $data->mvc_icon;
      $order = $data->mvc_order;

      $sql = "INSERT INTO mvc (mvc_name, mvc_parent, mvc_view,mvc_class,mvc_roll,mvc_icon,mvc_order)
      VALUES ('".$name."','".$parent."', '".$view."', '".$class."','".$roll."','".$icon."','".$order."')";
      if (mysqli_query($db, $sql)) {
          echo "New record created successfully";
      } else {
          echo "Error: " . $sql . "<br>" . mysqli_error($db);
      }
      //copy('mvc_crud.php', $name.'_crud.php');
      //copy('../src/js/mvc_controller.js', '../src/js/'.$name.'_controller.js');
    break;
  case 'update':
      $name = $data->mvc_name;
      $view = $data->mvc_view;
      $parent = $data->mvc_parent;
      $class = $data->mvc_class;
      $roll = $data->mvc_roll;
      $icon = $data->mvc_icon;
      $order = $data->mvc_order;
      $id = $data->mvc_id;
      $sql = "UPDATE mvc SET mvc_name='".$name."', mvc_parent='".$parent."', mvc_class='".$class."', mvc_view='".$view."', mvc_roll='".$roll."', mvc_icon='".$icon."', mvc_order='".$order."' WHERE mvc_id=".$id;
      if (mysqli_query($db, $sql)) {
          echo "New record created successfully";
      } else {
          echo "Error: " . $sql . "<br>" . mysqli_error($db);
      }
    break;
  case 'delete':
      $id = $data->mvc_id;
      $sql = "DELETE FROM mvc WHERE mvc_id=".$id;
      if (mysqli_query($db, $sql)) {
          echo "New record created successfully";
      } else {
          echo "Error: " . $sql . "<br>" . mysqli_error($db);
      }
    break;
  default:
      $results=mysqli_query($db,"SELECT * FROM mvc");
      //var_dump( $results);
      while ($row = mysqli_fetch_array($results)){
        $mvcs[]=$row;
      }
      $temp['records']=$mvcs;
      echo json_encode($temp);
    break;
}
mysqli_close($db);
?>
