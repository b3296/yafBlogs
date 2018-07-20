<?php

namespace Model;
/**
 * Description of LoginLog
 *
 * @author feng
 * @date 2017-6-1
 * @Email 150560159@qq.com
 */
class LoginLog extends \App\Model {
    
    protected $table = "login_log";

    //日志生成
    public function create_log($data){
    	return $this->insert($data);
    }

    //日志展示
    public function log_list($page,$limit){
    	$offset = ($page-1)*$limit;
        $columns = array('id','userId','loginTime','loginIp');
    	$where = array('LIMIT'=>[$offset,$limit],'ORDER'=>['id'=>'DESC']);
        $loginfo = $this->select($columns,$where);
        foreach ($loginfo as &$v) {
            $v['loginTime'] = date('Y-m-d H:i:s',$v['loginTime']);
        }
        return $loginfo;
    }

    //日志统计
    public function log_count(){
    	return $this->count();
    }

    /**
     * 日志删除
     */
    public function log_del($id){
        $where = array('id'=>$id);
        return $this->delete($where);
    }
}   
