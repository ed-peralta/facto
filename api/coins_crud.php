
<?php
require_once('../dbase/conn.php');
$data = json_decode(file_get_contents("php://input"));
function currencyConverter($from_Currency,$to_Currency)
{
		$from_Currency = urlencode($from_Currency);
						//var_dump($from_Currency);
		$to_Currency = urlencode($to_Currency);
		$get = file_get_contents("http://free.currencyconverterapi.com/api/v3/convert?q=".$from_Currency."_".$to_Currency);
						//echo "http://free.currencyconverterapi.com/api/v3/convert?q=".$from_Currency."_".$to_Currency;
		//$get = explode("<span class=bld>",$get);
		//$get = explode("</span>",$get[1]);
						 $json = json_decode($get, true);
		//$converted_currency = preg_replace("/[^0-9\.]/", null, $get[0]);
						$result=$json["results"];
						$cur=$result[$from_Currency."_".$to_Currency];
						//echo $cur["val"];
						return $cur["val"];

		//return $converted_currency;

}
if(isset($data->activity)){
$activity=$data->activity;
}else {
  $activity="x";
}
switch ($activity) {
  case 'update':
	$currencies = array("USD", "GBP", "EUR", "CNY", "JPY", "IDR", "INR", "RUB", "CAD");
	$update_coin = "UPDATE c_coins SET coin_factor = ";
	foreach ($currencies as $currency)
	{
			$cnv_factor =  (float) currencyConverter($currency, "MXN");
									var_dump($cnv_factor);
									//echo $update_coin.$cnv_factor." WHERE coin_name = '".$currency."'";
			if(mysqli_query($db,$update_coin.$cnv_factor." WHERE coin_name = '".$currency."'" )){
				  echo "New record created successfully";
			}else {
				echo "Error: " . $sql . "<br>" . mysqli_error($db);
			}

	}


    break;
  default:
			//echo "string";
      $results=mysqli_query($db,"SELECT * FROM c_coins ORDER BY coin_name ASC");
		//	$c_coinss=array();
		while ($row = mysqli_fetch_array($results)){
			$aux['coin_id']=$row['coin_id'];
			$aux['coin_name']=utf8_encode($row['coin_name']);
			$aux['coin_factor']=utf8_encode($row['coin_factor']);
			$aux['coin_country']=utf8_encode($row['coin_country']);
		$coins[]=$aux;
		}

		$temp['records']=$coins;
		//var_dump($temp);
		echo json_encode($temp);
    break;
}
mysqli_close($db);
?>
