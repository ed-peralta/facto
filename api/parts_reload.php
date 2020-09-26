<?php
require_once('../dbase/conn.php');


$host2='localhost';
$user2='admin';
$password2='drakkar2018';
$database2='docsys';
$db2= mysqli_connect( $host2, $user2, $password2, $database2);

$results=mysqli_query($db,"SELECT * FROM parts LIMIT 100");

//	$mvcs=array()
$accents=array("Á", "É", "Í", "Ó", "Ú", "á", "é", "í", "ó", "ú","%","\t");
$woaccents=array("A", "E", "I", "O", "U", "a", "e", "i", "o", "u","","");

while ($row = mysqli_fetch_array($results)){
	$temp['part_id']=utf8_encode($row['part_id']);
	$temp['part_description']=utf8_encode($row['part_description']);
	$temp['part_number_manufacturer']=utf8_encode($row['part_number_manufacturer']);
	$temp['part_number_provider']=utf8_encode($row['part_number_provider']);
	$temp['part_unit']=$row['part_unit'];
	$temp['part_coin']=$row['part_coin'];
	$temp['part_manufacturer']=utf8_encode($row['part_manufacturer']);
	$temp['part_provider']=utf8_encode($row['part_provider']);
	$temp['part_magnitude']=$row['part_magnitude'];
	$temp['part_value']=$row['part_value'];
	$temp['part_price']=$row['part_price'];
	$temp['image_id']=$row['image_id'];
$mvcs[]=$temp;
// array($row["part_id"],iconv('UTF-8//TRANSLIT',$current_charset,str_replace($accents,$woaccents,$row["part_description"])));
//echo $row["part_id"]."-".iconv('UTF-8//TRANSLIT',$current_charset,str_replace($accents,$woaccents,$row["part_description"]))."<br>";
//echo $row["part_id"]."-".utf8_encode($row["part_description"])."<br>";
//echo $row["part_id"]."-".str_replace($accents,$woaccents,$row["part_description"]	)."<br>";


	//echo $query="INSERT INTO parts (part_id,part_description) VALUES(".$row["part_id"].",'".$row["part_description"]."')";
//	$res=mysqli_query($db,$query);
}

$temp['records']=$mvcs;
echo json_encode($temp);
?>
