<?php
error_reporting(E_ALL & ~E_DEPRECATED & ~E_WARNING);
/*
Array
(
    [cmd] => add.new.cust
    [cust] => Array
        (
            [api_id] => limeip
            [cust_no] => 3039
            [name_kr] => (주)쎌트로이
            [email] =>
            [biz_pin] =>
            [tel] =>
        )

)
 */

$cust = $_jsonPara['cust'];

$provider = $cust['api_id'];
$providerCustNo = $cust['cust_no'];
$today 	= date('YmdHis');
$nameKr = $cust['name_kr'];
$email = $cust['email'];
$tel = $cust['tel'];
$id = $cust['id'];   //사업자 번호
$pw = md5("0000");

$providerKey = sprintf('%s.%s',$provider,$providerCustNo);

$qWhere = ' provider="'.$provider.'" and providerKey="'.$providerKey.'" ';
$sql = db_getDbData(S_DB,'t_mbrdata','count(*) as cnt',$qWhere);

if ($sql['cnt'] == 0) {
    $dbFields = ' provider, providerKey, id, name , email , tel, regDate , pw ';
    $dbValues = " '{$provider}' , '{$providerKey}','{$id}','{$nameKr}','{$email}' ,'{$tel}' ,'{$today}'  ,'{$pw}' ";
    $sql = db_insertDbData(S_DB,'t_mbrdata',$dbFields,$dbValues);
    ___log($logHandle,$sql['q']);
    $msg = "IP 자산관리 신규고객으로 등록되었습니다.";
} else {
    $msg = "이미 등록된 고객입니다.";
}

___log($logHandle,$msg);

$ret = json_encode(array('result'=>'OK', 'msg'=>$msg));
___log($logHandle,$ret);

echo $ret;