<?php
/**
 * @author tony on 2022. 3. 24.
 * @author Tony Kang <bluein007@gmail.com>
 * Description
 *
 */

define ('OPENAPI_OK',0);
define ('OPENAPI_KEY_ERROR',1);
define ('OPENAPI_EXPIRE_ERROR',2);
define ('OPENAPI_INVALID_IP',3);
define ('OPENAPI_KEY_NONE',4);
define ('OPENAPI_INVALID_COMMAND',5);
define ('OPENAPI_KNOWN',6);
define ('OPENAPI_LOGIN_NEEDED',7);

include_once MY_PRJ_CODE_PATH.'/oApi/apiConfig.php';

function _openApi_error($errNo) {
    $err = [0=>'Open API Ok.'
        ,1=>'API Key is invalid.'
        ,2=>'API Key is expired.'
        ,3=>'Your IP addr is not valied.'
        ,4=>'Error API Key.'
        ,5=>'Invalid command.'
        ,6=>'Unknown API.'
        ,7=>'Login is required.'
    ];

    if (array_key_exists($errNo,$err)) return $err[$errNo];

    return 'Unknown Error.';
}

function _getApiFile($api) {
    $apiArr = [
        'login','logout'
    ];
    if (in_array($api,$apiArr)) return MY_SRC_PATH.'/openApi/oApi/oApi_'.$api.'.php';

    $custApiFile = ___getCustOpenApi($api);
    if ($custApiFile) return MY_PRJ_CODE_PATH.'/oApi/'.$custApiFile;

    return '';
}

function _openApi_checkKey($openApi,$logHandle='') {
    [$id,$expireDate] = explode('*',___decode($openApi['apiKey']));

    //___logArray($logHandle,$openApi);
    if (!array_key_exists('apiKey',$openApi)) return OPENAPI_KEY_ERROR;
    if ($openApi['id'] != $id) return OPENAPI_KEY_ERROR;

    if ($openApi['expireDate'] < date("Ymd") || $expireDate < date("Ymd")) return OPENAPI_EXPIRE_ERROR;

    if ($openApi['host']) {
        $remoteIp = $_SERVER['REMOTE_ADDR'];
        $tokenHostArr = preg_split('/\s/', $openApi['host']);    //공백으로 분리
        //$ipArr = array();
        foreach ($tokenHostArr as $h) {
            $hArr = preg_split('/\./', $h);  //먼저 XXX.XXX.XXX.XXX 구조인지 확인
            if (is_numeric($hArr[0])) {
                //___debug($h.' == '.$remoteIp);
                if ($h == $remoteIp) return OPENAPI_OK;
            } else {
                $hIp = gethostbyname($h);
                //___debug('hIp == '.$hIp);
                $hArr = preg_split('/\./', $hIp);
                if (is_numeric($hArr[0])) {
                    //___debug($hIp.' == '.$remoteIp);
                    if ($hIp == $remoteIp) return OPENAPI_OK;
                }
            }
        }

        return OPENAPI_INVALID_IP;
    }
    return OPENAPI_OK;
}

function ___oApiError($msg,$desc='') {
    $errorJson = array(
        'result'=>$msg,
        'desc'=>$desc
    );

    echo json_encode($errorJson);
    exit;
}

function ___oApiOk($okArr,$debugPrint=false) {
    if ($debugPrint) ___print($okArr,'Debug','50px','200px',false);

    echo json_encode($okArr);
    exit;
}