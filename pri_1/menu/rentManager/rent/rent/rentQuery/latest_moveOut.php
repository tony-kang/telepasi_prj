<?php
/**
 * @author tony on 2022. 6. 14.
 * @author Tony Kang <bluein007@gmail.com>
 * Description
 *
 */

// 최근 지정한 기간동안의 퇴거세대
$_pg['baseDate'] = ___get('baseDate',date('Ymd'));
$_start = ___dayAfter(sprintf('-%d day',$_pg['durationDay']),'Ymd',$_pg['baseDate']);
$_end = $_pg['baseDate'];

//___debug($_start.' ~ '.$_end);

include_once __DIR__.'/moveOut.php';
