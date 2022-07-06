<?php

___hasJavascript();
//##########################################################################################################
//##########################################################################################################
if ($_pg['ext']) {
    require_once ___EDIT_INCLUDE_FOR_EXT___;        // inc_parameter.php ,view/view_XXX.php : 뷰
} else {
    require_once ___EDIT_INCLUDE_FOR_DATA___;       // inc_func.php ,inc_dispFunc.php ,inc_parameter.php ,inc_main.php
    if ($_pg['edit']) require_once ___EDIT_INCLUDE_FOR_WORK___;       // inc_editData.php : 등록 / 수정 / 삭제
    else              require_once ___EDIT_INCLUDE_FOR_QUERY___;      // inc_query.php , inc_list.php : 조회 및 리스트
}
