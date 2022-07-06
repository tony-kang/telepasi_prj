<?php

$envEditorArr = [
    [ 'size'=>'col-6' , 'envFile'=>'env_m11'     , 'title'=>'업무코드 설정'               , '일반업무에 사용되는 코드및 항목을 지정합니다' ],
    [ 'size'=>'col-6' , 'envFile'=>'env_calendar'      , 'title'=>'문서코드'               , 'editDesc'=>'일정관련 코드및 항목을 지정합니다.' ],
    [ 'size'=>'col-12' , 'envFile'=>'env_excelData'        , 'title'=>'달력일정 설정'           , 'editDesc'=>'ERP내에서 엑셀로 자료를 업로드 하는 경우 엑셀파일 칼럼구조 지정' ],
];

echo html_envEditor($envEditorArr);
