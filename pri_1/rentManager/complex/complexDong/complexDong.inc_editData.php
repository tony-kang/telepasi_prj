<?php
/**
 * @author tony on 2022. 5. 17.
 * @author Tony Kang <bluein007@gmail.com>
 * Description
 *
 */


//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
// t: input type , d : disabled , c : color , p : placeHolder , r : required
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
$_row_1 = [
//    ['t'=>'hidden', 'label'=>'', 'name'=>___makeField(HIDDEN_BBS_FIELD,'bbsNo'), 'align'=>'', 'p'=>'','mask'=>'', 'r'=>0, 'd'=>0, 'value'=>3 ]
//    ,['t'=>'hidden', 'label'=>'', 'name'=>___makeField(HIDDEN_BBSDATA_FIELD,'bbsDataNo'), 'align'=>'', 'p'=>'','mask'=>'', 'r'=>0, 'd'=>0, 'value'=>0 ]
//    ,['t'=>'hidden', 'name'=>___makeField(HIDDEN_NUMBER_FIELD,'salesNo'), 'value'=>$_pg['salesNo']]
    ['t'=>'hidden', 'name'=>___makeField(HIDDEN_TEXT_FIELD,'complex'), 'value'=>$_pg['complex']]
    //['size'=>'col-3' ,'t'=>'input', 'label'=>'단지코드', 'name'=>___makeField(TEXT_FIELD,'complex'), 'align'=>'', 'p'=>'', 'r'=>1]
    ,['size'=>'col-2' ,'t'=>'input', 'label'=>'동이름(번호)', 'name'=>___makeField(TEXT_FIELD,'dong'), 'align'=>'', 'p'=>'','mask'=>'', 'r'=>1, 'd'=>0, 'note'=>'' ]
    ,['size'=>'col-2' ,'t'=>'input', 'label'=>'최고층', 'name'=>___makeField(NUMBER_FIELD,'maxFloor'), 'align'=>'', 'p'=>'','mask'=>'', 'r'=>1, 'd'=>0, 'note'=>'' ]
    ,['size'=>'col-2' ,'t'=>'number', 'label'=>'층당 세대수', 'name'=>___makeField(NUMBER_FIELD,'hoCnt'),'align'=>'right' , 'min'=>1 , 'r'=>1, 'max'=>10]
    ,['size'=>'col-3' ,'t'=>'input', 'label'=>'호수 표시규격', 'name'=>___makeField(TEXT_FIELD,'hoFormat'), 'align'=>'right', 'p'=>'', 'r'=>1,'default'=>'([FLOOR]*10) + [HO]' ]
];

$_editRow = [$_row_1];