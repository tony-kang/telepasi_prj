<?php
$sql = new TonySql(S_DB);
$sql->addTable('rm_dong','T');
$sql->addField('T.*');
$sql->addWhere(sprintf('T.complex = "%s"',___myManageComplex()));

//if ($_pg['sKey']) {
//    $sql->addWhere('and T.name like "%'.$_pg['sKey'].'%"');
//}
//if ($_pg['sKey2'] && $_pg['sKey2'] != 'A') {
//    $sql->addWhere('and T.cate_1 = "'.$_pg['sKey2'].'"');
//}
//if ($_pg['sKey3']) {
//    $sql->addWhere('and T.cate_2 = "'.$_pg['sKey3'].'"');
//}
//if ($_pg['sKey4']) {
//    $sql->addWhere('and T.cate_3 = "'.$_pg['sKey4'].'"');
//}

$sql->orderBy('dong ASC');

$_listArr = $sql->getRows();

//___debug($sql->getWhere());
//___debug($_listArr['q']);
/****
공실 체크 ???
SELECT CASE WHEN COUNT(*) = 1 THEN 'Y' ELSE 'N' END AS EMPTY_YN
FROM (
        SELECT COMPX_CD
             , DONG_NO
             , HO_NO
             , CASE WHEN NVL(MVIH_EST_YMD,'') = ''
                    THEN ADDDATE(EGRSN_EST_YMD, INTERVAL (SELECT CLS_NAME FROM TB_COMCODE WHERE MST_CLS_CD = 'TNNT_DAY' AND DTL_CLS_CD = '1') DAY)
                    ELSE MVIH_EST_YMD
                     END AS MVIH_EST_YMD
             , EPTRM_YN
             , EGRSN_EST_YMD
        FROM DONG_HO_MST_I A
       WHERE 1=1
         AND COMPX_CD = "C201900004"
         AND DONG_NO = "101"
         AND HO_NO = "1803"
         AND USE_YN = 'Y'
         AND NOT EXISTS ( SELECT * FROM NEW_CONTT_MST_I B WHERE A.DONG_NO = B.DONG_NO AND A.HO_NO = B.HO_NO)
) A
WHERE 1=1
  AND (A.EPTRM_YN = 'Y');

select * from DONG_HO_MST_I where COMPX_CD = "C201900004" and EPTRM_YN = 'Y'

 *
 *
 *
 *
 */