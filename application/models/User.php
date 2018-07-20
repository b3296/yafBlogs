<?php
namespace Model;

/**
 * 
 */
 class  User extends \App\Model
{
	protected $table = "users";
	public function checkUser($email,$name){
		if($this -> has(['email' =>$email])){
			return fn_ajax_return(1, '邮箱已注册！');
		}else if($this -> has(['name' => $name])){
			return fn_ajax_return(1, '名字已注册！');
		}else{
			return false;
		}
	}
	public function _insert($datas){
		if(!is_array($datas)){
			$datas = array($datas);
		}
		return $this -> insert($datas);
	}
	//获取用户信息
    public function admin_info($where){
    	$columns = array('id','name','passwd','admin','image');
    	return $this->get($columns,$where);
    }	
}

?>