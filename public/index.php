<?php
ini_set('yaf.name_suffix', 0);
ini_set('yaf.name_separator', '_');
define("APP_PATH",  realpath(dirname(__FILE__) . '/../')); /* 指向public的上一级 */
$app  = new Yaf\Application(APP_PATH . "/conf/application.ini");

// Yaf\Loader::getInstance()->registerLocalNamespace('Foo');
// print_r(Yaf\Loader::getInstance()->getLocalNamespace());
// Yaf\Loader::getInstance()->clearLocalNamespace();
// print_r(Yaf\Loader::getInstance()->getLocalNamespace());
$app->bootstrap()->run();