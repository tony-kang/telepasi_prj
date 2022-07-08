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
$_dbEditForm = new MyDbEditForm('id_configHo', 'rm_ho', '호실 관리');
$_editDb = $_dbEditForm
    ->puField('no')
    ->puType(NUMBER_FIELD)
    ->puParaName('ho')
    ->listViewer('___tableComplexDongHo')
    ->breadcrumbs(['caption' => '동호', 'url' => ''], ['caption' => '호실 관리', 'url' => ''])
    ->callback('hoSaveCallback')
    ->make();
//___print($_editDb);


//----------------------------------------------------------------------------------------------------------------
$sBtnList = new MySearchBtn();

//----------------------------------------------------------------------------------------------------------------
$sFieldList = new MySearchField();
