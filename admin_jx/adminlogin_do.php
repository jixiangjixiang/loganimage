<?php
/**
 * 管理员登录
 *
* @version       v0.01
 * @create time   2016/8/12
 * @update time
 * @author        MrCao
 * @copyright     Copyright (c) LiJiaWen
 * @informaition
 */
		require_once('inc_dbconn.php');
		$admin_account	= sqlReplace(trim($_POST['name']));
		$admin_pwd		= sqlReplace(trim($_POST['pwd']));
		checkData($admin_account,"帐号",1);
		checkData($admin_pwd,"密码",1);
		$code			= trim($_POST['code']);
		if($code	   != $_SESSION['wii_imgcode'])
		{
			alertInfo('验证码错误',"adminlogin.html",0);
		}
		$sql = "select * from ".WIIDBPRE."_admin where admin_account='".$admin_account."' and admin_password='".md5($admin_pwd)."'";
		$res = mysql_query($sql);
		$row = mysql_fetch_assoc($res);
		if($row)
		{
			$_SESSION['wii_admin_account']=$admin_account;
			$ip=$_SERVER['REMOTE_ADDR'];
			$logincount=$row['admin_loginCount'];
			$logincount=$logincount++;
			$sql2="update ".WIIDBPRE."_admin set admin_loginTime=now(),admin_lastIP='".$ip."',admin_loginCount=".$logincount." where admin_account='".$admin_account."'";
			if(mysql_query($sql2)){echo '登录语句更新失败';}
			Header("Location:adminindex.php");
		}else{
			alertInfo('账户或密码错误',"adminlogin.html",0);
		}
?>