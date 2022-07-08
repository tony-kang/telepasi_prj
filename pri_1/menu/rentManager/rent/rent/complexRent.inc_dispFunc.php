<?php

function ___tableComplexRent($dataArr,$p) {
    $_colArr[0] = [
        /* 헤더 기준 칼럼  */
        [ 'if'=>true    ,'align'=>'C'   ,'caption'=>'동'  ,'width'=>50],
        [ 'if'=>true    ,'align'=>'C'   ,'caption'=>'호'  ,'width'=>50],
        [ 'if'=>true    ,'align'=>'C'   ,'caption'=>'Action'  ,'width'=>50],
        [ 'if'=>true    ,'align'=>'C'   ,'caption'=>'유형'   ,'width'=>60],
        [ 'if'=>true    ,'align'=>'C'   ,'caption'=>'공급타입'   ,'width'=>80],
        [ 'if'=>true    ,'align'=>'C'   ,'caption'=>'계약번호'  ,'width'=>70],
        [ 'if'=>true    ,'align'=>'C'   ,'caption'=>'계약일'  ,'width'=>70],
        [ 'if'=>true    ,'align'=>'R'   ,'caption'=>'임대보증금'  ,'width'=>90],
        [ 'if'=>true    ,'align'=>'R'   ,'caption'=>'임대료'  ,'width'=>70],
        [ 'if'=>true    ,'align'=>'R'   ,'caption'=>'대출금'  ,'width'=>90],
        [ 'if'=>true    ,'align'=>'C'   ,'caption'=>'전세권<br>설정'  ,'width'=>50],
        [ 'if'=>true    ,'align'=>'C'   ,'caption'=>'성명'  ,'width'=>60],
        [ 'if'=>true    ,'align'=>'C'   ,'caption'=>'연락처'  ,'width'=>80],
        [ 'if'=>true    ,'align'=>'C'   ,'caption'=>'임대시작일'  ,'width'=>70],
        [ 'if'=>true    ,'align'=>'C'   ,'caption'=>'임대종료일'  ,'width'=>70],
    ];


    $mTable = new MyTable('id_ableComplexRent',$dataArr,$_colArr);
    $mTable->tableStart();
    $mTable->tableHeadStartEnd();
    $mTable->tableBodyStart();

    //--------------------------------------
    $if_1 = ___isAdmin();
    $i = 1;
    foreach($dataArr['pageData'] as $rHouse) {
        //-----------------------------------------------------------------------------
        $aMenu = new ActionMenu();
        //-----------------------------------------------------------------------------
        $hoEditUrl = sprintf('?cfg=menuEnv&mN=complex&mS=complexHoDetail&complex=%s&sDong=%s&sHo=%s',$rHouse['COMPX_CD'],$rHouse['DONG_NO'],$rHouse['HO_NO']);
        $aMenu->add(true,___amHref($hoEditUrl,sprintf('%s동 %s호 상세',$rHouse['DONG_NO'],$rHouse['HO_NO'])));
        $actionMenu = $aMenu->html();

        $lesSetYN = $rHouse['LES_SET_YN'] == 'Y' ? 'Y' : '-';

        $mTable->tableTrStart();
        $mTable->tableTd($rHouse['DONG_NO']);
        $mTable->tableTd($rHouse['HO_NO']);
        $mTable->tableTd($actionMenu);
        $mTable->tableTd($rHouse['ROOM_TP']);
        $mTable->tableTd(_roomTypeArr($rHouse['SUP_TYPE']));
        $mTable->tableTd($rHouse['CONTT_NO']);
        $mTable->tableTd(___date($rHouse['CONTT_YMD']));
        $mTable->tableTd(number_format($rHouse['LEAS_DPST_AMT']),['align'=>'right']);
        $mTable->tableTd(number_format($rHouse['RENT_AMT']),['align'=>'right','class'=>'bg-success-50']);
        $mTable->tableTd(number_format($rHouse['LNS_AMT']),['align'=>'right']);
        $mTable->tableTd($lesSetYN);
        $mTable->tableTd($rHouse['NAME']);
        $mTable->tableTd(___phoneNo($rHouse['TEL_NO']));
        $mTable->tableTd(___date($rHouse['LEAS_STR_YMD']));
        $mTable->tableTd(___date($rHouse['LEAS_END_YMD']));
        $mTable->tableTrEnd();
        $i++;
    }

    $mTable->tableBodyEnd();
    $mTable->tableEnd();


    return $mTable->getHtml();
}