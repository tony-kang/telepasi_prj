<?php
/**
 * @author tony on 2021. 11. 19.
 * @author Tony Kang <bluein007@gmail.com>
 * Description
 *
 */


$logHandle = ___logStart("ajax_schedule");
___logArray($logHandle,$sO);

$startDate = ___justNumber(substr($sO['start'],0,10));
$endDate = ___justNumber(substr($sO['end'],0,10));

$sql = new TonySql(S_DB);
$sql->addTable('t_timeInOut','T');
$sql->addTable('t_mbrdata','MBR');
$sql->addField('MBR.name as mbrName,MBR.part as mbrPart,T.*');
$sql->addWhere('MBR.deleted = 0 and MBR.level = 0 and MBR.op_1 = 0');
$sql->addWhere('and MBR.uid = T.workerNo');
$sql->addWhere(sprintf(' and ((T.inOutDate >= "%s" and T.inOutDate <= "%s") || (T.inOutDate >= "%s" and T.inOutDate <= "%s"))',$startDate,$endDate,$startDate,$endDate));

$_listArr = $sql->getRows();
___log($logHandle,$_listArr['q']);

$inOutTypeArr = ___envArr('X310','env_cust.txt');
$inOutTypeColorArr = ___envArr('X311','env_cust.txt');
___logArray($logHandle,$inOutTypeArr);
$schArr = array();
foreach($_listArr['pageData'] as $data) {
    $_schNo = $data['no'];
    $data['startTime'] = $data['startTime'] ?? '';
    $data['endTime'] = $data['endTime'] ?? '';

    $_start = ___date($data['inOutDate'],'Y-m-d');
    $_end = ___dayAfter('+1 day','Y-m-d',$data['inOutDate']);

    $_mbrName = $data['mbrName'] ?? '[Unknown]';
    $data['title'] = ' ● '.sprintf('%s - %s',$_mbrName,$inOutTypeArr[$data['inOutType']]);

    $_colorClass = '';

    $isPrivate = 0;
    $url = $data['url'] ?? '';
    $schCode = $data['inOutType'] ?? '';
    $_hasEditMenu = 0;
    $_hasDeleteMenu = 0;

    $_fColor = '';
    $_bColor = '#'.$inOutTypeColorArr[$data['inOutType']];

    $mpMemo = '';

    $sch = [
        'title'=>$data['title'], 'start'=>$_start, 'end'=>$_end, 'desc'=>$data['memo'], 'mbr'=>$_mbrName,
        'className'=>$_colorClass, 'backgroundColor'=>$_bColor , 'borderColor'=>$_bColor , 'textColor'=>$_fColor,
        'linkUrl'=>$url, 'schCode'=>$schCode, 'schNo'=>$_schNo, 'memo'=>$mpMemo,
        'private'=>$isPrivate, 'hasEditMenu'=>$_hasEditMenu, 'hasDeleteMenu'=>$_hasDeleteMenu
    ];

    array_push($schArr,$sch);
}
___logArray($logHandle,$schArr);
$ret = json_encode($schArr);

//-------------------------------------------------------------------------------------
___log($logHandle,$ret);
___logEnd($logHandle);
echo $ret;