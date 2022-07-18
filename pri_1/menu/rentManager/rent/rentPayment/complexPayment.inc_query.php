<?php
$sql = new TonySql(S_DB);
$sql->addTable('rm_ho','T');
$sql->addField('T.*');
$sql->addField('(select name from t_mbrdata as M where M.uid=T.regMbr) as regMbrName');
$sql->addField('(select name from t_mbrdata as M where M.uid=T.updateMbr) as updateMbrName');
$sql->addWhere(sprintf('T.complex = "%s" and dongNo=%d',$_pg['complex'],$_pg['dongNo']));
$sql->orderBy('T.floor DESC, T.ho ASC');

$_listArr = $sql->getRows();

//___debug($sql->getWhere());
//___debug($_listArr['q']);
