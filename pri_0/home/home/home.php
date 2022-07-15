<?php
/**
 * @author tony on 2022. 7. 6.
 * @author Tony Kang <bluein007@gmail.com>
 * Description
 *
 */

// 완전히 독립된 페이집니다.
//___screenCenterMsg('HOME PAGE');
// home 폴더 아래에 자유롭게 사이트를 작성할 수 있습니다.
$xMode = $_SESSION['xMode'] ?? '사용자';
//___debug('실행모드 : '.$xMode);
___screenCenterMsg('HOME PAGE 입니다. '.___hRef('관리자 페이지',['href'=>'/?cfg=xA']));


//$cArr = ___dbEnv('M031','color');
//___dbConst('M031');
//___debug(TEST_CONST_33);