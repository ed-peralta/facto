
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
      $name = $data->part_description;
      $number_manufacturer= $data->part_number_manufacturer;
      $number_provider = $data->part_number_provider;
      $unit = $data->part_unit;
      $coin = $data->part_coin;
      $manufacturer = $data->part_manufacturer;
      $provider = $data->part_provider;
			$magnitude=$data->part_magnitude;
			$value=$data->part_value;
			$price=$data->part_price;


      $sql = "INSERT INTO parts (part_description, part_number_manufacturer, part_number_provider,part_unit,part_coin,part_manufacturer,part_provider,part_value,part_price)
      VALUES ('".$name."','".$number_manufacturer."', '".$number_provider."', '".$unit."','".$coin."','".$manufacturer."','".$provider."','".$value."','".$price."')";
      if (mysqli_query($db, $sql)) {
          echo "New record created successfully";
      } else {
          echo "Error: " . $sql . "<br>" . mysqli_error($db);
      }
      //copy('part_crud.php', $name.'_crud.php');
      //copy('../src/js/part_controller.js', '../src/js/'.$name.'_controller.js');
    break;
  case 'update':
      $id=$data->part_id;
    	$name = $data->part_description;
    	$number_manufacturer= $data->part_number_manufacturer;
    	$number_provider = $data->part_number_provider;
    	$unit = $data->part_unit;
    	$coin = $data->part_coin;
    	$manufacturer = $data->part_manufacturer;
    	$provider = $data->part_provider;
    	$magnitude=$data->part_magnitude;
    	$value=$data->part_value;
    	$price=$data->part_price;

      $sql = "UPDATE parts SET part_description='".$name."', part_number_manufacturer='".$number_manufacturer."', part_number_provider='".$number_provider."', part_unit='".$unit."', part_coin='".$coin."', part_manufacturer='".$manufacturer."', part_provider='".$provider."',part_magnitude='".$magnitude."',part_value='".$value."',part_price='".$price."' WHERE part_id=".$id;
      if (mysqli_query($db, $sql)) {
          echo "New record created successfully";
      } else {
          echo "Error: " . $sql . "<br>" . mysqli_error($db);
      }
    break;
    case 'updatePrice':
        $id=$data->part_id;
      	$price=$data->part_price;

        $sql = "UPDATE parts SET part_price='".$price."' WHERE part_id=".$id;
        if (mysqli_query($db, $sql)) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($db);
        }
      break;
  case 'delete':
      $id = $data->part_id;
      $sql = "DELETE FROM mvc WHERE part_id=".$id;
      if (mysqli_query($db, $sql)) {
          echo "New record created successfully";
      } else {
          echo "Error: " . $sql . "<br>" . mysqli_error($db);
      }
    break;
  default:
			//echo "string";
      $results=mysqli_query($db,"SELECT * FROM parts ORDER BY part_id DESC LIMIT 20 ");
			$images_data=mysqli_query($db,"SELECT * FROM `c_images` WHERE part_id IN (SELECT part_id FROM parts )");
			//$mvcs=array();

		while ($row = mysqli_fetch_array($images_data)){
			$image['name']=$row['image_name'];
			$image['mime']=$row['image_mime'];
			$image['data']=$row['image_data'];
			$images[$row['part_id']]=$image;
			//$imags[]=$row;
		}
		while ($row = mysqli_fetch_array($results)){
			$aux['part_id']=utf8_encode($row['part_id']);
			$aux['part_description']=utf8_encode($row['part_description']);
			$aux['part_number_manufacturer']=utf8_encode($row['part_number_manufacturer']);
			$aux['part_number_provider']=utf8_encode($row['part_number_provider']);
			$aux['part_unit']=$row['part_unit'];
			$aux['part_coin']=$row['part_coin'];
			$aux['part_manufacturer']=utf8_encode($row['part_manufacturer']);
			$aux['part_provider']=utf8_encode($row['part_provider']);
			$aux['part_magnitude']=$row['part_magnitude'];
			$aux['part_value']=$row['part_value'];
			$aux['part_price']=$row['part_price'];
			if ($images[$row['part_id']]['mime']!=NULL) {
				$aux['image_mime']=utf8_encode($images[$row['part_id']]['mime']);
				$aux['image_data']=base64_encode($images[$row['part_id']]['data']);
				$aux['image_name']=utf8_encode($images[$row['part_id']]['name']);
				$aux['image_show']=1;
			}
			else {
				$aux['image_mime']="";
				$aux['image_name']="";
				$aux['image_data']="";
				$aux['image_show']=0;
			}

		$mvcs[]=$aux;
			//	echo $row["part_description"]."<br>";
		}

		$temp['records']=$mvcs;

		//var_dump($temp);
		echo json_encode($temp);
    break;
}
mysqli_close($db);
?>
