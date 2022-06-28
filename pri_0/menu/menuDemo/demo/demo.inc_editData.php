<?php
$editRow = new MyDbEditRow();

// Row 1
$editRow->newColumn()->size('col-2')->dbTable(TEXT_FIELD,'data_1')->type('input')->label('입력 1')->required(true)->note('일반입력(필수)')->addCol();
$editRow->newColumn()->size('col-2')->dbTable(TEXT_FIELD,'data_2')->type('input')->label('입력 2')->disabled(true)->note('일반입력(Disable)')->addCol();
$editRow->newColumn()->size('col-2')->dbTable(TEXT_FIELD,'data_3')->type('select')->label('선택(Selector)')->envSelector('X009','env_prj.txt')->addCol();
$editRow->newColumn()->size('col-6')->dbTable(TEXT_FIELD,'data_4')->type('radio')->label('선택(Radio)')->envRadio('X009','env_prj.txt')->addCol();
$editRow->addRow()->hr();

// Row 2
$editRow->newColumn()->size('col-6')->dbTable(TEXT_FIELD,'data_5')->type('checkbox')->label('선택(Checkbox)')->envCheckbox('X006','env_prj.txt')->addCol();
$editRow->newColumn()->size('col-2')->dbTable(TEXT_FIELD,'data_6')->type('number')->label('숫자(5~20')->minMax(5,20)->default(10)->alignRight()->addCol();
$editRow->newColumn()->size('col-2')->dbTable(DATE_FIELD,'data_7')->type('input')->label('날짜')->alignCenter()->addCol();
$editRow->newColumn()->size('col-2')->dbTable(TIME_FIELD,'data_8')->type('input')->label('시간')->alignCenter()->addCol();
$editRow->addRow()->hr();

// Row 3
$editRow->newColumn()->size('col-2')->dbTable(TEXT_FIELD,'data_9')->type('colorPicker')->label('칼라')->addCol();
$editRow->newColumn()->size('col-4')->dbTable(TEXT_FIELD,'data_10')->type('steps')->label('진행상태(Step)')->envSteps('X011','env_prj.txt')->addCol();
$editRow->newColumn()->size('col-6')->dbTable(TEXT_FIELD,'data_11')->type('textarea')->label('메모')->height(100)->placeHolder('내용을 입력하세요')->addCol();
$editRow->addRow()->hr();

// Row 4
$editRow->newColumn()->size('col-2')->dbTable(TEXT_FIELD,'data_12')->type('input')->label('회사명')->addCol();
$editRow->newColumn()->size('col-2')->dbTable(TEXT_FIELD,'data_13')->type('empty')->addCol();
$editRow->newColumn()->size('col-8')->dbTable(TEXT_FIELD,'data_14')->type('input')->label('회사주소')->placeHolder('주소를 입력하세요.')->addCol();
$editRow->addRow()->hr();

// Row 5
$editRow->newColumn()->size('col-6')->dbTable(TEXT_FIELD,'data_15')->type('select')->label('일정구분')->selector( ___calendarGroupArr())->addCol();
$editRow->newColumn()->size('col-3')->dbTable(DATE_FIELD,'data_16')->type('input')->label('시작일')->alignCenter()->addCol();
$editRow->newColumn()->size('col-3')->dbTable(DATE_FIELD,'data_17')->type('input')->label('종료일')->alignCenter()->addCol();
$editRow->addRowContinue(); // 다음 Row와 갭없이 붙임.

// Row 6
$calendarItemNote = ___isAdmin() ? '필요한 항목은 환경설정에서 편집해 주세요.&nbsp;&nbsp; <a href="/?cfg=menuEnv&mN=custEnv"><i class="fas fa-edit"></i> 바로가기</a>' : '';
$editRow->newColumn()->size('col-6')->type('spacer')->note($calendarItemNote)->addCol();    // 빈공간으로 지정하고 설명 붙임.
$editRow->newColumn()->size('col-3')->dbTable(TIME_FIELD,'data_18')->type('input')->placeHolder('시작시간')->alignCenter()->addCol();
$editRow->newColumn()->size('col-3')->dbTable(TIME_FIELD,'data_19')->type('input')->placeHolder('종료시간')->alignCenter()->addCol();
$editRow->addRow()->hr();

// Row 7
include_once MY_SRC_PATH.'/search/searchUser_forEdit.php';
$editRow->newColumn()->size('col-4')->dbTable(DB_NUMBER_FIELD,'number_21')->type('inputSearch')->label('담당자')->default(0)->addCol()->searchInput('담당자 검색',$searchUser_forEdit,'');
$editRow->newColumn()->size('col-6')->dbTable(URL_FIELD,'data_20')->type('input')->label('홈페이지(URL)')->addCol();
$editRow->addRow()->hr();

// Row 8
$editRow->newColumn()->size('col-6')->dbTable(EDITOR_FIELD,'text_31')->type('htmlEditor')->label('HTML 편집')->addCol();
$editRow->addRow();

$_editRow = $editRow->getRows();
//___print($_editRow);
/*
    ['size'=>'col-12' ,'t'=>'', 'label'=>'템플릿 내용', 'name'=>___makeField(,'contents'), 'align'=>'','mask'=>'', 'r'=>0, 'd'=>0, 'note'=>'' ]

 */
