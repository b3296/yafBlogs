<?php
class Bootstrap extends Yaf\Bootstrap_Abstract
{
	private $_config;
	public function _initConfig()
	{
		$this->_config = Yaf\Application::app()->getConfig();
		Yaf\Registry::set('_config',$this->_config);
	}
	public function _initPlugin(Yaf\Dispatcher $dispatcher)
	{
		// $user=new UserPlugin();
		// $dispatcher->registerPlugin($user);
	}
	public function _initDefaultName(Yaf\Dispatcher $dispatcher) 
	{
        /**
         * 这个只是举例, 本身Yaf默认的就是"Index"
         */
        //$dispatcher->setDefaultAction("login");
    }
	public function _initCommon()
    {
        Yaf\Loader::import("Function/Fn_arr.php");
    }    
    public function _initRoute(Yaf\Dispatcher $dispatcher) 
    {
        $router = Yaf\Dispatcher::getInstance()->getRouter();
        /**
         * 添加配置中的路由
         */
        //$router->addConfig(Yaf_Registry::get("config")->routes);
    }
    public function _initLayout(Yaf\Dispatcher $dispatcher)
    {
    	$layout = new \Core\View\Layout($this->_config->application->layout->directory);
    	$dispatcher -> setView($layout);

    }    
	public function _initPjax()
    {
        if(isset($_SERVER['HTTP_X_PJAX'])  && $_SERVER['HTTP_X_PJAX']  )
        {
            define("IS_PJAX", TRUE);
            define('IS_AJAX', FALSE);
        }  else {
            define("IS_PJAX", FALSE);
            $request = new Yaf\Request\Http();
            if($request->isXmlHttpRequest ()){
                define('IS_AJAX', TRUE);
            }  else {
                 define('IS_AJAX', FALSE);
            }
        }
    }    
}