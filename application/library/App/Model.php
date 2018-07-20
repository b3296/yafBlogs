<?php

namespace App;

/**
 * Description of Model
 *
 * @author Sgenmi
 * @date 2016-10-20
 * @Email 150560159@qq.com
 * 主要用来给用户自己写这用方法
 */
class Model extends \Core\Db\Medoo {
    protected $check_field;

    //统一判断用户提交数据,省去重复判断
    public function check_data($d) {
        $ret = TRUE;

        foreach ($d as $k => $v) {
            if (isset($this->check_field[$k])) {
                foreach ($this->check_field[$k] as $_k => $fv) {
                    switch ($_k) {
                        case 'required':            //必填
                            if ($fv) {
                                if ($v!=0 && empty($v) && !isset($this->check_field[$k]['in'])) {              //注意有0情况
                                    $ret = FALSE;
                                }
                            }
                            break;
                        case 'length':
                            $len = mb_strlen($v, 'utf-8');
                            if (is_array($fv)) {
                                if ($len < $fv[0] || $len > $fv[1]) {
                                    $ret = FALSE;
                                }
                            } else {
                                if ($len != $fv) {
                                    $ret = FALSE;
                                }
                            }
                            break;
                        case 'pattern':
                            if (!preg_match($fv, $v)) {
                                $ret = FALSE;
                            }
                            break;
                        case 'in':
                            if (!in_array($v, $fv)) {
                                $ret = FALSE;
                            }
                            break;
                      case 'integer':
                          if($fv)
                          {
                               if(!is_numeric($v) || strpos($v,".")!==false)
                              {
                                   $ret = FALSE;
                              }
                          }
                    }
                    if($ret==FALSE)
                    {
                        return $ret ;
                    }
                }
            }
        }
        return $ret;
    }
    
    //记录日志,可以异步
    function put_log($content )
    {
        $datas=array(
            'user_id'=>9999,
            'text'=>$content,
            'create_time'=>  time()
        );
        $this->insert($datas, 'wan_admin_log');
    }
    
    

}
