
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
      $name = $data->manufacturer_name;
      $sql = "INSERT INTO c_manufacturers (manufacturer_name) VALUES ('".$name."')";
      if (mysqli_query($db, $sql)) {
          echo "New record created successfully";
      } else {
          echo "Error: " . $sql . "<br>" . mysqli_error($db);
      }
      //copy('manufacturer_crud.php', $name.'_crud.php');
      //copy('../src/js/manufacturer_controller.js', '../src/js/'.$name.'_controller.js');
    break;
  case 'update':
			$name = $data->manufacturer_name;
			$id=$data->manufacturer_id;
	    $sql = "UPDATE c_manufacturers SET manufacturer_name='".$name."' WHERE manufacturer_id=".$id;
      if (mysqli_query($db, $sql)) {
          echo "New record created successfully";
      } else {
          echo "Error: " . $sql . "<br>" . mysqli_error($db);
      }
    break;
  case 'delete':
      $id = $data->manufacturer_id;
      $sql = "DELETE FROM c_manufacturers WHERE manufacturer_id=".$id;
      if (mysqli_query($db, $sql)) {
          echo "New record created successfully";
      } else {
          echo "Error: " . $sql . "<br>" . mysqli_error($db);
      }
    break;
  default:
			//echo "string";
      $results=mysqli_query($db,"SELECT * FROM c_manufacturers ORDER BY manufacturer_name ASC");

		while ($row = mysqli_fetch_array($results)){
			$aux['manufacturer_id']=$row['manufacturer_id'];
			$aux['manufacturer_name']=utf8_encode($row['manufacturer_name']);
		$manufacturers[]=$aux;
		}

		$temp['records']=$manufacturers;
		echo json_encode($temp);
    break;
}
mysqli_close($db);
?>
