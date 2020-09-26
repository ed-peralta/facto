
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
      $name = $data->magnitude_name;
      $description= $data->magnitude_description;

      $sql = "INSERT INTO c_magnitude (magnitude_name, magnitude_description)
      VALUES ('".$name."','".$description."')";
      if (mysqli_query($db, $sql)) {
          echo "New record created successfully";
      } else {
          echo "Error: " . $sql . "<br>" . mysqli_error($db);
      }
      //copy('magnitude_crud.php', $name.'_crud.php');
      //copy('../src/js/magnitude_controller.js', '../src/js/'.$name.'_controller.js');
    break;
  case 'update':
	$name   = $data->magnitude_name;
	$description= $data->magnitude_description;
	$id     = $data->magnitude_id;

      $sql = "UPDATE c_magnitude SET magnitude_name='".$name."', magnitude_description='".$description."' WHERE magnitude_id=".$id;
      if (mysqli_query($db, $sql)) {
          echo "New record created successfully";
      } else {
          echo "Error: " . $sql . "<br>" . mysqli_error($db);
      }
    break;
  case 'delete':
      $id = $data->magnitude_id;
      $sql = "DELETE FROM c_magnitude WHERE magnitude_id=".$id;
      if (mysqli_query($db, $sql)) {
          echo "New record created successfully";
      } else {
          echo "Error: " . $sql . "<br>" . mysqli_error($db);
      }
    break;
  default:
			//echo "string";
      $results=mysqli_query($db,"SELECT * FROM c_magnitude ORDER BY magnitude_description ASC");
		//	$mvcs=array();

		while ($row = mysqli_fetch_array($results)){
			$aux['magnitude_id']=$row['magnitude_id'];
			$aux['magnitude_name']=utf8_encode($row['magnitude_name']);
      $aux['magnitude_description']=utf8_encode($row['magnitude_description']);
		$magnitudes[]=$aux;
			//	echo $row["magnitude_description"]."<br>";
		}

		$temp['records']=$magnitudes;
		//var_dump($temp);
		echo json_encode($temp);
    break;
}
mysqli_close($db);
?>
