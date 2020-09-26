
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
      $name = $data->unit_name;
      $sql = "INSERT INTO c_units (unit_name) VALUES ('".$name."')";
      if (mysqli_query($db, $sql)) {
          echo "New record created successfully";
      } else {
          echo "Error: " . $sql . "<br>" . mysqli_error($db);
      }
      //copy('unit_crud.php', $name.'_crud.php');
      //copy('../src/js/unit_controller.js', '../src/js/'.$name.'_controller.js');
    break;
  case 'update':
  	$name = $data->unit_name;
  	$id= $data->unit_id;

    $sql = "UPDATE c_units SET unit_name='".$name."' WHERE unit_id=".$id;
    if (mysqli_query($db, $sql)) {
        echo "record updated successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($db);
    }
    break;
  case 'delete':
      $id = $data->unit_id;
      $sql = "DELETE FROM c_units WHERE unit_id=".$id;
      if (mysqli_query($db, $sql)) {
          echo "New record created successfully";
      } else {
          echo "Error: " . $sql . "<br>" . mysqli_error($db);
      }
    break;
  default:
			//echo "string";
      $results=mysqli_query($db,"SELECT * FROM c_units ORDER BY unit_name ASC");
		//	$mvcs=array();

		while ($row = mysqli_fetch_array($results)){

		$mvcs[]=$row;
			//	echo $row["unit_description"]."<br>";
		}

		$temp['records']=$mvcs;
		//var_dump($temp);
		echo json_encode($temp);
    break;
}
mysqli_close($db);
?>
