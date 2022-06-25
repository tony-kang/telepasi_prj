<?php
/**
 * @author tony on 2022. 1. 28.
 * @author Tony Kang <bluein007@gmail.com>
 * Description
 *
 */

function _globalCustomer($sO) {
    $logHandle = ___logStart("json_globalCustomer");
    ___logArray($logHandle,$sO);
    $jsonArr = [];
    $sql = db_getDbData(S_DB,'t_country as C,erp_customers','group_concat(distinct(C.code)) as cCodeList','C.no = T.countryCode');

    $arr = explode(',',$sql['cCodeList']);
    foreach ($arr as $p) {
        array_push($jsonArr, $p);
    }
    ___logArray($logHandle,$jsonArr);

    //-------------------------------------------------------------------------------------
    ___logEnd($logHandle);
    echo json_encode($jsonArr);
}

?>
<?php
	//------------------------------------------------------------------------------------------------------------------------
	//------------------------------------------------------------------------------------------------------------------------
	switch($_pg['jsonCmd'])
	{
	case 'global.customer':
		_globalCustomer($_pg);
		break;
	}
?>