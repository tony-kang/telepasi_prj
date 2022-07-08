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
    $complexName = $pComplex['complexName'];
}

//___debug($_pg['rentQueryType']);
$_editDb['title'] = '입주 세대 ';
if ($_pg['rentQueryType'] == 'latest_moveOut')              $_editDb['title'] = sprintf('최근 %d일 퇴거 세대 ',$_pg['durationDay']);
else if ($_pg['rentQueryType'] == 'yearMonth_moveOut')      $_editDb['title'] = sprintf('%d년 %d월 퇴거 세대 ',(int)substr($_pg['baseMonth'],0,4),(int)substr($_pg['baseMonth'],-2));
else if ($_pg['rentQueryType'] == 'yearMonth_newContract')  $_editDb['title'] = sprintf('%d년 %d월 신규계약 세대 ',(int)substr($_pg['baseMonth'],0,4),(int)substr($_pg['baseMonth'],-2));
else if ($_pg['rentQueryType'] == 'yearMonth_reContract')   $_editDb['title'] = sprintf('%d년 %d월 갱신계약 세대 ',(int)substr($_pg['baseMonth'],0,4),(int)substr($_pg['baseMonth'],-2));

//################################################################################################################
//################################################################################################################
$_editDb['table'] = 'rm_ho';
$_editDb['puField'] = 'no';
$_editDb['puType'] = NUMBER_FIELD;
$_editDb['getPara'] = 'ho';
$_editDb['formId'] = 'id_dbComplexDong';
$_editDb['iudField'] = [ 'insert'=>'mbrUid | regDate' ,'update'=>'updateMbr | updateDate' ,'delete'=>'deleted | deleteMbr | deleteDate' ]; //
$_editDb['saveCallback'] = 'hoSaveCallback';

//----------------------------------------------------------------------------------------------------------------
$_pg['btnArr'] = $_btnArr = [
    //[ 'action'=>'edit_newHo' , 'caption'=>'신규 호 등록' , 'type'=>'btn-success' ,'icon'=>'' , 'style'=>'' , 'para'=>[] ],
];

//----------------------------------------------------------------------------------------------------------------
$dateOpArr = [0=>'날짜 사용 안함', 1=>'계약일', 2=>'임대 시작일', 3=>'임대 종료일' ];
$_pg['searchArr'] = $_searchArr = [
    [ 'label'=>'이름', 'tag'=>'input' , 'placeHolder'=>'이름,전화,계약번호' , 'id'=>'sName' , 'leftMargin'=>0,'style'=>'width:120px'],
    [ 'label'=>'동호', 'tag'=>'input' , 'placeHolder'=>'동 호' , 'id'=>'sDongHo' , 'style'=>'width:100px'],
    [ 'label'=>'날짜', 'tag'=>'select' , 'placeHolder'=>'' , 'id'=>'dateOp' ,'select'=>$dateOpArr , 'style'=>'width:120px'],
    [ 'label'=>'구간', 'tag'=>'date' , 'placeHolder'=>'시작' , 'id'=>'sDate' , 'style'=>'width:100px; text-align:center;', 'tail'=>'&nbsp;~&nbsp;','rightMargin'=>'0','duration'=>''],
    [ 'label'=>'', 'tag'=>'date' , 'placeHolder'=>'종료' , 'id'=>'eDate' , 'style'=>'width:100px; text-align:center;','leftMargin'=>'0','duration'=>''],
];
