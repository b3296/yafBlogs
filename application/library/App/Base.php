<?php

namespace App;

class Base extends Web {

    protected $disable_functions = array();
    
    public function init() {
        parent::init();
        $this->disable_functions = \App\Tpl::$disable_functions;
    }
    
    

}
