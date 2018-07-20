<?php
	class Controller_Blogs extends App\Web
	{
		private  $blogsModel;
		private  $commentsModel;
	    public function init(){
	        parent::init();
	        $this->blogsModel = new \Model\Blogs();
	        $this->commentsModel = new \Model\Comments();
	    }		
		public function listAction()
		{
			if(IS_AJAX){
	            $get = $this->_request->getQuery('page');
	    		$page = isset($get) ? $get : 1;
				$pagetotal = $this->blogsModel->log_count();
				$limit = 10;
				$loginfo = $this->blogsModel->log_list($page,$limit);
				$pageClass = new \Component\Pagination($page,$pagetotal,$limit);
				$pagelist = $pageClass->display();
				$data['log'] = $loginfo;
				$data['page'] = $pagelist; 
				fn_ajax_return(0,'',$data);
	    	}			
			$this -> display('list');
		}
		public function contentAction()
		{
			$blog_id = $this->_request->getParam('id');
			if(empty($blog_id)){
				$this->redirect('/blogs/list');
			}
			\Yaf\Session::getInstance()->set('blog_id',$blog_id);
			$where = ['id'=>$blog_id];
			$blog = $this->blogsModel->log_content($where);
			$where = array('blog_id'=>$blog_id,'ORDER'=>['id'=>'DESC']);
			$commentsinfo = $this->commentsModel->comments_list($where);
			$commentsinfo = empty($commentsinfo)?[]:$commentsinfo;
			$this -> display('content',['blog'=>$blog,'comments'=>$commentsinfo]);
		}
		public function comment_addAction()
		{
			$content = $this->_request->getPost()['content'];
			if(empty($content)){
				fn_ajax_return(1, '请填写评论内容！');
			}
			$user_name = \Yaf\Session:: getInstance()->get('USER_NAME');
			$user_id = \Yaf\Session:: getInstance()->get('USER_ID');
			$user_image = \Yaf\Session:: getInstance()->get('USER_IMAGE');
			$blog_id = \Yaf\Session::getInstance()->get('blog_id');	
			$data = ['blog_id'=>$blog_id,'user_id'=>$user_id,'user_name'=>$user_name,'user_image'=>$user_image,'content'=>$content,'created_at'=>time()];
			if($this->commentsModel->_insert($data)==0){
				fn_ajax_return(3,'评论失败');
			}else{
				fn_ajax_return(2,'评论成功',$blog_id);
			}			

		}
		public function createBlogAction()
		{
			if (!fn_isAdmin()) {
	            $this->redirect('list');
	        }
	        if (IS_AJAX && ( $post_d = $this->getPost())) {
	        	$name = $post_d['name'];
	        	$summary = $post_d['summary'];
	        	$content = $post_d['content'];
				if(empty($name) ){
					fn_ajax_return(1, '标题不能为空！');
				}
				if(empty($summary) ){
					fn_ajax_return(1, '摘要不能为空！');
				}			
				if(empty($content) ){
					fn_ajax_return(1, '内容不能为空！');
				}
				$user_name = \Yaf\Session:: getInstance()->get('USER_NAME');
				$user_id = \Yaf\Session:: getInstance()->get('USER_ID');
				$user_image = \Yaf\Session:: getInstance()->get('USER_IMAGE');					
				$time = time();
				$data = ['name'=>$name,'summary'=>$summary,'content'=>$content,'user_id'=>$user_id,'user_name'=>$user_name,'user_image'=>$user_image,'created_at'=>$time]; 
				if($this->blogsModel->_insert($data)==0){
					fn_ajax_return(3,'保存失败');
				}else{
					fn_ajax_return(2,'保存成功');
				}     	
	        }
	        $this -> display('createBlog');			
		}
	} 















?>