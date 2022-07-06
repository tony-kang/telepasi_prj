<?php
/**
 * @author tony on 2022. 3. 24.
 * @author Tony Kang <bluein007@gmail.com>
 * Description
 * API Login
 */

//___debug(__FILE__);

//unset($_SESSION['oApiMbr']);
$sql = sql_updateDbData(S_DB,'t_openApi','apiKey="'.$_pg['apiKey'].'"','apiLogout="'.date('YmdHis').'"');
if ($sql['r']) {
    $jsonResponse = [
        'result' => 'OK'
        , 'desc' => 'Logout success'
    ];
} else {
    $jsonResponse = [
        'result' => 'ERROR'
        , 'desc' => 'Logout fail'
    ];
}
___oApiOk($jsonResponse,$_pg['arrayOutput']);
