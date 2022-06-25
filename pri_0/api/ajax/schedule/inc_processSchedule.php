<?php
/**
 * @author tony on 2021. 11. 19.
 * @author Tony Kang <bluein007@gmail.com>
 * Description
 *
 */


$logHandle = ___logStart("ajax_schedule");
___logArray($logHandle,$sO);

$_encProcess = $sO['schPara'] ?? '';
$processNo = $_encProcess ? ___getDecodeValue($_encProcess) : 0;

$startDate = ___justNumber(substr($sO['start'],0,10));
$endDate = ___justNumber(substr($sO['end'],0,10));
//$timezone = $sO['timeZone'];

$sql = new TonySql(S_DB);
$sql->addTable('erp_mpSchedule','T');
$sql->addField('T.*,T.mpStartDate as startDate,T.mpEndDate as endDate,T.mpMemo as memo');
$sql->addWhere('T.deleted = 0');
$sql->addWhere(sprintf(' and ((T.mpStartDate >= "%s" and T.mpStartDate <= "%s") || (T.mpEndDate >= "%s" and T.mpEndDate <= "%s"))',$startDate,$endDate,$startDate,$endDate));

if ($processNo) {
    $sql->addWhere('and T.processNo='.$processNo);
}
$_listArr = $sql->getRows();
___log($logHandle,$_listArr['q']);

$schArr = array();
foreach($_listArr['pageData'] as $data) {
    $_schNo = $data['no'];
    $data['startTime'] = $data['startTime'] ?? '';
    $data['endTime'] = $data['endTime'] ?? '';

    $mbr = ___getMbr($data['mbrUid']);
    $productNo = $data['productNo'];
    $processNo = $data['processNo'];
    $product = ___getProduct($productNo);
    $process = ___getProcess($processNo);
    $processName = $process['name'] ?? '';

    $_start = ___date($data['startDate'],'Y-m-d');
    if ($data['startTime']) $_start .= sprintf('T%s:00',$data['startTime']);

    if (empty($data['endDate'])) $data['endDate'] = $data['startDate'];

    if ($data['endTime']) {
        $_end = ___date($data['endDate'],'Y-m-d');
        $_end .= sprintf('T%s:00',$data['endTime']);
    }
    else {
        $_end = ___dayAfter('+1 day','Y-m-d',$data['endDate']);
        //날짜가 2일이상일 경우 마지막 날짜의 시간이 지정되지 않으면 마지막 날짜가 포험되지 않는 Full Calendar 문제를 처리함.
    }

    //$data['title'] = sprintf('%s-%s',$product['modelNo'],$process['name']);
    $data['title'] = $processName;
    if ($product['code']) $data['title'] .= ' ▶ '.$product['code'];

    $_colorClass = '';

    $isPrivate = 0;
    $url = $data['url'] ?? '';
    $schCode = $data['schCode'] ?? '';
    $_hasEditMenu = 0;
    $_hasDeleteMenu = 0;//($data['mbrUid'] == 0 || $data['mbrUid'] == $_SESSION['mbrUid']) ? 1 : 0;
    $_mbrName = $mbr['name'] ?? '[Unknown]';

    $_colorArr = ___calendarColor($schCode);
//    ___logArray($logHandle,$_colorArr);
//    $_fColor = $_colorArr['fColor'];    $_bColor = $_colorArr['bColor'];
    $_fColor = '';//#42AEDC';
    $_bColor = $process['color'] ?? '';

    $mpMemo = $data['memo'] ? $data['memo'] : '작업메모 없음';

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