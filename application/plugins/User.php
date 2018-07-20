 <?php
 class UserPlugin extends Yaf\Plugin_Abstract 
 {

	public function routerStartup(yaf\Request_Abstract $request, yaf\Response_Abstract $response) 
	{
	// 	$route = new yaf\Route_Supervar("r");
	// $router = yaf\Dispatcher::getInstance()->getRouter();
	// $router->addRoute('myRoute', $route);
	}

	public function routerShutdown(yaf\Request_Abstract $request, yaf\Response_Abstract $response) 
	{
        //echo "生效的路由协议是:" . yaf\Dispatcher::getInstance()->getRouter()->getCurrentRoute();
    }
 }