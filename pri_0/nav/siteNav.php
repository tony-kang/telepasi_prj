<?php
// modify the navigation for demonstration purposes
$_nav['menuDashboard'] = [
    'title' => 'Dashboard',
    'icon' => 'fal fa-analytics',
    'items' => [
        'custCountry' => [
            'title' => '글로벌 고객현황(1)',
            'url' => '/?cfg=menuDashboard&mN=custCountry'
        ],
        'globalCustomer' => [
            'title' => '글로벌 고객현황(2)',
            'url' => '/?cfg=menuDashboard&mN=globalCustomer'
        ],
        'globalCustomer2' => [
            'title' => '글로벌 고객현황(3)',
            'url' => '/?cfg=menuDashboard&mN=globalCustomer2'
        ]
    ]
];

if (___hasPermission(P_P1)) {

    $menuSalesMonitor = ['salesMonitor' => [
            'title' => '영업현황',
            'url' => '/?cfg=menuDashboard&mN=salesMonitor'
        ]];
    $menuSalesStatus = ['SalesStatus' => [
            'title' => '매출현황',
            'url' => '/?cfg=menuDashboard&mN=SalesStatus'
        ]];

    $_nav['menuDashboard']['items'] = $menuSalesMonitor + $menuSalesStatus + $_nav['menuDashboard']['items'];
}


$_nav['menuCost'] = [
    'title' => '제조원가',
    'icon' => 'fal fa-abacus',
    'items' => [
        'performance'   => [ 'title' => '실적원가', 'url' => '/?cfg=menuCost&mN=performance' ],
        'standard'      => [ 'title' => '표준원가', 'url' => '/?cfg=menuCost&mN=standard' ],
        'budget'        => [ 'title' => '예산', 'url' => '/?cfg=menuCost&mN=budget' ],
        'bepAnalysis'   => [ 'title' => '손익분석', 'url' => '/?cfg=menuCost&mN=bepAnalysis' ],
    ]
];


//$_nav['menuDemo'] = [
//    'title' => '데모',
//    'icon' => 'fal fa-file-powerpoint',
//    'items' => [
//        'order'      => [ 'title' => '발주 및 입고', 'url' => '/?cfg=menuDemo&mN=order' ],
//    ]
//];

$_nav['menuApproval'] = [
    'title' => '전자결재',
    'icon' => 'fas fa-edit',
    'items' => [
        'myStart_1'     => [ 'title' => 'My기안'       , 'url' => '/?cfg=menuApproval&mN=myStart_1&mT=myStart&mTs=confirm' ],
        'myConfirm_1'   => [ 'title' => '결재중'       , 'url' => '/?cfg=menuApproval&mN=myConfirm_1&mT=myConfirm&mTs=confirm' ],
        'myConfirm_2'   => [ 'title' => '결재완료'      , 'url' => '/?cfg=menuApproval&mN=myConfirm_2&mT=myConfirm&mTs=ok' ],
        'myConfirm_3'   => [ 'title' => '합의'         , 'url' => '/?cfg=menuApproval&mN=myConfirm_3&mT=myConfirm&mTs=agree' ],
        'myConfirm_4'   => [ 'title' => '참조'         , 'url' => '/?cfg=menuApproval&mN=myConfirm_4&mT=myConfirm&mTs=ref' ],
        'myConfirm_5'   => [ 'title' => '최종(승인/반려)' , 'url' => '/?cfg=menuApproval&mN=myConfirm_5&mT=myConfirm&mTs=done' ],
        'myStart_3'     => [ 'title' => '임시보관함'     , 'url' => '/?cfg=menuApproval&mN=myStart_3&mT=myStart&mTs=tempSave' ],
    ]
/*
        'myStart_1'     => [ 'title' => 'My기안 - 결재중'        , 'url' => '/?cfg=menuApproval&mN=myStart_1&mT=myStart&mTs=confirm' ],
        //'myStart_2'     => [ 'title' => 'My기안 - 결재완료'       , 'url' => '/?cfg=menuApproval&mN=myStart_2&mT=myStart&mTs=done' ],
        'myConfirm_1'   => [ 'title' => '처리 해야할 결재'         , 'url' => '/?cfg=menuApproval&mN=myConfirm_1&mT=myConfirm&mTs=confirm' ],
        'myConfirm_2'   => [ 'title' => '처리한 결재'            , 'url' => '/?cfg=menuApproval&mN=myConfirm_2&mT=myConfirm&mTs=ok' ],
        'myConfirm_3'   => [ 'title' => '합의요청 받은 결재'        , 'url' => '/?cfg=menuApproval&mN=myConfirm_3&mT=myConfirm&mTs=agree' ],
        'myConfirm_4'   => [ 'title' => '참조 해야할 결재'         , 'url' => '/?cfg=menuApproval&mN=myConfirm_4&mT=myConfirm&mTs=ref' ],
        'myConfirm_5'   => [ 'title' => '최종(승인/반려) 결재'      , 'url' => '/?cfg=menuApproval&mN=myConfirm_5&mT=myConfirm&mTs=done' ],
        'myStart_3'     => [ 'title' => '임시저장된(템플릿) 결재'    , 'url' => '/?cfg=menuApproval&mN=myStart_3&mT=myStart&mTs=tempSave' ],
 */
];


$_nav['menuBase'] = [
    'title' => '기준정보',
    'icon' => 'fas fa-info-circle',
    'items' => [
        //'factory'      => [ 'title' => '사업장(공장)', 'url' => '/?cfg=menuBase&mN=factory' ],
        'project'      => [ 'title' => '프로젝트', 'url' => '/?cfg=menuBase&mN=project' ],
        'product'       => [ 'title' => '제품', 'url' => '/?cfg=menuBase&mN=product' ],
        'drawing'       => [ 'title' => '도면', 'url' => '/?cfg=menuBase&mN=drawing' ],
        'materials'     => [ 'title' => '자재(원부자재)', 'url' => '/?cfg=menuBase&mN=materials' ],
        'process'       => [ 'title' => '공정', 'url' => '/?cfg=menuBase&mN=process' ],
        'equipment'     => [ 'title' => '설비', 'url' => '/?cfg=menuBase&mN=equipment' ],
        'customer'      => [ 'title' => '거래처', 'url' => '/?cfg=menuBase&mN=customer' ], //고객 / 수주처 / 발주처 등 매입매출의 기준 업체
        'inspection'   => [ 'title' => '불량유형', 'url' => '/?cfg=menuBase&mN=inspection' ],
        'warehouse'   => [ 'title' => '창고', 'url' => '/?cfg=menuBase&mN=warehouse' ],
    ]
];

if (___hasPermission(P_USER)) {
    $_nav['menuBase']['items']['user'] = [ 'title' => '사용자' , 'url' => '/?cfg=menuBase&mN=user' ];
}

if (___hasPermission(P_SALES)) {
    $_nav['menuBiz'] = [
        'title' => '영업', 'icon' => 'fas fa-business-time',
        'items' => []
    ];

    $_nav['menuBiz']['items']['sales'] = ['title' => '영업현황', 'url' => '/?cfg=menuBiz&mN=sales'];
    $_nav['menuBiz']['items']['inOrder'] = ['title' => '수주관리', 'url' => '/?cfg=menuBiz&mN=inOrder&ext=viewInOrderDetailNew'];
    $_nav['menuBiz']['items']['shipping'] = ['title' => '생산완료 출하 | 납품', 'url' => '/?cfg=menuBiz&mN=shipping'];
}

if (___hasPermission(P_ORDER)) {
    $_nav['menuOutOrder'] = [
        'title' => '구매',
        'icon' => 'fas fa-dolly-flatbed',
        'items' => [
            'orderManager' => ['title' => '구매관리', 'url' => '/?cfg=menuOutOrder&mN=orderManager&mT=orderManager&mTs=prOk'],
            'orderPaper' => ['title' => '발주현황(발주서)', 'url' => '/?cfg=menuOutOrder&mN=orderPaper'],
            'orderItem' => ['title' => '구매내역', 'url' => '/?cfg=menuOutOrder&mN=orderItem&ext=orderItem'],
        ]
    ];
}

$_nav['menuProduction'] = [
    'title' => '생산',
    'icon' => 'fal fa-cogs',
    'items' => [
        'mpProduct'             => [ 'title' => '생산관리', 'url' => '/?cfg=menuProduction&mN=mpProduct' ],
        //'menuTimeInOut'         => [ 'title' => '근태관리', 'url' => '/?cfg=menuProduction&mN=menuTimeInOut' ],
        'mpProductSchedule'     => [ 'title' => '생산일정', 'url' => '/?cfg=menuProduction&mN=mpProductSchedule' ],
        'mpProcessSchedule'     => [ 'title' => '공정일정', 'url' => '/?cfg=menuProduction&mN=mpProcessSchedule' ],
        'mpTeamOrder'           => [ 'title' => '작업관리현황', 'url' => '/?cfg=menuProduction&mN=mpTeamOrder' ],
        'mpMaterial'            => [ 'title' => '생산자재 | 출고현황', 'url' => '/?cfg=menuProduction&mN=mpMaterial' ],
        'mpDone'                => [ 'title' => '생산완료 - 검수 | 시운전 | 납품', 'url' => '/?cfg=menuProduction&mN=mpDone' ],
    ]
];
//        'productInspection'     => [ 'title' => '출하검사', 'url' => '/?cfg=menuQuality&mN=productInspection' ],
//        'deliveryInstall'       => [ 'title' => '납품 | 설치', 'url' => '/?cfg=menuQuality&mN=deliveryInstall' ],
if ($_site['feature']['timeInOut']) {
    $_nav['menuProduction']['items']['menuTimeInOut'] = [ 'title' => '근태관리', 'url' => '/?cfg=menuProduction&mN=menuTimeInOut' ];
}


$_nav['menuQuality'] = [
    'title' => '품질',
    'icon' => 'fal fa-award',
    'items' => [
        'importInspection'      => [ 'title' => '수입검사', 'url' => '/?cfg=menuQuality&mN=importInspection' ],
        //'AssyInspection'        => [ 'title' => '조립검사', 'url' => '/?cfg=menuQuality&mN=AssyInspection' ],
        //'complain'                  => [ 'title' => '고객불만 | A/S', 'url' => '/?cfg=menuQuality&mN=complain' ],
        //'selfInspection'          => [ 'title' => '자주검사', 'url' => '/?cfg=menuQuality&mN=selfInspection' ],
        //'shippingInspection'      => [ 'title' => '출하검사', 'url' => '/?cfg=menuQuality&mN=shippingInspection' ],
        //'incongruence'            => [ 'title' => '부적합', 'url' => '/?cfg=menuQuality&mN=incongruence' ],
    ]
];

$_nav['menuAS'] = [
    'title' => '고객불만 | A/S',
    'icon' => 'fal fa-user-headset',
    'items' => [
        'complain'                  => [ 'title' => 'A/S 접수 | 관리', 'url' => '/?cfg=menuAS&mN=complain' ],
    ]
];

$_nav['menuDocument'] = [
    'title' => '문서',
    'icon' => 'fas fa-archive',
    'items' => [
        'documentWeek'        => [ 'title' => '주간업무 보고서', 'url' => '/?cfg=menuDocument&mN=documentWeek&mT=report&mTs=week' ],
        'documentMonth'       => [ 'title' => '월간업무 보고서', 'url' => '/?cfg=menuDocument&mN=documentMonth&mT=report&mTs=month' ],
        'documentShare'       => [ 'title' => '일반 문서', 'url' => '/?cfg=menuDocument&mN=documentShare&mT=report&mTs=share' ],
        'documentSales'       => [ 'title' => '영업 현황', 'url' => '/?cfg=menuDocument&mN=documentSales&mT=report&mTs=sales' ],
        'documentCompany'       => [ 'title' => '경쟁사 현황', 'url' => '/?cfg=menuDocument&mN=documentCompany&mT=report&mTs=company' ],
        'documentSalesReport'   => [ 'title' => '영업 일일보고서', 'url' => '/?cfg=menuDocument&mN=documentSalesReport&mT=report&mTs=salesReport' ],
        'documentASReport'      => [ 'title' => 'A/S 일일보고서', 'url' => '/?cfg=menuDocument&mN=documentASReport&mT=report&mTs=asReport' ],
    ]
];

$_nav['menuEtc'] = [
    'title' => 'Todo 및 업무일정',
    'icon' => 'fal fa-atom',
    'items' => []
];

if ($_SESSION['mbr']['myTodo']) {
    $_nav['menuEtc']['items']['myTodo'] = [ 'title' => 'my Todo', 'url' => '/?cfg=menuDashboard&mN=myTodo' ];
}
$_nav['menuEtc']['items']['calendar'] = [ 'title' => '업무일정(전체)', 'url' => '/?cfg=menuDashboard&mN=calendar' ];


if (___isAdmin()) {
    $_nav['menuEnv'] = [
        'title' => '관리자-환경설정',
        'icon' => 'fal fa-flag-checkered',
        'items' => [
            'docManager'        => [ 'title' => '최근문서'      , 'url' => '/?cfg=menuDocument&mN=docManager' ],
            'mesManual'        => [ 'title' => '사용자 메뉴얼'      , 'url' => '/?cfg=menuDocument&mN=docManager&docPrefix=MANUAL_001' ],
            'user'              => [ 'title' => '사용자'       , 'url' => '/?cfg=menuEnv&mN=user' ],
            //'part'            => [ 'title' => '조직(부서)'    , 'url' => '/?cfg=menuEnv&mN=part' ],
            'custEnv'           => [ 'title' => 'ERP 환경설정'  , 'url' => '/?cfg=menuEnv&mN=custEnv' ],
            'inspectionType'    => [ 'title' => '불량유형관리'    , 'url' => '/?cfg=menuEnv&mN=inspectionType&mT=type1&iType=type1' ],
        ]
    ];
}
