<?php
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
// t: input type , d : disabled , c : color , p : placeHolder , r : required
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
$_row_1 = [
     ['size'=>'col-4' ,'t'=>'input', 'label'=>'단지명', 'name'=>___makeField(TEXT_FIELD,'COMPX_NM'), 'align'=>'', 'p'=>'', 'r'=>1]
    ,['size'=>'col-2' ,'t'=>'input', 'label'=>'단지코드', 'name'=>___makeField(TEXT_FIELD,'COMPX_CD'), 'align'=>'', 'p'=>'','mask'=>'', 'r'=>0, 'd'=>0, 'note'=>'' ]
    ,['size'=>'col-6' ,'t'=>'input', 'label'=>'단지주소', 'name'=>___makeField(TEXT_FIELD,'ADDR'), 'align'=>'', 'p'=>'','mask'=>'', 'r'=>0, 'd'=>0, 'note'=>'' ]
];

$_row_2 = [
     ['size'=>'col-4' ,'t'=>'input', 'label'=>'관리회사명', 'name'=>___makeField(TEXT_FIELD,'COMP_NM'), 'align'=>'', 'p'=>'', 'r'=>1]
    ,['size'=>'col-3' ,'t'=>'input', 'label'=>'법인번호', 'name'=>___makeField(TEXT_FIELD,'COMP_PIN'), 'align'=>'', 'p'=>'','mask'=>'', 'r'=>0, 'd'=>0, 'note'=>'' ]
    ,['size'=>'col-2' ,'t'=>'input', 'label'=>'사업자번호', 'name'=>___makeField(TEXT_FIELD,'BREG_NO'), 'align'=>'', 'p'=>'','mask'=>'', 'r'=>0, 'd'=>0, 'note'=>'' ]
    ,['size'=>'col-3' ,'t'=>'input', 'label'=>'임대관리사무소 전화번호', 'name'=>___makeField(TEXT_FIELD,'RENT_OFFICE_TEL'), 'align'=>'', 'p'=>'','mask'=>'', 'r'=>0, 'd'=>0, 'note'=>'' ]
];

$_row_3 = [
     ['size'=>'col-6' ,'t'=>'input', 'label'=>'보증보험 수수료(이전)', 'name'=>___makeField(TEXT_FIELD,'COMP_NM'), 'align'=>'', 'p'=>'', 'r'=>1]
    ,['size'=>'col-6' ,'t'=>'input', 'label'=>'보증보험 수수료(신규)', 'name'=>___makeField(TEXT_FIELD,'COMP_PIN'), 'align'=>'', 'p'=>'','mask'=>'', 'r'=>0, 'd'=>0, 'note'=>'' ]
];

$_row_4 = [
     ['size'=>'col-3' ,'t'=>'input', 'label'=>'임대료 수납은행', 'name'=>___makeField(TEXT_FIELD,'bank_name'), 'align'=>'', 'p'=>'', 'r'=>1]
    ,['size'=>'col-3' ,'t'=>'input', 'label'=>'수납 계약자표시방법', 'name'=>___makeField(TEXT_FIELD,'NAME_FORMAT'), 'align'=>'', 'p'=>'','mask'=>'', 'r'=>0, 'd'=>0, 'note'=>'' ]
    ,['size'=>'col-3' ,'t'=>'input', 'label'=>'담당자 전화번호', 'name'=>___makeField(TEXT_FIELD,'comp_tel'), 'align'=>'', 'p'=>'','mask'=>'', 'r'=>0, 'd'=>0, 'note'=>'' ]
    ,['size'=>'col-3' ,'t'=>'input', 'label'=>'현금영수증 발행구분', 'name'=>___makeField(TEXT_FIELD,'cashbill_number_type'), 'align'=>'', 'p'=>'','mask'=>'', 'r'=>0, 'd'=>0, 'note'=>'' ]
];

$_row_5 = [
     ['size'=>'col-3' ,'t'=>'input', 'label'=>'문자 수신번호', 'name'=>___makeField(TEXT_FIELD,'COMP_NM'), 'align'=>'', 'p'=>'', 'note'=>'문자서비스 사이트 발신번호를 등록해야 합니다.']
    ,['size'=>'col-3' ,'t'=>'input', 'label'=>'팝빌 ID', 'name'=>___makeField(TEXT_FIELD,'popbill_id'), 'align'=>'', 'p'=>'','mask'=>'', 'r'=>0, 'd'=>0, 'note'=>'' ]
    ,['size'=>'col-3' ,'t'=>'input', 'label'=>'담당자 전화번호', 'name'=>___makeField(TEXT_FIELD,'comp_tel'), 'align'=>'', 'p'=>'','mask'=>'', 'r'=>0, 'd'=>0, 'note'=>'' ]
    ,['size'=>'col-3' ,'t'=>'input', 'label'=>'현금영수증 발행구분', 'name'=>___makeField(TEXT_FIELD,'cashbill_number_type'), 'align'=>'', 'p'=>'','mask'=>'', 'r'=>0, 'd'=>0, 'note'=>'phone = 전화번호 , ssn = 주민번호' ]
];

$_editRow = [$_row_1,$_row_2,$_row_3,$_row_4,$_row_5];