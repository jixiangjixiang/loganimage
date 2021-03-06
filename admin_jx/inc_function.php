<?php
/**
 * 后台公用函数，与业务无关的函数
 *
 * @version       v0.01
 * @create time   2011-5-16
 * @update time
 * @author        jiangting
 * @copyright     Copyright (c) 微普科技 WiiPu Tech Inc. (http://www.wiipu.com)
 * @informaition
 */
function sqlReplace($str){
   $strResult = $str;
   if(!get_magic_quotes_gpc())
   {
     $strResult = addslashes($strResult);
   }
   return $strResult;
}
function HTMLEncode($str){
	if (!empty($str)){
		$str=str_replace("&","&amp;",$str);
		$str=str_replace(">","&gt;",$str);
		$str=str_replace("<","&lt;",$str);
		$str=str_replace(CHR(32),"&nbsp;",$str);
		$str=str_replace(CHR(9),"&nbsp;&nbsp;&nbsp;&nbsp;",$str);
		$str=str_replace(CHR(9),"&#160;&#160;&#160;&#160;",$str);
		$str=str_replace(CHR(34),"&quot;",$str);
		$str=str_replace(CHR(39),"&#39;",$str);
		$str=str_replace(CHR(13),"",$str);
		$str=str_replace(CHR(10),"<br/>",$str);
	}
	return $str;
}
Function HTMLDecode($str){
	if (!empty($str)){
		$str=str_replace("&amp;","&",$str);
		$str=str_replace("&gt;",">",$str);
		$str=str_replace("&lt;","<",$str);
		$str=str_replace("&nbsp;",CHR(32),$str);
		$str=str_replace("&nbsp;&nbsp;&nbsp;&nbsp;",CHR(9),$str);
		$str=str_replace("&#160;&#160;&#160;&#160;",CHR(9),$str);
		$str=str_replace("&quot;",CHR(34),$str);
		$str=str_replace("&#39;",CHR(39),$str);
		$str=str_replace("",CHR(13),$str);
		$str=str_replace("<br/>",CHR(10),$str);
		$str=str_replace("<br>",CHR(10),$str);
	}
	return $str;
}
function DateDiff($part, $begin, $end){
	$diff = strtotime($end) - strtotime($begin);
	switch($part){
		case "y": $retval = bcdiv($diff, (60 * 60 * 24 * 365)); break;
		case "m": $retval = bcdiv($diff, (60 * 60 * 24 * 30)); break;
		case "w": $retval = bcdiv($diff, (60 * 60 * 24 * 7)); break;
		case "d": $retval = bcdiv($diff, (60 * 60 * 24)); break;
		case "h": $retval = bcdiv($diff, (60 * 60)); break;
		case "n": $retval = bcdiv($diff, 60); break;
		case "s": $retval = $diff; break;
	}
	return $retval;
}
function alertInfo($info,$url,$type){
	switch($type){
		case 0:
			echo "<script language='javascript'>alert('".$info."');location.href='".$url."'</script>";
			exit();
			break;
		case 1:
			echo "<script language='javascript'>alert('".$info."');history.back(-1);</script>";
			exit();
			break;
	}
}
function checkData($data,$name,$type){
	switch($type){
		case 0:
			if(!preg_match('/^\d*$/',$data)){
				alertInfo("非法参数".$name,'',1);
			}
			break;
		case 1:
			if(empty($data)){
				alertInfo($name."不能为空","",1);
			}
			break;
	}
	return $data;
}

function checkEmail($email,$name)
{
	if(empty($email))
	{
		alertInfo($name.'不能为空','',1);
	}else if(!eregi("^[a-zA-Z0-9]([a-zA-Z0-9]*[-_.]?[a-zA-Z0-9]+)+@([a-zA-Z0-9]+\.)+[a-zA-Z]{2,}$", $email))
	{
		alertInfo($name.'输入格式不正确','',1);
	}

}
function cutstr($string, $length) {
	$charset="utf-8";
	if(strlen($string) <= $length) {
		return $string;
	}
	//$string = str_replace(array('&amp;', '&quot;', '&lt;', '&gt;'), array('&', '"', '<', '>'), $string);
	$strcut = '';
	if(strtolower($charset) == 'utf-8') {
		$n = $tn = $noc = 0;
		while($n < strlen($string)) {
			$t = ord($string[$n]);
			if($t == 9 || $t == 10 || (32 <= $t && $t <= 126)) {
				$tn = 1; $n++; $noc++;
			} elseif(194 <= $t && $t <= 223) {
				$tn = 2; $n += 2; $noc += 2;
			} elseif(224 <= $t && $t < 239) {
				$tn = 3; $n += 3; $noc += 2;
			} elseif(240 <= $t && $t <= 247) {
				$tn = 4; $n += 4; $noc += 2;
			} elseif(248 <= $t && $t <= 251) {
				$tn = 5; $n += 5; $noc += 2;
			} elseif($t == 252 || $t == 253) {
				$tn = 6; $n += 6; $noc += 2;
			} else {
				$n++;
			}
			if($noc >= $length) {
				break;
			}
		}
		if($noc > $length) {
			$n -= $tn;
		}
		$strcut = substr($string, 0, $n);

	} else {
		for($i = 0; $i < $length; $i++) {
			$strcut .= ord($string[$i]) > 127 ? $string[$i].$string[++$i] : $string[$i];
		}
	}
	//$strcut = str_replace(array('&', '"', '<', '>'), array('&amp;', '&quot;', '&lt;', '&gt;'), $strcut);
	return $strcut.'...';
}
//随机数函数
function random($length) {
		$hash = '';
		$chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ123456789abcdefghijkmnpqrstuvwxyz';
		$max = strlen($chars) - 1;
		mt_srand((double)microtime() * 1000000);
		for($i = 0; $i < $length; $i++) {
			$hash .= $chars[mt_rand(0, $max)];
		}
		return $hash;
	}

function getRndCode_r($length) {
	PHP_VERSION < '4.2.0' && mt_srand((double)microtime() * 1000000);
	$hash = '';
	$chars = '0123456789';
	$max = strlen($chars) - 1;
	for($i = 0; $i < $length; $i++) {
		$hash .= $chars[mt_rand(0, $max)];
	}
	return $hash;
}

function showPage($url,$page,$pagecount){
	$tempStr="";
	$spacer="?";
	if(strpos($url,"?")>-1) $spacer='&';
	$url.=$spacer;
	$tempStr="<a href='".$url."page=1'><img src='images/page_first.gif' alt='首页' /></a>";
	if($page>1)
		$tempStr.=" <a href='".$url."page=".($page-1)."'><img src='images/page_back.gif' alt='上一页' /></a>";
	else
		$tempStr.=" <img src='images/page_back.gif' alt='上一页' />";
	if($page<$pagecount)
		$tempStr.=" <a href='".$url."page=".($page+1)."'><img src='images/page_next.gif' alt='下一页' /></a>";
	else
		$tempStr.=" <img src='images/page_next.gif' alt='下一页' />";
	$tempStr.=" <a href='".$url."page=".$pagecount."'><img src='images/page_last.gif' alt='末页' /></a>";
	$tempStr.=" 转到第<input type='text' id='pageTo' size='3' style='width:26px;height:14px;' value='".$page."'/>页<a href='javascript:location.href=\"".$url."page=\"+document.getElementById(\"pageTo\").value;'><img src='images/page_go.gif' alt='转到' /></a>";
	return $tempStr;
}

//根据ID查Name
function getName($id,$table){
	$sql="select ".$table."_name from ".WIIDBPRE."_class where ".$table."_id=".$id;
	$rs=mysql_query($sql);
	$row=mysql_fetch_assoc($rs);
	if($row){
		return $row[$table.'_name'];
	}else{
		return '';
	}
}

//创建文件夹
function createFolders($dirpath)
	{
		if(!file_exists($dirpath))
        {
            @mkdir($dirpath);
            @chmod($dirpath,0777);
        }
	}

	//获取文件夹的大小
function getDirSize($dirname){
	  $dir_size = 0;
	  if($dir_link = @opendir($dirname)){
	   while($file = readdir($dir_link)){
		if($file!='.' && $file!='..'){
		 $filename = $dirname.'/'.$file;
		 if(is_dir($filename)){
		  $dir_size+=getDirSize($filename);
		 }
		 if(is_file($filename)){
		  $dir_size+=filesize($filename);
		 }
		}
	   }
	  }
	  closedir($dir_link);
	  return $dir_size;
	}

	//复制文件夹
function xCopy($source, $destination, $child){
		//参数说明：
		// $source:源目录名
		// $destination:目的目录名
		// $child:复制时，是不是包含的子目录
		if(!is_dir($source)){
			echo("不是一个目录!");
			return 0;
		}
		if(!is_dir($destination)){
			mkdir($destination,0777);
		}

		$handle=dir($source);
		while($entry=$handle->read()) {
			if(($entry!=".")&&($entry!="..")){
			if(is_dir($source."/".$entry)){
			if($child)
			xCopy($source."/".$entry,$destination."/".$entry,$child);
			}
			else{
			copy($source."/".$entry,$destination."/".$entry);
			}

			}
		}

		return 1;
	}

	//生成公共的config
function generateconfig($BackgroundColor,$ToolbarsColor,$ButtonsColor,$LoaderColor,$TextsColor,$PagesColor,$PagesLoaderColor,$BgImage,$pdfFile,$path,$mag_width,$mag_height){
		$str="<?php \n";
		$str.="\$backgroundcolor='$BackgroundColor';\n";
		$str.="\$toolbarscolor='$ToolbarsColor';\n";
		$str.="\$buttonscolor='$ButtonsColor';\n";
		$str.="\$loadercolor='$LoaderColor';\n";
		$str.="\$textscolor='$TextsColor';\n";
		$str.="\$pagescolor='$PagesColor';\n";
		$str.="\$pagesloadercolor='$PagesLoaderColor';\n";
		$str.="\$bgimage='$BgImage';\n";
		$str.="\$pdfFile='$pdfFile';\n";
        $str.="\$path='$path';\n";
		$str.="\$mag_width='$mag_width';\n";
		$str.="\$mag_height='$mag_height';\n";
		$str.="?>";
		$fp=fopen("../userfiles/mag/data/config.php","w+");
		fwrite($fp,$str);
		fclose($fp);
	}
	/*
//SQLite 查询
function dbQuery($queryString) {
  global $sql_db;

  $query = $sql_db->query($queryString);
  $i = 0;
  $queryReturn = array();
  foreach ($query as $query2) {
    $queryReturn[$i] = $query2;
    $i++;
  }
  if($i >= 1) {
    return $queryReturn;
  } else {
    return $queryReturn;
  }
}
*/
?>