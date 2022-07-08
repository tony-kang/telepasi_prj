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
case 'dashboard':
    if (substr($_site['mN'],0,7) == 'complex') {
        $fo_1.= '/menu/rentManager';
    }
    break;
case 'complexConfig':
    $fo_1.= '/menu';
    break;
case 'menuEnv':
    $fo_2 = 'env';
    break;
default:
    if (substr($_site['cfg'],0,4) == 'menu') {
        $fo_1 .= '/menu';
    }
    break;
}
