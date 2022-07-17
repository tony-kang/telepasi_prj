<?php
/**
 * @author tony on 2022. 5. 17.
 * @author Tony Kang <bluein007@gmail.com>
 * Description
 *
 */
//################################################################################################################
// 변경
// 아래쪽 데이타는 기본값 = 코딩하지 않아도 됨 --> 바꿔야 될 것이 있다면 -->make() 전에 추가
// iudInsertField('regMbr | regDate')->iudUpdateField('updateMbr | updateDate')->iudDeleteField('deleted | deleteMbr | deleteDate');
//################################################################################################################
$_dbEditForm = new MyDbEditForm('id_dbTableDemo','t_survey','설문관리');
$_editDb = $_dbEditForm
    ->puField('no')
    ->puType(NUMBER_FIELD)
    ->iudInsertField('regMbr | regDate')
    ->puParaName('survey')
    ->listViewer('___tableSurveyList')
    ->breadcrumbs(['caption'=>'서비스','url'=>''],['caption'=>'설문관리','url'=>''])
    ->make();
//___print($_editDb);

//----------------------------------------------------------------------------------------------------------------
$sBtnList = new MySearchBtn();
$sBtnList->newBtn('설문 등록')->btn('btn-success')->action('edit_newSurvey')->add();

//엑셀저장 버턴이 필요한 경우
//$_excelDialog = ___excelDialog('id_saveExcel','env_prj.txt','X020','env_excelData.txt');
//$sBtnList->newBtn('엑셀로 저장','fas fa-file-excel')->btn('btn-primary')->modal($_excelDialog['id'])->add();
$_btnArr = $sBtnList->make();
//___print($_btnArr);


//----------------------------------------------------------------------------------------------------------------
$sFieldList = new MySearchField();
$sFieldList->newField('input','sTitle','제목',90)->add();
$_searchArr = $sFieldList->make();
//___print($_searchArr);
