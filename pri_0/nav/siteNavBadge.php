<?php
/**
 * @author tony on 2021. 11. 25.
 * @author Tony Kang <bluein007@gmail.com>
 * Description
 *
 */

$_m7Day = ___endDate('-7 day');
//$_m7Day2 = ___dayAfter('-7 day');
//$_m7Day3 = ___expireDate('-7 day');
//___debug($_m7Day);
//___debug($_m7Day2);
//___debug($_m7Day3);

$sql = db_getDbData(S_DB,'t_uploadFile','count(*) as cnt',sprintf('T.regDate >= "%s"' ,$_m7Day).' and docCode like "%WEEK%"');
$cnt_1 = $sql['cnt'];
if ($cnt_1) ___menuSubBadge($_nav['menuDocument'],'documentWeek',$cnt_1);

$sql = db_getDbData(S_DB,'t_uploadFile','count(*) as cnt',sprintf('T.regDate >= "%s"' ,$_m7Day).' and docCode like "%MONTH%"');
$cnt_2 = $sql['cnt'];
if ($cnt_2) ___menuSubBadge($_nav['menuDocument'],'documentMonth',$cnt_2);

$_badge['menuDocumentCnt'] = $cnt_1 + $cnt_2;
$_badge['headerDocumentCnt'] = $_badge['menuDocumentCnt'];
if ($_badge['menuDocumentCnt']) ___menuBadge($_nav['menuDocument'],$_badge['menuDocumentCnt']);


/*************************************************************
 * 결재 개수 배지
 ************************************************************/
if ($_site['feature']['approval']['viewBadge']) {
    include_once MY_SRC_PATH . '/approval/inc_query.php';
    $_badge['menuApprovalCnt'] = 0;
    $_badge['headerApprovalCnt'] = 0;
    foreach ($approvalBadgeQueryArr_badge as $qKey => $badgeQery) {
        $approvalBadgeQuery = sprintf('deleted = 0 and aTempSave=%d', ($qKey == 'myStart.tempSave') ? 1 : 0);  //임시저장 처리
        $approvalBadgeQuery .= $approvalBadgeQueryArr_badge[$qKey]['q'];
        if ($badgeQery['submenu'] == 'myStart_3') $approvalBadgeQuery .= sprintf(' and T.regDate >= "%s"', $_m7Day);

        $sql = db_getDbData(S_DB, 't_approval', 'count(*) as cnt', $approvalBadgeQuery);
        //___echo($sql['q']);

        //2022.05.05 : 전자결재 특정 항목을 0으로 표시함
        if ($_site['feature']['approval']['count'][$qKey.'.zero']) $sql['cnt'] = 0;

        $cnt_1 = $sql['cnt'];
        $_badge['menuApprovalCnt'] += $sql['cnt'];
        $_badge['headerApprovalCnt'] += $sql['cnt'];
        if ($cnt_1) ___menuSubBadge($_nav['menuApproval'], $badgeQery['submenu'], $cnt_1);
    }
    if ($_badge['menuApprovalCnt']) ___menuBadge($_nav['menuApproval'], $_badge['menuApprovalCnt']);
}