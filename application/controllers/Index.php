<?php
class Controller_Index extends Yaf\Controller_Abstract
{
    public function indexAction()
    {
        $this->getView()->assign("content","Hello, world!");
    }
    public function init()
    {
        $this->getView()->content='__set';
        // print_r($this->getRequest()->getPost());
        // $this ->getResponse() -> prependBody('hello world');
        // echo '<hr>';
        // $this -> getResponse() -> clearBody();
        // echo '<hr>';
        // echo $this-> getResponse() -> getBody();
        // $this -> getResponse() -> response();

    	if(!Yaf\Session::getInstance()->get('user')){
    		//$this->redirect('index');
    	}

    }
    public function loginAction()
    {
    	$this->getView();
    }
    public function loginDoitAction()
    {
        yaf\Dispatcher::getInstance()->disableView();
    	$name = $this->getRequest()->getPost('name');
    	$password = $this->getRequest()->getPost('password');
    	if($name==1 && $password==1){
            $this->redirect('index.php?r=Index/Index/index');
    	}else{
    		$this->redirect('index.php?r=index/Index/login');
    	}
    }
    public function testAction()
    {

        $dispatcher = Yaf\Dispatcher::getInstance();
        // $config = Yaf\Registry::get('_config');
        // print_r(Yaf\Registry::get('_config'));
        // Yaf\Registry::del("_config");
        // print_r(Yaf\Registry::get('_config'));
        //$this->setViewPath('/usr/local/www/tpl');
        //print_r($this->getViewPath());
        print_r($dispatcher->getRouter()->getRoute('_default'));
        $dispatcher->disableView();
        $this->display('index');
    }
}
?>