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

            $sql = db_insertDbData(S_DB, 'rm_ho', $iField, $iValue);

            if ($floor == 1 && $i == 1) ___log($logHandle,$sql['q']);
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

function _makeDongHoShareData($sO) {
    $logHandle = ___logStart($sO['apiFile']);
    ___logArray($logHandle,$sO);
    //------------------------------------------------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------------------------------------------
    $dong = $sO['dong'];
    $dongNo = ___getDecodeValue($dong);

    $loginUid = ___getSession('mbrUid');
    $now = date('YmdHis');
    $mkCnt = 0;

    $sqlBaseHo = db_getDbRows(S_DB,'rm_ho','*','hoType='.HO_TYPE_SHARE.' and shareIdx = 0 and dongNo='.$dongNo);    // 기본 Ho 정보만 가져온다.
    ___log($logHandle,$cDong['q']);

    foreach ($sqlBaseHo['pageData'] as $baseHo) {
        $sqlShareHo = db_getDbRows(S_DB,'rm_ho','*','shareIdx > 0 and parentNo='.$baseHo['no']);    // 기본 Ho에 연결된 Shareed Ho를 가져온다.
        if ($sqlShareHo['dataCnt'] == $baseHo['shareCnt']) continue;

        for ($i=1; $i<=$baseHo['shareCnt']; $i++) {
            $checkHo = db_getDbData(S_DB,'rm_ho','count(*) as cnt','shareIdx = '.$i.' and parentNo='.$baseHo['no']);    // 기본 Ho에 연결된 Shareed Ho를 가져온다.
            if ($checkHo['cnt'] == 1) continue; // Share 호 정보 있음 --> 새로 생성하지 않음.

            $iField = 'dongNo';         $iValue = sprintf('%d',$dongNo);
            $iField .= ',complex';      $iValue .= sprintf(',"%s"',$baseHo['complex']);
            $iField .= ',floor';        $iValue .= sprintf(', %d',$baseHo['floor']);
            $iField .= ',dong';         $iValue .= sprintf(',"%s"',$baseHo['dong']);
            $iField .= ',ho';           $iValue .= sprintf(',"%s-%d"',$baseHo['ho'],$i);  // 2002-1호 , 2002-2호
            $iField .= ',hoType';       $iValue .= sprintf(', %d',HO_TYPE_SHARE);
            $iField .= ',shareCnt';     $iValue .= sprintf(', %d',0);
            $iField .= ',shareIdx';     $iValue .= sprintf(', %d',$i);
            $iField .= ',parentNo';     $iValue .= sprintf(', %d',$baseHo['no']);
            $iField .= ',regMbr';       $iValue .= sprintf(', %d',$loginUid);
            $iField .= ',regDate';      $iValue .= sprintf(',"%s"',$now);

            $sql = db_insertDbData(S_DB, 'rm_ho', $iField, $iValue);

            if ($i == 1) ___log($logHandle, $sql['q']);
            if ($sql['r']) $mkCnt++;
        }
    }

    $retPara = '';
    $html = '';
    $ret = sprintf("%s@@%s@@%s@@%s","OK",'쉐어 정보가 생성 되었습니다.['.$mkCnt.' 개]',$retPara,$html);

    //------------------------------------------------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------------------------------------------
    ___log($logHandle,$ret);
    ___logEnd($logHandle);
    echo $ret;
}

function _deleteDongHoData($sO) {
    $logHandle = ___logStart($sO['apiFile']);
    ___logArray($logHandle,$sO);
    //------------------------------------------------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------------------------------------------
    $dong = $sO['dong'];
    $dongNo = ___getDecodeValue($dong);

    $sql = db_deleteDbData(S_DB,'rm_ho','dongNo='.$dongNo);
    ___log($logHandle,$sql['q']);
    $alert = $sql['r'] ? '삭제 되었습니다.' : 'Error';

    $retPara = '';
    $html = '';
    $ret = sprintf("%s@@%s@@%s@@%s","OK",$alert,$retPara,$html);

    //------------------------------------------------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------------------------------------------
    ___log($logHandle,$ret);
    ___logEnd($logHandle);
    echo $ret;
}

//------------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------------
switch($sO['cmd'])
{
case "make.dong.ho.data":
    $ret = _makeDongHoData($sO);
    break;

case "make.dong.ho.share.data":
    $ret = _makeDongHoShareData($sO);
    break;

case "delete.dong.ho.data":
    $ret = _deleteDongHoData($sO);
    break;
}
