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

$ipList = $_jsonPara['ipList'];
___logArray($logHandle,$ipList);

$dbTable = 't_ip';
$custNo = 0;
foreach($ipList as $ipData) {
    if ($custNo == 0) {
        $custProviderKey = sprintf('%s.%s',$ipData['s0@@provider'],$ipData['n0@@providerCustNo']);
        $mbr = db_getDbData(S_DB,'t_mbrdata','*','providerKey="'.$custProviderKey.'"');
        $mbrUId = $mbr['uid'];
    }
    $iField = 'regMbr,providerKey';
    $iValue = sprintf('%s,"%s.%s.%d"',$mbrUId,$custProviderKey,$ipData['s0@@ipGroup'],$ipData['n0@@providerIpNo']);
    foreach($ipData as $fN => $value) {
        if ($iField) { $iField .= ',';  $iValue .= ','; }
        list($fType,$fName) = explode(MY_ENCODE_SEPERATOR,$fN);

        $iField .= $fName;	    $iValue .= ($fType == 'n0') ? sprintf(' "%s"',$value) : sprintf(' "%s"',$value);
    }

    $sql = db_insertIgnoreDbData(S_DB,$dbTable,$iField,$iValue);
    ___log($logHandle,$sql['r'].' : '.$sql['q']);
}

$msg = "IP 자산관리 데이타로 등록되었습니다.";
$ret = json_encode(array('result'=>'OK', 'msg'=>$msg));
___log($logHandle,$ret);

echo $ret;