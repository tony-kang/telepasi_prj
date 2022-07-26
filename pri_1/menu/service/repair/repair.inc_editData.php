<?php
$editRow = new MyDbEditRow();

$editRow->newColumn()->size('col-2')->dbField(TEXT_FIELD,'code')->type(ET_INPUT)->label('단지')->disabled(true)->default(___myManageComplex())->alignCenter()->addCol();
$editRow->newColumn()->size('col-10')->dbField(TEXT_FIELD,'title')->type(ET_INPUT)->label('설문제목')->addCol();
$editRow->addRow()->hr();

// Row 1
$editRow->newColumn()->size('col-3')->dbField(TEXT_FIELD,'provider')->type(ET_INPUT)->label('제공자')->required(true)->note('설문조사 제공업체')->default('다모아')->addCol();
$editRow->newColumn()->size('col-6')->dbField(URL_FIELD,'url')->type(ET_INPUT)->label('조사URL')->required(true)->addCol();
$editRow->newColumn()->size('col-3')->dbField(DATE_FIELD,'expireDate')->type(ET_INPUT)->label('조사마감일')->alignCenter()->addCol();
$editRow->addRow()->hr();

$_editRow = $editRow->getRows();
//___print($_editRow);
