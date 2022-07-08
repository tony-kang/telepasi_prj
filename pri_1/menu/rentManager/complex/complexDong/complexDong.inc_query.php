<?php
$sql = new TonySql(S_DB);
$sql->addTable('rm_dong','T');
$sql->addLeftJoinTable('salt_COMPX_COMP_I','C','C.COMPX_CD=T.complex');
$sql->addField('C.COMPX_NM as complexName,C.ADDR as complexAddr,T.*');
$sql->addField('(select name from t_mbrdata as M where M.uid=T.mbrUid) as regMbrName');
$sql->addField('(select name from t_mbrdata as M where M.uid=T.updateMbr) as updateMbrName');

$sql->addWhere(sprintf('T.complex = "%s"',$_pg['complex']));
if ($_pg['dongNo']) {
    $sql->addWhere(sprintf('and T.no = "%s"',$_pg['dongNo']));
}
$sql->orderBy('dong ASC');

$_listArr = $sql->getRows();


//$sql->addField('(SELECT count(*) as cnt from rm_ho as HO where HO.dongNo=T.no) as hoCntAll');
//___debug($sql->getWhere());
//___debug($_listArr['q']);
