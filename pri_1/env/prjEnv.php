<?php
//function html_envEditorTemplete($envEditor) {
//    $envTitle = $envEditor['title'];
//    $envTextFile = $envEditor['envFile'];
//
//    $envDesc = ___panelDesc(sprintf('[ %s ]<br>코드가 중복되지 않도록 입력해 주세요.',$envTextFile));
//    $html = '
//        <div class="col-lg-12 col-xl-6">
//            <div class="panel panel-collapsed">
//                '.___panelHeader($envTitle,'코드 편집').'
//                <div class="panel-container"><!-- 닫힌상태 : collapse 추가 -->
//                    <div class="panel-content">
//                        '.$envDesc.'
//                        <div class="frame-wrap">
//                            '.___panelTextEditor($envTextFile,300).'
//                        </div>
//                    </div>
//                </div>
//            </div>
//        </div>';
//    return $html;
//}

$envEditorArr = [
    [ 'size'=>'col-6' , 'envFile'=>'env_docGroup'     , 'title'=>'문서그룹'               , 'editDesc'=>'' ],
    [ 'size'=>'col-6' , 'envFile'=>'env_docCode'      , 'title'=>'문서코드'               , 'editDesc'=>'' ],
    [ 'size'=>'col-12' , 'envFile'=>'env_excel'        , 'title'=>'엑셀파일 DB화'           , 'editDesc'=>'ERP내에서 엑셀로 자료를 업로드 하는 경우 엑셀파일 칼럼구조 지정' ],
    [ 'size'=>'col-12' , 'envFile'=>'env_excelData'    , 'title'=>'엑셀파일 생성'           , 'editDesc'=>'ERP내에서 생성되는 엑셀의 데이타 형식을 지정합니다.' ],
    [ 'size'=>'col-12' , 'envFile'=>'env_m11'          , 'title'=>'업무코드 설정'           , 'editDesc'=>'<my class="text-danger">코드를 추가하고 사이트에 적용 하려면 개발자에 요청해 주세요 </my>' ],
    [ 'size'=>'col-12' , 'envFile'=>'env_cust'         , 'title'=>'업무코드 설정'           , 'editDesc'=>'<my class="text-danger">코드를 추가하고 사이트에 적용 하려면 개발자에 요청해 주세요 </my>' ],
    [ 'size'=>'col-6' , 'envFile'=>'env_calendar'     , 'title'=>'달력일정 설정'           , 'editDesc'=>'일정관련 코드및 항목을 지정합니다.' ],
    [ 'size'=>'col-3' , 'envFile'=>'env_code'         , 'title'=>'환경설정 코드지정'        , 'editDesc'=>'코드 지정' ],
    [ 'size'=>'col-3' , 'envFile'=>'env_org'          , 'title'=>'사업장 코드'            , 'editDesc'=>'그룹사 | 사업장 | 사업부 코드' ],
];

echo html_envEditor($envEditorArr);
