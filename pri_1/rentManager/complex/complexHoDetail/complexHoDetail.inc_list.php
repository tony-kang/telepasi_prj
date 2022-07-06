<?php
//$sql = new TonySql(S_DB);
//$sql->addTable('rm_ho','T');
//$sql->addField('T.*');
//
//if ($_pg['hoNo']) {
//    $sql->addWhere(sprintf('T.no=%d', $_pg['hoNo']));
//} else if ($_pg['complex'] && $_pg['sDong'] && $_pg['sHo']) {
//    $sql->addWhere(sprintf('T.complex="%s" and T.dong="%s" and T.ho="%s"',$_pg['complex'],$_pg['sDong'],$_pg['sHo']));
//}
//$ho = $sql->getData();
//___print($ho);

echo ___pageSubTitle('호실 계약정보');
echo ___tableHo_conttInfo($ho,$_pg);
