
<?php
require_once('../dbase/conn.php');
$data = json_decode(file_get_contents("php://input"));
//echo $data->activity;
//echo "hola";
if(isset($data->activity)){
$activity=$data->activity;
}else {
  $activity="x";
}
switch ($activity) {
  case 'insert':
      $name = $data->project_name;
      $json = $data->project_json;
      $sql = "INSERT INTO m_projects (tree_name, tree_json)
      VALUES ('".$name."','".$json."')";
      if (mysqli_query($db, $sql)) {
          echo "New record created successfully";
      } else {
          echo "Error: " . $sql . "<br>" . mysqli_error($db);
      }
      //copy('mvc_crud.php', $name.'_crud.php');
      //copy('../src/js/mvc_controller.js', '../src/js/'.$name.'_controller.js');
    break;
  case 'update':
  $id = $data->tree_id;
  $name = $data->project_name;
  $json = $data->project_json;
      $sql = "UPDATE m_projects SET tree_name='".$name."', tree_json='".$json."' WHERE tree_id=".$id;
      if (mysqli_query($db, $sql)) {
          echo "New record created successfully";
      } else {
          echo "Error: " . $sql . "<br>" . mysqli_error($db);
      }
    break;
  case 'delete':
      $id = $data->tree_id;
      $sql = "UPDATE m_projects SET tree_deleted=1 WHERE tree_id =".$id;
      if (mysqli_query($db, $sql)) {
          echo "project deleted";
      } else {
          echo "Error: " . $sql . "<br>" . mysqli_error($db);
      }
    break;
  case 'get_project':
      $id = $data->tree_id;
      $results=mysqli_query($db,"SELECT * FROM m_projects WHERE tree_id =".$id);
      while ($row = mysqli_fetch_array($results)){
        $mvcs[]=$row;
      }
      $temp['records']=$mvcs;
      echo json_encode($temp);
    break;
  default:
      //echo "string";
      $results=mysqli_query($db,"SELECT * FROM m_projects WHERE tree_deleted=0 ORDER BY tree_name ASC");
      while ($row = mysqli_fetch_array($results)){
        $mvcs[]=$row;
      }
      $temp['records']=$mvcs;
      echo json_encode($temp);
    break;
}
mysqli_close($db);
?>
