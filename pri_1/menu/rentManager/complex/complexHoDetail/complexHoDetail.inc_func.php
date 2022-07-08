<?php

function ___tableHo_conttInfo($ho,$p) {
    $iData = new MyItemData(array(12,20,12,20,12,20)); // 2개가 한쌍 : 6개 = 3개의 데이타쌍으로 구성됨
    //--------------------------------------
        $data = sprintf('%s동 %s호',$ho['dong'],$ho['ho']);
    $iData->addData('동호수',$data);
    $iData->addData('계약번호','S-0000001');
    $iData->addData('타입','37B');
    //--------------------------------------
    $iData->addData('계약일자',['data'=>'2020-06-10','para'=>['class'=>'td-item bg-primary-500']]);
    $iData->addData('약정 보증금','137,000,000원(일억삼천칠백만원)');
    $iData->addData('약정 임대료','670,000원(육십칠만원)');
    //--------------------------------------
    $iData->addData('임대차 계약기간','2020-06-20 ~ 2022-06-19');
    $iData->addData();
    $iData->addData();
    //--------------------------------------
    $iData->addData('상태',['data'=>'입주','para'=>['class'=>'td-item bg-primary-500']]);
    $iData->addData('업무',['data'=>'처리업무 없음','para'=>['class'=>'td-item bg-danger-500']]);
    $iData->addData('수납',['data'=>'미납 없음','para'=>['class'=>'td-item bg-success-500']]);
    //--------------------------------------
    $iData->addData('대출여부','있음');
        $data = ___btn('복사',['data'=>'1234-5678']);
    $iData->addData('임대료 계좌',$data);
        $data = ___btn('복사',['data'=>'1234-5678']);
    $iData->addData('보증금 계좌',$data);
    //--------------------------------------

    return $iData->html();
}
