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
$_dbEditForm = new MyDbEditForm('','',$_hoInfo['dongHo']);
$_editDb = $_dbEditForm
    ->listViewer('')
    ->breadcrumbs(['caption'=>'임대관리','url'=>''],['caption'=>$_hoInfo['dongHo'].' 상세','url'=>''])
    ->make();
//___print($_editDb);
