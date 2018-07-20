<?php

/**
 * Description of Base
 *
 * @author Sgenmi
 * @date 2016-10-11
 * @email  150560159@qq.com
 */

namespace App;
class Admin extends \App\Base {

    private $m = null;
    private $c = null;
    private $a = null;
    
    
    protected $ico=array(
        'folder'=>'mif-folder',
        'img'=>'mif-image',
        'swf'=>'mif-file-play',
        'txt'=>'mif-file-text',
        'js'=>'mif-js',
        'css'=>'mif-css',
        'htm'=>'mif-htm',
        'html'=>'mif-html',
        'php'=>'mif-php'
    );

    public function init() {
        parent::init();
        $this->getFirstNav();
        $this->checkLogin();
    }

    private function checkLogin() {
        
//         if (!\Yaf\Session:: getInstance()->get('USER_ID')) {
//             $this->redirect('/loginqi/login');
//             exit;
// //             throw new \Yaf\Exception("未登录");
//         }
    }
   

    /**
     * 获取第一条导航
     */
    protected function getFirstNav() {
        $this->m = strtoupper($this->_request->getModuleName());
        $this->c = strtoupper($this->_request->getControllerName());
        $this->a = strtoupper($this->_request->getActionName());
    }







   

}
