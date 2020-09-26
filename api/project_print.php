<?php
require_once('../dbase/conn.php');
//$data = json_decode(file_get_contents("php://input"));
//echo $_GET['tree_id'];
//echo "SELECT * FROM m_projects WHERE tree_id=".$_GET['tree_id'];
//echo $data->tree_id;

 $results=mysqli_query($db,"SELECT * FROM m_projects WHERE tree_id=".$_GET['tree_id']);
//echo $results;
$row=mysqli_fetch_array($results);
//echo json_encode($row);

require_once '../servicios/PHPExcel/Classes/PHPExcel.php';
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
							 ->setLastModifiedBy("Maarten Balliauw")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");


// Add some data
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'DRAKKAR')
			->setCellValue('A2', 'ÁRBOL DE ENSAMBLE')
			->setCellValue('B3', 'ENSAMBLE:')
			->setCellValue('B4', 'NÚMERO:')
			->setCellValue('C5', 'FIRMA');

      $objPHPExcel->setActiveSheetIndex(0);
      	$name="AT-";
      	header('Content-Type: application/vnd.ms-excel');
      	header("Content-Disposition: attachment;filename='".$name."-cliente.xls'");
      	header('Cache-Control: max-age=0');
      	// If you're serving to IE 9, then the following may be needed
      	header('Cache-Control: max-age=1');

      	// If you're serving to IE over SSL, then the following may be needed
      	header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
      	header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
      	header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
      	header ('Pragma: public'); // HTTP/1.0

      	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
      	$objWriter->save('php://output');

      	exit;
      /*  */
mysqli_close($db);
 ?>
