<?php
/**
 * @author tony on 2022. 1. 28.
 * @author Tony Kang <bluein007@gmail.com>
 * Description
 *
 */

function _chartSalesCountry($sO) {
    $logHandle = ___logStart("json_pieChart");
    ___logArray($logHandle,$sO);
    $sql = db_getDbRows(S_DB,'t_country as C,erp_customers','C.code, C.country , count(*) as custCnt','C.no = T.countryCode group by T.countryCode','custCnt desc');

    ___log($logHandle,$sql['q']);

    $jsonArr = [];
    if ($sql['dataCnt']) {
        $jsonArr['result'] = 'OK';
        $jsonArr['chartTitle'] = '글로벌 고객현황(3)';
        $jsonArr['chartData'] = [];

        foreach ($sql['pageData'] as $p) {
            //$arr = ['country'=>$p['country'],'custCnt'=>$p['custCnt']];
            $arr = [$p['country'],$p['custCnt']];
            //___logArray($logHandle,$arr);
            array_push($jsonArr['chartData'], $arr);
        }
    } else {
        $jsonArr['result'] = 'ER';
    }

    ___logArray($logHandle,$jsonArr);

    //-------------------------------------------------------------------------------------
    ___logEnd($logHandle);
    echo json_encode($jsonArr,JSON_NUMERIC_CHECK);
}

function _chartSalesProductCate_1($sO) {
    $logHandle = ___logStart("json_pieChart");
    ___logArray($logHandle,$sO);

    $year = $sO['year'];
    $sql = db_getDbRows(S_DB,
                        'erp_product as P,erp_inOrderItems',
                        'P.cate_1,sum(T.unitPrice * T.qty) as sAmount,sum(T.qty) as sCount',
                        'P.no = T.productNo and T.deleted = 0 and T.oState = 1 and T.salesNo = 0 and LEFT(T.oDate,4) = "'.$year.'" group by P.cate_1');

    ___log($logHandle,$sql['q']);

    $jsonArr = [['제품군','매출']];  //,'수량'
    if ($sql['dataCnt']) {
        $jsonArr['result'] = 'OK';
        $jsonArr['chartTitle'] = '제품군별 매출비중';
        $jsonArr['chartData'] = [];

        foreach ($sql['pageData'] as $p) {
            $arr = [$p['cate_1'],$p['sAmount']];    //,$p['sCount']
            //___logArray($logHandle,$arr);
            array_push($jsonArr['chartData'], $arr);
        }
    } else {
        $jsonArr['result'] = 'ER';
    }

    ___logArray($logHandle,$jsonArr);

    //-------------------------------------------------------------------------------------
    ___logEnd($logHandle);
    echo json_encode($jsonArr,JSON_NUMERIC_CHECK);
}

function _chartSalesProductCate_3($sO) {
    $logHandle = ___logStart("json_pieChart");
    ___logArray($logHandle,$sO);

    $year = $sO['year'];
    $sql = db_getDbRows(S_DB,
                        'erp_product as P,erp_inOrderItems',
                        'P.cate_3,sum(T.unitPrice * T.qty) as sAmount,sum(T.qty) as sCount',
                        'P.no = T.productNo and T.deleted = 0 and T.oState = 1 and T.salesNo = 0 and LEFT(T.oDate,4) = "'.$year.'" group by P.cate_3');

    ___log($logHandle,$sql['q']);

    $cate_3Arr = ___envArr('X052','env_prj.txt');
    $jsonArr = [['지역별','매출']];  //,'수량'
    if ($sql['dataCnt']) {
        $jsonArr['result'] = 'OK';
        $jsonArr['chartTitle'] = '지역별 매출비중';
        $jsonArr['chartData'] = [];

        foreach ($sql['pageData'] as $p) {
            $cate_3_name = $p['cate_3'] ? $cate_3Arr[$p['cate_3']] : 'Unknown';
            $arr = [$cate_3_name,$p['sAmount']];    //,$p['sCount']
            //___logArray($logHandle,$arr);
            array_push($jsonArr['chartData'], $arr);
        }
    } else {
        $jsonArr['result'] = 'ER';
    }

    ___logArray($logHandle,$jsonArr);

    //-------------------------------------------------------------------------------------
    ___logEnd($logHandle);
    echo json_encode($jsonArr,JSON_NUMERIC_CHECK);
}

?>
<?php
	//------------------------------------------------------------------------------------------------------------------------
	//------------------------------------------------------------------------------------------------------------------------
	switch($sO['cmd'])
	{
    case 'chart.sales.country':
        _chartSalesCountry($sO);
        break;
    case 'chart.sales.product.cate_1':
        _chartSalesProductCate_1($sO);
        break;
    case 'chart.sales.product.cate_3':
        _chartSalesProductCate_3($sO);
        break;
	}
?>