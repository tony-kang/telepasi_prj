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

// DB 번호로 찾을 때 (Layout에서 오는 경우)
$_pg['ho'] = ___get('ho');
$_pg['hoNo'] = ___getDecodeValue($_pg['ho']);   // rm_ho.no

// 동 호를 지정해서 찾을 때 (임대관리에서 오는 경우)
$_pg['sDong'] = ___get('sDong');    //동 문자
$_pg['sHo'] = ___get('sHo');    //호 문자

//___print($_pg);