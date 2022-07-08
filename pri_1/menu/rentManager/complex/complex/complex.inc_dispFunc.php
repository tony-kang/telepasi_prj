<?php
function ___tableComplex($colArr,$dataArr,$p) {
    $html = html_tableStart($colArr,'id_tableComplexDong');
    //--------------------------------------
    foreach($dataArr['pageData'] as $complex) {
        //-----------------------------------------------------------------------------
        $aMenu = new ActionMenu();
        //-----------------------------------------------------------------------------
        //$aMenu->add(true,___amData(['obj-action'=>"edit_complex", 'obj-para'=>$encInOrder],'수정'));
        //$aMenu->add(true,___amData(['obj-action'=>"delete_inOrderItem", 'obj-para'=>$encInOrder],'삭제'));
        $actionMenu = $aMenu->html();

        $html .= html_tableTrStart();
        $html .= html_tableTd(true,$actionMenu);
        $html .= html_tableTd(true,$complex['COMPX_CD'],'center',['onClick'=>"___GET('mN=complex,mS=complexDong,complex=".$complex['COMPX_CD']."')"]);
        $html .= html_tableTd(true,$complex['COMPX_NM'],'left',['onClick'=>"___GET('mN=complex,mS=complexLayout,complex=".$complex['COMPX_CD']."')"]);
        $html .= html_tableTd(true,$complex['ADDR'],'left');
        $html .= html_tableTd(true,$complex['COMP_NM'],'left');
        $html .= html_tableTd(true,$complex['RENT_OFFICE_TEL']);
        $html .= html_tableTd(true,$complex['bank_name'],'left');

        $html .= html_tableTrEnd();
    }

    //--------------------------------------
    $html .= html_tableEnd();

    return $html;
}