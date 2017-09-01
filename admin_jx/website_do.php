<?php
/**
 * website_do.php  网站设置操作页面
 *
 * @version       v0.01
 * @create time   2017/1/6 星期五
 * @update time
 * @author        MrCao
 * @copyright     Copyright (c) WangXiang
 * @informaition
 */
require_once 'admincheck.php'; 
$act=sqlReplace(trim($_GET["act"]));
switch ($act){
		
		case "edit":
			$id 		=	sqlReplace(trim($_GET["id"]));
			$name		=	sqlReplace(trim($_POST["name"]));
			$email1		=	sqlReplace(trim($_POST["email1"]));
			$phone1		=	sqlReplace(trim($_POST['phone1']));
			$email2		=	sqlReplace(trim($_POST["email2"]));
			$phone2		=	sqlReplace(trim($_POST["phone2"]));
			//var_dump($name);return;
			checkData($id,"ID",0);
			checkData($name,"名称",1);

			$sqlStr	=	"update ".WIIDBPRE."_site set site_webname='".$name."',site_email='".$email1."',site_email1='".$email2."',site_phone='".$phone1."',site_phone1='".$phone2."'  where site_id = $id ";
			if (mysql_query($sqlStr)){
				alertInfo("修改成功","website.php",0);
			}else{
				alertInfo("修改失败","",1);
			}
		break;
	}
?>
