<?php
if ($_listArr['pageDataCnt'] > 0) {
    echo html_pagination($_editDb['title'],'',$_listArr['pageDataCnt'],$_listArr['dataCnt'],$_pageArr);
    echo html_searchAndButtons($_searchArr,$_btnArr);
    echo ___tableComplexDongHo($_colArr ,$_listArr,$_pg);
    echo html_pagination('','',$_listArr['pageDataCnt'],$_listArr['dataCnt'],$_pageArr);
} else {
    echo html_pagination($_editDb['title'],'',$_listArr['pageDataCnt'],$_listArr['dataCnt'],$_pageArr);
    echo html_searchAndButtons($_searchArr,$_btnArr);
    echo ___dataIsNone();
}