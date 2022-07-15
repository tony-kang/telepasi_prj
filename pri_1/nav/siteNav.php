<?php
// modify the navigation for demonstration purposes
$_nav['dashboard'] = [
    'title' => ___myManageHouse(),
    'icon' => 'fal fa-analytics',
    'items' => [
        'complexLayout' => [
            'title' => '단지구성도',
            'url' => '/?cfg=dashboard&mN=complexLayout&mG=complex'
        ],
        'complexSummary' => [
            'title' => '단지현황',
            'url' => '/?cfg=dashboard&mN=complexSummary&mG=complex'
        ]
    ]
];

$_nav['menuRent'] = [
    'title' => '임대 관리',
    'icon' => 'fal fa-file-powerpoint',
    'items' => [
        'newContract'   => ['title' => '신규계약 세대', 'url' => '/?cfg=menuRent&mN=newContract&mG=complex'],
        'tbReContract'  => ['title' => '갱신예정 세대', 'url' => '/?cfg=menuRent&mN=tbReContract&mG=complex'],
        'reContract'  => ['title' => '갱신 세대', 'url' => '/?cfg=menuRent&mN=reContract&mG=complex'],
        'tbMoveOut'     => ['title' => '퇴거예정 세대', 'url' => '/?cfg=menuRent&mN=tbMoveOut&mG=complex'],
        'living'        => ['title' => '입주 세대', 'url' => '/?cfg=menuRent&mN=living&mG=complex'],
        'moveComplete'  => ['title' => '퇴거 세대', 'url' => '/?cfg=menuRent&mN=moveComplete&mG=complex'],
    ]
];

$_nav['menuPayment'] = [
    'title' => '수납 관리',
    'icon' => 'fal fa-file-powerpoint',
    'items' => [
        'payment'           => ['title' => '수납 현황', 'url' => '/?cfg=menuRent&mN=payment&mG=complex'],
        'paymentOverdue'    => ['title' => '연체 세대', 'url' => '/?cfg=menuRent&mN=paymentOverdue&mG=complex'],
        'paymentOk'         => ['title' => '완납 세대', 'url' => '/?cfg=menuRent&mN=paymentOk&mG=complex'],
    ]
];
$_nav['menuInsurance'] = [
    'title' => '보증보험 관리',
    'icon' => 'fal fa-file-powerpoint',
    'items' => [
        'tbReContract'  => ['title' => '수수료 수납현황', 'url' => '/?cfg=menuRent&mN=tbReContract&mG=complex'],
        'newContract'   => ['title' => '수수료 일괄부과', 'url' => '/?cfg=menuRent&mN=newContract&mG=complex'],
    ]
];

$_nav['menuService'] = [
    'title' => '서비스',
    'icon' => 'fal fa-flag-checkered',
    'items' => [
        'survey'        => [ 'title' => '설문관리'          , 'url' => '/?cfg=menuService&mN=survey&mG=service' ],
        'repair'          => [ 'title' => '민원(하자보수)관리'     , 'url' => '/?cfg=menuService&mN=repair&mG=service' ],
    ]
];

if (HAS_APPROVAL_MENU) {
    $_nav['menuApproval'] = [
        'title' => '전자결재',
        'icon' => 'fas fa-edit',
        'items' => [
            'myStart_1' => ['title' => 'My기안', 'url' => '/?cfg=menuApproval&mN=myStart_1&mT=myStart&mTs=confirm'],
            'myConfirm_1' => ['title' => '결재중', 'url' => '/?cfg=menuApproval&mN=myConfirm_1&mT=myConfirm&mTs=confirm'],
            'myConfirm_2' => ['title' => '결재완료', 'url' => '/?cfg=menuApproval&mN=myConfirm_2&mT=myConfirm&mTs=ok'],
            'myConfirm_3' => ['title' => '합의', 'url' => '/?cfg=menuApproval&mN=myConfirm_3&mT=myConfirm&mTs=agree'],
            'myConfirm_4' => ['title' => '참조', 'url' => '/?cfg=menuApproval&mN=myConfirm_4&mT=myConfirm&mTs=ref'],
            'myConfirm_5' => ['title' => '최종(승인/반려)', 'url' => '/?cfg=menuApproval&mN=myConfirm_5&mT=myConfirm&mTs=done'],
            'myStart_3' => ['title' => '임시보관함', 'url' => '/?cfg=menuApproval&mN=myStart_3&mT=myStart&mTs=tempSave'],
        ]
    ];
}

if (HAS_DOCUMENT_MENU) {
    $_nav['menuDocument'] = [
        'title' => '문서',
        'icon' => 'fas fa-archive',
        'items' => [
            'documentWeek' => ['title' => '주간업무 보고서', 'url' => '/?cfg=menuDocument&mN=documentWeek&mT=report&mTs=week'],
            'documentMonth' => ['title' => '월간업무 보고서', 'url' => '/?cfg=menuDocument&mN=documentMonth&mT=report&mTs=month'],
            'documentShare' => ['title' => '일반 문서', 'url' => '/?cfg=menuDocument&mN=documentShare&mT=report&mTs=share'],
            'documentSales' => ['title' => '영업 현황', 'url' => '/?cfg=menuDocument&mN=documentSales&mT=report&mTs=sales'],
            'documentCompany' => ['title' => '경쟁사 현황', 'url' => '/?cfg=menuDocument&mN=documentCompany&mT=report&mTs=company'],
            'documentSalesReport' => ['title' => '영업 일일보고서', 'url' => '/?cfg=menuDocument&mN=documentSalesReport&mT=report&mTs=salesReport'],
            'documentASReport' => ['title' => 'A/S 일일보고서', 'url' => '/?cfg=menuDocument&mN=documentASReport&mT=report&mTs=asReport'],
        ]
    ];
}

if (HAS_ETC_MENU) {
    $_nav['menuEtc'] = [
        'title' => 'Todo 및 업무일정',
        'icon' => 'fal fa-atom',
        'items' => []
    ];

    if ($_SESSION['mbr']['myTodo']) {
        $_nav['menuEtc']['items']['myTodo'] = ['title' => 'my Todo', 'url' => '/?cfg=dashboard&mN=myTodo'];
    }
    $_nav['menuEtc']['items']['calendar'] = ['title' => '업무일정(전체)', 'url' => '/?cfg=dashboard&mN=calendar'];
}

if (___isAdmin()) {
    $_nav['complexConfig'] = [
        'title' => ___myManageHouse().' 설정',
        'icon' => 'fal fa-flag-checkered',
        'items' => [
            'configDong'      => [ 'title' => '동 구성관리' , 'url' => '/?cfg=complexConfig&mN=configDong&mG=complexConfig' ],
            'configHo'        => [ 'title' => '호실 관리'   , 'url' => '/?cfg=complexConfig&mN=configHo&mG=complexConfig' ],
        ]
    ];
}

if (___isAdmin()) {
    $_nav['adminMenu'] = [
        'title' => '관리자-환경설정',
        'icon' => 'fal fa-flag-checkered',
        'items' => [
            'docManager'        => [ 'title' => '최근문서'          , 'url' => '/?cfg=menuDocument&mN=docManager' ],
            'template'          => [ 'title' => 'HTML 템플리트'     , 'url' => '/?cfg=adminMenu&mN=template' ],
            'user'              => [ 'title' => '사용자'       , 'url' => '/?cfg=menuEnv&mN=user' ],
            'prEnv'             => [ 'title' => '프로젝트 환경설정'   , 'url' => '/?cfg=menuEnv&mN=prjEnv' ],
            'mesManual'         => [ 'title' => '사용자 메뉴얼'      , 'url' => '/?cfg=menuDocument&mN=docManager&docPrefix=MANUAL_001' ],
            //'part'            => [ 'title' => '조직(부서)'    , 'url' => '/?cfg=menuEnv&mN=part' ],
            //'inspectionType'  => [ 'title' => '불량유형관리'    , 'url' => '/?cfg=menuEnv&mN=inspectionType&mT=type1&iType=type1' ],
        ]
    ];
}

if (___isDeveloper()) {
    $_nav['menuDemo'] = [
        'title' => '데모',
        'icon' => 'fal fa-file-powerpoint',
        'items' => [
            'demo1' => ['title' => '데모 (1)', 'url' => '/?cfg=menuDemo&mN=demo1&mG=demo'],
            'demo2' => ['title' => '데모 (2)', 'url' => '/?cfg=menuDemo&mN=demo2&mG=demo'],
        ]
    ];
}