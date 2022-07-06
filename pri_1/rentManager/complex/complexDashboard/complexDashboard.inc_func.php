<?php

//임대 현황
function ___tableComplexDashboardRent($p) {

    $_colArr[0] = [
        /* 헤더 기준 칼럼  */
        [ 'if'=>true    ,'align'=>'C'   ,'caption'=>'임대 현황'  ,'height'=>50 ,'colSpan'=>3],
    ];

    $_colArr[1] = [
        /* 데이타 기준 칼럼  */
        [ 'if'=>true    ,'width'=>150 ],
        [ 'if'=>true    ,'width'=>180 ],
        [ 'if'=>true    ,'width'=>200 ],
    ];

    $mTable = new MyTable('id_tableComplexDeposit',[],$_colArr,['style'=>'width:250px;']);
    $mTable->tableStart();
    $mTable->tableHeadStartEnd();
    $mTable->tableBodyStart();

    //--------------------------------------
    $month = 3;
    $yearMonth = '202203';
    $weekMoveOutCnt = 10;  // 7일이내 퇴거 세대
    $monthMoveOutCnt = 10;  // 해당월 퇴거 세대
    $monthNewConttCnt = 10;  // 해당월 신규계약 세대

    $mTable->tableTrStart();
    $mTable->tableTd(sprintf('%d월 신규계약',$month),['colSpan'=>2]);
    $mTable->tableTd(number_format($monthNewConttCnt),['align'=>'right','tail'=>' 세대', 'onClick'=>"___GET('cfg=menuEnv,mN=complex,mS=complexRent,rent=yearMonth,baseMonth=".$yearMonth.",rentType=newContract,complex=".___myManageComplex()."')"]);
    $mTable->tableTrEnd();

    $mTable->tableTrStart();
    $mTable->tableTd(sprintf('%d월 갱신계약',$month),['colSpan'=>2]);
    $mTable->tableTd(number_format($monthNewConttCnt),['align'=>'right','tail'=>' 세대', 'onClick'=>"___GET('cfg=menuEnv,mN=complex,mS=complexRent,rent=yearMonth,baseMonth=".$yearMonth.",rentType=reContract,complex=".___myManageComplex()."')"]);
    $mTable->tableTrEnd();

    $mTable->tableTrStart();
    $mTable->tableTd('계약<br>만료',['rowSpan'=>2]);
    $mTable->tableTd('7일이내<br>퇴거');
    $mTable->tableTd(number_format($weekMoveOutCnt),['align'=>'right','tail'=>' 세대', 'onClick'=>"___GET('cfg=menuEnv,mN=complex,mS=complexRent,rent=latest,rentType=moveOut,complex=".___myManageComplex()."')"]);
    $mTable->tableTrEnd();

    $mTable->tableTrStart();
    $mTable->tableTd('당월<br>퇴거');
    $mTable->tableTd(number_format($monthMoveOutCnt),['align'=>'right','tail'=>' 세대', 'onClick'=>"___GET('cfg=menuEnv,mN=complex,mS=complexRent,rent=yearMonth,baseMonth=".$yearMonth.",rentType=moveOut,complex=".___myManageComplex()."')"]);
    $mTable->tableTrEnd();

    $mTable->tableBodyEnd();
    $mTable->tableEnd();


    return $mTable->getHtml();
}

//임대료현황
function ___tableComplexDashboardPayment($p) {
    $_colArr[0] = [
        /* 헤더 기준 칼럼  */
        [ 'if'=>true    ,'align'=>'C'   ,'caption'=>'임대료 현황'  ,'height'=>50, 'colSpan'=>3],
    ];

    $_colArr[1] = [
        /* 데이타 기준 칼럼  */
        [ 'if'=>true    ,'width'=>160 ],
        [ 'if'=>true    ,'width'=>160 ],
        [ 'if'=>true    ,'width'=>200 ],
    ];

    $mTable = new MyTable('id_tableComplexPayment',[],$_colArr,['style'=>'width:250px;']);
    $mTable->tableStart();
    $mTable->tableHeadStartEnd();
    $mTable->tableBodyStart();

    //--------------------------------------
    $month = 3;
    $monthReqAmount = 1000000;
    $monthPrincipal = 100000;  //해당월의 원금
    $monthLateFee = 100000;  //해당월의 연체료
    $monthOverPayment = 100000;  //해당월의 과납/오납

    $mTable->tableTrStart();
    $mTable->tableTd(sprintf('%d월 청구금액',$month),['colSpan'=>2]);
    $mTable->tableTd(number_format($monthReqAmount),['align'=>'right','tail'=>' 원']);
    $mTable->tableTrEnd();

    $mTable->tableTrStart();
    $mTable->tableTd('입금 금액',['rowSpan'=>4, 'class'=>'bg-primary-50', 'style'=>'border-right:none;']);
    $mTable->tableTd(number_format($monthPrincipal+$monthLateFee+$monthOverPayment),['colSpan'=>2,'align'=>'right','tail'=>' 원' , 'class'=>'bg-primary-50' , 'style'=>'border-left:none;']);
    $mTable->tableTrEnd();

    $mTable->tableTrStart();
    $mTable->tableTd('납부원금');
    $mTable->tableTd(number_format($monthPrincipal),['align'=>'right','tail'=>' 원']);
    $mTable->tableTrEnd();

    $mTable->tableTrStart();
    $mTable->tableTd('연체료');
    $mTable->tableTd(number_format($monthLateFee),['align'=>'right','tail'=>' 원']);
    $mTable->tableTrEnd();

    $mTable->tableTrStart();
    $mTable->tableTd('과오납');
    $mTable->tableTd(number_format($monthOverPayment),['align'=>'right','tail'=>' 원']);
    $mTable->tableTrEnd();

    $mTable->tableBodyEnd();
    $mTable->tableEnd();


    return $mTable->getHtml();
}

//보증금 현황
function ___tableComplexDashboardDeposit($p) {

    $_colArr[0] = [
        /* 헤더 기준 칼럼  */
        [ 'if'=>true    ,'align'=>'C'   ,'caption'=>'보증금 현황'  ,'height'=>50 ,'colSpan'=>2],
    ];

    $_colArr[1] = [
        /* 데이타 기준 칼럼  */
        [ 'if'=>true    ,'width'=>100 ],
        [ 'if'=>true    ,'width'=>100 ],
    ];

    $mTable = new MyTable('id_tableComplexDeposit',[],$_colArr,['style'=>'width:250px;']);
    $mTable->tableStart();
    $mTable->tableHeadStartEnd();
    $mTable->tableBodyStart();

    //--------------------------------------
    $month = 3;
    $complexDepositTotal = 1000000;
    $monthDepositIn = 100000;  //해당월의 보증금 입금액
    $monthDepositOut = 120000;  //해당월의 보증금 출금액

    $mTable->tableTrStart();
    $mTable->tableTd('보증금 총액');
    $mTable->tableTd(number_format($complexDepositTotal),['align'=>'right','tail'=>' 원']);
    $mTable->tableTrEnd();

    $mTable->tableTrStart();
    $mTable->tableTd(sprintf('%d월 입금 보증금',$month),['aligh'=>'right']);
    $mTable->tableTd(number_format($monthDepositIn),['align'=>'right','tail'=>' 원']);
    $mTable->tableTrEnd();

    $mTable->tableTrStart();
    $mTable->tableTd(sprintf('%d월 출금 보증금',$month),['aligh'=>'right']);
    $mTable->tableTd(number_format($monthDepositOut),['align'=>'right','tail'=>' 원']);
    $mTable->tableTrEnd();

    $mTable->tableBodyEnd();
    $mTable->tableEnd();


    return $mTable->getHtml();
}

//미납 현황
function ___tableComplexDashboardNonPayment($p) {

    $_colArr[0] = [
        /* 헤더 기준 칼럼  */
        [ 'if'=>true    ,'align'=>'C'   ,'caption'=>'미납 현황'  ,'height'=>50 ,'colSpan'=>3],
    ];

    $_colArr[1] = [
        /* 데이타 기준 칼럼  */
        [ 'if'=>true    ,'width'=>150 ],
        [ 'if'=>true    ,'width'=>180 ],
        [ 'if'=>true    ,'width'=>200 ],
    ];

    $mTable = new MyTable('id_tableComplexDeposit',[],$_colArr,['style'=>'width:250px;']);
    $mTable->tableStart();
    $mTable->tableHeadStartEnd();
    $mTable->tableBodyStart();

    //--------------------------------------
    $month = 3;
    $nonPaymentRentFeeCnt = 10;  // 임대료 미납 세대수
    $nonPaymentRentFee = 120000;  // 임대료 미납 총액
    $nonPaymentDepositCnt = 10;  // 보증금 미납 세대수
    $nonPaymentDeposit = 120000;  // 보증금 미납 총액

    $mTable->tableTrStart();
    $mTable->tableTd('미납<br>보증금',['rowSpan'=>2]);
    $mTable->tableTd('세대수');
    $mTable->tableTd(number_format($nonPaymentDepositCnt),['align'=>'right','tail'=>' 세대', 'onClick'=>"___GET('cfg=menuEnv,mN=complex,mS=complexPayment,payment=deposit,paymentType=nonPayment,complex=".___myManageComplex()."')"]);
    $mTable->tableTrEnd();

    $mTable->tableTrStart();
    $mTable->tableTd('총액');
    $mTable->tableTd(number_format($nonPaymentDeposit),['align'=>'right','tail'=>' 원']);
    $mTable->tableTrEnd();

    $mTable->tableTrStart();
    $mTable->tableTd('미납<br>임대료',['rowSpan'=>2]);
    $mTable->tableTd('세대수');
    $mTable->tableTd(number_format($nonPaymentRentFeeCnt),['align'=>'right','tail'=>' 세대', 'onClick'=>"___GET('cfg=menuEnv,mN=complex,mS=complexPayment,payment=rent,paymentType=nonPayment,complex=".___myManageComplex()."')"]);
    $mTable->tableTrEnd();

    $mTable->tableTrStart();
    $mTable->tableTd('총액');
    $mTable->tableTd(number_format($nonPaymentRentFee),['align'=>'right','tail'=>' 원']);
    $mTable->tableTrEnd();

    $mTable->tableBodyEnd();
    $mTable->tableEnd();


    return $mTable->getHtml();
}
