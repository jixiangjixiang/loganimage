<?php
	require_once('admin_jx/inc_dbconn.php');
	//$webUrl = $_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
	//echo $webUrl;
	$cid	= sqlReplace($_GET['cid']);
	$where  = ' where 1=1 ';

	$sql = "select * from ".WIIDBPRE."_site limit 1";
	$rs  = mysql_query($sql);
	$row = mysql_fetch_assoc($rs);
	$nae = $row['site_webname'];
	$em  = $row['site_email'];
	$ph  = $row['site_phone'];
	$em1 = $row['site_email1'];
	$ph1 = $row['site_phone1'];
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title><?php echo $nae;?></title>
<link rel="stylesheet" type="text/css" href="css/index.css">
<link rel="stylesheet" href="src/jquery.skidder.css">
</head>
<body>
<div id="header" class="">
	<div class="header-logo"><a href="javascript:void(0);"><?php echo $nae;?></a></div>
	<div class="header-nav">
		<ul>
			<?php
				$sql = "select * from ".WIIDBPRE."_class order by class_id desc ";
				$res = mysql_query($sql);
				$act = '';
				while($row=(mysql_fetch_assoc($res))){

					//默认导航栏样式
					$cid = empty($cid)?$row['class_id']:$cid;
					if($row["class_id"] == $cid){
						$act = ' class="active" ';
						$where .= ' and pic_classid = '.$cid.' ';
					}else{
						$act = '';
					}
					
					echo '<li><a '.$act.' href="index.php?cid='.$row["class_id"].'">'.$row["class_name"].'</a></li>';
				}
			?>
		</ul>
	</div>
</div>
<div class="slideshow" style="overflow: hidden">
<?php
	$sql = "select * from ".WIIDBPRE."_pic $where order by pic_id desc ";
	$rst = mysql_query($sql);
	while($row = mysql_fetch_assoc($rst)){
		echo '<div class="slide"><img src="userfiles/pic/'.$row["pic_address"].'"></div>';
	}
?>
	  <!-- <div class="slide"><img src="./img/6.jpg"></div>
	  <div class="slide"><img src="./img/7.jpg"></div>
	  <div class="slide"><img src="./img/8.jpg"></div>
	  <div class="slide"><img src="./img/9.jpg"></div>
	  <div class="slide"><img src="./img/10.jpg"></div>
	  <div class="slide"><img src="./img/11.jpg"></div>
	  <div class="slide"><img src="./img/12.jpg"></div>
	  <div class="slide"><img src="./img/13.jpg"></div>
	  <div class="slide"><img src="./img/14.jpg"></div>
	  <div class="slide"><img src="./img/15.jpg"></div>
	  <div class="slide"><img src="./img/16.jpg"></div> -->
</div>
<script src="js/jquery-1.11.0.min.js" type="text/javascript"></script>
<script src="js/imagesloaded.js"></script>
<script src="js/smartresize.js"></script>
<script src="src/jquery.skidder.js"></script>
<script type="text/javascript">
	$('.slideshow').each( function() {
		  var $slideshow = $(this);
		  //宽
		  if (window.innerWidth){
			  winWidth = window.innerWidth;
		  }else if((document.body) && (document.body.clientWidth)){
			winWidth = document.body.clientWidth;
		  }
		  //高
		  if (window.innerHeight){
			winHeight = window.innerHeight;
		  }else if ((document.body) && (document.body.clientHeight)){
		  //winHeight = document.body.clientHeight;
			winHeight = winWidth/2;
		  }

		  $slideshow.imagesLoaded( function() {
			$slideshow.skidder({
			  slideClass    : '.slide',
			  animationType : 'css',
			  scaleSlides   : true,
			  maxWidth : winWidth,
			  maxHeight: winHeight,
			  paging        : true,
			  autoPaging    : true,
			  pagingWrapper : ".skidder-pager",
			  pagingElement : ".skidder-pager-dot",
			  swiping       : true,
			  leftaligned   : false,
			  cycle         : true,
			  jumpback      : false,
			  speed         : 400,
			  autoplay      : false,
			  autoplayResume: false,
			  interval      : 4000,
			  transition    : "slide",
			  afterSliding  : function() {},
			  afterInit     : function() {}
			});
		  });
	});
	$(window).smartresize(function(){
		  $('.slideshow').skidder('resize');
	});
</script>
<div id="footer">
	<div class="contact">
		<p>email: <a href=""><?php echo $em;?></a></p>
		<p>phone: <a href=""><?php echo $ph;?></a></p>
		<?php
			if(!empty($em1)){
				echo '<p>email: <a href="">'.$em1.'</a></p>';
			}

			if(!empty($ph1)){
				echo '<p>phone: <a href="">'.$ph1.'</a></p>';
			}
		?>
	</div>
</div>
</body>
</html>