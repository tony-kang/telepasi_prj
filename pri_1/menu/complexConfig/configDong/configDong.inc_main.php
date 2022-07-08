<?php
/**
 * @author tony on 2022. 5. 17.
 * @author Tony Kang <bluein007@gmail.com>
 * Description
 *
 */

//################################################################################################################
// 아래쪽 데이타는 기본값 = 코딩하지 않아도 됨 --> 바꿔야 될 것이 있다면 -->make() 전에 추가
// iudInsertField('regMbr | regDate')->iudUpdateField('updateMbr | updateDate')->iudDeleteField('deleted | deleteMbr | deleteDate');
//################################################################################################################
$_dbEditForm = new MyDbEditForm('id_configDong', 'rm_dong', '단지구성 동관리');
$_editDb = $_dbEditForm
    ->puField('no')
    ->puType(NUMBER_FIELD)
    ->puParaName('dong')
    ->listViewer('___tableComplexDong')
    ->breadcrumbs(['caption' => '단지구성', 'url' => ''], ['caption' => '동관리', 'url' => ''])
    ->make();
//___print($_editDb);


//----------------------------------------------------------------------------------------------------------------
$sBtnList = new MySearchBtn();
$sBtnList->newBtn('신규 동 등록')->btn('btn-success')->action('edit_newComplexDong')->add();
$_btnArr = $sBtnList->make();

//----------------------------------------------------------------------------------------------------------------
$sFieldList = new MySearchField();
$sFieldList->newField('input', 'sDong', '동', 90)->add();
$_searchArr = $sFieldList->make();
//___print($_searchArr);
