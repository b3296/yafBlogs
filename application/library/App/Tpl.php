<?php

namespace App;

/**
 * Description of Tpl
 *
 * @author Sgenmi
 * @date 2017-7-11
 * @Email 150560159@qq.com
 */
class Tpl {

    static $tpl_select = array(
        'pc' => array(
            'text' => "PC端",
            'tpl_select' => array(
                1000 => array(
                    'text' => '常规单子',
                    'form' => 'changgui',
                    'tpl' => 'changgui'
                ),
                1001 => array(
                    'text' => '两张素材轮播单子',
                    'form' => 'lunbo',
                    'tpl' => 'lunbo'
                ),
                1002 => array(
                    'text' => '趣游游戏单子',
                    'form' => 'quyouyouxi',
                    'tpl' => 'quyouyouxi'
                ),
            )
        ),
        'mob' => array(
            'text' => "移动端",
            'tpl_select' => array(
                1100 => array(
                    'text' => '常规单子',
                    'form' => 'changgui',
                    'tpl' => 'changgui'
                ),
                1101 => array(
                    'text' => '两张素材轮播单子',
                    'form' => 'lunbo',
                    'tpl' => 'lunbo'
                ),
                1102 => array(
                    'text' => '辅助效果单子',
                    'form' => 'fuzhuxiaoguo',
                    'tpl' => 'fuzhuxiaoguo'
                ),
            )
        ),
    );
    
    static   $disable_functions = array(
        'phpinfo', 'file_get_contents', 'file_put_contents', 'fopen', 'fread', 'fwrite', 'fclose', 'chmod',
        'delete', 'unlink', 'feof', 'fflush', 'fgetc', 'fgetcsv', 'fgets', 'fgetss', 'file', 'fsockopen', 'filegroup', 'fileowner',
        'fputcsv', 'fputs', 'fstat', 'readfile', 'rename', 'rmdir', 'symlink', 'tmpfile', 'touch','eval'
    );

    
    static function getTplSelectName($key = 0) {
        $ret = array();
        $pl = "";
        if (isset(self::$tpl_select['pc']['tpl_select'][$key])) {
            $pl = "pc";
        } elseif (isset(self::$tpl_select['mob']['tpl_select'][$key])) {
            $pl = "mob";
        }
        if ($pl) {
            $ret = array(
                'pl' => $pl,
                'pl_' => self::$tpl_select[$pl]['text'],
                'select' => self::$tpl_select[$pl]['tpl_select'][$key],
            );
        }
        return $ret;
    }
    
    static function getAllKey(){
        $pc_key = array_keys( self::$tpl_select['pc']['tpl_select']);
        $mob_key = array_keys( self::$tpl_select['mob']['tpl_select']);
        return array_merge($pc_key, $mob_key) ;
    }
    
    
    

}
