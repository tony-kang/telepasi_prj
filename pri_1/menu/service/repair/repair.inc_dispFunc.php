<?php
/***
 * 화면출력 함수
 * @param $dataArr  : 출력데이타 배열  : 실제데이타는 $dataArr[pageData]에 들어 있음.
 * @param $p        : 기본 파라미터 : $_pg가 연결된다.
 *
 * @return string
 */
function ___tableSurveyList($_listArr,$p) {
    $_colArr[0] = [
        /* 헤더 기준 칼럼  */
        [ 'if'=>true    ,'align'=>'C'   ,'caption'=>'#'  ,'width'=>40],
        [ 'if'=>true    ,'align'=>'L'   ,'caption'=>'제목'  ,'width'=>200],
        [ 'if'=>true    ,'align'=>'L'   ,'caption'=>'URL'  ,'width'=>150],
        [ 'if'=>true    ,'align'=>'C'   ,'caption'=>'조사마감일'  ,'width'=>80],
        [ 'if'=>true    ,'align'=>'C'   ,'caption'=>'제공자'   ,'width'=>60],
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
        $mTable->tableTd($d['title'],['align'=>'left']);
        $mTable->tableTd(___href($d['url'],['href'=>$d['url']]),['align'=>'left']);
        $mTable->tableTd(___date($d['expireDate']));
        $mTable->tableTd($d['provider']);
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