<?php
/**
 * page.php  分页显示
 *
 * @version       v0.01
 * @create time   2011-8-22
 * @update time   
 * @author        cyk
 * @copyright     Copyright (c) 微普科技 WiiPu Tech Inc. (http://www.wiipu.com)
 * @informaition  

 * Update Record:
 *
 */
?>
<div class="page">当前页:<?php echo $page;?>/<?php echo $pagecount;?>页 每页 <?php echo $pagesize?> 条</div>
<div class="page2"><a href="<?php echo $url;?>page=1&pagesize=<?php echo $pagesize?>"><img src="images/firstpage.jpg" width="50" height="11" alt="首页" /></a>
	<a href="<?php echo $url;?>page=<?php echo $prepage;?>&pagesize=<?php echo $pagesize?>"><img src="images/prepage.jpg" width="56" height="11" alt="上一页" /></a>
	<a href="<?php echo $url;?>page=<?php echo $nextpage;?>&pagesize=<?php echo $pagesize?>"><img src="images/nextpage.gif" width="57" height="11" alt="下一页" /></a>
	<a href="<?php echo $url;?>page=<?php echo $pagecount;?>&pagesize=<?php echo $pagesize?>"><img src="images/lastpage.gif" width="60" height="11" alt="尾页" /></a>
	转到第<input type="text" name="page" value="<?php echo $page?>" size="2"/>页 <a href="javascript:document.listForm.action='<?php echo $url;?>pagesize=<?php echo $pagesize;?>';document.listForm.method='get';document.listForm.submit()"><img class="img1" src="images/foward.gif" width="26" height="20" alt="转" /></a>
</div>
