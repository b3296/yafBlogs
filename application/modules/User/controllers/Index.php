<?php
class Controller_Index extends Yaf\Controller_Abstract{
        public function indexAction(){
             $this->getView()->assign("content","I am User");
        }
        public function loginAction(){
        	$this->getView();
        }
        public function loginDoitAction(){
            Yaf\Dispatcher::getInstance()->disableView();
        	$name = $this->getRequest()->getPost('name');
        	$password = $this->getRequest()->getPost('password');
        	if($name==1 && $password==1){
                $this->redirect('/Index/Index/index');
        	}else{
        		$this->redirect('/User/Index/login');
        	}
        }
}
?>