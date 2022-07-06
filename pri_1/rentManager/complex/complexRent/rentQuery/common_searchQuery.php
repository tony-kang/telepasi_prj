<?php
/**
 * @author tony on 2022. 6. 16.
 * @author Tony Kang <bluein007@gmail.com>
 * Description
 *
 */

if ($_pg['sName']) $sql->addWhere(sprintf('and (B.NAME = "%s" or B.TEL_NO like "%%%s%%" or B.CONTT_NO like "%%%s%%")',$_pg['sName'],$_pg['sName'],$_pg['sName']));
if ($_pg['sDong']) $sql->addWhere(sprintf('and A.DONG_NO = "%s"',$_pg['sDong']));
if ($_pg['sHo']) $sql->addWhere(sprintf('and A.HO_NO = "%s"',$_pg['sHo']));

if ($_pg['dateOp']) {
    if ($_pg['dateOp'] == 1) $dateField = 'A.CONTT_YMD';                  //계약일
    else if ($_pg['dateOp'] == 2) $dateField = 'A.LEAS_STR_YMD';          //임대 시작일
    else if ($_pg['dateOp'] == 3) $dateField = 'A.LEAS_END_YMD';          //임대 종료일
    else $dateField = '';

    if ($dateField && $_pg['sDate']) $sql->addWhere(sprintf('and %s >= "%s"',$dateField,str_replace('.', '', $_pg['sDate'])));
    if ($dateField && $_pg['eDate']) $sql->addWhere(sprintf('and %s <= "%s"',$dateField,str_replace('.', '', $_pg['eDate'])));
}
