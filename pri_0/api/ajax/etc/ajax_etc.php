<?php
/**
 * @author tony on 2022. 4. 30.
 * @author Tony Kang <bluein007@gmail.com>
 * Description
 *
 */

function _getGlobalCountryCust($sO)
{
    $logHandle = ___logStart("ajax_etc");
    ___logArray($logHandle,$sO);

    $country = $sO['country'];
    //$region = $sO['region'];

    $countryArr = db_getDbRows(S_DB,'t_country as C,erp_customers','C.code, C.country , group_concat(T.name) as compList, count(*) as countryCnt','C.no = T.countryCode and C.code="'.$country.'" group by T.countryCode');
    ___log($logHandle,$countryArr['q']);

    function _countryBlockLeft($country,$isFirst,$count=0) {
        $fFlag = $isFirst ? 'js-jqvmap-flag' : '';
        $fCountry = $isFirst ? 'js-jqvmap-country' : '';

        $compList = '';//'<ul>';
        $compArr = explode(',',$country['compList']);
        foreach($compArr as $compName) {
            //$compList .= sprint('<li>%s</li>',$compName);
            if ($compList) $compList .= ' | ';
            $compList .= $compName;
        }
        $compList .= '';//'</ul>';

        $html = '
            <div class="mb-1">
                <img class="d-inline-block '.$fFlag.' mr-3 border-faded" alt="flag" src="'.SERVER_URL.'/myPlugin/flag/flags/4x3/'.$country['code'].'.svg" style="width:55px; height: auto;">
                <h4 class="d-inline-block fw-300 m-0 text-muted fs-lg">
                    <small class="'.$fCountry.' mb-0 fw-500 text-dark">'.$country['country'].' ('.$count.' 개)</small>
                </h4>
                <div style = "padding-left:75px;">'.$compList.'</div>
            </div>';
        return $html;
    }

    $countryList = '';
    foreach($countryArr['pageData'] as $country) {
        $isFirst = false; //$countryList ? false : true;
        $countryList .= _countryBlockLeft($country,$isFirst,$country['countryCnt']);
    }

    //-------------------------------------------------------------------------------------
    ___log($logHandle,$countryList);
    ___logEnd($logHandle);
    echo $countryList;
}

?>
<?php
// ########################################################################################
// ############################       A    P    I      ####################################
// ########################################################################################
switch($sO['cmd'])
{
case 'get.global.country.cust';
    _getGlobalCountryCust($sO);
    break;

}
//------------------------------------------------------------------------------------------------------------------------
?>