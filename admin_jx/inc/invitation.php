<?php
/**
	 * invitation.php   用户邀请处理模型
	 *
	 * @version          v0.01
	 * @create time   2014-1-14
	 * @author           lixin
	 * @copyright      Copyright (c) 微普科技 WiiPu Tech Inc. ( http://www.wiipu.com)
	 * @information
	 * @Update Record
 * */
class invitation{
	private $conn;


	public function __construct($conn) {
		$this->conn = $conn;
  	}

	
	/* *
		function addSysInvitationCode 为系统生成邀请码
		* @param $参数1 参数1意义
		* @param $参数2 参数2意义
		* @return int 返回插入数量
		* @info     其他说明，与普通验证码不同：status =2，系统生成，当发放后会置为0； user = null 
	*/
	public function addSysInvitationCode($num){
		$i=0;
		$str='';
		$comm='';
		for(;$i<$num;$i++){
			$_code=substr(uniqid(),7);
			$str.=$comm.$_code;
			$comm='|';
			$sql="insert into ".WIIDBPRE."_invitationcode(code_status,code_addtime,code_value) values(2,".time().",'{$_code}')";
			if (!(mysql_query($sql,$this->conn))){
				return $i;
			}
		}
		return $str;
	}
	
	/* *
		function addInvitationCode 为指定用户生成邀请码
		* @param $参数1 参数1意义
		* @param $参数2 参数2意义
		* @return int 返回插入数量
		* @info     其他说明
	*/
	public function addInvitationCode($uid,$num){
		$i=0;
		$str='';
		$comm='';
		for(;$i<$num;$i++){
			$_code=substr(uniqid(),7);
			$str.=$comm.$_code;
			$comm='|';
			$sql="insert into ".WIIDBPRE."_invitationcode(code_userid,code_status,code_addtime,code_value) values({$uid},0,".time().",'{$_code}')";
			if (!(mysql_query($sql,$this->conn))){
				return $i;
			}
		}
		return $str;
	}


}