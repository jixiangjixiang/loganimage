<?php
/**
 * website.php 网站设置
 *
* @version       v0.01
 * @create time   2016/8/12
 * @update time
 * @author        MrCao
 * @copyright     Copyright (c) LiJiaWen
 * @informaition
 */
require_once ('admincheck.php');

$sqlstr		=	"select * from ".WIIDBPRE."_site where site_id = 1";
$result		=	mysql_query($sqlstr);
$row		=	mysql_fetch_assoc($result);
$id			=	$row['site_id'];
$name		=	$row['site_webname'];
$email1		=	$row['site_email'];
$email2		=	$row['site_email1'];
$phone1		=	$row['site_phone'];
$phone2		=	$row['site_phone1'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title> 网站设置 </title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" href="style2.css" type="text/css"/>
</head>
<body>
<div class="bgintor">
	<div class="tit1">
		<ul>
			<li><a href="website.php" target="mainFrame">网站设置</a></li>
		</ul>
	</div>
	<div class="listintor">
		<div class="header2"><span></span></div>
		<div class="fromcontent">
		  <form id="doForm" name="addForm" method="post" action="website_do.php?act=edit&id=<?php echo $row['site_id'];?>">
			<p>名　　称：<input class="in1" id="name" name="name" value="<?php echo $name;?>" type="text"/><span class="start"> *</span> </p>
			<p>邮　　箱：<input class="in1" id="email1" name="email1" value="<?php echo $email1;?>" type="text"/><span class="start"> *</span> </p>
			<p>电　　话：<input class="in1" id="phone1" name="phone1" value="<?php echo $phone1;?>" type="text"/><span class="start"> *</span> </p>
			<p>邮　　箱：<input class="in1" id="email2" name="email2" value="<?php echo $email2;?>" type="text"/><span class="start"> 选填</span> </p>
			<p>电　　话：<input class="in1" id="phone2" name="phone2" value="<?php echo $phone2;?>" type="text"/><span class="start"> 选填</span> </p>
			<div class="btn" style="margin-left:66px;">
				<input type="image" src="images/submit1.gif" width="56" height="20" alt="提交" onClick="return checkIn();"/>
			</div>
			<script type="text/javascript">
					function checkIn()
					{
						if(document.getElementById('name').value=="")
						{
							alert('名称不能为空');
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