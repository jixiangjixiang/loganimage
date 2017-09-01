<?php
/**
 * pic_edit.php 修改图片
 *
* @version       v0.01
 * @create time   2017/1/5 星期四
 * @update time
 * @author        MrCao
 * @copyright     Copyright (c) WangXiang
 * @informaition
 */
require_once ('admincheck.php');
$page		=	sqlReplace(trim($_GET['page']));
$pagesize	=	sqlReplace(trim($_GET['pagesize']));
$id			=	sqlReplace(trim($_GET['id']));
$cid		=	sqlReplace(trim($_GET['cid']));
checkData($id,"ID",0);
$sqlstr		=	"select * from ".WIIDBPRE."_pic where pic_id=".$id;
$result		=	mysql_query($sqlstr);
$row		=	mysql_fetch_assoc($result);

if(!$row){
	alertInfo("该数据不存在","pic_list.php",0);
}else{
	$name	=	$row['pic_name'];
	$url	=	$row['pic_address'];
	$link	=	$row['pic_link'];
	$cid	=	$row['pic_classid'];
	$order	=	$row['pic_order'];
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title> 修改图片 </title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" href="style2.css" type="text/css"/>
  <script type="text/javascript" src="js/jquery-1.6.min.js"></script>
  <script type="text/javascript" src="js/upload.js"></script>
  <script type="text/javascript">
	function ajaxFileUpload()
	{
		$("#loading")
		.ajaxStart(function(){
			$(this).show();
		})
		.ajaxComplete(function(){
			$(this).hide();
		});

		$.ajaxFileUpload
		(
			{
			    url:'pic_picup.php',
				secureuri:false,
				fileElementId:'fileToUpload',
				dataType: 'json',
				data:{name:'logan', id:'id'},
				success: function (data, status)
				{
					data=data.replace('<pre>','');
					data=data.replace('</pre>','');
					var info=data.split('|');
					if(info[0]=="E")
						alert(info[1]);
					else{
						document.getElementById('upfile').value=info[1];
						document.getElementById('logo').innerHTML='';
						document.getElementById('logo').innerHTML="<img src='../"+info[2]+"' width='50' height='50' />";
					}

				},
				error: function (data, status, e)
				{
					alert(e);
				}
			}
		)
		return false;
	}
</script>
</head>
<body>
<div class="bgintor">
	<div class="tit1">
		<ul>
			<li class="l1"><a href="pic_list.php" target="mainFrame">图片列表</a></li>
			<li class="l1"><a href="pic_add.php" target="mainFrame">添加图片</a></li>
			<li><a href="#" target="mainFrame">修改图片</a></li>
		</ul>
	</div>
	<div class="listintor">
		<div class="header2"><span></span></div>
		<div class="fromcontent">
		  <form id="doForm" name="addForm" method="post" action="pic_do.php?act=edit&cid=<?php echo $cid?>&id=<?php echo $id?>&page=<?php echo $page;?>&pagesize=<?php echo $pagesize;?>">
			<p class="underline">所属分类：<select name="cid" id="cid" >
			<option value="-1" selected>请选择分类</option>
			<?php
				$sqlStr="select * from ".WIIDBPRE."_class order by class_id desc";
				$rs=mysql_query($sqlStr);
				$rows=mysql_num_rows($rs);
				If(!$rows){
					//alertInfo("请先添加分类","pic_list.php",0);
				}else{
					$str = '';
					while($row=mysql_fetch_assoc($rs)){
						if($row["class_id"] == $cid){
							$str = 'selected';
						}else{
							$str = '';
						}
						echo "<option value='".$row["class_id"]."' $str >".$row["class_name"]."</option>";
					}
				}
			?>
			</select><span class="start"> *</span>
			</p>
			<p>名　　称：<input class="in1 in2" id="name" name="name" value="<?php echo $name;?>" type="text"/><span class="start"> *</span> </p>
			<p>链接地址：<input  onblur="checkurl();" class="in1 in2" id="url" name="url" value="<?php echo $link;?>" type="text"/><span class="start"> *</span> </p>
			<p>排　　序：<input class="in1 in2" id="order" name="order" value="<?php echo $order;?>" type="text"/><span class="start"> *</span> </p>
			<p>图　　片：
				<span id="loading" style="display:none;"><img src="images/loading.gif" width="16" height="16" alt="loading" /></span>
				<input id="upfile" name="upfile" value="<?php echo $url;?>" type="hidden"/>
				<input id="fileToUpload" type="file" name="fileToUpload" style="height:24px;"/>
				<input type="button" onclick="return ajaxFileUpload();" value="上传"/></p>
			    <p id='logo' style='padding-left:60px;'><img src="../userfiles/pic/small/<?php echo $url;?>" width='50' height='50' /></p>
			    <p><span class="start">提示：图片格式只能为图片jpg|png，大小必须小于2M。宽:18px，高:18px</span></p>
			<div class="btn" style="margin-left:66px;">
				<input type="image" src="images/submit1.gif" width="56" height="20" alt="提交" onClick="return checkIn();"/>
			</div>
			<script type="text/javascript">
					function checkIn()
					{
						if(document.getElementById('cid').value=="" || document.getElementById('cid').value==-1)
						{
							alert('请选择所属分类');
							return false;
						}
						if(document.getElementById('name').value=="")
						{
							alert('名称不能为空');
							document.getElementById('name').focus();
							return false;
						}
					}
					function checkurl() {
						url = document.getElementById("url").value;
						url = url.substr(0,7).toLowerCase()=="http://"?url:"http://"+url;;
						document.getElementById("url").value = url;
					}
			</script>
		  </form>
		</div>
	</div>
</div>
</body>
</html>