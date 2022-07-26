<?php
/**
 * @author tony on 2021. 11. 25.
 * @author Tony Kang <bluein007@gmail.com>
 * Description
 *
 */

//$iconBadgeArr = [];
//$hasBadge = false;
//
//if ($_site['feature']['approval']['viewBadge'] && $_badge['headerApprovalCnt']) {
//    $hasBadge = true;
//    $badge_approval = ['icon' => 'fal fa-envelope-open', 'href' => '?cfg=menuApproval&mN=myStart_1&mT=myStart&mTs=confirm', 'data' => ['badgeText' => $_badge['headerApprovalCnt'], 'caption' => '결재']];
//    array_push($iconBadgeArr, $badge_approval);
//}
//
//if ($_badge['headerDocumentCnt']) {
//    $hasBadge = true;
//    $badge_doc = ['icon' => 'fal fa-album-collection', 'href' => '?cfg=menuDocument&mN=documentWeek&mT=report&mTs=week', 'data' => ['badgeText' => $_badge['headerDocumentCnt'], 'caption' => '문서']];
//    array_push($iconBadgeArr, $badge_doc);
//}
//
//if ($hasBadge) {
//    echo ___iconBadge($iconBadgeArr);
//}

$myBadge = new MyBadge();
if (HAS_APPROVAL_MENU && APPROVAL_VIEW_BADGE && $_badge['headerApprovalCnt']) {
    $myBadge->newTopBadge($_badge['headerApprovalCnt'])->icon('fal fa-envelope-open')->href('?cfg=menuApproval&mN=myStart_1&mT=myStart&mTs=confirm')->caption('결재')->make();
}

if ($_badge['headerDocumentCnt']) {
    $myBadge->newTopBadge($_badge['headerDocumentCnt'])->icon('fal fa-album-collection')->href('?cfg=menuDocument&mN=documentWeek&mT=report&mTs=week')->caption('문서')->make();
}

$myBadge->print();