<?php


$json= '{"name":"Eduardo","lastname_materno":"Peralta","lastname_paterno":"Popoca","mail":"edmon@homail.com","phone":"23232344","birthday":"","smoker":false,"ocupation":"","civil_state":true,"spouse":{"name":"Karen","lastname_materno":"Rod","lastname_paterno":"Shmul","mail":"","phone":"443434","birthday":""},"is_father":true,"sons":[{"name":"Fernando","lastname_materno":"Popoca","lastname_paterno":"Popoca","mail":"","phone":"","$$hashKey":"object:24"},{"name":"Fernando","lastname_materno":"Popoca","lastname_paterno":"Popoca","mail":"","phone":"","$$hashKey":"object:26"}],"asma":false,"motociclismo":false,"diabetes":false,"hipertencion":false,"tiroides":false,"investment":"mensual","references":[]}';
//$json= '{"name":"Eduardo","lastname_materno":"Peralta","lastname_paterno":"Popoca","mail":"edmon@homail.com","phone":"23232344","birthday":"","smoker":false,"ocupation":"","civil_state":true,"spouse":{"name":"Karen","lastname_materno":"Rod","lastname_paterno":"Shmul","mail":"","phone":"443434","birthday":""},"is_father":true,"sons":[{"name":"Fernando","lastname_materno":"Popoca","lastname_paterno":"Popoca","mail":"","phone":"","$$hashKey":"object:24"},{"name":"Fernando","lastname_materno":"Popoca","lastname_paterno":"Popoca","mail":"","phone":"","$$hashKey":"object:26"}],"asma":false,"motociclismo":false,"diabetes":false,"hipertencion":false,"tiroides":false,"investment":"mensual","references":[{"name":"Primer referencia","lastname_materno":"","lastname_paterno":"","mail":"","phone":"","$$hashKey":"object:28"},{"name":"Primer referencia","lastname_materno":"","lastname_paterno":"","mail":"","phone":"","$$hashKey":"object:30"}]}';
//var_dump(json_decode($json));
$p_object=json_decode($json);
foreach ($p_object->sons as $key => $value) {
    # code...
    echo $value->name;
 
}
if (!empty($p_object->references)) {
    # code...

    foreach ($p_object->references as $key => $value) {
        # code...
        echo $value->name;
    
    }
}
echo json_encode(["sdasdasda","asdasdasda","asdasdasda"]);  
echo $p_object->spouse->name;
//for ($i=0; $i < 5; $i++) { 
//    # code...
//    echo ",";
//    echo uniqid();
//
//}
?>