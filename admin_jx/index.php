<?php

//require_once('inc_configue.php');
//require_once('inc_function.php');
/*
//$db = new PDO("sqlite:../sqlite/jx.db");
$sql_db = new PDO("sqlite:../sqlite/jx.db");
//var_dump($sql_db);
//$db = SQLite3::open('../sqlite/jx');
//var_dump($db);
if ($sql_db){ 
	//链接成功!!!
	
}else{ 
	echo 'sqlite3 connect bad - 数据库链接失败'; 
}
$sql = 'select * from '.WIIDBPRE.'_admin ';
$res1 = dbQuery($sql);
foreach($res1 as $row){
	print_r($res1);
}
echo '<pre>';
print_r($res1);
$sql2="insert into ".WIIDBPRE."_admin(admin_account,admin_password) values('admin1','".md5("admin888")."');";
echo $sql2;
//$res = $db->query($sql2);
$res = $sql_db->exec($sql2);
var_dump($res);

/*

class MyDB extends SQLite3
{
    function __construct()
    {
        $this->open('../sqlite/jx.db');
    }
}

$db = new MyDB();
$sql = "select * from jx_admin";
//$db->exec();

$result = $db->query($sql);
var_dump($result->fetchArray());

*/
echo "It's not index file.";
?>