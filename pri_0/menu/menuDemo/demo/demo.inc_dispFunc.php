<?php
/***
 * @param $dataArr  : 출력데이타 배열  : 실제데이타는 $dataArr[pageData]에 들어 있음.
 * @param $p        : 기본 파라미터 : $_pg가 연결된다.
 *
 * @return string
 */
function ___tableListDemo($_listArr,$p) {
    $_colArr[0] = [
        /* 헤더 기준 칼럼  */
        [ 'if'=>true    ,'align'=>'C'   ,'caption'=>'#'  ,'width'=>40],
        [ 'if'=>true    ,'align'=>'C'   ,'caption'=>'data 1'  ,'width'=>60],
        [ 'if'=>true    ,'align'=>'C'   ,'caption'=>'data 2'  ,'width'=>80],
        [ 'if'=>true    ,'align'=>'C'   ,'caption'=>'data 3'   ,'width'=>60],
        [ 'if'=>true    ,'align'=>'C'   ,'caption'=>'data 4'   ,'width'=>60],
        [ 'if'=>true    ,'align'=>'C'   ,'caption'=>'등록일'   ,'width'=>60],
        [ 'if'=>true    ,'align'=>'C'   ,'caption'=>'등록자'   ,'width'=>60],
        [ 'if'=>true    ,'align'=>'C'   ,'caption'=>'Action'  ,'width'=>60]
    ];

    $mTable = new MyTable('',$_listArr,$_colArr);
    $mTable->tableStart();
    $mTable->tableHeadStartEnd();
    $mTable->tableBodyStart();

    //--------------------------------------
    $i = 1;
    foreach($_listArr['pageData'] as $d) {
        $aMenu = new ActionMenu();
        //-----------------------------------------------------------------------------
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
        $mTable->tableTd($d['regMbrName']);
        $mTable->tableTd(___date($d['regDate']));
        $mTable->tableTd($actionMenu);
        $mTable->tableTrEnd();
        $i++;
    }

    $mTable->tableBodyEnd();
    $mTable->tableEnd();

    return $mTable->getHtml();
}