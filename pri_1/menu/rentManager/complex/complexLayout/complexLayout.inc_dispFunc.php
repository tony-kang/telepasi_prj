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

/*** 렌더링 속도 테스트 ***/
/*
 * ___tableComplexLayout            ___tableComplexLayout_1
 * 해당동의 쿼리를 한번에 해서 그리기           해당동의 층마다 쿼리를 해서 그리기
 * 약 50 ~ 120 ms 정도 빠름
 * Linux Obuntu 18.04 LTS , 1 CPU , 2G RAM 환경에서 테스트함
 */

function ___tableComplexLayout($dataArr,$p) {
    $html = '<div class="complexLayout">';
    $hoWidth = 60;
    //--------------------------------------
    $dongHoSql = new TonySql(S_DB);
    $dongHoSql->addTable('rm_ho','T');
    $dongHoSql->addField('D.*,T.*');
    $dongHoSql->addLeftJoinTable('DONG_HO_MST_I','D','D.COMPX_CD=T.complex and D.DONG_NO=T.dong and D.HO_NO=T.ho');

    foreach($dataArr['pageData'] as $cDong) {
            $html .= '<div class="dongLayout">';
            //___debug($cDong['hoCnt']);
            //--------------------------------------
            $dongHoSql->clearWhere();
            $dongHoSql->addWhere(sprintf('T.dongNo="%s"',$cDong['no']));
            $dongHoSql->orderBy('cast(T.ho as signed) ASC');
            $dongHoArr = $dongHoSql->getRows();
            //___debug($dongHoArr['q']);
            $hoIdx = 0;
            $fIdx = 1;
            $maxFloor = $cDong['maxFloor'];
            $floorHtmlArr = array();
            foreach($dongHoArr['pageData'] as $dongHo) {
                if ($hoIdx == 0) {
                    $hWidthTotal = 0;
                    $floorHtml = sprintf('<div class="floorLayout" style="%s">',($fIdx<$maxFloor) ? 'margin-top:-1px;' : '');
                }
                //호
                $floorHtml .= ___hoDrawing($dongHo,$hoWidth);

                $hWidthTotal += $hoWidth;

                $hoIdx = ($hoIdx + 1) % $cDong['hoCnt'];
                if ($hoIdx == 0) {
                    $floorHtml .= '</div>';
                    $floorHtmlArr[$maxFloor-$fIdx] = $floorHtml;
                    $fIdx++;
                }
            }

            for ($i=0; $i<$maxFloor; $i++) {
                $html .= $floorHtmlArr[$i];
            }

            $html .= ___dongDrawing($cDong,$hWidthTotal-$cDong['hoCnt']+1); // 하단 동 표시 그리기
            $html .= '</div>';
        //--------------------------------------
    }
    $html .= '</div>';

    return $html;
}

function ___tableComplexLayout_1($dataArr,$p) {
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

