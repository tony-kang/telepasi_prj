<?php
//---------------------------------------------------------------------------------
// 일정 상단메뉴
// 제품/공정 등의 특수일정이 아닐경우 기본상단메뉴가 나오도록 처리
//---------------------------------------------------------------------------------
//$_pg['schGroup'] = ___get('schGroup','aaa');
//include_once MY_SRC_PATH.'/calendar/calendar.inc_func.php';
//if (array_key_exists($_pg['schGroup'],___getSpecialScheduleArr())) {
//    //양산일정 등의 특수 스케줄 보기
//} else {
//    $tMenu['menuDashboard.calendar'] = array(
//        'caption'=>'일정'
//        ,'data' => array(
//            'holidays'=>array('caption'=>'휴무자','child'=>''),
//            'bizTrip'=>array('caption'=>'출장자','child'=>''),
//        )
//    );
//
//    $tMenu['menuDashboard.calendar']['data']['project'] = ['caption'=>'프로젝트'];
//}
//
////---------------------------------------------------------------------------------
//$tMenu['standardErp'] = array(
//    'caption'=>POWERED_BY_VERSION
//    ,'data' => array(
//        'm_1'=>array('caption'=>'공통코드','child'=>array(
//            'm_12'=>array('caption'=>'사용자 권한'),
//            'm_13'=>array('caption'=>'은행'),
//            'm_14'=>array('caption'=>'문서'),
//            )
//        ),
//        'm_2'=>array('caption'=>'ERP코드','child'=>array(
//            'm_21'=>array('caption'=>'영업'),
//            'm_22'=>array('caption'=>'인사'),
//            'm_23'=>array('caption'=>'재고'),
//            'm_24'=>array('caption'=>'제조'),
//            'm_25'=>array('caption'=>'품질'),
//            'm_26'=>array('caption'=>'구매'),
//            )
//        )
//    )
//);

$tMenu['menuDemo.order'] = array(
    'caption'=>'발주서'
    ,'data' => array(
        'ready'=>array('caption'=>'발주완료','child'=>''),
        'checking'=>array('caption'=>'업체확인중','child'=>''),
        'working'=>array('caption'=>'제작중','child'=>''),
        'made'=>array('caption'=>'제작완료','child'=>''),
        'complete'=>array('caption'=>'납품완료','child'=>''),
    )
);

$tMenu['menuApproval.approval'] = array(
    'caption'=>'전자결재'
    ,'clearParameter'=>'approval,template'
    ,'data' => array(
        'myStart'=>array('caption'=>'My 기안','child'=>array(
            'confirm'=>array('caption'=>'결재중'),
            'done'=>array('caption'=>'결재완료'),
            )
        ),
        'myConfirm'=>array('caption'=>'My 결재','child'=>array(
            'confirm'=>array('caption'=>'진행중 - 처리해야할 결재'),
            'ok'=>array('caption'=>'진행중 - 처리한 결재'),
            'agree'=>array('caption'=>'진행중 - 합의요청 받은 결재'),
            'ref'=>array('caption'=>'진행중 - 참조해야할 결재'),
            'done'=>array('caption'=>'완료됨 - 최종(승인/반려) 결재'),
            )
        ),
    )
);

$tMenu['menuDocument.document'] = array(
    'caption'=>'문서'
    ,'clearParameter'=>'documet'
    ,'data' => array(
        'report'=>array('caption'=>'보고서','child'=>array(
            'week'=>array('caption'=>'주간업무보고서'),
            'month'=>array('caption'=>'월간업무보고서'),
            )
        ),
        'normal'=>array('caption'=>'일반','child'=>array(
            'productSchedule'=>array('caption'=>'생산일정(Excel)'),
            )
        ),
    )
);

//자재 구매 요청자
$tMenu['menuBase.materials'] = array(
    'caption'=>'자재'
    ,'clearParameter'=>'dComp'
    ,'data' => array(
        'myMaterial'=>array('caption'=>'My','child'=>array(
            'my'=>array('caption'=>'구매요청할 자재'),
            'myOk'=>array('caption'=>'구매요청완료 자재'),
            //'myIn'=>array('caption'=>'구매요청입고 자재'),
            )
        )
    )
);

if (___hasPermission(P_ORDER)) {
    //구매 담당자
    $tMenu['menuBase.materials']['data']['prMaterial'] = array(
        'caption'=>'구매'
        ,'child'=>array(
            'prOk'=>array('caption'=>'현황'),
            'prOrderConfirm'=>array('caption'=>'구매확정 자재'),
            'prOrderPaper'=>array('caption'=>'발주서(작성완료) 자재'),
            'prOrder'=>array('caption'=>'발주서(발주중) 자재'),
            'prIn'=>array('caption'=>'발주서(입고) 자재'),
            )
    );

    //구매 담당자
    $tMenu['menuOutOrder.orderManager']['data']['orderManager'] = array(
        'caption'=>'구매'
        ,'child'=>array(
            'prOk'=>array('caption'=>'현황'),
            'prOrderConfirm'=>array('caption'=>'구매확정 자재'),
            'prOrderPaper'=>array('caption'=>'발주서(작성완료) 자재'),
            'prOrder'=>array('caption'=>'발주완료 자재'),
            'prIn'=>array('caption'=>'발주입고 자재'),
            )
    );
}

$tMenu['menuEnv.inspectionType'] = array(
    'caption'=>'불량'
    ,'clearParameter'=>''
    ,'data' => array(
        'type1'=>array('caption'=>'유형(대)','getPara'=>'iType=type1'),
        'type2'=>array('caption'=>'유형(중)','getPara'=>'iType=type2'),
        'type3'=>array('caption'=>'유형(소)','getPara'=>'iType=type3'),
    )
);
//
//$tMenu['menuProduction.mpTeamOrder'] = array(
//    'caption'=>'작업관리'
//    ,'clearParameter'=>''
//    ,'data' => array(
//        'teamOrder'=>array('caption'=>'작업자','getPara'=>''),
//    )
//);
