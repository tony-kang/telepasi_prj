<?php
/**
 * @author tony on 2022. 7. 12.
 * @author Tony Kang <bluein007@gmail.com>
 * Description
 *
 */

/***
 * 동의 기본정보만 취한다.
 * @return string
 */
function q_complexHo() {
    $q = '
    select 
        H.no ,H.dongNo ,H.complex ,H.dong ,H.floor ,H.ho ,H.nickname ,H.state, H.hoType, H.shareCnt
        ,_DH.ROOM_TP as roomType ,_DH.TERCE_YN as hasTerras ,_DH.USE_YN as inUse ,_DH.EPTRM_YN as isEmpty ,_DH.EXSUE_AREA as exArea ,_DH.SUP_AREA as supArea
        ,if (_DH.COMPX_CD is NULL, "N", "Y") as hoExist
    from rm_dong as D
        join rm_ho as H on D.no = H.dongNo and H.parentNo = 0
        left join DONG_HO_MST_I as _DH on _DH.COMPX_CD = H.complex and _DH.DONG_NO = H.dong and _DH.HO_NO = H.ho
    where
        H.complex = "' . ___myManageComplex() . '"
    order by 
        cast(D.dong as signed) asc , 
        cast(H.floor as signed) desc, 
        cast(H.ho as signed) asc';

    $sql = db_getDbRows_q(S_DB,$q);
    return $sql['pageData'];
}

/***
 * 연체세대
 * @param int          $delayMonthCount : n 개월 이상 연체세대
 * @param false|string $delayCheckMonth : 연체 기준 월
 */
function q_complexOverdue($delayMonthCount,$delayCheckMonth) {
    $q = '
    select 
        distinct
        H.no
        ,_LATE.DLY_CNT as dMonth
    FROM
        rm_ho as H,
        CONTT_MST_I as _CONTT,
        CNTR_MST_I as _CNTR,
        DONG_HO_MST_I as _DH,
        (
            select
                SUM(CASE WHEN OSDSM_EST_AMT > 0 THEN 1 ELSE 0 END) AS DLY_CNT
                ,SUM( F.OSDSM_EST_AMT ) as lateMonthFee
                ,DONG_NO
                ,HO_NO
                ,CONTT_NO
                ,COMPX_CD
            from 
                RNT_CONTT_PYMT_I F 
            where 
                COMPX_CD="'.___myManageComplex().'" and BILL_MONTH < "'.$delayCheckMonth.'" 
            group by 
                CONTT_NO 
            having 
                lateMonthFee > 0
        ) as _LATE 
    WHERE
        H.complex = _CONTT.COMPX_CD and _CONTT.COMPX_CD = _CNTR.COMPX_CD and _CNTR.COMPX_CD = _DH.COMPX_CD and _DH.COMPX_CD = _LATE.COMPX_CD
        and H.complex="'.___myManageComplex().'"
        and H.dong = _DH.DONG_NO and H.ho = _DH.HO_NO
        and _CONTT.CONTT_NO = _CNTR.CONTT_NO and _CNTR.CONTT_NO = _LATE.CONTT_NO
        and _CONTT.DONG_NO = _DH.DONG_NO and _CONTT.HO_NO = _DH.HO_NO
        and _LATE.DONG_NO = _DH.DONG_NO and _LATE.HO_NO = _DH.HO_NO
        and _LATE.DLY_CNT >= '.$delayMonthCount.'
    ORDER BY 
        _LATE.DLY_CNT DESC';

    $sql = db_getDbRows_q(S_DB,$q);
    return $sql['pageData'];
}

function q_complexDong() {
    $q = '
    select
        D.dong, D.maxFloor, D.hoCnt
    from rm_dong as D 
    where
        D.complex = "' . ___myManageComplex() . '"
    order by 
        cast(D.dong as signed) asc
    ';

    $sql = db_getDbRows_q(S_DB,$q);
    return $sql['pageData'];
}

/***
 * 입주 예정세대
 */
function q_complexInReady() {
    $q = '
    select H.no from
        rm_ho as H
        ,NEW_CONTT_MST_I as _NCONTT
        ,NEW_CNTR_MST_I as _NCNTR
        ,DONG_HO_MST_I as _DH
    where 
        H.complex = _NCONTT.COMPX_CD and _NCONTT.COMPX_CD = _NCNTR.COMPX_CD and _NCNTR.COMPX_CD = _DH.COMPX_CD
        and _NCONTT.CONTT_NO = _NCNTR.CONTT_NO
        and _NCONTT.BIZ_CD = "NC" and _NCNTR.REPR_CNTR_YN = "Y" 
        and H.dong = _NCONTT.DONG_NO and H.ho = _NCONTT.HO_NO
        and H.dong = _DH.DONG_NO and H.ho = _DH.HO_NO
        and H.complex = "' . ___myManageComplex() . '"
    order by 
        cast(H.dong as signed) asc , 
        cast(H.floor as signed) desc, 
        cast(H.ho as signed) asc
    ';

    $sql = db_getDbRows_q(S_DB,$q);
    return $sql['pageData'];
}

/***
 * 갱신예정 세대
 * @return mixed
 */
function q_complexReContract() {
    $q = '
    select H.no from
        rm_ho as H
        ,NEW_CONTT_MST_I as _NCONTT
        ,NEW_CNTR_MST_I as _NCNTR
        ,DONG_HO_MST_I as _DH
    where 
        H.complex = _NCONTT.COMPX_CD and _NCONTT.COMPX_CD = _NCNTR.COMPX_CD and _NCNTR.COMPX_CD = _DH.COMPX_CD
        and _NCONTT.CONTT_NO = _NCNTR.CONTT_NO
        and _NCONTT.BIZ_CD = "RC" and _NCNTR.REPR_CNTR_YN = "Y" 
        and H.dong = _NCONTT.DONG_NO and H.ho = _NCONTT.HO_NO
        and H.dong = _DH.DONG_NO and H.ho = _DH.HO_NO
        and H.complex = "C201900004"
    order by 
        cast(H.dong as signed) asc , 
        cast(H.floor as signed) desc, 
        cast(H.ho as signed) asc
    ';

    $sql = db_getDbRows_q(S_DB,$q);
    return $sql['pageData'];
}

$complexInfo['complex'] = ___myManageComplex();
$complexInfo['dongList'] = q_complexDong();
$complexInfo['hoList'] = q_complexHo();
$complexInfo['overdueList'] = q_complexOverdue(1,date('Ym'));
$complexInfo['inReadyList'] = q_complexInReady();
//$complexInfo['reContractList'] = q_complexReContract();
$complexInfo['rentBaseFloor'] = (___myManageComplex() == 'C202000007') ? 3 : 1;
$complexInfo['hoWidth'] = (___myManageComplex() == 'C202000007') ? 32 : 40;
$complexInfo['hoHeight'] = 15;

$json_complexInfo = json_encode($complexInfo);

echo $json_complexInfo;