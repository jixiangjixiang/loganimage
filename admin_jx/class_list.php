<?php
/**
 * class_list.php 分类列表
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
  <title> 分类列表 </title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" href="style2.css" type="text/css"/>
	<script language="javascript">
		function checkAll(f){
			var len=f.elements.length;
			if (document.getElementById("handler").checked==true)
			{
				for(i=0;i<len;i++){
					var e=f.elements[i];
					if (e.type=='checkbox') e.checked=true;
				}
			}
			if (document.getElementById("handler").checked==false)
			{
				for(i=0;i<len;i++){
					var e=f.elements[i];
					if (e.type=='checkbox') e.checked=false;
				}
			}
		}
	</script>
 </head>
<body>
<div class="bgintor">
  	<div class="tit1">
		<ul>
			<li><a href="class_list.php">分类列表</a></li>
			<li class="l1"><a href="class_add.php">添加分类</a></li>
		</ul>
	</div>
	<div class="listintor">
			<form id="listForm" name="listForm" method="post" action="#">
				<div class="header2"><span></span></div>
				<div class="header3">
					<a href="javascript:if(confirm('您确定要批量删除吗？')){document.listForm.action='class_do.php?act=delAll';document.listForm.submit();}"><img src="images/act_del.gif" width="14" height="14" alt="批量删除" /> <strong>批量删除</strong></a>
				</div>
				<div class="content">
					<table width="100%">
					  <tr class="t1">
					    <td width="10%"><input style="width:25px;height:20px;" type="checkbox" id="handler" name="handler" onClick="checkAll(this.form)">全选</td>
						<td>名称(点击查看分类图片)</td>
						<td width="15%">编辑</td>
						<td width="15%">删除</td>
					  </tr>
					  <?php
						if(empty($_GET['pagesize'])||!is_numeric($_GET['pagesize']))
						{
							$pagesize=10;
						}else{
							$pagesize=$_GET['pagesize'];
						if($_GET['pagesize']<1)$pagesize=10;
						}
						$startrow=0;
						$sql2="select * from ".WIIDBPRE."_class order by class_id desc";
						$rs=mysql_query($sql2) or die ("查询失败，请检查sQL语句2！");
						$rscount=mysql_num_rows($rs);
						if ($rscount%$pagesize==0)
						$pagecount=$rscount/$pagesize;
						else
							$pagecount=ceil($rscount/$pagesize);
						if (empty($_GET['page'])||!is_numeric($_GET['page']))
							$page=1;
						else{
							$page=$_GET['page'];
							if($page<1) $page=1;
							if($page>$pagecount) $page=$pagecount;
							$startrow=($page-1)*$pagesize;
						}
						if($page>=$pagecount)
						{
							$nextpage=$pagecount;
						}else{
							$nextpage=$page+1;
						}
						if($page<=1)
						{
							$prepage=1;
						}else{
							$prepage=$page-1;
						}
						$sqlstr="select * from ".WIIDBPRE."_class order by class_id desc limit $startrow,$pagesize";
						$result = mysql_query($sqlstr);
						if(!$rscount){
							echo "<tr><td colspan='10'>暂且没有数据！</td></tr>";
						}else{
							$i=1;
							while($row=mysql_fetch_assoc($result)){
					  ?>
					  <tr>
						<td><input style="width:25px;height:20px;" type="checkbox" name="id_list[]" value="<?php echo $row["class_id"]?>" /></td>
						<td><a href="pic_list.php?cid=<?php echo $row["class_id"]?>" target="mainFrame"><?php echo $row["class_name"];?></a></td>
						<td><a href="class_edit.php?id=<?php echo $row["class_id"]?>&page=<?php echo $page;?>&pagesize=<?php echo $pagesize;?>" target="mainFrame"><img src="images/dot_edit.gif" width="9" height="9" alt="编辑" /></td>
						<td><a href="javascript:if(confirm('您确定要删除吗？')){location.href='class_do.php?act=del&id=<?php echo $row['class_id'];?>&page=<?php echo $page;?>&pagesize=<?php echo $pagesize;?>'}"><img src="images/dot_del.gif" width="9" height="9" alt="删除" /></a></td>
					  </tr>
					  	<input type='hidden' name='i' value="<?php echo $i;?>"/>
					  <?php
							$i++;
							}
						}
					  ?>
					</table>
					<?php
						if($rscount>0){
							$url="class_list.php?";
							$url2="class_list.php";
							include_once('page.php');
						}
					?>
				</div>
			</form>
	</div>
</div>
</body>
</html>