<?php
/**
 * 数据库连接
 *
 * @version       v0.01
 * @create time   2016/8/12
 * @update time
 * @author        MrCao
 * @copyright     Copyright (c) LiJiaWen
 * @informaition
 */
	require_once('inc_configue.php');
	require_once('inc_function.php');
/*
	//使用PDO打开sqlite数据库
	$sql_db = new PDO("sqlite:../sqlite/jx.db");
	if ($sql_db){ 
		//链接成功!!!
		//echo 'OK';
	}else{ 
		echo 'sqlite3 connect bad - 数据库链接失败';
		return;
	}
	*/

	//数据库参数
	$WIIDBHOST  = '127.0.0.1';
	$WIIDBUSER  = 'root';
	$WIIDBPASS  = 'logan2014';

	//database name
	$WIIDBNAME  = 'jx';

	$db_connect = mysql_connect($WIIDBHOST,$WIIDBUSER,$WIIDBPASS);
	 if(!$db_connect){
		die('数据库连接失败');
	 }
	 mysql_select_db($WIIDBNAME,$db_connect) or die('找不到数据库');
	 mysql_query('set names utf8;');
?>
