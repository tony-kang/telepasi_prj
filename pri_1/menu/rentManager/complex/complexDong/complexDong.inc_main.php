<?php
/**
 * @author tony on 2022. 5. 17.
 * @author Tony Kang <bluein007@gmail.com>
 * Description
 *
 */

$complexName = '';
if ($_pg['complex']) {
    $pComplex = db_getDbdata(S_DB,'salt_COMPX_COMP_I','COMPX_NM as complexName,ADDR as complexAddr','COMPX_CD="'.$_pg['complex'].'"');
    $complexName = '('.$pComplex['complexName'].' - '.___ellipsis($pComplex['complexAddr'],15).')';
}
//################################################################################################################
// XXX.inc_main
//################################################################################################################
$_editDb['title'] = '단지 관리'.$complexName;
$_editDb['table'] = 'rm_dong';
$_editDb['puField'] = 'no';
$_editDb['puType'] = NUMBER_FIELD;
$_editDb['getPara'] = 'dong';
$_editDb['formId'] = 'id_dbComplexDong';
$_editDb['iudField'] = [ 'insert'=>'mbrUid | regDate' ,'update'=>'updateMbr | updateDate' ,'delete'=>'deleted | deleteMbr | deleteDate'];
//----------------------------------------------------------------------------------------------------------------

//----------------------------------------------------------------------------------------------------------------
$_pg['btnArr'] = $_btnArr = [
    [ 'action'=>'edit_newComplexDong' , 'caption'=>'신규 동 등록' , 'type'=>'btn-success' ,'icon'=>'' , 'style'=>'' , 'para'=>[] ],
];
//----------------------------------------------------------------------------------------------------------------
$_pg['searchArr'] = $_searchArr = [
//    [ 'label'=>'제품', 'tag'=>'input' , 'placeHolder'=>'이름' , 'id'=>'sKey' , 'style'=>'width:200px'],
//    [ 'label'=>'년', 'tag'=>'select' , 'placeHolder'=>'' , 'id'=>'year' , 'select'=>___numberArr(-1,'년',(int)date('Y')-5,(int)date('Y')+1,false,999),'style'=>'width:100px'],
//    [ 'label'=>'월', 'tag'=>'select' , 'placeHolder'=>'' , 'id'=>'month' ,'select'=>___numberArr(1,'월',1,12,false,999) , 'style'=>'width:100px'],
];
