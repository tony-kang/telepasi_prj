<?php
/**
 * @author tony on 2022. 6. 24.
 * @author Tony Kang <bluein007@gmail.com>
 * Description
 *
 */

// 소스파일을 필요에 따라 폴더를 그루핑해서 관리하도록 함.
$fo_1 = MY_PRJ_CODE_PATH;

if (substr($_site['cfg'],0,4) == 'menu') {
    $fo_1 .= '/menu';
}
