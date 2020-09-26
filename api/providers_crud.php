
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
      $name = $data->provider_name;
      $address= $data->provider_address;
      $vat = $data->provider_vat;
      $contact = $data->provider_contact;
      $phone = $data->provider_phone;
      $mail = $data->provider_mail;
      $count = $data->provider_count;
			$bank=$data->provider_bank;
			$percentaje=$data->provider_percentaje;

      $sql = "INSERT INTO c_providers (provider_name, provider_address, provider_vat,provider_contact,provider_phone,provider_mail,provider_count,provider_bank,provider_percentaje)
      VALUES ('".$name."','".$address."', '".$vat."', '".$contact."','".$phone."','".$mail."','".$count."','".$bank."','".$percentaje."')";
      if (mysqli_query($db, $sql)) {
          echo "New record created successfully";
      } else {
          echo "Error: " . $sql . "<br>" . mysqli_error($db);
      }
      //copy('provider_crud.php', $name.'_crud.php');
      //copy('../src/js/provider_controller.js', '../src/js/'.$name.'_controller.js');
    break;
  case 'update':
			$id					= $data->provider_id;
			$name 			= $data->provider_name;
			$address		= $data->provider_address;
			$vat 				= $data->provider_vat;
			$contact		= $data->provider_contact;
			$phone 			= $data->provider_phone;
			$mail 			= $data->provider_mail;
			$count 			= $data->provider_count;
			$bank				= $data->provider_bank;
			$percentaje = $data->provider_percentaje;

      $sql = "UPDATE c_providers SET provider_name='".$name."',
			provider_address='".$address."', provider_vat='".$vat."',
			provider_contact='".$contact."', provider_phone='".$phone."',
			provider_mail='".$mail."', provider_count='".$count."',
			provider_bank='".$bank."', provider_percentaje='".$percentaje."' WHERE provider_id=".$id;
      if (mysqli_query($db, $sql)) {
          echo "New record created successfully";
      } else {
          echo "Error: " . $sql . "<br>" . mysqli_error($db);
      }
    break;
  case 'delete':
      $id = $data->provider_id;
      $sql = "DELETE FROM c_providers WHERE provider_id=".$id;
      if (mysqli_query($db, $sql)) {
          echo "New record created successfully";
      } else {
          echo "Error: " . $sql . "<br>" . mysqli_error($db);
      }
    break;
  default:
			//echo "string";
      $results=mysqli_query($db,"SELECT * FROM c_providers ORDER BY provider_name ASC");
		//	$c_providerss=array();
		while ($row = mysqli_fetch_array($results)){
			$aux['provider_id']=$row['provider_id'];
			$aux['provider_name']=utf8_encode($row['provider_name']);
			$aux['provider_address']=utf8_encode($row['provider_address']);
			$aux['provider_vat']=utf8_encode($row['provider_vat']);
			$aux['provider_contact']=utf8_encode($row['provider_contact']);
			$aux['provider_phone']=utf8_encode($row['provider_phone']);
			$aux['provider_mail']=utf8_encode($row['provider_mail']);
			$aux['provider_count']=utf8_encode($row['provider_count']);
			$aux['provider_bank']=utf8_encode($row['provider_bank']);
			$aux['provider_percentaje']=$row['provider_percentaje'];

		$providers[]=$aux;
		}

		$temp['records']=$providers;
		//var_dump($temp);
		echo json_encode($temp);
    break;
}
mysqli_close($db);
?>
