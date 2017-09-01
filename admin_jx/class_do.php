<?php
/**
 * class_do.php  一级分类操作页面
 *
 * @version       v0.01
 * @create time   2016/8/12
 * @update time
 * @author        MrCao
 * @copyright     Copyright (c) LiJiaWen
 * @informaition
 */
require_once 'admincheck.php'; 
$act=sqlReplace(trim($_GET["act"]));
switch ($act){
		//批量删除
		case "delAll":
			if(empty($_POST["id_list"])){
				alertInfo('请选择删除项!',"",1);
			}
			$id_list=$_POST["id_list"];
			foreach($id_list as $val)
			{
				$sql="select * from ".WIIDBPRE."_class where class_id=".$val;
				$result=mysql_query($sql);
				$row=mysql_fetch_assoc($result);
				if(!$row)
				{
					alertInfo('要删除的数据不存在','',1);
				}else{
					$sql="delete from ".WIIDBPRE."_class where class_id=".$val;
					if(mysql_query($sql)){
						//删除成功
					}else{
						alertInfo('删除失败，原因sQL出现异常',"",1);
					}
				}
			}
			alertInfo("删除成功","",1);
			break;

		//单个删除
		case "del":
			$id=sqlReplace(Trim($_GET["id"]));
			checkData($id,"ID",0);
			$sql2="select * from ".WIIDBPRE."_class where class_id=".$id;
			$result2=mysql_query($sql2);
			$row2=mysql_fetch_assoc($result2);
			if(!$row2)
			{
				alertInfo('您要删除的数据不存在','',1);
			}
			$sql="delete from ".WIIDBPRE."_class where class_id=".$id;
			if(mysql_query($sql)){
				alertInfo("删除成功","",1);
			}else{
				alertInfo('删除失败，原因sQL出现异常',"",1);
			}
			break;
		//添加
		case "add":
			$name=sqlReplace(trim($_POST["name"]));
			checkData($name,"名称",1);
			$sql="select class_id from ".WIIDBPRE."_class where class_name='".$name."'";
			$rs=mysql_query($sql);
			$rows=mysql_fetch_assoc($rs);
			if ($rows){
				alertInfo("分类名称已存在","",1);
			}else{
				$sqlStr="insert into ".WIIDBPRE."_class (class_name) values ('".$name."')";
				//echo $sqlStr;return;
				if (mysql_query($sqlStr)){
					alertInfo("分类添加成功","class_list.php",0);
				}else{
					alertInfo("分类添加失败","",1);
				}
			}
		break;
		//修改
		case "edit":
			$id		=	sqlReplace(trim($_GET["id"]));
			$name	=	sqlReplace(trim($_POST["name"]));
			checkData($name,"名称",1);
			checkData($id,"ID",0);

			//检测重名
			$sql	=	"select class_id from ".WIIDBPRE."_class where class_name='".$name."' and class_id != $id ";
			$rs		=	mysql_query($sql);
			$rows	=	mysql_fetch_assoc($rs);
			if ($rows){
				alertInfo("分类名称存在重复！","",1);
			}

			$sql_r	=	"select class_id from ".WIIDBPRE."_class where class_id=".$id;
			$rs		=	mysql_query($sql_r);
			$row	=	mysql_fetch_assoc($rs);
			if ($row){
				$sqlStr	=	"update ".WIIDBPRE."_class set class_name='".$name."' where class_id=".$id;
				if (mysql_query($sqlStr)){
					alertInfo("分类修改成功","class_list.php",0);
				}else{
					alertInfo("分类修改失败","",1);
				}
			}else{
				alertInfo("数据不存在","",1);
			}
		break;
		//排序
		/**
		 *
		case "update1":
		$i=sqlReplace(trim($_POST["i"]));
		checkData($i,"",0);
		for($x=1;$x<=$i;$x++){
			$tempId=sqlReplace(trim($_POST["id".$x]));
			checkData($tempId,'ID',0);
			$tempOrder=sqlReplace(trim($_POST["order".$x]));
			checkData($tempOrder,'ID',0);
			$sqlStr="update ".WIIDBPRE."_class set class_order=".$tempOrder." where class_id=".$tempId."";
			if(!mysql_query($sqlStr)){
				alertInfo('保存失败! 原因：SQL更新失败',"",1);
			}
		}
		alertInfo('保存成功!',"class_list.php",0);
		break;
		*/
	}
?>
