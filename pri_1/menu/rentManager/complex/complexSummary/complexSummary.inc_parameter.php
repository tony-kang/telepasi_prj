<?php
/**
 * @author tony on 2022. 5. 17.
 * @author Tony Kang <bluein007@gmail.com>
 * Description
 *
 */

$_pg['page'] = ___get('page',1);
$_pg['pSize'] = ___get('pSize',15);
$_pg['complex'] = ___get('complex');    //C201900004 등
$_pg['ho'] = ___get('ho');    //ho
$_pg['hoNo'] = ___getDecodeValue($_pg['ho']);

//___print($_pg);