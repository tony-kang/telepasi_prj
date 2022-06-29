<?php
/**
 * @author tony on 2022. 5. 17.
 * @author Tony Kang <bluein007@gmail.com>
 * Description
 *
 */

//################################################################################################################
// XXX.inc_main
//################################################################################################################
$_editDb['title'] = '데모 리스트(1)';
$_editDb['table'] = 'prj_demo1';        // database table name
$_editDb['puField'] = 'no';             // primary or unique Key field
$_editDb['puType'] = NUMBER_FIELD;      // primary or unique Key type : NUMBER_FIELD or STRING_FIELD
$_editDb['getPara'] = 'gPara';          // get parameter name
$_editDb['formId'] = 'id_dbTableDemo';  // form ID
$_editDb['iudField'] = [ 'insert'=>'regMbr | regDate' ,'update'=>'updateMbr | updateDate' ,'delete'=>'deleted | deleteMbr | deleteDate' ]; // 왠만한 테블에는 모두 추가해 주세요.
//----------------------------------------------------------------------------------------------------------------

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
