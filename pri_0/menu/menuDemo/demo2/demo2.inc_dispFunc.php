<?php
/***
 * @param $dataArr  : 출력데이타 배열  : 실제데이타는 $dataArr[pageData]에 들어 있음.
 * @param $p        : 기본 파라미터 : $_pg가 연결된다.
 *
 * @return string
 */
function ___tableListDemo2($_listArr,$p) {
    $_colArr[0] = [
        /* 헤더 기준 칼럼  */
        [ 'if'=>true    ,'align'=>'C'   ,'caption'=>'#'  ,'width'=>40],
        [ 'if'=>true    ,'align'=>'C'   ,'caption'=>'data 1'  ,'width'=>60],
        [ 'if'=>true    ,'align'=>'C'   ,'caption'=>'data 2'  ,'width'=>80],
        [ 'if'=>true    ,'align'=>'C'   ,'caption'=>'data 3'   ,'width'=>60],
        [ 'if'=>true    ,'align'=>'C'   ,'caption'=>'data 4'   ,'width'=>60],
        [ 'if'=>true    ,'align'=>'C'   ,'caption'=>'data 5'   ,'width'=>60],
        [ 'if'=>true    ,'align'=>'C'   ,'caption'=>'data 6'   ,'width'=>60],
        [ 'if'=>true    ,'align'=>'C'   ,'caption'=>'data 7'   ,'width'=>60],
        [ 'if'=>false    ,'align'=>'C'   ,'caption'=>'data 8'   ,'width'=>60],
        [ 'if'=>false    ,'align'=>'C'   ,'caption'=>'data 9'   ,'width'=>60],
        [ 'if'=>false    ,'align'=>'C'   ,'caption'=>'data 10'   ,'width'=>60],
        [ 'if'=>true    ,'align'=>'C'   ,'caption'=>'upload 1'   ,'width'=>60],
        [ 'if'=>true    ,'align'=>'C'   ,'caption'=>'upload 2'   ,'width'=>60],
        [ 'if'=>true    ,'align'=>'C'   ,'caption'=>'upload 3'   ,'width'=>60],
        [ 'if'=>true    ,'align'=>'C'   ,'caption'=>'등록일'   ,'width'=>60],
        [ 'if'=>true    ,'align'=>'C'   ,'caption'=>'등록자'   ,'width'=>60],
        [ 'if'=>true    ,'align'=>'C'   ,'caption'=>'Action'  ,'width'=>30]
    ];

    $mTable = new MyTable('',$_listArr,$_colArr);
    $mTable->tableStart();
    $mTable->tableHeadStartEnd();
    $mTable->tableBodyStart();

    //--------------------------------------
    $i = 1;
    foreach($_listArr['pageData'] as $d) {
        // 자유롭게 코딩가능한 영역입니다.

        //-----------------------------------------------------------------------------
        $aMenu = new ActionMenu();
        $encNo = ___makeEncode($d['no']);
        $aMenu->add(true,___amData(['obj-action'=>"edit_demoData", 'obj-para'=>$encNo],'수정'));
        $aMenu->add(true,___amData(['obj-action'=>"delete_demoData", 'obj-para'=>$encNo],'삭제'));
        $actionMenu = $aMenu->html();


        $mTable->tableTrStart();    //'bg-fusion-500'
        $mTable->tableTd($d['no']);
        $mTable->tableTd($d['data_1']);
        $mTable->tableTd($d['data_2']);
        $mTable->tableTd($d['data_3']);
        $mTable->tableTd($d['data_4']);
        $mTable->tableTd($d['data_5']);
        $mTable->tableTd($d['data_6']);
        $mTable->tableTd($d['data_7']);
        $mTable->tableTd($d['data_8']);
        $mTable->tableTd($d['data_9']);
        $mTable->tableTd($d['data_10']);
        $mTable->tableTd($d['upload1']);
        $mTable->tableTd($d['upload2']);
        $mTable->tableTd($d['upload3']);
        $mTable->tableTd(___date($d['regDate']));
        $mTable->tableTd($d['regMbrName']);
        $mTable->tableTd($actionMenu);
        $mTable->tableTrEnd();
        $i++;
    }

    $mTable->tableBodyEnd();
    $mTable->tableEnd();

    return $mTable->getHtml();
}