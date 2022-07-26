<?php
/**
 * @author tony on 2022. 7. 24.
 * @author Tony Kang <bluein007@gmail.com>
 * Description
 *
 */

$jsonArr = array(
    [ 'text'=> '강병우' , 'memo'=>'프로그램 최고!!'],
    [ 'text'=> '홍길동' , 'memo'=>'동해번쩍 최고!!'],
    [ 'text'=> '일지매' , 'memo'=>'창던지기 최고!!'],
);

echo json_encode($jsonArr);