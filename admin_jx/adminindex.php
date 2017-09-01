<?php
/**
 * 后台管理界面框架集
 *
* @version       v0.01
 * @create time   2016/8/12
 * @update time
 * @author        MrCao
 * @copyright     Copyright (c) LiJiaWen
 * @informaition
 */
	require_once('admincheck.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title> Fashion系统管理平台  </title>
	</head>
	<frameset rows="94,*,23" frameborder="no" border="0" framespacing="0" id="top">
	  <frame src="header.php" id="topFrame" scrolling="no" noresize="noresize" title="TopFrame" />
	  <frameset cols="205,7,*" frameborder="no" border="0" framespacing="0" id="frams">
		<frame src="menu.php" id="menuFrame" noresize="noresize" title="menuFrame"/>
		<frame src="switchframe.php"  noresize="noresize" title="switchFrame"/>
		<frame src="main.php" id="mainFrame" name="mainFrame" title="mainFrame" />
	  </frameset>
	  <frame src="footer.php" id="footFrame" scrolling="no" noresize="noresize" title="FootFrame" />
	</frameset>
	<noframes>
		<body>
		</body>
	</noframes>
</html>