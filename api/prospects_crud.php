
<?php
require_once('../dbase/conn.php');
$data = json_decode(file_get_contents("php://input"));
if(isset($data->activity)){
$activity=$data->activity;
}else {
  $activity="x";
  //echo $activity;
}
$response ;
switch ($activity) {
  case 'insert':
      //echo "hola";
      //var_dump($data->prospect);
      $prospect=json_decode($data->prospect);
   
      if($prospect->smoker){
        $converted_smoker="1";
      }else{
        $converted_smoker="0";
      }
      if($prospect->civil_state){
        $converted_civil_state="1";
      }else{
        $converted_civil_state="0";
      }
      if($prospect->asma){
        $converted_asma="1";
      }else{
        $converted_asma="0";
      }
      if($prospect->motociclismo){
        $converted_motociclismo="1";
      }else{
        $converted_motociclismo="0";
      }
      if($prospect->diabetes){
        $converted_diabetes="1";
      }else{
        $converted_diabetes="0";
      }
      if($prospect->hipertencion){
        $converted_hipertencion="1";
      }else{
        $converted_hipertencion="0";
      }
      if($prospect->tiroides){
        $converted_tiroides="1";
      }else{
        $converted_tiroides="0";
      }

      $prospect_id=uniqid();
      $spouse_id=uniqid();
      $sons_ids=[];
      $references_ids=[];
     
      if($prospect->is_father){
        foreach ($prospect->sons as $key => $value) {
          # code...
          $son_id=uniqid();
          array_push($sons_ids,$son_id);
          $sql = "INSERT INTO c_persons (person_id,person_name, person_lastname_paterno, person_lastname_materno, person_mail, person_phone,person_recomended_by, person_type)
          VALUES (";
          $sql= $sql.'"'.$son_id.'","'.$value->name.'","'.$value->lastname_paterno.'","'.$value->lastname_materno.'","'.$value->mail.'","'.$value->phone.'","'.$prospect_id.'","HIJO")';
          if (mysqli_query($db, $sql)) {
            $response->status_sons = "ok";
          } else {
              echo "Error: " . $sql . "<br>" . mysqli_error($db);
          }
        }        
      }
      if($prospect->civil_state){
        //$spouse=json_encode($prospect->spouse);
        $sql = "INSERT INTO c_persons (person_id,person_name, person_lastname_paterno, person_lastname_materno, person_mail, person_phone, person_civil_state, person_spouse,person_recomended_by, person_type)
        VALUES (";
        $sql= $sql.'"'.$spouse_id.'","'.$prospect->spouse->name.'","'.$prospect->spouse->lastname_paterno.'","'.$prospect->spouse->lastname_materno.'","'.$prospect->spouse->mail.'","'.$prospect->spouse->phone.'","1","'.$prospect_id.'","'.$prospect_id.'","CONYUGE")';
        if (mysqli_query($db, $sql)) {
          $response->status_spouse = "ok";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($db);
        }
      }else{
        $spouse_id="0";
      }

      if(!empty($prospect->references)){
        foreach ($prospect->references as $key => $value) {
          # code...
          $ref_id=uniqid();
          array_push($references_ids,$ref_id);
          $sql = "INSERT INTO c_persons (person_id,person_name, person_lastname_paterno, person_lastname_materno, person_mail, person_phone,person_recomended_by, person_type)
          VALUES (";
          $sql= $sql.'"'.$ref_id.'","'.$value->name.'","'.$value->lastname_paterno.'","'.$value->lastname_materno.'","'.$value->mail.'","'.$value->phone.'","'.$prospect_id.'","REFERENCIA")';
          if (mysqli_query($db, $sql)) {
            $response->status_refs = "ok";
          } else {
              echo "Error: " . $sql . "<br>" . mysqli_error($db);
          }
        }        
      }

      $sql = "INSERT INTO c_persons (person_id,person_name, person_lastname_paterno, person_lastname_materno, person_mail, person_phone, person_smoker, person_ocupation,person_birthday, person_civil_state, person_spouse, person_type, person_asma, person_motociclismo, person_diabetes, person_hipertencion, person_tiroides, person_investment,person_sons,person_references,person_data)
      VALUES (";
      $sql= $sql.'"'.$prospect_id.'","'.$prospect->name.'","'.$prospect->lastname_paterno.'","'.$prospect->lastname_materno.'","'.$prospect->mail.'","'.$prospect->phone.'","'.$converted_smoker.'","'.$prospect->ocupation.'","'.date("Y-m-d H:i:s", strtotime($prospect->birthday)).'","'.$converted_civil_state.'","'.$spouse_id.'","PROSPECTO","'.$converted_asma.'","'.$converted_motociclismo.'","'.$converted_diabetes.'","'.$converted_hipertencion.'","'.$converted_tiroides.'","'.$prospect->investment.'",'."'".json_encode($sons_ids)."','".json_encode($references_ids)."','".$data->prospect."')";
      echo $sql;
     
      if (mysqli_query($db, $sql)) {
        $response->status = "ok";
          echo json_encode($response);
      } else {
          echo "Error: " . $sql . "<br>" . mysqli_error($db);
      }
      //copy('prospect_crud.php', $name.'_crud.php');
      //copy('../src/js/prospect_controller.js', '../src/js/'.$name.'_controller.js');
    break;
  case 'update':
			$id					= $data->prospect_id;
			$name 			= $data->prospect_name;
			$address		= $data->prospect_address;
		
			$phone 			= $data->prospect_phone;
			$mail 			= $data->prospect_mail;
		
      $sql = "UPDATE c_prospects SET prospect_name='".$name."',
			prospect_address='".$address."', prospect_phone='".$phone."',
			prospect_mail='".$mail."' WHERE prospect_id=".$id;
      if (mysqli_query($db, $sql)) {
          echo "New record created successfully";
      } else {
          echo "Error: " . $sql . "<br>" . mysqli_error($db);
      }
    break;
  case 'get_prospect':
      $id = $data->prospect_id;
      $sql = "SELECT * FROM c_persons WHERE person_id='".$id."'";
      //echo $sql;
      $results=mysqli_query($db,$sql);
      //	$c_prospectss=array();
      $row = mysqli_fetch_object($results);
      //var_dump($results);
      //echo  $db->server_info;
      $temp['records']=$row;
      //var_dump($temp);
      echo json_encode($temp);
    break;
  
  case 'delete':
      $id = $data->prospect_id;
      $sql = "UPDATE c_persons SET person_deleted=1 WHERE person_id='".$id."'";
      echo $sql;
      if (mysqli_query($db, $sql)) {
          echo "New record created successfully";
      } else {
          echo "Error: " . $sql . "<br>" . mysqli_error($db);
      }
    break;
  default:
			//echo "string";
      $results=mysqli_query($db,"SELECT * FROM c_persons WHERE person_type='PROSPECTO' AND person_deleted=0 ORDER BY person_name ASC");
		//	$c_prospectss=array();
		while ($row = mysqli_fetch_object($results)){
		$prospects[]=$row;
		}
    //var_dump($results);
    //echo  $db->server_info;
		$temp['records']=$prospects;
		//var_dump($temp);
		echo json_encode($temp);
    break;
}
mysqli_close($db);
?>
