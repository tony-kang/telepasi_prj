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
$bizPin = $cust['biz_pin'];
$pw = md5("0000");

$qWhere = ' provider="'.$provider.'" and providerCustNo = '.$providerCustNo.'  ';
$sql = sql_getDbData(DB_WIPP,'po_cust','count(*) as cnt',$qWhere);

if ($sql['cnt'] == 0) {
    $dbFields = ' provider, providerCustNo ,a_name , a_email , a_pin , a_tel, reg_date , pw ';
    $dbValues = " '{$provider}' , {$providerCustNo},'{$nameKr}','{$email}' ,'{$bizPin}','{$tel}' ,'{$today}'  ,'{$pw}' ";
    $sql = sql_insertDbData(DB_WIPP,'po_cust',$dbFields,$dbValues);

    $msg = "IP 자산관리 신규고객으로 등록되었습니다.";
} else {
    $msg = "이미 등록된 고객입니다.";
}

//echo $msg;
//___print($sql);

echo json_encode(array('result'=>'OK', 'msg'=>$msg));