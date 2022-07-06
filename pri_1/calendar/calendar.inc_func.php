<?php
// 파리미터에서 사용된다던지등
// display와 상관없는 함수를 정의하는데 사용됨.
function ___getSpecialScheduleArr($productName='') {
    $arr = [
        'product' => $productName.' 제품생산 일정',
        'process' => $productName.' 작업공정 일정',
        'attendance' => $productName.' 작업자 주요일정(근태)'
    ];

    return $arr;
}

function ___getScheduleTitle($schGroup,$p) {
    //파리미터 확인하려면
    //___print($p,'달력 일정 제목을 정하기 위한 파라미터');

    $productNo = $p['productNo'] ?? 0;
    if ($productNo) {
        $product = ___getProduct($productNo);
        $productName = $product['modelNo'] ?? '';
        $arr = ___getSpecialScheduleArr($productName);
        $title = $arr[$schGroup] ?? '일정';
    } else {
        $title = sprintf('%s 일정','');
    }

    return $title;
}