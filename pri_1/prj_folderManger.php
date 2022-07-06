<?php
/**
 * @author tony on 2022. 6. 24.
 * @author Tony Kang <bluein007@gmail.com>
 * Description
 *
 */

// 소스파일을 필요에 따라 폴더를 그루핑해서 관리하도록 함.
$fo_1 = MY_PRJ_CODE_PATH;

switch ($_site['cfg']) {
case 'menuDashboard':
    if (substr($_site['mN'],0,7) == 'complex') {
        $fo_2 = 'rentManager/complex';
        if ($_site['mN']) $fo_2 .= '/'.$_site['mN'];
    }
    break;
case 'home':
    //___debug('홈페이지');
    $fo_2 = 'home';
    break;
case 'menuEnv':
    $fo_2 = 'env';
    break;
default:
    if (substr($_site['cfg'],0,4) == 'menu') {
        $fo_2 = 'menu';
        if ($_site['cfg']) $fo_2 .= '/'.$_site['cfg'];
        if ($_site['mN']) $fo_2 .= '/'.$_site['mN'];

        //___debug($fo_2);
    }
    break;
}
