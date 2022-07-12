<?php
////------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//// t: input type , d : disabled , c : color , p : placeHolder , r : required
////------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//$_row_1 = [
//     ['size'=>'col-3' ,'t'=>'input', 'label'=>'단지코드', 'name'=>___makeField(TEXT_FIELD,'complex'), 'align'=>'', 'p'=>'', 'r'=>0,'d'=>1]
//    ,['size'=>'col-2' ,'t'=>'input', 'label'=>'동', 'name'=>___makeField(TEXT_FIELD,'dong'), 'align'=>'', 'p'=>'','mask'=>'', 'r'=>0,'d'=>1]
//    ,['size'=>'col-2' ,'t'=>'input', 'label'=>'층', 'name'=>___makeField(NUMBER_FIELD,'floor'), 'align'=>'', 'p'=>'','mask'=>'', 'r'=>0, 'd'=>1 ]
//];
//
//$_row_2 = [
//     ['size'=>'col-2' ,'t'=>'input', 'label'=>'호실', 'name'=>___makeField(TEXT_FIELD,'ho'),'align'=>'center' , 'r'=>1]
//    ,['size'=>'col-3' ,'t'=>'input', 'label'=>'시설명', 'name'=>___makeField(TEXT_FIELD,'nickname'), 'align'=>'center', 'note'=>'어린이집, 보일러실 등 일반임대시설이 아닌경우 입력하세요.' ]
//    ,['size'=>'col-3' ,'t'=>'select', 'label'=>'상태', 'name'=>___makeField(NUMBER_FIELD,'state'), 'select'=>___envArr('M002','env_rm.txt') ]
//
//];

$editRow = new MyDbEditRow();

// Row 1
$editRow->newColumn()->size('col-3')->dbTable(TEXT_FIELD,'complex')->type(ET_INPUT)->label('단지코드')->disabled(true)->addCol();
$editRow->newColumn()->size('col-2')->dbTable(TEXT_FIELD,'dong')->type(ET_NUMBER)->label('동')->disabled(true)->addCol();
$editRow->newColumn()->size('col-2')->dbTable(NUMBER_FIELD,'floor')->type(ET_NUMBER)->label('층')->disabled(true)->addCol();
$editRow->addRow()->hr();   //아래쪽에 구분선 출력

// Row 1
$editRow->newColumn()->size('col-2')->dbTable(TEXT_FIELD,'ho')->type(ET_INPUT)->label('호실')->disabled(true)->addCol();
$editRow->newColumn()->size('col-3')->dbTable(TEXT_FIELD,'nickname')->type(ET_NUMBER)->label('시설명')->note('어린이집, 보일러실 등 일반임대시설이 아닌경우 입력하세요.')->addCol();
$editRow->newColumn()->size('col-2')->dbTable(NUMBER_FIELD,'state')->type(ET_SELECT)->label('상태')->addCol(___envArr('M002','env_rm.txt'));
$editRow->newColumn()->size('col-2')->dbTable(NUMBER_FIELD,'hoType')->type(ET_SELECT)->label('형태(쉐어형이면 선택)')->addCol(___envArr('M003','env_rm.txt'));
$editRow->newColumn()->size('col-2')->dbTable(NUMBER_FIELD,'shareCnt')->type(ET_NUMBER)->label('쉐어개수')->minMax(1,2)->note('쉐어가구수-1')->addCol();
$editRow->addRow()->hr();   //아래쪽에 구분선 출력

$_editRow = $editRow->getRows();
//___print($_editRow);
