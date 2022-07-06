<?php
/**
 * @author tony on 2022. 6. 23.
 * @author Tony Kang <bluein007@gmail.com>
 * Description
 *
 */

// 파일 Include는 하지 마세요.

// 개발중인 프로젝트의 도메인을 추가해 주세요.
// prj_n 폴더를 myPrj에 만들고
$_prj['prjDomain'] = [
    //prj_0는 개발 프로젝트 입니다. prjNo는 0보다 큰 숫자를 사용해 주세요.
    //prj_1 을 hd.prj.telepasi.co.kr 에 연결하려면
    'odn.telepasi.co.kr' => ['prjNo' => 1 , 'serverDesc'=>'DEV' ],  // 개발서버 connect to  prj_1 에 연결
    'test.telepasi.co.kr' => ['prjNo' => 2 , 'serverDesc'=>'DEV' ],  // 개발서버 connect to  prj_2 에 연결
];

