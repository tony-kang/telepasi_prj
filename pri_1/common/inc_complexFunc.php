<?php
/**
 * @author tony on 2022. 6. 10.
 * @author Tony Kang <bluein007@gmail.com>
 * Description
 *
 */

/*
 * common 폴더에 파일츨 추가하면 자동으로 include_once 처리됩니다.
 */
function _supTypeArr($rT) {
    $arr = array(1=>'일반'
        ,2=>'특별-구로구/금천구 중소기업 종사자'
        ,3=>'특별-3대(代)동반입주'
        ,4=>'특별-한일시멘트 재직자'
        ,5=>'특별-구로구 소재 협동조합'
        ,6=>'특별-신혼부부' // 서교동
        ,7=>'특별-세어형태' // 서교동
        );

    $r = $arr[$rT] ?? '일반';
    return $r;
}

function _hoTypeArr($rT) {
    $arr = ___envArr('M003','env_rm.txt');

    $r = $arr[$rT] ?? '일반';
    return $r;
}

function ___hoHouseState($state) {
    $arr = array(
         HO_STATE_EMPTY=>'공실'
        ,HO_STATE_IN_READY=>'입주예정'
        ,HO_STATE_IN_ING=>'입주중'
        ,HO_STATE_IN_DONE=>'입주완료'
        ,HO_STATE_OUT_READY=>'퇴거예정'
        ,HO_STATE_OUT_ING=>'퇴거중'
        ,HO_STATE_OUT_DONE=>'퇴거완료(공실)'
    );

    $r = $arr[$rT] ?? '입주중(추정)';
    return $r;
}

function ___hoWorkState($state) {
    //0=진행업무 없음,1=계약예정,2=계약중,3=계약완료,4=계약금입금완료,5=잔금입금완료,...,갱신정보 = +10
    $arr = array(0=>'진행업무 없음'
        ,1=>'계약예정'
        ,2=>'계약중'
        ,3=>'계약완료'
        ,4=>'계약금입금완료'
        ,5=>'잔금입금완료'
        ,11=>'갱신계약예정'
        ,12=>'갱신계약중'
        ,13=>'갱신계약완료'
        ,14=>'갱신계약금입금완료'
        ,15=>'갱신잔금입금완료'
        );

    $r = $arr[$rT] ?? '진행업무 없음(추정)';
    return $r;
}

function ___hoInfo($hoNo) {
    $sql = sql_getDbData(S_DB,'rm_ho','*','no='.$hoNo);
    $sql['dongHo'] = sprintf('%d동 %d호',$sql['dong'],$sql['ho']);
    return $sql;
}