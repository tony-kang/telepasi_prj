<?php
/**
 * @author tony on 2022. 3. 24.
 * @author Tony Kang <bluein007@gmail.com>
 * Description
 * API Login
 */

//___debug(__FILE__);
//___debug($_pg['apiKey']);

$id = $openApi['id'] ?? '';

if ($id) {
    $sql = sql_updateDbData(S_DB,'t_openApi','apiKey="'.$_pg['apiKey'].'"','apiLoginCount=apiLoginCount+1,apiLogin="'.date('YmdHis').'"');
    $jsonReponse = [
        'result' => 'OK'
        , 'user' => [
            'id' => $openApi['id']
            , 'name' => $openApi['name']
            , 'tel' => $openApi['tel']
            , 'email' => $openApi['email']
            , 'expireDate' => $openApi['expireDate']
        ]
    ];
} else {
    $jsonReponse = [
        'result' => 'ERROR'
        , 'desc' => 'Invalid API key.'
    ];
}
___oApiOk($jsonReponse,$_pg['arrayOutput']);
