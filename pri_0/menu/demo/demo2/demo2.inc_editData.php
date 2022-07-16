<?php
$editRow = new MyDbEditRow();

// Row 1
$editRow->newColumn()->size('col-2')->dbTable(TEXT_FIELD,'data_1')->type(ET_INPUT)->label('입력 1')->required(true)->note('일반입력(필수)')->addCol();
$editRow->newColumn()->size('col-2')->dbTable(TEXT_FIELD,'data_2')->type(ET_INPUT)->label('입력 2')->disabled(true)->note('일반입력(Disable)')->addCol();
$editRow->newColumn()->size('col-2')->dbTable(TEXT_FIELD,'data_3')->type(ET_SELECT)->label('선택(Selector)')->addCol(___envArr('X009','env_demo.txt'));
$editRow->newColumn()->size('col-6')->dbTable(TEXT_FIELD,'data_4')->type(ET_RADIO)->label('선택(Radio)')->addCol(___envArr('X009','env_demo.txt'));
$editRow->addRow()->hr();


// Row 2
$userPhotoUpload = ___makeDbEditUploader('t_uploadUser','upload1',IMG_TAG,IMG_CTRL,'사용자 사진');
$userPhotoUpload_2 = ___makeDbEditUploader('t_uploadUser','upload2',IMG_TAG,IMG_CTRL,'사용자 사진');
$userProfileUpload = ___makeDbEditUploader('t_uploadUser','upload3',DOC_TAG,DOC_CTRL,'이력서 PDF');
$editRow->newColumn()->size('col-3')->dbTable(IMG_FIELD,'upload1')->type(ET_IMG_UPLOAD)->label('사진(1)')->note('사진파일 업로드')->addCol($userPhotoUpload,120,160);
$editRow->newColumn()->size('col-3')->dbTable(IMG_FIELD,'upload2')->type(ET_IMG_UPLOAD)->label('사진(2)')->note('사진파일업로드')->addCol($userPhotoUpload_2,85,120);
$editRow->newColumn()->size('col-3')->dbTable(IMG_FIELD,'upload3')->type(ET_DOC_UPLOAD)->label('이력서')->note('pdf 사용을 권장합니다.')->addCol($userProfileUpload,60,60);
$editRow->addRow()->hr();

$_editRow = $editRow->getRows();
//___print($_editRow);
