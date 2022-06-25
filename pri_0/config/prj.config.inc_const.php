<?php
/**
 * @author tony on 2022. 6. 23.
 * @author Tony Kang <bluein007@gmail.com>
 * Description
 *
 */

const PRJ_NAME = '테스트 프로젝트';
const MY_PRJ_TITLE = 'Telepasi Framework';

//global 선언없이 함수 안에서 사용될 로고를 상수를 정의
const PRJ_LOGO_FILE = MY_PRJ_ASSETS_URL.'/img/tonySign_black.png';
const PRJ_LOGO_FILE_1 = MY_PRJ_ASSETS_URL.'/img/tonySign_e8e8e8.png';

//프로젝트에서 사용되는 로고가 여러개일경우 배열로 등록해서 사용
$_prj['logo'][0] = [ 'url'=>PRJ_LOGO_FILE , 'width'=>520, 'height'=>295 ];
$_prj['logo'][1] = [ 'url'=>PRJ_LOGO_FILE_1 , 'width'=>520, 'height'=>295 ];

$_prj['startMenu'] = 'menuDashboard';
$_prj['startMenuItem'] = 'calendar';

//___debug(MY_PRJ_ASSETS_URL);
//___debug($_prj['logo'][0]);