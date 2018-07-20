<?php
namespace Model;
/**
* 
*/
class  Blogs extends \App\Model
{
	protected $table = "blogs";
	public function _insert($datas){
		if(!is_array($datas)){
			$datas = array($datas);
		}
		return $this -> insert($datas);
	}
	// 获取文章内容
	public function log_content($where){
		$columns = array('id','name','summary','content','created_at','user_id');
    	return $this->get($columns,$where);
	}
	//日志展示
    public function log_list($page,$limit){
    	$offset = ($page-1)*$limit;
    	$columns = array('id','name','summary','created_at');
    	$where = array('LIMIT'=>[$offset,$limit],'ORDER'=>['id'=>'DESC']);
    	$loginfo = $this->select($columns,$where);
    	foreach ($loginfo as &$v) {
    		//$v['type_t'] = isset($this->arr[$v['type']] ) ?  $this->arr[$v['type']] : '未知';
    		$v['created_at'] = date('Y-m-d H:i:s',$v['created_at']);
    	}
    	return $loginfo;
    }

    //日志统计
    public function log_count(){
    	return $this->count();
    }

    //日志详情
    public function log_detail($id){
    	$where = array('id'=>$id);
    	$columns = array('id','fileName','oldContent','newContent');
        return $this->get($columns,$where);

    }		
}


?>