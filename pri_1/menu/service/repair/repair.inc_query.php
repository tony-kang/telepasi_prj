<?php
$sql = new TonySql(S_DB);
$sql->addTable('t_survey','T');
$sql->addLeftJoinTable('t_mbrdata','M','M.uid = T.regMbr');
$sql->addField('T.*');
$sql->addField('M.name as regMbrName');
$sql->addWhere('T.deleted = 0 and T.code="'.___myManageComplex().'"');

if (___pOk($_pg['sTitle'])) {
    $sql->addWhere(sprintf('and T.title like "%%%s%%"',$_pg['sKey1']));
}

$sql->orderBy('T.no DESC');
$sql->page($_pg['page'],$_pg['pSize']);
$_listArr = $sql->getRows();

//___debug($sql->getWhere());
//___debug($_listArr['q']);
