<?php

/**
 * Description of Index
 *
 * @author feng
 * @date 2016-10-11
 * @email 150560159@qq.com
 */
class Controller_Loginlog extends App\Admin {

    private $logModel;

    public function init(){
        parent::init();
        if (!fn_isAdmin() ) {
            $this->redirect('/blogs/list');
        }
        $this->logModel = new \Model\LoginLog();
    }

    public function listAction()
    {
    	if(IS_AJAX){
    		$get = $this->_request->getQuery('page');
            $page = isset($get) ? $get : 1;
			$pagetotal = $this->logModel->log_count();
			$loginfo = $this->logModel->log_list($page,15);
			$pageClass = new \Component\Pagination($page,$pagetotal,15);
			$pagelist = $pageClass->display();
			$data['log'] = $loginfo;
			$data['page'] = $pagelist; 
			fn_ajax_return(0,'',$data);
    	}
    	$this->display('list');
    }

   /**
    * 日志删除
    */
    public function delAction(){

        $id = $this->_request->getQuery('id');
        $z = $this->logModel->log_del($id);
        if ($z) fn_ajax_return(0,'删除成功');
        fn_ajax_return(1,'删除失败');
   }
 		
    
}