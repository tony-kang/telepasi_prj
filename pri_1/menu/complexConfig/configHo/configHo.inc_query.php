<?php
$sql = new TonySql(S_DB);
$sql->addTable('rm_ho','T');
$sql->addLeftJoinTable('CONTT_MST_I','CONTT','CONTT.COMPX_CD=T.complex and CONTT.DONG_NO=T.dong and CONTT.HO_NO=T.ho');
$sql->addLeftJoinTable('t_mbrdata','M','M.uid=T.regMbr');
$sql->addLeftJoinTable('t_mbrdata','MU','MU.uid=T.updateMbr');
$sql->addLeftJoinTable('DONG_HO_MST_I','DONG','DONG.COMPX_CD=T.complex and DONG.DONG_NO=T.dong and DONG.HO_NO=T.ho');

$sql->addField('T.*');
$sql->addField('M.name as regMbrName');
$sql->addField('MU.name as updateMbrName');
$sql->addField('DONG.*');
$sql->addField('CONTT.*');

$sql->addWhere(sprintf('T.deleted = 0 and T.complex = "%s" and T.dongNo=%d',$_pg['complex'],$_pg['dongNo']));

if (___pOk($_pg['sDongHo'])) {
    [$sDong,$sHo] = explode(' ',$_pg['sDongHo']);

    $sql->addWhere(sprintf('and T.dong="%s" and T.ho like "%s%%"',$sDong,$sHo));    //찾기 : 쉐어 형태도 모두 찾는다.
}

$sql->page($_pg['page'],$_pg['pSize']);

$sql->orderBy('CAST(T.floor AS SIGNED) DESC, CAST(T.ho AS SIGNED) ASC');

$_listArr = $sql->getRows();

//___debug($sql->getWhere());
//___debug($_listArr['q']);
