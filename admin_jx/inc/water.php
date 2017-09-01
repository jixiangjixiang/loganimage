<?php
/*
 * img_func.php		微博上传图片打水印类
 * @create time		2013/1/23
 * @author			lmx
 * @Description:	图片水印添加方法，包括文字水印和图片水印两种形式.图片格式必须为jpeg文件
*/
class Water{
	private $waterType; //水印类型 1-- 图片 2-- 文字
	private $waterimgsrc; //水印图片
	private $waterFontc; //水印字体颜色
	private $waterFonts; //水印字体大小
	private $waterPosition; //水印位置 1:左上 2:左下 3:右上 4:右下
	private $orgImg; //需要打水印的原图
	private $marktext; //水印文字
	private $path; //打印文字的图片保存路径

	/*
	 * function waterImg() 构造函数
	 * @parame $waterType 水印类型
	*/
	function __construct($waterType,$orgImg,$waterimgsrc){
		$this->waterType = $waterType;
		$this->orgImg = $orgImg;
		$this->waterimgsrc = $waterimgsrc;
	}
	/*
	 * function setOrgImg($orgimg)设置需要打水印的原图
	 * @param $orgimg 原图
	*/
	function setOrgImg($orgimg){
		$this->orgImg = $orgimg;
	}
	/*
	 * function setWaterType($waterType) 设置水印类型
	 * @parame $waterType;
	*/
	function setWaterType($waterType){
		$this->waterType = $waterType;
	}
	/*
	 * function setWaterimgsrc($images) 设置水印图片
	 * @parame $images 水印图片
	*/
	function setWaterimgsrc($images){
		$this->waterimgsrc = $images;
	}
	/*
	 * funciton setWaterFontc($color)设置水印字体颜色
	 * @param $color 字体颜色
	*/
	function setWaterFontc($color){
		$this->waterFontc = $color;
	}
	/*
	 * function setWaterFonts($size)设置字体大小
	 * @parame $size; 字体大小
	*/
	function setWaterFonts($size){
		$this->waterFonts = $size;
	}
	/*
	 * function setWaterp($position)设置水印位置
	 * @parame $position 水印位置
	*/
	function setWaterPosition($position){
		$this->waterPosition = $position;
	}
	/*
	 * function setMarktext($marktext)设置打印文字
	*/
	function setMarktext($marktext){
		$this->marktext = $marktext;
	}
	/*
	 * function setPath($path)设置打印文字图片路径
	*/
	function setPath($path){
		$this->path = $path;
	}
	/*
	 * function getWaterimgsrc() 获得水印类型
	*/
	function  getWaterType(){
		return $this->waterType;
	}
	/*
	 * function getPath() 获得水印图片路径
	*/
	function  getPath(){
		return $this->path;
	}
	/*
	 * function getWaterimgsrc() 获得水印图片
	*/
	function  getWaterimgsrc(){
		return $this->waterimgsrc;
	}
	/*
	 * function getWaterFontc() 获得字体颜色
	*/
	function  getWaterFontc(){
		return $this->waterFontc;
	}
	/*
	 * function getWaterFonts() 获得字体大小
	*/
	function  getWaterFonts(){
		return $this->waterFonts;
	}
	/*
	 * function getWaterPosition() 获得水印的位置
	*/
	function  getWaterPosition(){
		return $this->waterPosition;
	}
	/*
	 * function getMarktext() 获得打印文字
	*/
	function getMarktext(){
		return $this->marktext;
	}
	/*
	 * function getRgbcolor($color)获得十六进制颜色值的RGB值
	 * @param $color 十六进制颜色值
	 * return Array $rgb 返回的RGB颜色值 
	*/
	function getRgbcolor($color){
		$rgbcolor = str_replace('#', '', $color);
		if (strlen($color) > 3) {
		$rgb = array(
		'r' => hexdec(substr($rgbcolor, 0, 2)),
		'g' => hexdec(substr($rgbcolor, 2, 2)),
		'b' => hexdec(substr($rgbcolor, 4, 2))
		);
		} else {
		$rgbcolor = str_replace('#', '', $color);
		$r = substr($rgbcolor, 0, 1) . substr($rgbcolor, 0, 1);
		$g = substr($rgbcolor, 1, 1) . substr($rgbcolor, 1, 1);
		$b = substr($rgbcolor, 2, 1) . substr($rgbcolor, 2, 1);

		$rgb = array(
		'r' => hexdec($r),
		'g' => hexdec($g),
		'b' => hexdec($b)
		);
		}
		return $rgb;
	}
	/*
	 * function printWater($waterType) 打水印
	 * @parame $waterType 水印类型 1--图片水印 2--文字水印
	*/
	function printWater($waterType){
		if($waterType=='1'){
			$backimage = $this->orgImg;   
			$waterimage =$this->waterimgsrc; 
			
			$org_info = getimagesize($backimage);
			$water_info = getimagesize($waterimage);  
			
			$org_w = $org_info[0];
			$org_h = $org_info[1];
			$water_w = $water_info[0];  
			$water_h = $water_info[1];  
			  
			$water_image = imagecreatefromjpeg($waterimage);  
			$back_image = imagecreatefromjpeg($backimage);  
			
			//获得水印位置
			$position  = $this->getWaterPosition();
			if($position == '1'){
				$src_x = 0;
				$src_y = 0;
			}
			if($position == '2'){
				$src_x = 0;
				$src_y = $org_h - $water_h;
			}
			if($position == '3'){
				$src_x = $org_w - $water_w;
				$src_y = 0;
			}
			if($position == '4'){
				$src_x = $org_w - $water_w;
				$src_y = $org_h - $water_h;
			}
			imagecopy($back_image,$water_image,$src_x,$src_y,0,0,$water_w,$water_h);  
			unlink($backimage);  
			imagejpeg($back_image,$backimage);  
			imagedestroy($back_image);   
		}else{ //文字水印
			//Header ('Content-type: image/jpg');  
			$org_img = $this->orgImg;

			$arr = getimagesize($org_img);
			$org_w = $arr[0];
			$org_h = $arr[1];
			$im = imagecreatefromjpeg($org_img); 
			$font_size = $this->getWaterFonts();
			$font_color = $this->getWaterFontc();
			$arr_color = $this->getRgbcolor($font_color);
			$r = $arr_color['r'];
			$g = $arr_color['g'];
			$b = $arr_color['b'];
			$fontname = '../themes/font/simsun.ttc'; 
			//$fontname = "simhei.ttf";
			$black = imagecolorallocate($im, $r, $g, $b);
			
			$word = $this->getMarktext();
			$position = $this->getWaterPosition();
			
			$box = imagettfbbox ($font_size,0,$fontname , $word ); 
			$logow = max($box[2], $box[4]) - min($box[0], $box[6]); //文本宽度
			$logoh = max($box[1], $box[3]) - min($box[5], $box[7]); //文本高度
			if($position == '1'){
				$src_x = 0;
				$src_y = $font_size;
			}
			if($position == '2'){
				$src_x = 0;
				$src_y = $org_h-($font_size/2);
			}
			if($position == '3'){
				$src_x = $org_w - $logow;
				$src_y = $font_size;
			}
			if($position == '4'){
				$src_x = $org_w - $logow;
				$src_y = $org_h - $logoh;
			}
			$path = $this->getPath();
			imagettftext($im, $font_size,0, $src_x, $src_y, $black, $fontname, $word);  
			imagejpeg($im,$path,100); 
			imagedestroy($im);  
		}
	}
}
?>