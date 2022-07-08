<?php

function ___tableComplexDongHo($_listArr,$p) {
    $_colArr[0] = [
         /* 헤더 기준 칼럼  */
        [ 'if'=>true    ,'align'=>'C'   ,'caption'=>'#'  ,'width'=>40],
        [ 'if'=>true    ,'align'=>'C'   ,'caption'=>'Action'  ,'width'=>30],
        [ 'if'=>true    ,'align'=>'C'   ,'caption'=>'동'  ,'width'=>80],
        [ 'if'=>true    ,'align'=>'C'   ,'caption'=>'층'  ,'width'=>40],
        [ 'if'=>true    ,'align'=>'C'   ,'caption'=>'호'   ,'width'=>80],
        [ 'if'=>true    ,'align'=>'C'   ,'caption'=>'시설명'   ,'width'=>150],
        [ 'if'=>true    ,'align'=>'C'   ,'caption'=>'상태'   ,'width'=>100],

        [ 'if'=>true    ,'align'=>'C'   ,'caption'=>'유형'   ,'width'=>100],
        [ 'if'=>true    ,'align'=>'C'   ,'caption'=>'공급타입'   ,'width'=>100],
        [ 'if'=>true    ,'align'=>'C'   ,'caption'=>'계약번호'   ,'width'=>100],
        [ 'if'=>true    ,'align'=>'C'   ,'caption'=>'계약일'   ,'width'=>100],
        [ 'if'=>true    ,'align'=>'C'   ,'caption'=>'임대보증금'   ,'width'=>100],
        [ 'if'=>true    ,'align'=>'C'   ,'caption'=>'임대료'   ,'width'=>100],
        [ 'if'=>true    ,'align'=>'C'   ,'caption'=>'대출금'   ,'width'=>100],
        [ 'if'=>true    ,'align'=>'C'   ,'caption'=>'이름'   ,'width'=>100],
        [ 'if'=>true    ,'align'=>'C'   ,'caption'=>'연락처'   ,'width'=>100],

        [ 'if'=>true    ,'align'=>'C'   ,'caption'=>'수정일'   ,'width'=>50],
        [ 'if'=>true    ,'align'=>'C'   ,'caption'=>'수정자'   ,'width'=>50],
        [ 'if'=>true    ,'align'=>'C'   ,'caption'=>'등록일'   ,'width'=>50],
        [ 'if'=>true    ,'align'=>'C'   ,'caption'=>'등록자'   ,'width'=>50],
    ];

    $mTable = new MyTable('',$_listArr,$_colArr);
    $mTable->tableStart();
    $mTable->tableHeadStartEnd();
    $mTable->tableBodyStart();

    //--------------------------------------
    $i = 1;
    foreach($_listArr['pageData'] as $ho) {
        // 자유롭게 코딩가능한 영역입니다.

        $encHo = ___makeEncode($ho['no']);
        //-----------------------------------------------------------------------------
        $aMenu = new ActionMenu();
        $aMenu->add(true,___amData(['obj-action'=>"edit_ho", 'ho'=>$encHo],'수정'));
        $actionMenu = $aMenu->html();

        $dongHoState = ___hoState($ho['state']);
        $supType = _roomTypeArr($rentHouse['SUP_TYPE']);

        $mTable->tableTrStart();    //'bg-fusion-500'
        $mTable->tableTd($ho['no']);
        $mTable->tableTd($actionMenu);
        $mTable->tableTd($ho['dong']);
        $mTable->tableTd($ho['floor']);
        $mTable->tableTd($ho['ho']);
        $mTable->tableTd($ho['nickname'],['align'=>'left']);
        $mTable->tableTd($dongHoState);

        $mTable->tableTd($ho['ROOM_TP']);
        $mTable->tableTd($supType);
        $mTable->tableTd($ho['CONTT_NO']);
        $mTable->tableTd(___date($ho['CONTT_YMD']));
        $mTable->tableTd(number_format($ho['LEAS_DPST_AMT']),['align'=>'right']);
        $mTable->tableTd(number_format($ho['RENT_AMT']),['align'=>'right']);
        $mTable->tableTd(number_format($ho['LNS_AMT']),['align'=>'right']);
        $mTable->tableTd($ho['NAME']);
        $mTable->tableTd(___phoneNo($ho['TEL_NO']));

        $mTable->tableTd(___date($ho['updateDate']));
        $mTable->tableTd($ho['updateMbrName']);
        $mTable->tableTd(___date($ho['regDate']));
        $mTable->tableTd($ho['regMbrName']);
        $mTable->tableTrEnd();
        $i++;
    }

    $mTable->tableBodyEnd();
    $mTable->tableEnd();

    return $mTable->getHtml();
}