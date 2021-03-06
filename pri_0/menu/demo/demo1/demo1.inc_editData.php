<?php
$editRow = new MyDbEditRow();

// Row 1
$editRow->newColumn()->size('col-2')->dbField(TEXT_FIELD,'data_1')->type(ET_INPUT)->label('입력 1')->required(true)->note('일반입력(필수)')->addCol();
$editRow->newColumn()->size('col-2')->dbField(TEXT_FIELD,'data_2')->type(ET_INPUT)->label('입력 2')->disabled(true)->note('일반입력(Disable)')->addCol();
$editRow->newColumn()->size('col-2')->dbField(TEXT_FIELD,'data_3')->type(ET_SELECT)->label('선택(Selector)')->addCol(___envArr('X009',EF_SEL_1));
$editRow->newColumn()->size('col-6')->dbField(TEXT_FIELD,'data_4')->type(ET_RADIO)->label('선택(Radio)')->addCol(___envArr('X009',EF_SEL_1));
$editRow->addRow()->hr();   //아래쪽에 구분선 출력

// Row 2
$editRow->newColumn()->size('col-6')->dbField(TEXT_FIELD,'data_5')->type(ET_CHECKBOX)->label('선택(Checkbox)')->addCol(___envArr('X006',EF_SEL_1));
$editRow->newColumn()->size('col-2')->dbField(TEXT_FIELD,'data_6')->type(ET_NUMBER)->label('숫자(5~20')->minMax(5,20)->default(10)->alignRight()->addCol();
$editRow->newColumn()->size('col-2')->dbField(DATE_FIELD,'data_7')->type(ET_INPUT)->label('날짜')->alignCenter()->addCol();
$editRow->newColumn()->size('col-2')->dbField(TIME_FIELD,'data_8')->type(ET_INPUT)->label('시간')->alignCenter()->addCol();
$editRow->addRow()->hr();

// Row 3
$editRow->newColumn()->size('col-2')->dbField(TEXT_FIELD,'data_9')->type(ET_COLOR_PICKER)->label('칼라')->addCol();
$editRow->newColumn()->size('col-4')->dbField(TEXT_FIELD,'data_10')->type(ET_STEPS)->label('진행상태(Step)')->addCol(___envArr('X011',EF_SEL_1));
$editRow->newColumn()->size('col-6')->dbField(TEXT_FIELD,'data_11')->type(ET_TEXTAREA)->label('메모')->height(100)->placeHolder('내용을 입력하세요')->addCol();
$editRow->addRow()->hr();

// Row 4
$editRow->newColumn()->size('col-2')->dbField(TEXT_FIELD,'data_12')->type(ET_INPUT)->label('회사명')->addCol();
$editRow->newColumn()->size('col-2')->dbField(TEXT_FIELD,'data_13')->type(ET_EMPTY)->addCol();
$editRow->newColumn()->size('col-8')->dbField(TEXT_FIELD,'data_14')->type(ET_INPUT)->label('회사주소')->placeHolder('주소를 입력하세요.')->addCol();
$editRow->addRow()->hr();

// Row 5
$editRow->newColumn()->size('col-6')->dbField(TEXT_FIELD,'data_15')->type(ET_SELECT)->label('일정구분')->addCol(___calendarGroupArr());
$editRow->newColumn()->size('col-3')->dbField(DATE_FIELD,'data_16')->type(ET_INPUT)->label('시작일')->alignCenter()->addCol();
$editRow->newColumn()->size('col-3')->dbField(DATE_FIELD,'data_17')->type(ET_INPUT)->label('종료일')->alignCenter()->addCol();
$editRow->addRowContinue(); // 다음 Row와 갭없이 붙임.

// Row 6
$calendarItemNote = ___isAdmin() ? '필요한 항목은 환경설정에서 편집해 주세요.&nbsp;&nbsp; <a href="/?cfg=menuEnv&mN=custEnv"><i class="fas fa-edit"></i> 바로가기</a>' : '';
$editRow->newColumn()->size('col-6')->type('spacer')->note($calendarItemNote)->addCol();    // 빈공간으로 지정하고 설명 붙임.
$editRow->newColumn()->size('col-3')->dbField(TIME_FIELD,'data_18')->type(ET_INPUT)->placeHolder('시작시간')->alignCenter()->addCol();
$editRow->newColumn()->size('col-3')->dbField(TIME_FIELD,'data_19')->type(ET_INPUT)->placeHolder('종료시간')->alignCenter()->addCol();
$editRow->addRow()->hr();

// Row 7
include_once MY_SRC_PATH.'/search/searchUser_forEdit.php';
$editRow->newColumn()->size('col-4')->dbField(DB_NUMBER_FIELD,'number_21')->type(ET_INPUT_SEARCH)->label('담당자')->default(0)->addCol($searchUser_forEdit,'담당자 검색','');
$editRow->newColumn()->size('col-6')->dbField(URL_FIELD,'data_20')->type(ET_INPUT)->label('홈페이지(URL)')->addCol();
$editRow->addRow()->hr();

// Row 8
$editRow->newColumn()->size('col-6')->dbField(EDITOR_FIELD,'text_31')->type(ET_HTML_EDITOR)->label('HTML 편집')->addCol();
$editRow->addRow();

$_editRow = $editRow->getRows();
//___print($_editRow);
