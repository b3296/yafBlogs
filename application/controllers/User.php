<?php
class Controller_User extends App\Web
{
	private $userModel;
	public function init()
	{
		parent::init();
		$this->userModel = new \Model\User();
	}
	public function loginAction()
	{
		$this->layout="";
        $this->getView()->setLayout("");		
		$this -> display('login');
	}
	public function loginDoitAction()
	{
		if (IS_AJAX && ( $post_d = $this->getPost())) {
			$email = isset($post_d['email'])?$post_d['email']:'';
			$passwd = isset($post_d['passwd'])?$post_d['passwd']:'';
			if(empty($email) ){
				fn_ajax_return(1, '邮箱不能为空！');
			}			
			if(empty($passwd) ){
				fn_ajax_return(1, '口令不能为空！');
			}
			$where = array('email'=>$email);
            $user = $this->userModel->admin_info($where);
            if ($user) {
                if (md5($email.':'.$passwd) == $user['passwd']) {
                    
                      \Yaf\Session:: getInstance()->set('USER_NAME', $user['name']);
                      \Yaf\Session:: getInstance()->set('USER_ID', $user['id']);
                      \Yaf\Session:: getInstance()->set('IS_ADMIN', $user['admin']);
                      \Yaf\Session:: getInstance()->set('USER_IMAGE', $user['image']);
                    $ip = fn_getIP();  
                    $data['userId'] = $user['id'];
                    //$data['userTrueName'] = $admin['trueName'];
                    $data['loginTime']    = time();
                    $data['loginIp']      = $ip;

                    //生成登录日志
                    $Model = new \Model\LoginLog();
                    $Model->create_log($data);
                    fn_ajax_return(2,'登录成功');
                }else{
                    $message = '密码不正确';
                }
            }else{
                $message = '用户名不存在';
            }
            fn_ajax_return(0,$message);
    	}			
		$this -> display('login');
	}
	public function registerAction()
	{
		$this -> display('register');
	}
	public function registerDoitAction()
	{
		if (IS_AJAX && ( $post_d = $this->getPost())) {
			$name = isset($post_d['name'])?$post_d['name']:'';
			$email = isset($post_d['email'])?$post_d['email']:'';
			$passwd = isset($post_d['passwd'])?$post_d['passwd']:'';
			if(empty($name) ){
				fn_ajax_return(1, '名字不能为空！');
			}
			if(empty($email) ){
				fn_ajax_return(1, '邮箱不能为空！');
			}			
			if(empty($passwd) ){
				fn_ajax_return(1, '口令不能为空！');
			}
			if(!preg_match('/^[a-z0-9\.\-\_]+\@[a-z0-9\-\_]+(\.[a-z0-9\-\_]+){1,4}$/',$email)){
				fn_ajax_return(1, '请输入正确的Email地址！');
			}
			if(strlen($passwd)<6){
				fn_ajax_return(1, '口令长度至少为6个字符！');
			}	
			if($ret = $this->userModel->checkUser($email,$name)){
				return $ret;
			}else{
				$time = time();
				$admin = 0;
				$image = '';
				$datas= ['name'=>$name,'email'=>$email,'passwd'=>md5($email.':'.$passwd),'admin'=>$admin,'image'=>$image,'created_at'=>$time];
				if($this->userModel->_insert($datas)==0){
					fn_ajax_return(3, '注册失败！');
				}else{
					fn_ajax_return(2,'注册成功！');
				}
			}		
		}
		$this -> display('register');
	}
	public function vcodeAction(){
        getCode(120,40);
    }
	public function logoutAction(){
         \Yaf\Session:: getInstance()->del('USER_NAME');
         \Yaf\Session:: getInstance()->del('USER_ID');
         \Yaf\Session:: getInstance()->del('USER_TRUENAME');
        session_destroy();
        $this->redirect('/user/login');
    }    	
}




?>