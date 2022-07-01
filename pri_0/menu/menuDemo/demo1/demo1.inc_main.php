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
$_pg['btnArr'] = $_btnArr = [
    [ 'action'=>'edit_newData' , 'caption'=>'신규데이타 등록' , 'type'=>'btn-success' ,'icon'=>'' , 'style'=>'' , 'para'=>[] ],
];
//----------------------------------------------------------------------------------------------------------------
$_pg['searchArr'] = $_searchArr = [
    [ 'label'=>'data 1', 'tag'=>'input' , 'placeHolder'=>'' , 'id'=>'sKey1' , 'style'=>'width:150px'],
    [ 'label'=>'등록자', 'tag'=>'input' , 'placeHolder'=>'' , 'id'=>'sKey2' , 'style'=>'width:150px'],
//    [ 'label'=>'년', 'tag'=>'select' , 'placeHolder'=>'' , 'id'=>'year' , 'select'=>___numberArr(-1,'년',(int)date('Y')-5,(int)date('Y')+1,false,999),'style'=>'width:100px'],
//    [ 'label'=>'월', 'tag'=>'select' , 'placeHolder'=>'' , 'id'=>'month' ,'select'=>___numberArr(1,'월',1,12,false,999) , 'style'=>'width:100px'],
];
