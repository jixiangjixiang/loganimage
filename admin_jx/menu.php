 <?php
/**
 * 管理后台左侧菜单
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
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
  <title> 菜单 </title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" href="style2.css" type="text/css"/>
 </he                      1a    d>
 <body id="flow">
	<div class="menu" id="me">
		<div class="menu_content">
			<div class="menu_h menu_h3">分类管理</div>
			<div class="menu_intor">
				<p><a href="class_list.php" target="mainFrame">分类列表</a></p>
				<p><a href="pic_list.php" target="mainFrame">图片管理</a></p>
			</div>
		</div>
		<div class="menu_content">
			<div class="menu_h menu_h3">系统管理</div>
			<div class="menu_intor">
				<p><a href="website.php" target="mainFrame">网站设置</a></p>
				<p><a href="adminlist.php" target="mainFrame">管理员设置</a></p>
			</div>
		</div>
	</div>
 </body>
</html>