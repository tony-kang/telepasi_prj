<?php
//$sql = new TonySql(S_DB);
//$sql->addTable('rm_ho','T');
//$sql->addField('T.*');
//$sql->addWhere(sprintf('T.no=%d',$_pg['hoNo']));
//$ho = $sql->getData();

echo ___pageSubTitle('2022년 3월');
echo '<div class="row">';
echo '<div class="col text-center">'.___tableComplexDashboardRent($_pg).'</div>';
echo '<div class="col text-center">'.___tableComplexDashboardPayment($_pg).'</div>';
echo '<div class="col text-center">'.___tableComplexDashboardDeposit($_pg).'</div>';
echo '<div class="col text-center">'.___tableComplexDashboardNonPayment($_pg).'</div>';
echo '</div>';