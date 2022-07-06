<?php
/**
 * @author tony on 2022. 3. 24.
 * @author Tony Kang <bluein007@gmail.com>
 * Description
 *
 */

function ___oApiLoginCheck($openApi) {
/*
    list($oApiMbr,$oApiExpireDate) = explode('*',___decode($openApi['apiKey']));
    if ($oApiMbr != ___getSession('oApiMbr')) {
        ___oApiError('ERROR',_openApi_error(OPENAPI_LOGIN_NEEDED));
    }
    //___echo('Open API Login Ok.');
*/
    if ($openApi['apiLogin'] < $openApi['apiLogout']) {
        ___oApiError('ERROR',_openApi_error(OPENAPI_LOGIN_NEEDED));
    }
}
