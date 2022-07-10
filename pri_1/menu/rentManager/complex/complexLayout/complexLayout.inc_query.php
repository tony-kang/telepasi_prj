<?php
$sql = new TonySql(S_DB);
$sql->addTable('rm_dong','T');
$sql->addField('T.*');
$sql->addWhere(sprintf('T.complex = "%s"',___myManageComplex()));

//if ($_pg['sKey']) {
//    $sql->addWhere('and T.name like "%'.$_pg['sKey'].'%"');
//}
//if ($_pg['sKey2'] && $_pg['sKey2'] != 'A') {
//    $sql->addWhere('and T.cate_1 = "'.$_pg['sKey2'].'"');
//}
//if ($_pg['sKey3']) {
//    $sql->addWhere('and T.cate_2 = "'.$_pg['sKey3'].'"');
//}
//if ($_pg['sKey4']) {
//    $sql->addWhere('and T.cate_3 = "'.$_pg['sKey4'].'"');
//}

$sql->orderBy('dong ASC');

$_listArr = $sql->getRows();

//___debug($sql->getWhere());
//___debug($_listArr['q']);
//___printExeTime();
