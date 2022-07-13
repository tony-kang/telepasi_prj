<style>
.div-center-wrapper {
    display:flex;
    justify-content: center;
    align-items: center;
}
.div-center-content { flex:0 0 300px; }
</style>
<?php
/***
 * @param     $number
 * @param int $op       : 0 = 한글 , 1 = 숫자(한글)
 */
function ___table_hoInfo($ho,$title,$op=VIEW_TABLE) {
    $iData = new MyItemData(array(12,20,12,20,12,20)); // 2개가 한쌍 : 6개 = 3개의 데이타쌍으로 구성됨

    $ho_dongHo = $ho['dongHo'];
    $ho_contractNumber = $ho['contract']['number'] ?? '-';
    $ho_houseType = $ho['house']['type'] ?? '-';
    $ho_contractDate = $ho['contract']['date'] ?? '-';
    $ho_depositAmount = $ho['contract']['depositAmount'] ?? 111110;
    $ho_rentAmount = $ho['contract']['rentAmount'] ?? 3242340;
    $ho_rentDate = sprintf('%s ~ %s',___date($ho['contract']['startDate']),___date($ho['contract']['endDate']));
    $ho_stateText = '입주';
    $ho_stateWork = '처리업무 없음';
    $ho_statePayment = '미납 없음';
    $ho_hasLoan = '있음';
    $ho_rentAccount = '';
    $ho_depositAccount = '';

    //--------------------------------------
    $iData->addData('동호수',$ho_dongHo);
    $iData->addData('계약번호',$ho_contractNumber);
    $iData->addData('타입',$ho_houseType);
    //--------------------------------------
    $iData->addData('계약일자',['data'=>$ho_contractDate,'para'=>['class'=>'td-item bg-primary-500']]);
    $iData->addData('약정 보증금',number_format($ho_depositAmount));
    $iData->addData('약정 임대료',number_format($ho_rentAmount));
    //--------------------------------------
    $iData->addData('임대차 계약기간',$ho_rentDate);
    $iData->addData();
    $iData->addData();
    //--------------------------------------
    $iData->addData('상태',['data'=>$ho_stateText,'para'=>['class'=>'td-item bg-primary-500']]);
    $iData->addData('업무',['data'=>$ho_stateWork,'para'=>['class'=>'td-item bg-danger-500']]);
    $iData->addData('수납',['data'=>$ho_statePayment,'para'=>['class'=>'td-item bg-success-500']]);
    //--------------------------------------
    $iData->addData('대출여부',$ho_hasLoan);
    $iData->addData('임대료 계좌',___btn('복사',['data'=>$ho_rentAccount]));
    $iData->addData('보증금 계좌',___btn('복사',['data'=>$ho_depositAccount]));
    //--------------------------------------

     return $iData->html($title,$op);
}

function ___table_hoContract($ho,$title,$op=VIEW_TABLE) {
    $iData = new MyItemData(array(12,20,12,20,12,20)); // 2개가 한쌍 : 6개 = 3개의 데이타쌍으로 구성됨

    $ho_dongHo = $ho['dongHo'];
    $ho_contractor = '';
    $ho_contractNumber = $ho['contract']['number'] ?? '-';
    $ho_houseType = $ho['house']['type'] ?? '-';
    $ho_contractDate = $ho['contract']['date'] ?? '-';
    $ho_depositAmount = $ho['contract']['depositAmount'] ?? 111110;
    $ho_rentAmount = $ho['contract']['rentAmount'] ?? 3242340;
    $ho_rentDate = sprintf('%s ~ %s',___date($ho['contract']['startDate']),___date($ho['contract']['endDate']));
    $ho_stateText = '입주';
    $ho_stateWork = '처리업무 없음';
    $ho_statePayment = '미납 없음';
    $ho_hasLoan = '있음';
    $ho_rentAccount = '';
    $ho_depositAccount = '';
    $ho_postAddr = '';
    $ho_coRepresentative = '';

    //--------------------------------------
    $iData->addData('계약자명',$ho_contractor);
    $iData->addData('생년월일',$ho_contractNumber);
    $iData->addData('연락처',$ho_houseType);
    //--------------------------------------
    $iData->addData('이메일',$ho_contractDate);
    $iData->addData('우편물주소',['data'=>$ho_postAddr,'para'=>['colSpan'=>3, 'forceTr'=>true]]);    //colSpan 처리 주의

    //--------------------------------------
    $iData->addData('공동대표자',['data'=>$ho_coRepresentative,'para'=>['colSpan'=>5, 'forceTr'=>true]]);
    //--------------------------------------
    $iData->addData('공동대표자-생연월일');
    $iData->addData('공동대표자-연락처');
    $iData->addData('공동대표자-이메일');
    //--------------------------------------

     return $iData->html($title,$op);
}

function ___centerDiv($content) {
    $html = '<div class="div-center-wrapper"><div class="div-center-content">'.$content.'</div></div>';
    return $html;
}

function ___table_hoContractHistory($ho,$title,$op=VIEW_TABLE) {

    $content = ___centerDiv('<my class="my-cursor-pointer" data-obj-action="ajax_hoContractHistory" data-target="id_hoContractHistory" data-ho-no="'.$ho['no'].'">링크를 클릭하면 데이타를 불러 옵니다.</my>');
    if ($op == VIEW_PANEL_TABLE) $html = ___panel($title,$content,'id_hoContractHistory');
    else $html = $content;

    return $html;
}
