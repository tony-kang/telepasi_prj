<?php
$sql = new TonySql(S_DB);
$sql->addTable('prj_demo1','T');
$sql->addLeftJoinTable('t_mbrdata','M','M.uid = T.regMbr');
$sql->addField('T.*');
$sql->addField('M.name as regMbrName');
$sql->addWhere('T.deleted = 0');

if (___pOk($_pg['sKey1'])) {
    $sql->addWhere(sprintf('and T.data_1 like "%%%s%%"',$_pg['sKey1']));
}

if (___pOk($_pg['sKey2'])) {
    $sql->addWhere(sprintf('and M.name like "%%%s%%"',$_pg['sKey2']));
}

$sql->orderBy('T.no DESC');
$sql->page($_pg['page'],$_pg['pSize']);
$_listArr = $sql->getRows();

//___debug($sql->getWhere());
//___debug($_listArr['q']);
