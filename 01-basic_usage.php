<?php /** @noinspection ForgottenDebugOutputInspection */
require_once 'SimpleXLS.php';
require_once 'conf.php';
//$status = "test";
if (($fp = fopen("file/data.csv", "r")) !== FALSE) {
	while (($data = fgetcsv($fp, 0, ";")) !== FALSE) {
		//var_dump($data);
		$status = select_db($data[0]);
		//var_dump($status[0]);
		$data[] = $status[0];
		//var_dump($data);
		$list[] = $data;
	//	$list[] += $test;
		//$list[]= $test;
	//	var_dump($list);
	}
	fclose($fp);
//	print_r($list);
}

$fp = fopen('file/out.csv', 'w');
foreach ($list as $fields) {
	fputcsv($fp, $fields, ';', '"');
}
fclose($fp);
//$file_name = scandir('file/litle');

/*$db->exec('CREATE TABLE IF NOT EXISTS `source` (
 `id` INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL ,
  `idcase` varchar(20) NOT NULL, `source` varchar(20) NOT NULL);');*/
//create_db();

/*if ( $xls = SimpleXLS::parse('export.xls') ) {
	$data = $xls->rows();
} else {
	echo SimpleXLS::parseError();
}
 foreach ($data as $value){
  insert_db( $value[1], $value[0]);
}*/
//load_file();
