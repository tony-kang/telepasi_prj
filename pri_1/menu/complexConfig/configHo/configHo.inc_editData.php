<?php
$editRow = new MyDbEditRow();

// Row 1
$editRow->newColumn()->size('col-3')->dbField(TEXT_FIELD,'complex')->type(ET_INPUT)->label('단지코드')->disabled(true)->addCol();
$editRow->newColumn()->size('col-2')->dbField(TEXT_FIELD,'dong')->type(ET_NUMBER)->label('동')->disabled(true)->addCol();
$editRow->newColumn()->size('col-2')->dbField(NUMBER_FIELD,'floor')->type(ET_NUMBER)->label('층')->disabled(true)->addCol();
$editRow->addRow()->hr();   //아래쪽에 구분선 출력

// Row 1
$editRow->newColumn()->size('col-2')->dbField(TEXT_FIELD,'ho')->type(ET_INPUT)->label('호실')->disabled(true)->addCol();
$editRow->newColumn()->size('col-3')->dbField(TEXT_FIELD,'nickname')->type(ET_NUMBER)->label('시설명')->note('어린이집, 보일러실 등 일반임대시설이 아닌경우 입력하세요.')->addCol();
$editRow->newColumn()->size('col-2')->dbField(NUMBER_FIELD,'state')->type(ET_SELECT)->label('상태')->addCol(___envArr('M002',EF_SEL_1));
$editRow->newColumn()->size('col-2')->dbField(NUMBER_FIELD,'hoType')->type(ET_SELECT)->label('형태(쉐어형이면 선택)')->addCol(___envArr('M003',EF_SEL_1));
$editRow->newColumn()->size('col-2')->dbField(NUMBER_FIELD,'shareCnt')->type(ET_NUMBER)->label('쉐어개수')->minMax(1,2)->note('쉐어가구수-1')->addCol();
$editRow->addRow()->hr();   //아래쪽에 구분선 출력

$_editRow = $editRow->getRows();
//___print($_editRow);
