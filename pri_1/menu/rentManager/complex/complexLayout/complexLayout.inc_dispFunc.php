<style>
.dongLayout {
    display:inline-block;
    margin:20px;
    vertical-align: bottom;
}

.floorLayout {
    width:100%;
    display: flex;
}
</style>
<?php

function ___tableComplexLayout($dataArr,$p) {
    $html = '<div class="complexLayout">';
    $hoWidth = 60;
    //--------------------------------------
    $floorSql = new TonySql(S_DB);
    $floorSql->addTable('rm_ho','T');
    $floorSql->addField('D.*,T.*');
    $floorSql->addLeftJoinTable('DONG_HO_MST_I','D','D.COMPX_CD=T.complex and D.DONG_NO=T.dong and D.HO_NO=T.ho');

    foreach($dataArr['pageData'] as $cDong) {
            $html .= '<div class="dongLayout">';
            //--------------------------------------
            $maxFloor = $cDong['maxFloor'];
            for($fIdx=$maxFloor;$fIdx>0;$fIdx--) {
                //층
                $floorSql->clearWhere();
                $floorSql->addWhere(sprintf('T.dongNo="%s" and T.floor=%d',$cDong['no'],$fIdx));
                $floorSql->orderBy('T.ho ASC');
                $floorHoArr = $floorSql->getRows();
                ___printExeTime();

                //___debug($floorHoArr['q']);
                //$floorHoArr = db_getDbRows(S_DB,'rm_ho','*',sprintf('dongNo="%s" and floor=%d',$cDong['no'],$fIdx),'ho ASC');

                $html .= sprintf('<div class="floorLayout" style="%s">',($fIdx<$maxFloor) ? 'margin-top:-1px;' : '');
                if ($fIdx == 1) $hWidthTotal = 0;
                foreach($floorHoArr['pageData'] as $floorHo) {
                    //호
                    $html .= ___hoDrawing($floorHo,$hoWidth);

                    if ($fIdx == 1) $hWidthTotal += $hoWidth;
                }
                $html .= '</div>';
            }

            $html .= ___dongDrawing($cDong,$hWidthTotal-$cDong['hoCnt']+1);
            $html .= '</div>';
        //--------------------------------------
    }
    $html .= '</div>';
    return $html;
}

/*
function ___tableComplexLayout($dataArr,$p) {
    $html = '<div class="complexLayout">';
    $hoWidth = 60;
    //--------------------------------------
    $floorSql = new TonySql(S_DB);
    $floorSql->addTable('rm_ho','T');
    $floorSql->addField('D.*,T.*');
    $floorSql->addLeftJoinTable('DONG_HO_MST_I','D','D.COMPX_CD=T.complex and D.DONG_NO=T.dong and D.HO_NO=T.ho');

    foreach($dataArr['pageData'] as $cDong) {
            $html .= '<div class="dongLayout">';
            //--------------------------------------
            $maxFloor = $cDong['maxFloor'];
            for($fIdx=$maxFloor;$fIdx>0;$fIdx--) {
                //층
                $floorSql->clearWhere();
                $floorSql->addWhere(sprintf('T.dongNo="%s" and T.floor=%d',$cDong['no'],$fIdx));
                $floorSql->orderBy('T.ho ASC');
                $floorHoArr = $floorSql->getRows();
                ___printExeTime();

                //___debug($floorHoArr['q']);
                //$floorHoArr = db_getDbRows(S_DB,'rm_ho','*',sprintf('dongNo="%s" and floor=%d',$cDong['no'],$fIdx),'ho ASC');

                $html .= sprintf('<div class="floorLayout" style="%s">',($fIdx<$maxFloor) ? 'margin-top:-1px;' : '');
                if ($fIdx == 1) $hWidthTotal = 0;
                foreach($floorHoArr['pageData'] as $floorHo) {
                    //호
                    $html .= ___hoDrawing($floorHo,$hoWidth);

                    if ($fIdx == 1) $hWidthTotal += $hoWidth;
                }
                $html .= '</div>';
            }

            $html .= ___dongDrawing($cDong,$hWidthTotal-$cDong['hoCnt']+1);
            $html .= '</div>';
        //--------------------------------------
    }
    $html .= '</div>';
    return $html;
}
*/