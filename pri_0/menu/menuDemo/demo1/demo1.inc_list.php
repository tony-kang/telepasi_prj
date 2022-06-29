<?php
/**
 * @author tony on 2021. 9. 18.
 * @author Tony Kang <bluein007@gmail.com>
 * Description
 *
 */
//##########################################################################################################
echo ___pageTitle($_editDb['title']);
echo html_searchAndButtons($_searchArr,$_btnArr);
if ($_listArr['pageDataCnt'] > 0) {
    echo html_pagination('','',$_listArr['pageDataCnt'],$_listArr['dataCnt'],$_pageArr);
    echo ___tableListDemo($_listArr,$_pg);
    echo html_pagination('','',$_listArr['pageDataCnt'],$_listArr['dataCnt'],$_pageArr);
} else {
    echo ___dataIsNone();
}

