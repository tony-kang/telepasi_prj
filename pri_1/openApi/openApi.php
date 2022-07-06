<?php
//error_reporting(E_ALL);
include_once MY_SRC_PATH.'/openApi/common/inc_func.php';
include_once MY_SRC_PATH.'/openApi/common/inc_loginCheck.php';

$logHandle = ___logStart("api_oApi");

$_apiKey = ___get('apiKey');
if (empty($_apiKey)) {
    $_apiKey = ___post('apiKey');

    if (empty($_apiKey)) {
        ___oApiError('ERROR',_openApi_error(OPENAPI_KEY_NONE));
    }
}

___log($logHandle,$_apiKey);
$_pg['apiKey'] = urldecode($_apiKey);
//___debug($_pg['apiKey']);
$openApi = sql_getDbData(S_DB,'t_openApi','*',sprintf('apiKey="%s"',$_pg['apiKey']));
$id = $openApi['id'] ?? '';
if (empty($id)) ___oApiError('ERROR',_openApi_error(OPENAPI_KEY_ERROR));

$r = _openApi_checkKey($openApi,$logHandle);
if ($r) ___oApiError('ERROR',_openApi_error($r));

$_api = ___get('api');
$_output = ___get('output','json');      //출력포멧 기본 = JSON
$_pg['arrayOutput'] = ($_output == 'array');            //배열출력 여부

$apiFile = _getApiFile($_api);
if ($apiFile) {
    //API 호출 등 외부에서 요청을 받은 경우
    //Access-Control-Allow-Origin 바로다음에 공백없이 : 를 입력해줘야 에러가 안남
    header('Access-Control-Allow-Origin: *');

    if ($_api != 'login' && $_api != 'logout') ___oApiLoginCheck($openApi);

    include_once $apiFile;
} else {
    ___exception('ERROR',_openApi_error(OPENAPI_KNOWN));
    //$_post = ___post('para');
    //___print($_post);
    //$_apiData = str_replace(array("\t","\n","\a"),'',$_post);
    //___logArray($logHandle,$_apiData);

    //$_jsonPara = json_decode($_apiData['data'],true);
    //___log($logHandle,'json_last_error = '.json_last_error());
    //$_jsonCmd = $_jsonPara['cmd'];
    //$_apiFile = __DIR__.'/oApi/oApi_'.$_jsonCmd.'.php';
    //___log($logHandle,$_apiFile);
    //
    //if (file_exists($_apiFile)) {
    //    echo $_apiFile;
    //} else {
    //    ___exception('ERROR','API가 정의되지 않았습니다.');
    //}
}






___logEnd($logHandle);
