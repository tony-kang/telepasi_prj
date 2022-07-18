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
$_editDb['title'] = '임대관리 단지';
$_editDb['puField'] = 'COMPX_CD';
$_editDb['puType'] = STRING_FIELD;
$_editDb['getPara'] = 'complex';
$_editDb['formId'] = 'id_dbComplex';
$_editDb['iudField'] = [ ]; //'insert'=>'regMbr | regDate' ,'update'=>'updateMbr | updateDate' ,'delete'=>'deleted | deleteMbr | deleteDate'
//----------------------------------------------------------------------------------------------------------------
$_pg['colArr'] = $_colArr = [
    [ 'caption'=>'Action', 'align'=>'center', 'width'=>50 ],
    [ 'caption'=>'단지코드', 'align'=>'center', 'width'=>80 ],
    [ 'caption'=>'단지명', 'align'=>'center', 'width'=>120 ],
    [ 'caption'=>'단지주소', 'align'=>'left', 'width'=>200 ],
    [ 'caption'=>'관리회사', 'align'=>'left', 'width'=>150 ],
    [ 'caption'=>'관리사무소 전화번호', 'align'=>'center', 'width'=>100 ],
    [ 'caption'=>'수납은행', 'align'=>'left', 'width'=>80 ],
    //[ 'caption'=>'관리회사 사업자번호', 'align'=>'left', 'width'=>120 ],
    //[ 'caption'=>'관리회사 법인번호', 'align'=>'center', 'width'=>80 ],
    //[ 'caption'=>'문자발신번호', 'align'=>'center', 'width'=>80 ],
];
//----------------------------------------------------------------------------------------------------------------
$_pg['btnArr'] = $_btnArr = [
    //[ 'action'=>'edit_newHo' , 'caption'=>'신규 호 등록' , 'type'=>'btn-success' ,'icon'=>'' , 'style'=>'' , 'para'=>[] ],
];
//----------------------------------------------------------------------------------------------------------------
$_pg['searchArr'] = $_searchArr = [
//    [ 'label'=>'제품', 'tag'=>'input' , 'placeHolder'=>'이름' , 'id'=>'sKey' , 'style'=>'width:200px'],
//    [ 'label'=>'년', 'tag'=>'select' , 'placeHolder'=>'' , 'id'=>'year' , 'select'=>___numberArr(-1,'년',(int)date('Y')-5,(int)date('Y')+1,false,999),'style'=>'width:100px'],
//    [ 'label'=>'월', 'tag'=>'select' , 'placeHolder'=>'' , 'id'=>'month' ,'select'=>___numberArr(1,'월',1,12,false,999) , 'style'=>'width:100px'],
];
