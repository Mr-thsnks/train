<?php

function chkValue($variable, $filter = []){
    foreach ($variable as $key => $value) {
        if(is_array($filter) && !empty($filter)){
            foreach ($filter as $val) {
                if($value != '' && $key != $val){
                    return true;
                }
            }
        }else{
            if($value != '' && $key != $val){
                return true;
            }
        }
    }
    return false;
}

function getAuth(){
    $authGroup = M('auth_group');
    $results = $authGroup->where('id > 1')->field('id, title')->select();
    return $results;
}

function passwd(string $str){
    return md5(encrypt($str));
}

function encrypt($string, $expire = 0)
{
    $Crypt = new \Think\Crypt();
    $string = $Crypt->encrypt($string, C("DATA_CRYPT_KEY"), $expire);
    return $string;
}

function decrypt($string, $expire = 0)
{
    $Crypt = new \Think\Crypt();
    $string = $Crypt->decrypt($string, C("DATA_CRYPT_KEY"), $expire);
    return $string;
}

function int2string(&$data, $map = array('status' => array(1 => '正常', -1 => '删除', 0 => '禁用', 2 => '未审核', 3 => '草稿')))
{
    if ($data === false || $data === null) {
        return $data;
    }
    $data = (array) $data;
    foreach ($data as $key => $row) {
        foreach ($map as $col => $pair) {
            if (isset($row[$col]) && isset($pair[$row[$col]])) {
                $data[$key][$col . '_text'] = $pair[$row[$col]];
            }
        }
    }
    return $data;
}

function _print($data)
{
    echo '<pre>' . print_r($data, true) . '</pre>';
}

function chkStatus($status, string $success, string $error, string $successUrl, $errorUrl)
{

    if ($status === false) {
        isset($errorUrl) && !empty($errorUrl) ? alert($error, $errorUrl) : alert($error);
        
        return false;
    }else{
        isset($successUrl) && !empty($successUrl) ? alert($success, $successUrl) : alert($success);
        return false; 
    }
}

function alert($Str, $Typ = "back", $TopWindow = "", $Tim = 100)
{
    echo "<script>" . chr(10);
    if (!empty($Str)) {
        echo "alert(\"{$Str}\");" . chr(10);
    }
    echo "function _r_r_(){";
    $WinName = (!empty($TopWindow)) ? "top" : "self";
    switch (StrToLower($Typ)) {
        case "#":
            break;
        case "back":
            echo $WinName . ".history.go(-1);" . chr(10);
            break;
        case "reload":
            echo $WinName . ".window.location.reload();" . chr(10);
            break;
        case "close":
            echo "window.opener=null;window.close();" . chr(10);
            break;
        case "function":
            echo "var _T=new function('return {$TopWindow}')();_T();" . chr(10);
            break;
        //Die();
        default:
            if ($Typ != "") {
                echo "window.{$WinName}.location=('{$Typ}');";
            }
    }
    echo "}" . chr(10);
    echo "if(setTimeout(\"_r_r_()\"," . $Tim . ")==2){_r_r_();}";
    if ($Tim == 100) {
        echo "_r_r_();" . chr(10);
    } else {
        echo "setTimeout(\"_r_r_()\"," . $Tim . ");" . chr(10);
    }
    echo "</script>" . chr(10);
    exit();
}
