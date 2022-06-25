<?php
/**
 * @author tony on 2022. 1. 23.
 * @author Tony Kang <bluein007@gmail.com>
 * Description
 *
 */

$logHandle = ___logStart("daemon_cashbill");

$daily = array('일','월','화','수','목','금','토');
$date = date('Y.m.d');
$weekday = $daily[date('w')];
$hour = date('H');
if ($weekday == '일' || $weekday == '토') {
    ___log($logHandle,'주말에는 현금영수증이 자동 발행되지 않습니다.');
    ___logEnd($logHandle);
    return;
}
if ($hour < 10 || $hour > 17) {
    ___log($logHandle,'주말 또는 현재시간(오전 10시 이전과 오후 5시 이후)에는 현금영수증이 자동 발행되지 않습니다.');
    ___logEnd($logHandle);
    return;
}

$_pg['cashBillTest'] = false;    // true = Test , flase = 서비스
require_once MY_LIB_PATH.'/extApi/bill/popbill/my_popbillCommon.php';

//데몬 호출 Command
    // 단지별 수행 : 컴플렉스 파라미터 추가하면 됨.
    //php index_popbillDaemon.php --port:8080 C202000007
    //php index_popbillDaemon.php --port:8080 C201900004
    // 통합수행 : 평상시에는 이것으로 수행
    //php index_popbillDaemon.php --port:8080
//웹 호출 URL
//http://dev.rent.ondongne.net:8080/?php=daemon&sub=Cashbill
//http://dev.rent.ondongne.net:8080/?php=daemon&sub=Cashbill&daemonId=C202000007
//http://dev.rent.ondongne.net:8080/?php=daemon&sub=Cashbill&daemonId=C201900004
//디버그 메세지
//http://dev.rent.ondongne.net:8080/?php=log&log=daemon_cashbill
$today = date('Ymd');
$now = date('YmdHis');

if (is_array($_SERVER['argv'])) {
    //데몬으로 실행
    //var_dump($argv);
    $daemonId = $argv[2] ?? '';
//    echo $daemonId;
//    echo "\n";
} else {
    //웹으로 호출됨
    $daemonId = ___get('daemonId','');
}

include_once __DIR__.'/inc_daemonCashbill.php';

___logEnd($logHandle);
