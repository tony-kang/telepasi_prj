<?php

function ___tableComplexDongHo($colArr,$dataArr,$p) {

    $html = html_tableStart($colArr,'id_tableComplexDong');
    //--------------------------------------
    foreach($dataArr['pageData'] as $ho) {
        $encHo = ___makeEncode($ho['no']);
        //$ho = db_getDbData(S_DB,'rm_ho','count(*) as cnt',sprintf('complex="%s" and dongNo=%d',$cDong['complex'],$cDong['no']));

        //-----------------------------------------------------------------------------
        $aMenu = new ActionMenu();
        //-----------------------------------------------------------------------------
        $aMenu->add(true,___amData(['obj-action'=>"edit_ho", 'ho'=>$encHo],'수정'));
        //$aMenu->add(true,___amData(['obj-action'=>"delete_ho", 'ho'=>$encHo],'삭제'));
        $actionMenu = $aMenu->html();

//        $salesColorClass = ' bg-info-50 ';
//        $stepBackColor = ($item['oState']) ? $salesColorClass : ' ';
        $dongHoState = ___hoState($ho['state']);

        $html .= html_tableTrStart();
        $html .= html_tableTd(true,$ho['no']);
        $html .= html_tableTd(true,$actionMenu);
        $html .= html_tableTd(true,$ho['dong']);
        $html .= html_tableTd(true,$ho['floor']);
        $html .= html_tableTd(true,$ho['ho']);
        $html .= html_tableTd(true,$ho['nickname'],'left');
        $html .= html_tableTd(true,$dongHoState);
        $html .= html_tableTd(true,___date($ho['updateDate']));
        $html .= html_tableTd(true,$ho['updateMbrName']);
        $html .= html_tableTd(true,___date($ho['regDate']));
        $html .= html_tableTd(true,$ho['regMbrName']);

        $html .= html_tableTrEnd();
    }

    //--------------------------------------
    $html .= html_tableEnd();

    return $html;
}