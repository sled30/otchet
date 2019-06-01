<?php
class MyDB extends SQLite3{
        function __construct()
        {
                $this->open('mysqlitedb.db');
        }
}
function parser_file($name){
	// code...
	if ( $xls = SimpleXLS::parse($name) ) {
		$data = $xls->rows();
	} else {
		echo SimpleXLS::parseError();
	}
	 foreach ($data as $value){
	  insert_db( $value[1], $value[0]);
	 }
}
function create_db(){
	// code...
	$db = new MyDB();
	$sql = "CREATE TABLE IF NOT EXISTS `source` (
	  `id` INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL ,
	  `idcase` varchar(20) NOT NULL, `source` varchar(20) NOT NULL)";
	$db->exec($sql);
	$db->close();
}
function select_db($idcase){
  // code...
  $sql = "select source from source where idcase = '$idcase'";
  $db = new MyDB();
	$db->exec($sql);
  $result = $db->query($sql);
  $status = $result->fetchArray();
  if($status === FALSE){
    $status[0]='не найдено';
    echo "алярма\n";
  }
	$db->close();
  return $status;
}
function insert_db($idcase, $source){
	// code...
	$db = new MyDB();
	$sql= "INSERT INTO source (idcase, source) VALUES ('$idcase', '$source')";
	//echo $sql;
	//echo "\n";
	$db->exec($sql);
	$db->close();
}
function load_file(){
	// code...
  $arr_file_name = scandir('file/litle');
  foreach ($arr_file_name as $file_name){
  	// code...
  	//echo $file_name;
  	$file=__DIR__.'/file/litle/'.$file_name;
  	echo $file;
  	if (is_file($file)){
  		// code...
  		parser_file($file);
    }}
}
