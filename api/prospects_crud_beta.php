
<?php
require_once('../dbase/conn.php');
$fgcont=file_get_contents("php://input");
$data = json_decode($fgcont);
//var_dump( $fgcont);
//echo "<br>-----------------</br>";
//var_dump($_REQUEST);
//echo "<br>-----------------</br>";

session_start();
if(isset($data->activity)){
$activity=$data->activity;
}else {
  $activity="x";
  //echo $activity;
}
$user_id= $_SESSION['user']['user_id'];
$history;
$response ;
switch ($activity) {
  case 'insert':
      $prospect=json_decode($data->prospect);
      $prospect_id=uniqid();
      $spouse_id=uniqid();
     
      if($prospect->is_father){
        foreach ($prospect->sons as $key => $value) {
          # code...
          $son_id=uniqid();
          $value->person_id=$son_id;
          $value->type="REFERENCIA";
          $value->referenced_by=$prospect_id;
          $history->activity="created";
          $history->date=date("Y-m-d H:i:s");
          $hist[]=$history;
          $sql = "INSERT INTO c_persons_beta (person_id,user_id,person_data,person_history)
          VALUES (";
          $sql= $sql.'"'.$son_id.'","'.$user_id.'",'."'".json_encode( $value)."','".json_encode($hist)."')";
         $hist=array(); 
         echo "<br>";
         echo $sql;
         echo "<br>";
         if (mysqli_query($db, $sql)) {
           $response->status_sons = "ok";
         } else {
             echo "Error: " . $sql . "<br>" . mysqli_error($db);
         }
        }        
      }
      if($prospect->civil_state){
        //$spouse=json_encode($prospect->spouse);
        $prospect->spouse->person_id=$spouse_id;
        $prospect->spouse->type="REFERENCIA";
        $prospect->spouse->referenced_by=$prospect_id;
        $history->activity="created";
        $history->date=date("Y-m-d H:i:s");
        $hist[]=$history;
        $sql = "INSERT INTO c_persons_beta (person_id,user_id,person_data,person_history)
        VALUES (";
        $sql= $sql.'"'.$spouse_id.'","'.$user_id.'",'."'".json_encode( $prospect->spouse)."','".json_encode($hist)."')";
        $hist=array();
        echo "<br>";
        echo $sql;
        echo "<br>";
        //$sql= $sql.'"'.$spouse_id.'","'.$prospect->spouse->name.'","'.$prospect->spouse->lastname_paterno.'","'.$prospect->spouse->lastname_materno.'","'.$prospect->spouse->mail.'","'.$prospect->spouse->phone.'","1","'.$prospect_id.'","'.$prospect_id.'","CONYUGE")';
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
          $value->person_id=$ref_id;
          $value->type="REFERENCIA";
          $value->referenced_by=$prospect_id;
          $history->activity="created";
          $history->date=date("Y-m-d H:i:s");
          $hist[]=$history;
          $sql = "INSERT INTO c_persons_beta (person_id,user_id,person_data,person_history)
          VALUES (";
          $sql= $sql.'"'.$ref_id.'","'.$user_id.'",'."'".json_encode( $value)."','".json_encode($hist)."')";
          $hist=array();
          echo "<br>";
          echo $sql;
          echo "<br>";
          if (mysqli_query($db, $sql)) {
            $response->status_refs = "ok";
          } else {
              echo "Error: " . $sql . "<br>" . mysqli_error($db);
          }
        }        
      }
      $prospect->type="PROSPECTO";
      $prospect->referenced_by  ="";
      
      $history->activity="created";
      $history->date=date("Y-m-d H:i:s");
      $hist[]=$history;
      
      $sql = "INSERT INTO c_persons_beta (person_id,user_id,person_data,person_history)
      VALUES (";
      echo "<br>";
      $sql= $sql.'"'.$prospect_id.'","'.$user_id.'",'."'".json_encode( $prospect)."','".json_encode($hist)."')";
      echo $sql;
      echo "<br>";
      //var_dump($prospect);
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
   // echo "update";
    $prospect=json_decode($data->prospect);
      var_dump($prospect);
      $id= $data->prospect_id;
      echo $id;
      $sql = "UPDATE c_persons_beta SET person_data='".$data->prospect."' WHERE person_id='".$id."'";
      if (mysqli_query($db, $sql)) {
          echo "New record created successfully";
      } else {
          echo "Error: " . $sql . "<br>" . mysqli_error($db);
      }
    break;
  case 'get_prospect':
      $id = $data->prospect_id;
      $sql = "SELECT * FROM c_persons_beta WHERE person_id='".$id."'";
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
    //echo $_SESSION['user']['user_id'];;
    $sql='SELECT * FROM c_persons_beta WHERE  person_deleted=0 AND JSON_EXTRACT(person_data,"$.type") ="PROSPECTO"';
   // $sql="SELECT * FROM c_persons_beta WHERE  person_deleted=0 AND user_id=". $user_id;
    //echo $sql;
    $results=mysqli_query($db,$sql);
    //	$c_prospectss=array();
    //var_dump($results);
    
    $i=0;
		while ($row = mysqli_fetch_object($results)){
      $temp['person_data']=json_decode($row->person_data);
      $temp['person_history']=json_decode($row->person_history);
      $temp['person_id']=$row->person_id;
      $prospects[]=$temp;    

    }
    
		$response['records']=$prospects;
		//var_dump($temp);
		echo json_encode($response);
    break;
}
mysqli_close($db);
?>
