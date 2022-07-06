<?php
/**
 * @author tony on 2022. 5. 17.
 * @author Tony Kang <bluein007@gmail.com>
 * Description
 *
 */
function ___hoDrawing($ho,$w=60) {
    $encDong = ___makeEncode($ho['dong']);
    $encHo = ___makeEncode($ho['no']);
    //$encCompleDongHo = ___makeEncode($ho['complex'],$ho['dong'],$ho['ho']);
    $hoNone = ($ho['state'] == 2);      //층없음
    $hoDisable = ($ho['state'] == 1);   //사용안함

    if ($hoNone || $hoDisable) $hoText = '&nbsp;';
    else $hoText = ($ho['nickname'] ? $ho['nickname'] : $ho['ho']); // 편의시설

    $nickClass = $disableClass = '';
    if ($ho['nickname']) $nickClass = ' bg-info-500';
    if ($hoDisable) $disableClass = 'cross-line';

    $hoCaption = sprintf('%s 동 %s 호',$ho['dong'],$ho['ho']);
    if ($ho['nickname']) $hoCaption .= '('.$ho['nickname'].')';

    //-----------------------------------------------------------------------------
    $aMenu = new ActionMenu($hoText);
    if (___isAdmin()) {
        //관리자는 호 레이아웃 셋팅메뉴 보임
        $hoEditUrl = '?cfg=menuDashboard&mN=complex&mS=complexHo&complex='.$ho['complex'].'&dong='.$encDong.'&edit=exist&ho='.$encHo;
        $aMenu->add(true,___amHref($hoEditUrl,sprintf('%s동 %s호 정보 수정',$ho['dong'],$ho['ho'])));

        $hoEditUrl = '?cfg=menuDashboard&mN=complex&mS=complexHoDetail&complex='.$ho['complex'].'&ho='.$encHo;
        $aMenu->add(true,___amHref($hoEditUrl,sprintf('%s동 %s호 상세',$ho['dong'],$ho['ho'])));
    } else {
        $hoEditUrl = '?cfg=menuDashboard&mN=complex&mS=complexHoDetail&complex='.$ho['complex'].'&ho='.$encHo;
        $aMenu->add(true,___amHref($hoEditUrl,sprintf('%s동 %s호 상세',$ho['dong'],$ho['ho'])));
    }

    $hoStateHistory = db_getDbData(S_DB,'rm_hoStateHistory','no,houseState,workState',
                                   sprintf('complex="%s" and dong="%s" and ho="%s" order by no desc limit 1',$ho['complex'],$ho['dong'],$ho['ho']));
    $hoState_house = $hoStateHistory['houseState'] ?? HO_STATE_IN_DONE;
    $hoState_work = $hoStateHistory['workState'] ?? 0;

    $houseState = ___hoHouseState($hoState_house);
    $workState = ___hoWorkState($hoState_work);;
    $aMenu->add(true,___amView(sprintf('상태:%s<br>업무:%s',$houseState,$workState)));
    $hoText = $aMenu->html();


    $supType = _roomTypeArr($ho['SUP_TYPE']);
    //___debug($ho);
    //if ($hoState_house != HO_STATE_IN_DONE) ___debug($hoState_house);
    $hoBackColor = ($hoState_house == HO_STATE_EMPTY) ? 'background-color:#f00; color:#fff;' : '';
    $hoLineColor = ($hoNone) ? '' : 'border:solid 1px #aaa;';

    $html = '<div';
    $html .= sprintf(' class="%s %s my-inline-block text-center"',$nickClass,$disableClass);
    $html .= sprintf(' title="[%s] [%s] [공급:%.1f ㎡ ,전용:%.1f ㎡]"',$supType,$ho['ROOM_TP'],(float)$ho['SUP_AREA'],(float)$ho['EXSUE_AREA']);
    $html .= sprintf(' style="margin-right:-1px; width:%dpx; max-width:%dpx; %s %s"',$w,$w,$hoBackColor,$hoLineColor);
    $html .= '>';
    $html .= $hoText;
    $html .= '</div>';

    return $html;
}

function ___dongDrawing($dong,$w=180) {
    $html = '<div';
    $html .= sprintf(' class="text-center bg-primary-500"');
    $html .= sprintf(' style="width:%dpx; max-width:%dpx; %s"',$w,$w,'margin-top:2px; border:solid 1px #aaa;');
    $html .= '>';
    $html .= $dong['dong'].' 동';
    $html .= '</div>';

    return $html;
}
