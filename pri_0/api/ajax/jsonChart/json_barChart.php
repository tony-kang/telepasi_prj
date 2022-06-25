<?php
/**
 * @author tony on 2022. 1. 28.
 * @author Tony Kang <bluein007@gmail.com>
 * Description
 *
 */

function _chartSalesPerformance($sO) {
    $logHandle = ___logStart("json_barChart");
    ___logArray($logHandle,$sO);

    $chartData = [['년도', '영업목표', '예상실적', '수주실적']];
    for ($year=$sO['sY']; $year<=$sO['eY']; $year++) {

        $qField = 'year,sum(goalAmount) as gAmount';
        $qWhere = sprintf('deleted = 0 and year=%d',$year);
        $mSalesYear = db_getDbData(S_DB, 'erp_sales', $qField, $qWhere);
        ___log($logHandle,$mSalesYear['q']);

        if (array_key_exists('year',$mSalesYear)) {
            $arr = [];
            $goal = db_getDbData(S_DB,'erp_inOrderItems','sum(T.unitPrice * T.qty) as goalOrderAmount','T.deleted = 0 and T.salesNo = 0 and LEFT(T.oDate,4) = "'.$year.'"');
            ___log($logHandle,$goal['q']);
            $real = db_getDbData(S_DB,'erp_inOrderItems','sum(T.unitPrice * T.qty) as realOrderAmount','T.deleted = 0 and T.oState = 1 and T.salesNo = 0 and LEFT(T.oDate,4) = "'.$year.'"');
            ___log($logHandle,$real['q']);
            array_push($arr,$year,$mSalesYear['gAmount'],$goal['goalOrderAmount'],$real['realOrderAmount']);
            ___logArray($logHandle,$arr);
        } else {
            $arr = [$year,0,0,0];
        }

        array_push($chartData,$arr);
    }

    $jsonArr = [];
    $jsonArr['result'] = 'OK';
    $jsonArr['chartTitle'] = 'Sales,Expense, and Profit';
    $jsonArr['chartData'] = $chartData;

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
    case 'chart.sales.performance':
        _chartSalesPerformance($sO);
        break;
	}
?>