<?php
// modify the navigation for demonstration purposes
$_nav['dashboard'] = [
    'title' => 'Dashboard',
    'icon' => 'fal fa-analytics',
    'items' => [
        'custCountry' => [
            'title' => '글로벌 고객현황(1)',
            'url' => '/?cfg=dashboard&mN=custCountry'
        ],
        'globalCustomer' => [
            'title' => '글로벌 고객현황(2)',
            'url' => '/?cfg=dashboard&mN=globalCustomer'
        ],
        'globalCustomer2' => [
            'title' => '글로벌 고객현황(3)',
            'url' => '/?cfg=dashboard&mN=globalCustomer2'
        ]
    ]
];

$_nav['menuDemo'] = [
    'title' => '데모',
    'icon' => 'fal fa-file-powerpoint',
    'items' => [
        'demo1'      => [ 'title' => '데모 (1)', 'url' => '/?cfg=menuDemo&mN=demo1&mG=demo' ],
        'demo2'      => [ 'title' => '데모 (2)', 'url' => '/?cfg=menuDemo&mN=demo2&mG=demo' ],
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
    $_nav['adminMenu'] = [
        'title' => '관리자-환경설정',
        'icon' => 'fal fa-flag-checkered',
        'items' => [
            'template'          => [ 'title' => 'HTML 템플리트'     , 'url' => '/?cfg=adminMenu&mN=template&mG=template' ],
            'user'              => [ 'title' => '사용자'       , 'url' => '/?cfg=adminMenu&mN=user&mG=user' ],
            'part'            => [ 'title' => '조직(부서)'    , 'url' => '/?cfg=adminMenu&mN=part&mG=user' ],
        ]
    ];
}