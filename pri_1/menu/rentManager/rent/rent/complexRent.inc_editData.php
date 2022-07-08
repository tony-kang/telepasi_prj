<?php
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
// t: input type , d : disabled , c : color , p : placeHolder , r : required
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
$_row_1 = [
     ['size'=>'col-3' ,'t'=>'input', 'label'=>'단지코드', 'name'=>___makeField(TEXT_FIELD,'complex'), 'align'=>'', 'p'=>'', 'r'=>0,'d'=>1]
    ,['size'=>'col-2' ,'t'=>'input', 'label'=>'동', 'name'=>___makeField(TEXT_FIELD,'dong'), 'align'=>'', 'p'=>'','mask'=>'', 'r'=>0,'d'=>1]
    ,['size'=>'col-2' ,'t'=>'input', 'label'=>'층', 'name'=>___makeField(NUMBER_FIELD,'floor'), 'align'=>'', 'p'=>'','mask'=>'', 'r'=>0, 'd'=>1 ]
];

$_row_2 = [
     ['size'=>'col-2' ,'t'=>'input', 'label'=>'호실', 'name'=>___makeField(TEXT_FIELD,'ho'),'align'=>'center' , 'r'=>1]
    ,['size'=>'col-3' ,'t'=>'input', 'label'=>'시설명', 'name'=>___makeField(TEXT_FIELD,'nickname'), 'align'=>'center', 'note'=>'어린이집, 보일러실 등 일반임대시설이 아닌경우 입력하세요.' ]
    ,['size'=>'col-3' ,'t'=>'select', 'label'=>'상태', 'name'=>___makeField(NUMBER_FIELD,'state'), 'select'=>___envArr('M002','env_rm.txt') ]

];

$_editRow = [$_row_1,$_row_2];