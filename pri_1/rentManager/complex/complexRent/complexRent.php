<?php
$pageLog = new MyLog(__FILE__,false);

___hasJavascript();
//##########################################################################################################
//##########################################################################################################
require_once ___EDIT_INCLUDE_FOR_DATA___;       // inc_func.php ,inc_dispFunc.php ,inc_parameter.php ,inc_main.php
require_once ___EDIT_INCLUDE_FOR_QUERY___;      // inc_query.php , inc_list.php : 조회 및 리스트

$pageLog->end();