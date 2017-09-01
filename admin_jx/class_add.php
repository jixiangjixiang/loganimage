<?php
/**
 * class_add.php 添加分类
 *
* @version       v0.01
 * @create time   2016/8/12
 * @update time
 * @author        MrCao
 * @copyright     Copyright (c) LiJiaWen
 * @informaition
 */
require_once ('admincheck.php');
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
			<li><a href="class_add.php" target="mainFrame">添加分类</a></li>
		</ul>
	</div>
	<div class="listintor">
		<div class="header2"><span></span></div>
		<div class="fromcontent">
		  <form id="doForm" name="addForm" method="post" action="class_do.php?act=add">
			<p>名　　称：<input class="in1 in2" id="name" name="name" type="text"/><span class="start"> *</span> </p>	
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