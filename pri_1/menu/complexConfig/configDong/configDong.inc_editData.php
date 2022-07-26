<?php
/**
 * @author tony on 2022. 5. 17.
 * @author Tony Kang <bluein007@gmail.com>
 * Description
 *
 */
$editRow = new MyDbEditRow();

// Row 1
$editRow->newColumn()->dbField(HIDDEN_TEXT_FIELD,'complex')->hidden()->value($_pg['complex'])->addCol();
$editRow->newColumn()->size('col-2')->dbField(TEXT_FIELD,'dong')->type(ET_INPUT)->label('동이름(번호)')->required(true)->note('예> 101')->addCol();
$editRow->newColumn()->size('col-2')->dbField(NUMBER_FIELD,'maxFloor')->type(ET_NUMBER)->label('최고층')->minMax(1,100)->addCol();
$editRow->newColumn()->size('col-2')->dbField(NUMBER_FIELD,'hoCnt')->type(ET_NUMBER)->label('층당 세대수')->minMax(1,100)->addCol();
$editRow->newColumn()->size('col-3')->dbField(TEXT_FIELD,'hoFormat')->type(ET_INPUT)->label('호수 표시규격')->default('([FLOOR]*100) + [HO]')->addCol();
$editRow->addRow()->hr();   //아래쪽에 구분선 출력

$_editRow = $editRow->getRows();
//___print($_editRow);
