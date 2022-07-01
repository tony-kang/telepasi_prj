<?php
/**
 * @author tony on 2021. 9. 18.
 * @author Tony Kang <bluein007@gmail.com>
 * Description
 *
 */
//##########################################################################################################
echo ___pageTitle($_editDb['mainTitle']);
echo html_searchAndButtons($_searchArr,$_btnArr);
if ($_listArr['pageDataCnt'] > 0) {
    echo ___pageInfo($_listArr['pageDataCnt'],$_listArr['dataCnt'],$_pageArr);
    echo ___tableListDemo1($_listArr,$_pg);
    echo ___pageInfo($_listArr['pageDataCnt'],$_listArr['dataCnt'],$_pageArr);

    if (is_array($_excelDialog)) {
        $_excelDialog['listQuery'] = ___makeCsvQuery($_listArr['q']);
        echo ___saveExcelDialog($_excelDialog); //excel 저장 Dialog
    }
} else {
    echo ___dataIsNone();
}
