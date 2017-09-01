<?php
/**
 * class_edit.php 编辑分类
 *
* @version       v0.01
 * @create time   2016/8/12
 * @update time
 * @author        MrCao
 * @copyright     Copyright (c) LiJiaWen
 * @informaition
 */
require_once ('admincheck.php');

$page		=	sqlReplace(trim($_GET['page']));
$pagesize	=	sqlReplace(trim($_GET['pagesize']));
$id			=	sqlReplace(trim($_GET['id']));
checkData($id,"ID",0);

$sqlstr		=	"select * from ".WIIDBPRE."_class where class_id=".$id;
$result		=	mysql_query($sqlstr);
$row		=	mysql_fetch_assoc($result);

if(!$row){
	alertInfo("该分类不存在","class_list.php",0);
}else{
	$name	=	$row['class_name'];
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title> 添加分类 </title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" href="style2.css" type="text/css"/>
</head>
<body>
<div class="bgintor">
	<div class="tit1">
		<ul>
			<li class="l1"><a href="class_list.php" target="mainFrame">分类列表</a></li>
			<li class="l1"><a href="class_add.php" target="mainFrame">添加分类</a></li>
			<li><a href="#" target="mainFrame">编辑分类</a></li>
		</ul>
	</div>
	<div class="listintor">
		<div class="header2"><span></span></div>
		<div class="fromcontent">
		  <form id="doForm" name="addForm" method="post" action="class_do.php?act=edit&id=<?php echo $id;?>&page=<?php echo $page;?>&pagesize=<?php echo $pagesize;?>">
			<p>名　　称：<input class="in1 in2" id="name" name="name" value="<?php echo $name;?>" type="text"/><span class="start"> *</span> </p>
			<div class="btn" style="margin-left:66px;">
				<input type="image" src="images/submit1.gif" width="56" height="20" alt="提交" onClick="return checkIn();"/>
			</div>
			<script type="text/javascript">
					function checkIn()
					{
						if(document.getElementById('name').value=="")
						{
							alert('标题不能为空');
							document.getElementById('name').focus();
							return false;
						}
					}
			</script>
		  </form>
		</div>
	</div>
</div>
</body>
</html>