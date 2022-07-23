<?php
/**
 * @author tony on 2022. 6. 23.
 * @author Tony Kang <bluein007@gmail.com>
 * Description
 *
 */

//도메인 및 개발이냐 실제 서비냐에 따른 데이타베이스 연결을 구성
if ($_site['domain'] == 'my.prj.telepasi.co.kr') {
    if (PRJ_SERVER_DESC == REAL_SERVER) include_once __DIR__.'/inc_dbRealService.php';
    else include_once __DIR__.'/inc_dbDev.php';
}