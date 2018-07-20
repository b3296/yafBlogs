<?php


/**
 * Ajax 返回JSON
 * @param  integer $return 1：失败， 0：成功
 * @param  string $message 提示信息
 * @param  array $data 返回的数据
 * @return JSON
 * */
function fn_ajax_return( $return = 0, $message = NULL, $data = NULL )
{
    $r_data['code'] = $return;
    if ($message)
    {
        $r_data['msg'] = $message;
    }
    if ($data)
    {
        $r_data['data'] = $data;
    }
  echo  json_encode( $r_data ); exit;
}

//获取IP
function fn_getIP()
{
    if (getenv("HTTP_CLIENT_IP")) {
        $ip = getenv("HTTP_CLIENT_IP");
    } else if (getenv("HTTP_X_FORWARDED_FOR")) {
        $ip = getenv("HTTP_X_FORWARDED_FOR");
    } else if (getenv("REMOTE_ADDR")) {
        $ip = getenv("REMOTE_ADDR");
    } else {
        $ip = "Unknow";
    }
    return $ip;
}
//生成验证码
function getCode( $w, $h )
{
    $im = imagecreate( $w, $h );

    //imagecolorallocate($im, 14, 114, 180); // background color
    $red = imagecolorallocate( $im, 255, 0, 0 );
    $white = imagecolorallocate( $im, 255, 255, 255 );

    $num1 = rand( 1, 20 );
    $num2 = rand( 1, 20 );

    $_SESSION['sspcode'] = $num1 + $num2;

    $gray = imagecolorallocate( $im, 118, 151, 199 );
    $black = imagecolorallocate( $im, mt_rand( 0, 100 ), mt_rand( 0, 100 ), mt_rand( 0, 100 ) );

    //画背景
    imagefilledrectangle( $im, 10, 10, 110, 30, $black );
    //在画布上随机生成大量点，起干扰作用;
    for ($i = 0; $i < 80; $i++)
    {
        imagesetpixel( $im, rand( 0, $w ), rand( 0, $h ), $gray );
    }

    imagestring( $im, 10, 20, 12, $num1, $red );
    imagestring( $im, 10, 45, 12, "+", $red );
    imagestring( $im, 10, 60, 12, $num2, $red );
    imagestring( $im, 10, 80, 12, "=", $red );
    imagestring( $im, 10, 95, 12, "?", $white );

    header( "Content-type: image/png" );
    imagepng( $im );
    imagedestroy( $im );
}


function fn_createLog($type,$fileName,$newContent,$oldContent=""){
    $model = new Model\Log();
    $insert_data = array(
        'userId'=> \Yaf\Session:: getInstance()->get('USER_ID'),
        'userTrueName'=> \Yaf\Session:: getInstance()->get('USER_TRUENAME'),
        'type'=>$type,
        'fileName'=>$fileName,
        'oldContent'=>$oldContent,
        'newContent'=>$newContent,
        'createTime'=> time()
    );
    $model->insert($insert_data);
}

function fn_isAdmin(){
    $is_admin = \Yaf\Session:: getInstance()->get('IS_ADMIN');
    if($is_admin==1){
        return TRUE;
    }
    return FALSE;
    
}
//过滤器
function fn_fliter( $v ){
    return trim(addslashes($v));
}



