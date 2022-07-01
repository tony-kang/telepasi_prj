<?php
/**
 * @author tony on 2022. 5. 17.
 * @author Tony Kang <bluein007@gmail.com>
 * Description
 *
 */

//################################################################################################################
// 기존
//################################################################################################################
//$_editDb['title'] = '데모 리스트(2)';
//$_editDb['table'] = 'prj_demo2';        // database table name
//$_editDb['puField'] = 'no';             // primary or unique Key field
//$_editDb['puType'] = NUMBER_FIELD;      // primary or unique Key type : NUMBER_FIELD or STRING_FIELD
//$_editDb['getPara'] = 'gPara';          // get parameter name
//$_editDb['formId'] = 'id_dbTableDemo';  // form ID
//$_editDb['iudField'] = [ 'insert'=>'regMbr | regDate' ,'update'=>'updateMbr | updateDate' ,'delete'=>'deleted | deleteMbr | deleteDate' ]; // 왠만한 테블에는 모두 추가해 주세요.
//----------------------------------------------------------------------------------------------------------------
//___print($_editDb);

//################################################################################################################
// 변경
// 아래쪽 데이타는 기본값 = 코딩하지 않아도 됨 --> 바꿔야 될 것이 있다면 -->make() 전에 추가
// iudInsertField('regMbr | regDate')->iudUpdateField('updateMbr | updateDate')->iudDeleteField('deleted | deleteMbr | deleteDate');
//################################################################################################################
$_dbEditForm = new MyDbEditForm('id_dbTableDemo','prj_demo2','데모 리스트(2)');
$_editDb = $_dbEditForm->puField('no')->puType(NUMBER_FIELD)->puParaName('gPara')->make();
//----------------------------------------------------------------------------------------------------------------
//___print($_editDb);




//----------------------------------------------------------------------------------------------------------------
$_pg['btnArr'] = $_btnArr = [
    [ 'action'=>'edit_newData' , 'caption'=>'신규데이타 등록' , 'type'=>'btn-success' ,'icon'=>'' , 'style'=>'' , 'para'=>[] ],
];
//----------------------------------------------------------------------------------------------------------------
$_pg['searchArr'] = $_searchArr = [
    [ 'label'=>'데이타', 'tag'=>'input' , 'placeHolder'=>'' , 'id'=>'sKey1' , 'style'=>'width:150px'],
    [ 'label'=>'등록자', 'tag'=>'input' , 'placeHolder'=>'' , 'id'=>'sKey2' , 'style'=>'width:150px'],
//    [ 'label'=>'년', 'tag'=>'select' , 'placeHolder'=>'' , 'id'=>'year' , 'select'=>___numberArr(-1,'년',(int)date('Y')-5,(int)date('Y')+1,false,999),'style'=>'width:100px'],
//    [ 'label'=>'월', 'tag'=>'select' , 'placeHolder'=>'' , 'id'=>'month' ,'select'=>___numberArr(1,'월',1,12,false,999) , 'style'=>'width:100px'],
];
