<?php
function _makeDongHoData($sO) {
    $logHandle = ___logStart($sO['apiFile']);
    ___logArray($logHandle,$sO);
    //------------------------------------------------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------------------------------------------
    $dong = $sO['dong'];
    $dongNo = ___getDecodeValue($dong);

    $cDong = db_getDbData(S_DB,'rm_dong','*','no='.$dongNo);
    ___log($logHandle,$cDong['q']);
    $loginUid = ___getSession('mbrUid');
    $now = date('YmdHis');
    $mkCnt = 0;
    for ($floor=1; $floor<=$cDong['maxFloor']; $floor++) {
        for ($i=1; $i<=$cDong['hoCnt']; $i++) {

            $hN = $cDong['hoFormat'];
            $hN = str_replace('[FLOOR]','$floor',$hN);
            $hN = str_replace('[HO]','$i',$hN);
            $hN = '$hoName = '.$hN.';';
            eval($hN);

            $iField = 'dongNo';         $iValue = sprintf('%d',$dongNo);
            $iField .= ',complex';      $iValue .= sprintf(',"%s"',$cDong['complex']);
            $iField .= ',floor';        $iValue .= sprintf(', %d',$floor);
            $iField .= ',dong';         $iValue .= sprintf(',"%s"',$cDong['dong']);
            $iField .= ',ho';           $iValue .= sprintf(',"%s"',$hoName);
            $iField .= ',regMbr';       $iValue .= sprintf(', %d',$loginUid);
            $iField .= ',regDate';      $iValue .= sprintf(',"%s"',$now);
            $sql = db_insertDbData(S_DB,'rm_ho',$iField,$iValue);
            ___log($logHandle,$sql['q']);
            if ($sql['r']) $mkCnt++;
        }
    }

    $retPara = '';
    $html = '';
    $ret = sprintf("%s@@%s@@%s@@%s","OK",'생성 되었습니다.['.$mkCnt.' 개]',$retPara,$html);

    //------------------------------------------------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------------------------------------------
    ___log($logHandle,$ret);
    ___logEnd($logHandle);
    echo $ret;
}
?>
<?php
	//------------------------------------------------------------------------------------------------------------------------
	//------------------------------------------------------------------------------------------------------------------------
	switch($sO['cmd'])
	{
	case "make.dong.ho.data":
		$ret = _makeDongHoData($sO);
		break;
	}
	//------------------------------------------------------------------------------------------------------------------------
	//------------------------------------------------------------------------------------------------------------------------
?>