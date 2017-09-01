<?php
/**
 * 检查管理员是否登录
 *
 * @version       v0.01
 * @create time   2016/8/12
 * @update time
 * @author        MrCao
 * @copyright     Copyright (c) LiJiaWen
 * @informaition
 */
	require_once('inc_dbconn.php');
	if(empty($_SESSION['wii_admin_account'])){
		echo "<script language='javascript'>top.location.href='adminlogin.html'</script>";
		die();
	}
?>