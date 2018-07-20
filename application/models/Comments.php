<?php
namespace Model;
class Comments extends \App\Model
{
	protected $table = "comments";
	public function _insert($datas){
		if(!is_array($datas)){
			$datas = array($datas);
		}
		return $this -> insert($datas);
	}
	public function comments_list($where){
    	$columns = array('user_id','user_name','content','created_at');
    	$commntesinfo = $this->select($columns,$where);
    	return $commntesinfo;
    }		
}


?>