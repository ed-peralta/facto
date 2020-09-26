<?php
echo 'holo';
//require_once('../dbase/conn.php');
require_once('../dbase/conn_docsys.php');
$results=mysqli_query($dbdocsys,"SELECT * FROM a_trees");

while ($row = mysqli_fetch_array($results)){
  $mvcs[]=$row['a_tree_id'];
}
//var_dump($mvcs)
echo "-".$mvcs[0]."<br>";


$lpAtree=mysqli_query($dbdocsys,"SELECT * FROM parts_lists WHERE a_tree_id=".$mvcs[0]);
while ($row = mysqli_fetch_array($lpAtree)){
  $lp[]=$row;
  echo "/".$row['l_part_id'];
}
echo "<br>";
function recursive($parent,$db)
{
	echo $branch['name']=$parent['l_part_assambly'];
	$branch['children']=array();
	$lpresult=mysqli_query($db,"SELECT * FROM parts_lists WHERE parent_id=".$parent['l_part_id']);
	if ($lpresult->num_rows>0) {
		while ($row = mysqli_fetch_array($lpresult)){
			//$lpres[]=$row;
			array_push($branch['children'],recursive($row,$db));
		}
	}else {
	$branch['children']= array();
	}
	echo "string";
	var_dump($branch);
	return $branch;
}

$tree['name']="holo";
foreach ($lp as $listpat) {
	array_push($tree['children'],recursive($listpat,$dbdocsys));
	echo "<br>";
}
var_dump($tree);
 ?>
