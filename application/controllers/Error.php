<?php
	class ErrorController extends Yaf\Controller_Abstract
	{
		public function ErrorAction($exception)
		{
			print_r($exception);
			Yaf\Dispatcher::getInstance()->disableview();
		}
	}















?>