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
$_dbEditForm = new MyDbEditForm('id_dbTableDemo','prj_demo1','데모 리스트(1)');
$_editDb = $_dbEditForm->puField('no')->puType(NUMBER_FIELD)->puParaName('gPara')->listViewer('___tableListDemo1')->make();
//___print($_editDb);


//----------------------------------------------------------------------------------------------------------------
$sBtnList = new MySearchBtn();
$sBtnList->newBtn('신규데이타 등록')->btn('btn-success')->action('edit_newData')->add();

//엑셀저장 버턴이 필요한 경우
$_excelDialog = ___excelDialog('id_saveExcel','env_m11.txt','X020','env_excelData.txt');
$sBtnList->newBtn('엑셀로 저장','fas fa-file-excel')->btn('btn-primary')->modal($_excelDialog['id'])->add();
$_btnArr = $sBtnList->make();
//___print($_btnArr);


//----------------------------------------------------------------------------------------------------------------
$sFieldList = new MySearchField();
$sFieldList->newField('input','sKey1','data 1',90)->add();
$sFieldList->newField('input','sKey2','등록자',90)->add();
$_searchArr = $sFieldList->make();
//___print($_searchArr);
