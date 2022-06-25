<?php
/**
 * @author tony on 2021. 10. 24.
 * @author Tony Kang <bluein007@gmail.com>
 * Description
 *
 */


$logHandle = ___logStart($sO['jsonFile']);
___logArray($logHandle,$sO);

//--------------------------------------------------------------------------------
//--------------------------------------------------------------------------------
$processNo = ___getDecodeValue($sO['process']);
$processEqNo = ___getDecodeValue($sO['processEq']);
___log($logHandle,sprintf('processNo=%d',$processNo));
___log($logHandle,sprintf('processEqNo=%d',$processEqNo));

//--------------------------------------------------------------------------------
//--------------------------------------------------------------------------------
$process = ___getProcess($processNo);
___log($logHandle,$process['q']);

$_editDb['table'] = 'erp_processEquipment';
$_editDb['puField'] = 'no';
$_editDb['puType'] = NUMBER_FIELD;
$_editDb['puValue'] = $processEqNo;

$jsonArr = [
    'result'=>'OK',
    'processNo'=>$process['no'],
    'processName'=>$process['name'],
    'processEqNo'=>$processEqNo,
    'processEq'=>['result'=>'none']
];
___logArray($logHandle,$_editDb);
$jsonArr['dataDbPara'] = ___encode(___make_dbKey(array($_editDb['table'],$_editDb['puField'],$_editDb['puType'],$_editDb['puValue'])));


if ($processEqNo) {
    $processEq = ___getProcessEquipment($processEqNo);
    ___log($logHandle,$processEq['q']);
    if (is_array($processEq)) {
        $eq = ___getEquipment($processEq['equipmentNo']);
        ___log($logHandle,$eq['q']);
        $jsonArr['processEq'] = [
                'result'=>'OK',
                'no'=>$eq['no'],
                'name'=>$eq['name'],
                'code'=>$eq['code'],
                'serialNo'=>$eq['serialNo'],
                'percentRate'=>$processEq['percentRate'],
                'startDate'=>___date($processEq['startDate']),
                'comment'=>$processEq['comment'],
            ];
    }
}

//--------------------------------------------------------------------------------
___logArray($logHandle,$jsonArr);

//-------------------------------------------------------------------------------------
___logEnd($logHandle);
echo json_encode($jsonArr);