<?php

function ___tableComplexDong($dataArr,$p) {
    $_colArr[0] = [
        /* 헤더 기준 칼럼  */
        [ 'if'=>true    ,'align'=>'C'   ,'caption'=>'#'         ,'rowSpan'=>2    ,'class'=>'bg-success-100' ],
        [ 'if'=>true    ,'align'=>'C'   ,'caption'=>'단지'        ,'colSpan'=>4    ,'class'=>'bg-primary-100'],
        [ 'if'=>true    ,'align'=>'C'   ,'caption'=>'층별 호구성'   ,'colSpan'=>3     ,'class'=>'bg-primary-300'],
        [ 'if'=>true    ,'align'=>'C'   ,'caption'=>'수정일' ,'rowSpan'=>2],
        [ 'if'=>true    ,'align'=>'C'   ,'caption'=>'수정자' ,'rowSpan'=>2],
        [ 'if'=>true    ,'align'=>'C'   ,'caption'=>'등록일' ,'rowSpan'=>2],
        [ 'if'=>true    ,'align'=>'C'   ,'caption'=>'등록자' ,'rowSpan'=>2]
    ];

    $_colArr[1] = [
        /* 헤더 기준 칼럼  */
        [ 'if'=>true    ,'align'=>'C'   ,'caption'=>'단지코드'  ,'height'=>50],
        [ 'if'=>true    ,'align'=>'C'   ,'caption'=>'Action' ],
        [ 'if'=>true    ,'align'=>'C'   ,'caption'=>'동' ],
        [ 'if'=>true    ,'align'=>'C'   ,'caption'=>'최고층' ],
        [ 'if'=>true    ,'align'=>'C'   ,'caption'=>'세대수/층'         ,'class'=>'bg-primary-300'],
        [ 'if'=>true    ,'align'=>'C'   ,'caption'=>'호실 구성 방법'      ,'class'=>'bg-primary-300'],
        [ 'if'=>true    ,'align'=>'R'   ,'caption'=>'호개수(자동생성)'     ,'class'=>'bg-primary-300'],
    ];

    $_colArr[2] = [
        /* 데이타 기준 칼럼  */
        [ 'if'=>true    ,'width'=>60 ],
        [ 'if'=>true    ,'width'=>80 ],
        [ 'if'=>true    ,'width'=>30 ],
        [ 'if'=>true    ,'width'=>80 ],
        [ 'if'=>true    ,'width'=>80 ],
        [ 'if'=>true    ,'width'=>80 ],
        [ 'if'=>true    ,'width'=>200],
        [ 'if'=>true    ,'width'=>150],
        [ 'if'=>true    ,'width'=>80 ],
        [ 'if'=>true    ,'width'=>80 ],
        [ 'if'=>true    ,'width'=>80 ],
        [ 'if'=>true    ,'width'=>80 ],
    ];

    $mTable = new MyTable('id_tableComplexDong',$dataArr,$_colArr);
    $mTable->tableStart();
    $mTable->tableHeadStartEnd();
    $mTable->tableBodyStart();

    //--------------------------------------
    $if_1 = ___isAdmin();
    $i = 1;
    foreach($dataArr['pageData'] as $cDong) {
        $encDong = ___makeEncode($cDong['no']); //___debug($encDong);
        $sql = db_getDbData(S_DB,'rm_ho','count(*) as hoCntAll',sprintf('complex="%s" and dongNo=%d',$cDong['complex'],$cDong['no']));
        $hoCntAll = $sql['hoCntAll'];
        $if_make = ($if_1 && ($hoCntAll ? false : true));
        //___debug($if_1.' : '.$hoCntAll.' : '.$sql['q']);

        //-----------------------------------------------------------------------------
        $aMenu = new ActionMenu();
        //-----------------------------------------------------------------------------
        $aMenu->add(true,___amData(['obj-action'=>"edit_complexDong", 'dong'=>$encDong],'수정'));
        $aMenu->add(($hoCntAll > 0),___amData(['obj-action'=>"delete_complexDongHoData", 'dong'=>$encDong, 'dong-text'=>$cDong['dong']],sprintf('%s동 %s 개 호실정보 삭제',$cDong['dong'],$hoCntAll)));
        $aMenu->add($if_make,___amData(['obj-action'=>"make_complexDongHoData", 'dong'=>$encDong, 'dong-text'=>$cDong['dong']],sprintf('%s동 호실 정보만들기',$cDong['dong'])));
        $aMenu->add(($hoCntAll > 0),___amData(['obj-action'=>"make_complexDongHoShareData", 'dong'=>$encDong, 'dong-text'=>$cDong['dong']],sprintf('%s동 쉐어정보 만들기',$cDong['dong'])));
        $aMenu->add(($hoCntAll == 0),___amData(['obj-action'=>"delete_complexDong", 'dong'=>$encDong],'삭제'));
        $actionMenu = $aMenu->html();

        $mTable->tableTrStart();
        $mTable->tableTd($i);
        $mTable->tableTd($cDong['complex'],['title'=>$cDong['no']]);
        $mTable->tableTd($actionMenu);
        $mTable->tableTd($cDong['dong'],['onClick'=>"___GET('mN=configHo,complex=".$cDong['complex'].",dong=".$encDong."')"]);
        $mTable->tableTd($cDong['maxFloor']);

        $mTable->tableTd($cDong['hoCnt']);
        $mTable->tableTd($cDong['hoFormat']);

        if ($hoCntAll == 0) $mTable->tableTd('<my class="my-text-danger">정보 없음</my>',['align'=>'right']);
        else                $mTable->tableTd(number_format($hoCntAll),['align'=>'right','tail'=>' 개']);

        $mTable->tableTd(___date($cDong['updateDate']));
        $mTable->tableTd($cDong['updateMbrName']);
        $mTable->tableTd(___date($cDong['regDate']));
        $mTable->tableTd($cDong['regMbrName']);
        $mTable->tableTrEnd();
        $i++;
    }

    $mTable->tableBodyEnd();
    $mTable->tableEnd();


    return $mTable->getHtml();
}
