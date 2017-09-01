<?php
/**
 * pic_list.php 图片列表
 *
* @version       v0.01
 * @create time		2017/1/7 星期一
 * @update time		2017/1/9 星期一
 * @author        MrCao
 * @copyright     Copyright (c) WangXiang
 * @informaition
 */
 
require_once ('admincheck.php');
$cid	= sqlReplace(trim($_GET["cid"]));
$where	= 'where 1=1 ';
if(!empty($cid)){
	$where .= '  and pic_classid = '.$cid ;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
  <title> 图片列表 </title>
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
		function serch(){
			var cid = document.getElementById("cid").value;
			document.listForm.action="pic_list.php?cid="+cid;
			document.listForm.submit();
		}
	</script>
 </head>
<body>
<div class="bgintor">
  	<div class="tit1">
		<ul>
			<li><a href="pic_list.php?cid=<?php echo $cid; ?>">图片列表</a></li>
			<li class="l1"><a href="pic_add.php">添加图片</a></li>
		</ul>
	</div>
	<div class="listintor">
			<form id="listForm" name="listForm" method="post" action="#">
				<div class="header2"><span></span></div>
				<div class="header3">
					<a href="javascript:document.listForm.action='pic_do.php?act=update1&cid=<?php echo $cid; ?>';document.listForm.submit();"><img src="images/act_save.gif" width="16" height="16" alt="保存排序" title="保存排序"  /> <strong>保存排序</strong></a>
					<a href="javascript:if(confirm('您确定要批量删除吗？')){document.listForm.action='pic_do.php?act=delAll&cid=<?php echo $cid?>';document.listForm.submit();}"><img src="images/act_del.gif" width="14" height="14" alt="批量删除" /> <strong>批量删除</strong></a>
				</div>
				<div id="" class="" style="padding-top:10px;">
					<p class="underline">　　　　所属分类：<select name="cid" id="cid" onChange="serch();">
						<option>　选择分类搜索　</option>
				<?php
					$sqlStr="select * from ".WIIDBPRE."_class order by class_id desc";
					$rs=mysql_query($sqlStr);
					$rows=mysql_num_rows($rs);
					If(!$rows){
						alertInfo("请先添加分类","class_add.php",0);
					}else{
						$actstr    = '';
						while($row = mysql_fetch_assoc($rs)){
							if($row['class_id'] == $cid){
								$actstr = 'selected';
							}else{
								$actstr = '';
							}
							echo "<option $actstr value='".$row["class_id"]."' >".$row["class_name"]."</option>";
						}
					}
				?>
				</select
			</p>
				</div>
				<div class="content">
					<table width="100%">
					  <tr class="t1">
					    <td><input type="checkbox" id="handler" name="handler" onClick="checkAll(this.form)">全选</td>
						<td width="30%">名称</td>
                        <td>缩略图</td>
                        <td>所属分类</td>
                        <td>外链</td>
                        <td>排序</td>
						<td>编辑</td>
						<td>删除</td>
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
						$sql2="select pic_id from ".WIIDBPRE."_pic ".$where." order by pic_order asc,pic_id desc";
						$rs=mysql_query($sql2) or die ("查询失败，请检查sQL语句2-page！");
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
						$sqlstr="select * from ".WIIDBPRE."_pic ".$where." order by pic_order asc,pic_id desc limit $startrow,$pagesize";
						$result = mysql_query($sqlstr);
						if(!$rscount){
							echo "<tr><td colspan='10'>暂且没有数据！</td></tr>";
						}else{
							$i=1;
							while($row=mysql_fetch_assoc($result)){
					  ?>
					  <tr>
						<td><input type="checkbox" name="id_list[]" value="<?php echo $row["pic_id"]?>" /></td>
						<td><?php echo $row['pic_name'];?></td>
						<td><img src="../userfiles/pic/<?php echo $row['pic_address'];?>" width="50" height="50" style="padding:3px;" ></td>
						<td><?php $cname = getName($row['pic_classid'],'class');echo $cname;?></td>
						<td><?php echo $row['pic_link'];?></td>
						<td><input name="id<?php echo $i?>" type="hidden" value="<?php echo $row["pic_id"]?>"><input name="order<?php echo $i?>" type="text" class="input-short"  style="width:25px; height:18px;" value="<?php echo $row["pic_order"]?>"/></td>
						<td><a href="pic_edit.php?id=<?php echo $row["pic_id"]?>&cid=<?php echo $row['pic_classid']?>&page=<?php echo $page;?>&pagesize=<?php echo $pagesize;?>" target="mainFrame"><img src="images/dot_edit.gif" width="9" height="9" alt="编辑" /></td>
						<td><a href="javascript:if(confirm('您确定要删除吗？')){location.href='pic_do.php?act=del&cid=<?php echo $row['pic_classid']?>&id=<?php echo $row['pic_id'];?>&page=<?php echo $page;?>&pagesize=<?php echo $pagesize;?>'}"><img src="images/dot_del.gif" width="9" height="9" alt="删除" /></a></td>
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
							$url="pic_list.php?&cid=$cid&";
							$url2="pic_list.php";
							include_once('page.php');
						}
					?>
				</div>
			</form>
	</div>
</div>
</body>
</html>