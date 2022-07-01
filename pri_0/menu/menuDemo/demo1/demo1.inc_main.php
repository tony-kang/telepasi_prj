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
$_editDb = $_dbEditForm->puField('no')->puType(NUMBER_FIELD)->puParaName('gPara')->make();
//----------------------------------------------------------------------------------------------------------------
//___print($_editDb);


//----------------------------------------------------------------------------------------------------------------
$sBtnList = new MySearchBtn();
$sBtnList->newBtn('신규데이타 등록')->btn('btn-success')->action('edit_newData')->add();

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


////----------------------------------------------------------------------------------------------------------------
//$_pg['btnArr'] = $_btnArr = [
//    [ 'action'=>'edit_newData' , 'caption'=>'신규데이타 등록' , 'type'=>'btn-success' ,'icon'=>'' , 'style'=>'' , 'para'=>[] ],
//];
////----------------------------------------------------------------------------------------------------------------
//$_pg['searchArr'] = $_searchArr = [
//    [ 'label'=>'data 1', 'tag'=>'input' , 'placeHolder'=>'' , 'id'=>'sKey1' , 'style'=>'width:150px'],
//    [ 'label'=>'등록자', 'tag'=>'input' , 'placeHolder'=>'' , 'id'=>'sKey2' , 'style'=>'width:150px'],
////    [ 'label'=>'년', 'tag'=>'select' , 'placeHolder'=>'' , 'id'=>'year' , 'select'=>___numberArr(-1,'년',(int)date('Y')-5,(int)date('Y')+1,false,999),'style'=>'width:100px'],
////    [ 'label'=>'월', 'tag'=>'select' , 'placeHolder'=>'' , 'id'=>'month' ,'select'=>___numberArr(1,'월',1,12,false,999) , 'style'=>'width:100px'],
//];
//
//

//$sBtnList = new MySearchBtn();
//$sBtnList->newBtn('신규데이타 등록')->btn('btn-success')->action('edit_newData')->add();
////$sBtnList->newBtn('버턴 1')->btn('btn-success')->action('edit_newData')->add();
////$sBtnList->newBtn('버턴 2')->btn('btn-primary')->href('?cfg=menuBase&mN=product')->add();
////$sBtnList->newBtn('버턴 3')->btn('btn-info')->action('pr_selectMaterial')->para('keyA','dataA','keyB','dataB')->add();
////$sBtnList->newBtn('엑셀로 저장','fas fa-file-excel')->btn('btn-primary')->modal($_excelDialog['id']);
//$_btnArr = $sBtnList->make();
//
//$sFieldList = new MySearchField();
//$sFieldList->newField('input','sKey1','data 1',150)->add();
//$sFieldList->newField('input','sKey2','등록자',150)->add();
////$sFieldList->newField('input','sKey3','자재규격')->tooltip('이것은 툴팁입니다.')->para('callback','callback_A','tooltip','제품선택')->add();
////$sFieldList->newField('select','sKey4','자재분류')->select(___envArr('X011','env_prj.txt'))->add();
////$sFieldList->newField('reset')->resetPara('product','mp')->add();
//$_searchArr = $sFieldList->make();
//
//___print($_btnArr);
//___print($_searchArr);