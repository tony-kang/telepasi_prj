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
    $complexName = '('.$pComplex['complexName'].')';
}
//################################################################################################################
// XXX.inc_main
//################################################################################################################
$_editDb['title'] = '단지 관리'.$complexName;
$_editDb['table'] = 'rm_ho';
$_editDb['puField'] = 'no';
$_editDb['puType'] = NUMBER_FIELD;
$_editDb['getPara'] = 'ho';
$_editDb['formId'] = 'id_dbComplexDong';
$_editDb['iudField'] = [ 'insert'=>'regMbr | regDate' ,'update'=>'updateMbr | updateDate' ,'delete'=>'deleted | deleteMbr | deleteDate' ]; //
$_editDb['saveCallback'] = 'hoSaveCallback';
//----------------------------------------------------------------------------------------------------------------
$_pg['colArr'] = $_colArr = [
    [ 'caption'=>'#', 'align'=>'center', 'width'=>60 ],
    [ 'caption'=>'Action', 'align'=>'center', 'width'=>30 ],
    [ 'caption'=>'동', 'align'=>'center', 'width'=>80 ],
    [ 'caption'=>'층', 'align'=>'center', 'width'=>40 ],
    [ 'caption'=>'호', 'align'=>'center', 'width'=>80 ],
    [ 'caption'=>'시설명', 'align'=>'left', 'width'=>120 ],
    [ 'caption'=>'상태', 'align'=>'center', 'width'=>100 ],
    //[ 'caption'=>'세대수', 'align'=>'right', 'width'=>80 ],
    [ 'caption'=>'수정일', 'align'=>'center', 'width'=>80 ],
    [ 'caption'=>'수정자', 'align'=>'center', 'width'=>80 ],
    [ 'caption'=>'등록일', 'align'=>'center', 'width'=>80 ],
    [ 'caption'=>'등록자', 'align'=>'center', 'width'=>80 ],
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
