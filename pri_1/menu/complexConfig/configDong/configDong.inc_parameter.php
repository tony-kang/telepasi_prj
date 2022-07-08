<?php
/**
 * @author tony on 2022. 5. 17.
 * @author Tony Kang <bluein007@gmail.com>
 * Description
 *
 */
$_pg['page'] = ___get('page',1);
$_pg['pSize'] = ___get('pSize',15);

$_pg['complex'] = ___get('complex',___myManageComplex());    //C201900004 등
$_pg['dong'] = ___get('dong');    // encoded
$_pg['dongNo'] = ___getDecodeValue($_pg['dong']);   //rm_dong.no

//___print($_pg);