<?php
$sql = new TonySql(S_DB);
$sql->addTable('rm_dong','T');
$sql->addLeftJoinTable('t_mbrdata','M','M.uid=T.regMbr');
$sql->addLeftJoinTable('t_mbrdata','MU','MU.uid=T.updateMbr');
$sql->addLeftJoinTable('salt_COMPX_COMP_I','C','C.COMPX_CD=T.complex');

$sql->addField('T.*');
$sql->addField('M.name as regMbrName');
$sql->addField('MU.name as updateMbrName');
$sql->addField('C.COMPX_NM as complexName,C.ADDR as complexAddr,T.*');

$sql->addWhere(sprintf('T.deleted = 0 and T.complex = "%s"',$_pg['complex']));
if ($_pg['dongNo']) {
    $sql->addWhere(sprintf('and T.no = "%s"',$_pg['dongNo']));
}

$sql->page($_pg['page'],$_pg['pSize']);

$sql->orderBy('T.dong ASC');

$_listArr = $sql->getRows();

//___debug($sql->getWhere());
___debug($_listArr['q']);
