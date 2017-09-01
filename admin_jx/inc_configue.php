<?php
/**
 * 基本参数设置
 *
 * @version       v0.01
 * @create time   2016/8/12
 * @update time
 * @author        MrCao
 * @copyright     Copyright (c) LiJiaWen
 * @informaition
 */

	error_reporting(1);    //网站开发必须关闭此处，网站上线必须打开此处
	header("content-type:text/html;charset=utf-8");
	session_start();
	//ob_start();

	//配置数据库连接参数
	define('WIIDBPRE','jx');

?>
