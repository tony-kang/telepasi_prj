<?php
/**
 * @author tony on 2022. 6. 14.
 * @author Tony Kang <bluein007@gmail.com>
 * Description
 *
 */

// 최근 지정한 월의 신규 계약 세대
$_pg['baseMonth'] = ___get('baseMonth',date('Ym')); //baseMonth 월에 퇴거 완료 세대

include_once __DIR__.'/newContract.php';
