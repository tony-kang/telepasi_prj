<?php
/**
 * @author tony on 2022. 5. 17.
 * @author Tony Kang <bluein007@gmail.com>
 * Description
 *
 */

$_pg['page'] = ___get('page',1);
$_pg['pSize'] = ___get('pSize',15);

//---------- Dashboard 에서 넘어오는 파라미터
$_pg['complex'] = ___get('complex');    //C201900004 등

$_pg['dong'] = ___get('dong');    // encoded
$_pg['dongNo'] = ___getDecodeValue($_pg['dong']);   //rm_dong.no

$_pg['ho'] = ___get('ho');      // encoded
$_pg['hoNo'] = ___getDecodeValue($_pg['ho']);   //등번호 = rm_ho.no

$_pg['rent'] = ___get('rent');            // 임대 세대 리스트 타입 : latest , yearMonth , year , ...
$_pg['rentType'] = ___get('rentType');    // 임대 세대 리스트 타입 : newContract , reContract , moveOut , ...
$_pg['rentQueryType'] = sprintf('%s_%s',$_pg['rent'],$_pg['rentType']);
$_pg['durationDay'] = ___get('durationDay',7);   // baseDate 기준일로부터 최근 7일내의 퇴거 완료 세대

$_pg['baseMonth'] = ___get('baseMonth');    // 기준 월 : 202203 형태의 6자리
$_pg['baseDay'] = ___get('baseDay');    // 기준 월 : 20220312 형태의 8자리

//---------- 페이지 검색 파라미터
$_pg['sName'] = ___get('sName');
$_pg['sDongHo'] = ___get('sDongHo');
if ($_pg['sDongHo']) {
    list($_pg['sDong'],$_pg['sHo']) = preg_split("/[\s,-]/",$_pg['sDongHo']);
} else {
    $_pg['sDong'] = '';
    $_pg['sHo'] = '';
}

$_pg['dateOp'] = ___get('dateOp');
$_pg['sDate'] = ___get('sDate');
$_pg['eDate'] = ___get('eDate');
