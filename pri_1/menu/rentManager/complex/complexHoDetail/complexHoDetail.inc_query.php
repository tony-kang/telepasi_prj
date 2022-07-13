<?php
/**
 * 호 상세정보
 */
function q_hoDetail($hoNo) {
    $q = '
    select 
        H.no ,H.dongNo ,H.complex ,H.dong ,H.floor ,H.ho ,H.nickname ,H.state, H.hoType, H.shareCnt
        ,_DH.ROOM_TP as roomType ,_DH.TERCE_YN as hasTerras ,_DH.USE_YN as inUse ,_DH.EPTRM_YN as isEmpty ,_DH.EXSUE_AREA as exArea ,_DH.SUP_AREA as supArea
        ,if (_DH.COMPX_CD is NULL, "N", "Y") as hoExist
    from rm_dong as D
        join rm_ho as H on D.no = H.dongNo and H.parentNo = 0
        left join DONG_HO_MST_I as _DH on _DH.COMPX_CD = H.complex and _DH.DONG_NO = H.dong and _DH.HO_NO = H.ho
    where
        H.no = '.$hoNo.'
    order by 
        cast(D.dong as signed) asc , 
        cast(H.floor as signed) desc, 
        cast(H.ho as signed) asc';

    $sql = db_getDbData_q(S_DB,$q);
    return $sql;
}

/***
 * 입주 예정세대 검사
 */
function q_stateInReady($hoNo) {
    $q = '
    select count(*) as cnt from
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
        and H.no = '.$hoNo.'
    ';

    $sql = db_getDbData_q(S_DB,$q);
    $r = ($sql['cnt'] > 0);
    $state = $r ? '입주예정' : HO_STATE_CHECK_TEXT;
    return ['result'=>$r,'state'=>$state];
}

/***
 * 갱신예정 세대 검사
 */
function q_stateReContract($hoNo) {
    $q = '
    select count(*) as cnt from
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
        and H.no = '.$hoNo.'
    ';

    $r = ($sql['cnt'] > 0);
    $state = $r ? '갱신예정' : '';
    return ['result'=>$r,'state'=>$state];
}

function q_hoState($hoNo) {
    $r = q_stateInReady($hoNo);
    if (!$r['result']) $r = q_stateReContract($hoNo);

    return $r['state'];
}

//$hoDetail = q_hoDetail($_pg['hoNo']);
//$hoState = q_hoState($_pg['hoNo']);
//$hoInuse = ($hoDetail['inUse'] == 'Y');
//$hoEmpty = ($hoDetail['isEmpty'] == 'N');
