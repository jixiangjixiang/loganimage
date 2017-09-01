<?php
/**
 * pic_do.php  图片操作页面
 *
 * @version       v0.01
 * @create time   2017/1/5 星期四
 * @update time
 * @author        MrCao
 * @copyright     Copyright (c) WangXiang
 * @informaition
 */
require_once 'admincheck.php'; 
$act=sqlReplace(trim($_GET["act"]));
switch ($act){
		//批量删除
		case "delAll":
			$cid	=	sqlReplace(trim($_POST["cid"]));
			if(empty($_POST["id_list"])){
				alertInfo('请选择删除项!',"",1);
			}
			$id_list	=	$_POST["id_list"];
			foreach($id_list as $val)
			{
				$sql	=	"select * from ".WIIDBPRE."_pic where pic_id=".$val;
				$result	=	mysql_query($sql);
				$row	=	mysql_fetch_assoc($result);
				if(!$row)
				{
					alertInfo('要删除的数据不存在','',1);
				}else{
					$sql	=	"delete from ".WIIDBPRE."_pic where pic_id=".$val;
					if(mysql_query($sql)){
						//删除成功，delete image
						$del1 = @unlink('../userfiles/pic/'.$row2['pic_address']);
						$del2 = @unlink('../userfiles/pic/small/'.$row2['pic_address']);
					}else{
						alertInfo('删除失败，原因sQL出现异常',"",1);
					}
				}
			}
			alertInfo("删除成功","pic_list.php?cid=$cid",1);
			break;

		//单个删除
		case "del":
			$id		=	sqlReplace(Trim($_GET["id"]));
			$cid	=	sqlReplace(trim($_POST["cid"]));
			checkData($id,"ID",0);
			$sql2="select * from ".WIIDBPRE."_pic where pic_id=".$id;
			$result2=mysql_query($sql2);
			$row2=mysql_fetch_assoc($result2);
			if(!$row2)
			{
				alertInfo('您要删除的数据不存在','',1);
			}
			$sql="delete from ".WIIDBPRE."_pic where pic_id=".$id;
			if(mysql_query($sql)){

				//delete img
				$del1 = @unlink('../userfiles/pic/'.$row2['pic_address']);
				$del2 = @unlink('../userfiles/pic/small/'.$row2['pic_address']);
				alertInfo("删除成功","pic_list.php?cid=$cid",1);
			}else{
				alertInfo('删除失败，原因sQL出现异常',"",1);
			}
			break;
		//添加
		case "add":
			$name	=	sqlReplace(trim($_POST["name"]));
			$pic1	=	sqlReplace(trim($_POST['upfile']));
			$cid	=	sqlReplace(trim($_POST["cid"]));
			$url	=	sqlReplace(trim($_POST["url"]));
			//$pic    =   $pic1 == ''?'inc/default.jpg':$pic1;

			checkData($pic1,"上传图片",1);
			checkData($cid,"分类名称",0);

			if($cid<1){
				alertInfo("请选择分类","",1);
			}
			$sql	=	"select * from ".WIIDBPRE."_class where class_id=".$cid;
			$result	=	mysql_query($sql);
			$row	=	mysql_fetch_assoc($result);
			if(!$row){
				alertInfo('你选择的分类不存在','',1);

				//add failed,delete image
				$del1 = @unlink('../userfiles/pic/'.$pic1);
				$del2 = @unlink('../userfiles/pic/small/'.$pic1);
			}
			$sqlStr	=	"insert into ".WIIDBPRE."_pic (pic_name,pic_link,pic_address,pic_classid,pic_order)values('".$name."','".$url."','".$pic1."',".$cid.",999)";//echo $sqlStr;return;
			if (mysql_query($sqlStr)){
				alertInfo("图片添加成功","pic_list.php?cid=$cid",0);
			}else{
				
				//add failed,delete image
				$del1 = @unlink('../userfiles/pic/'.$pic1);
				$del2 = @unlink('../userfiles/pic/small/'.$pic1);
				alertInfo("图片添加失败","",1);
			}
		break;
		//修改
		case "edit":
			$id			=	sqlReplace(trim($_GET["id"]));
			$page		=	sqlReplace(trim($_GET["page"]));
			$pagesize	=	sqlReplace(trim($_GET["pagesize"]));
			$cid2		=	sqlReplace(trim($_POST["cid"]));
			$name		=	sqlReplace(trim($_POST["name"]));
			$pic1		=	sqlReplace(trim($_POST['upfile']));
			$url		=	sqlReplace(trim($_POST["url"]));
			$order		=	sqlReplace(trim($_POST["order"]));
			checkData($pic1,"上传图片",1);
			checkData($name,"名称",1);
			checkData($url,"url",1);
			checkData($id,"ID",0);
			checkData($cid2,"cID2",0);
			checkData($order,"order",0);
			if($order > 9999){
				alertInfo('');
			}

			//检测重名
			$sql	=	"select pic_id from ".WIIDBPRE."_pic where pic_name='".$name."' and pic_id != $id ";
			$rs		=	mysql_query($sql);
			$rows	=	mysql_fetch_assoc($rs);
			if ($rows){
				alertInfo("图片名称存在重复！","",1);
			}

			$sql_r	=	"select pic_id from ".WIIDBPRE."_pic where pic_id=".$id;
			$rs		=	mysql_query($sql_r);
			$row	=	mysql_fetch_assoc($rs);
			if ($row){
				$sqlStr	=	"update ".WIIDBPRE."_pic set pic_link='".$url."',pic_name='".$name."',pic_address='".$pic1."',pic_classid = $cid2,pic_order = $order where pic_id=".$id;
				if (mysql_query($sqlStr)){
					$str = "图片修改成功";

					//图片更改时，删除原图片
					if($pic1 != $row['pic_address']){
						$del1 = @unlink('../userfiles/pic/'.$row['pic_address']);
						$del2 = @unlink('../userfiles/pic/small/'.$row['pic_address']);
						if($del1 && $del2){
							$str .= "-原图片删除成功";
						}
					}
					
					alertInfo($str,"pic_list.php?cid=$cid2&page=$page&pagesize=&pagesize",0);
				}else{
					alertInfo("图片修改失败","",1);
				}
			}else{
				alertInfo("数据不存在","",1);
			}
		break;
		//排序
		case "update1":
		$i		=	sqlReplace(trim($_POST["i"]));
		$cid	=	sqlReplace(trim($_GET["cid"]));
		checkData($cid,"cID",0);
		checkData($i,"",0);
		for($x=1;$x<=$i;$x++){
			$tempId		=	sqlReplace(trim($_POST["id".$x]));
			$tempOrder	=	sqlReplace(trim($_POST["order".$x]));
			checkData($tempId,'ID',0);
			checkData($tempOrder,'ID',0);
			$sqlStr		=	"update ".WIIDBPRE."_pic set pic_order=".$tempOrder." where pic_id=".$tempId."";
			if(!mysql_query($sqlStr)){
				alertInfo('保存失败! 原因：SQL更新失败',"",1);
			}
		}
		alertInfo('保存成功!',"pic_list.php?cid=$cid",0);
		break;
	}
?>
