<?php

/**
 * Description of Web
 *
 * @author Sgenmi
 * @date 2014-02-18
 */

namespace App;
class Web extends \Yaf\Controller_Abstract {

    protected $request_http;
    protected $layout = 'main';
    protected $_config;
    protected $_session;
    protected $view_path;
    protected $_request;

    public function init() {
        date_default_timezone_set('PRC');
        $this->_config = \Yaf\Registry::get("_config");
//        $this->_request = new \Yaf\Request\Http();
        $this->_request = $this->getRequest();
//        $this->_session = new Component_Session();

        \Yaf\Dispatcher::getInstance()->disableView();
//        $this->_m = $this->getRequest()->getModuleName();
//        $this->_c = $this->getRequest()->getControllerName();
//        $this->_a = $this->getRequest()->getActionName();
        $this->pajx();
    }

    private function pajx() {
        if (IS_PJAX || IS_AJAX) {
            $this->layout = NULL;
        }
        $this->getView()->setLayout($this->layout);
    }

    //渲染视图
    // protected function display($view_path = NULL, array $tpl_vars = array()) {
    //     $this->set_view_path($view_path);
    //     self::getView()->display($this->view_path, $tpl_vars);
    //     return;
    // }

    //返回视图->实际是在视图中，加载另一个视图用
    // protected function render($view_path = NULL, array $tpl_vars = array()) {
    //     if (!$this->set_view_path($view_path)) {
    //         return;
    //     }

    //     echo $this->getView()->render($this->view_path, $tpl_vars);
    // }

//    给视图中变量赋值
    // protected function assign($name = NULL, $value = NULL) {
    //     if (!$name) {
    //         return;
    //     }

    //     if (is_string($name)) {
    //         if (!$value) {
    //             return;
    //         }
    //         return $this->getView()->assign($name, $value);
    //     } else {
    //         return $this->getView()->assign($name);
    //     }
    // }

    // private function set_view_path($view_path) {
    //     $fileInfo = pathinfo($view_path);
    //     if (!isset($fileInfo['extension'])) {
    //         $view_path .= "." . $this->_config->application->view->ext;
    //     }
    //     $this->view_path = $view_path;
    // }

    protected function getPost($key = NULL) {

        if ($key) {
            $ret = fn_fliter($this->_request->getPost($key, ""));
        } else {
             $ret = array();
            $_postData = $this->_request->getPost();
            foreach ($_postData as $k => $v) {
                $ret[$k] = fn_fliter($v);
            }
        }
        return $ret;
    }

    // protected function get($key = NULL) {
    //     if ($key) {
    //         $ret = fn_fliter($this->_request->getQuery($key, ""));
    //     } else {
    //         $ret = array();
    //         $_getData = $this->_request->getQuery();
    //         foreach ($_getData as $k => $v) {
    //             $ret[$k] = fn_fliter($v);
    //         }
    //     }
    //     return $ret;
    // }

}
