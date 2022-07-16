<?php
/***
 * @param $dataArr  : 출력데이타 배열  : 실제데이타는 $dataArr[pageData]에 들어 있음.
 * @param $p        : 기본 파라미터 : $_pg가 연결된다.
 *
 * @return string
 */
function ___tableListDemo1($_listArr,$p) {
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
        [ 'if'=>true    ,'align'=>'C'   ,'caption'=>'data 8'   ,'width'=>60],
        [ 'if'=>true    ,'align'=>'C'   ,'caption'=>'data 9'   ,'width'=>60],
        [ 'if'=>true    ,'align'=>'C'   ,'caption'=>'data 10'   ,'width'=>60],
        [ 'if'=>true    ,'align'=>'C'   ,'caption'=>'data 11'  ,'width'=>60],
        [ 'if'=>true    ,'align'=>'C'   ,'caption'=>'data 12'  ,'width'=>80],
        [ 'if'=>true    ,'align'=>'C'   ,'caption'=>'data 13'   ,'width'=>60],
        [ 'if'=>true    ,'align'=>'C'   ,'caption'=>'data 14'   ,'width'=>60],
        [ 'if'=>true    ,'align'=>'C'   ,'caption'=>'data 15'   ,'width'=>60],
        [ 'if'=>true    ,'align'=>'C'   ,'caption'=>'data 16'   ,'width'=>60],
        [ 'if'=>true    ,'align'=>'C'   ,'caption'=>'data 17'   ,'width'=>60],
        [ 'if'=>true    ,'align'=>'C'   ,'caption'=>'data 18'   ,'width'=>60],
        [ 'if'=>true    ,'align'=>'C'   ,'caption'=>'data 19'   ,'width'=>60],
        [ 'if'=>true    ,'align'=>'C'   ,'caption'=>'data 20'   ,'width'=>60],
        [ 'if'=>true    ,'align'=>'C'   ,'caption'=>'number 21'   ,'width'=>60],
        [ 'if'=>true    ,'align'=>'C'   ,'caption'=>'number 22'   ,'width'=>60],
        [ 'if'=>true    ,'align'=>'C'   ,'caption'=>'text 31'   ,'width'=>60],
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
    $d5Arr = ___envArr('X006','env_demo.txt');
    $d15Arr = ___calendarGroupArr();

    foreach($_listArr['pageData'] as $d) {
        // 자유롭게 코딩가능한 영역입니다.

        //-----------------------------------------------------------------------------
        $aMenu = new ActionMenu();
        $encNo = ___makeEncode($d['no']);
        $aMenu->add(true,___amData(['obj-action'=>"edit_demoData", 'obj-para'=>$encNo],'수정'));
        $aMenu->add(true,___amData(['obj-action'=>"delete_demoData", 'obj-para'=>$encNo],'삭제'));
        $actionMenu = $aMenu->html();

        $d5 = ___getCheckBoxValue($d5Arr,$d['data_5']);
        $d15 = $d15Arr[$d['data_15']];

        $mTable->tableTrStart();    //'bg-fusion-500'
        $mTable->tableTd($d['no']);
        $mTable->tableTd($d['data_1']);
        $mTable->tableTd($d['data_2']);
        $mTable->tableTd($d['data_3']);
        $mTable->tableTd($d['data_4']);
        $mTable->tableTd($d5);
        $mTable->tableTd($d['data_6']);
        $mTable->tableTd($d['data_7']);
        $mTable->tableTd($d['data_8']);
        $mTable->tableTd($d['data_9']);
        $mTable->tableTd($d['data_10']);
        $mTable->tableTd($d['data_11']);
        $mTable->tableTd($d['data_12']);
        $mTable->tableTd($d['data_13']);
        $mTable->tableTd($d['data_14']);
        $mTable->tableTd($d15);
        $mTable->tableTd($d['data_16']);
        $mTable->tableTd($d['data_17']);
        $mTable->tableTd($d['data_18']);
        $mTable->tableTd($d['data_19']);
        $mTable->tableTd($d['data_20']);
        $mTable->tableTd($d['number_21']);
        $mTable->tableTd($d['number_22']);
        $mTable->tableTd($d['text_31']);
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