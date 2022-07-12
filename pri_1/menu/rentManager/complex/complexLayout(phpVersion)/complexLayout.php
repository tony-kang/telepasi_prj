<style>

</style>

<?php
___hasJavascript();     // 파일명과 같은 javascript가 load됩니다.( = demo.js.php )
___urlCss(MY_PRJ_ASSETS_URL.'/css/odnRentManager.css');

////##########################################################################################################
////##########################################################################################################
require_once ___EDIT_INCLUDE_FOR_DATA___;       // inc_func.php ,inc_dispFunc.php ,inc_parameter.php ,inc_main.php
//특수화면은 아래 내용 사용하지 않아도 됨 -->
//if ($_pg['edit']) require_once ___EDIT_INCLUDE_FOR_WORK___;       // inc_editData.php : 등록 / 수정 / 삭제
//else              require_once ___EDIT_INCLUDE_FOR_QUERY___;      // inc_query.php , inc_list.php : 조회 및 리스트


echo ___pageTitle('단지 구성도');
echo ___complexColorDesc();
echo '<div id="id_jsDongCanvas" class="complexLayout"></div>';