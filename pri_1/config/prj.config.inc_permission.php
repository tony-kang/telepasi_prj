<?php
/**
 * @author tony on 2022. 6. 23.
 * @author Tony Kang <bluein007@gmail.com>
 * Description
 *
 */

$_prj['permission'] = [
    //필요한 만큼 추가해 주세요.
    'CEO'=>'CEO',
    'P1'=>'P1',
    'P2'=>'P2',
    'P3'=>'P3',
    'P4'=>'P4',
    'P5'=>'P5',
];

// 활용
// t_mbrdata의 permission에 [CEO , xxx , yyyy] 처럼 콤마구분으로 권한을 등록한 다음 아래처럼 코딩
//if (___hasPermission($_stie['permission']['CEO'])) {
//    //권한 있으면 수행됨
//}

//------------------------------------------------------------------------------------
const LOGIN_SECURITY_CHECK = 'database';    //
// database or coding
//보안접속 처리 방법 1 : Database
//
//보안접속 처리 방법 2 : Hard Coding
//사이트에 IP 보안 접속이 적용된 경우 외부(허용되지 않은 IP)에서의 접속을 허용할 사람(t_mbrdata 의 uid 배열)
//$_prj['allowedMember'] = [
//                    6       //김영태 부장
//                    ,283    //박태영 상무
//                    ,292    //김희주 사장 (CEO)
//                    ,293    //유병석 상무(영업총괄)
//                           ];