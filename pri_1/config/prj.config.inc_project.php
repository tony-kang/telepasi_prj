<?php
/**
 * @author tony on 2022. 6. 23.
 * @author Tony Kang <bluein007@gmail.com>
 * Description
 *
 */

//################################################################################################
// 개발사 표시
//################################################################################################
const POWERED_BY = 'Tony Kang';
const POWERED_BY_HOMEPAGE = 'www.telepasi.co.kr';
const POWERED_BY_DESC = '텔레파시';
const POWERED_BY_MARK = 'TELEPASI';

//################################################################################################
// 프로젝트 정보 설정
//################################################################################################
const PRJ_NAME = '온동네 임대관리 프로젝트';
const MY_PRJ_TITLE = 'ODN-RentManager';

//왼쪽 메뉴위에 표시되는 텍스트
const MENU_TOP_TEXT_1 = '임대관리';
const MENU_TOP_TEXT_2 = 'Rent Manager';


//################################################################################################
// 사이트 디버깅 관련 셋팅
//################################################################################################
const DEBUG_ENABLE = true;                  // Debug On
const VIEW_PRJ_GLOBAL_VARIABLE = false;     // index.php 수행단계에서 정의된 글로벌 변수 및 상수 보기
const HEADER_AREA_DEBUG = false;            // 컨텐츠 메인창에 Debug 영역 확보
const PHP_CALL_TRACE = false;               // 메인 컨텐츠 파일 호출 순서 Trace 보기.
const PHP_CSS_JS_TRACE = true;              // 메인 컨텐츠 파일 호출 순서 Trace 보기.
const DEBUG_SRC_FILE_NAME = false;          // 메인 컨텐츠 파일 호출 PHP source filename 보기.
const DEBUG_PHP_SRC_PATH = false;           // 메인 컨텐츠 PHP Src 파일이 결정되는 순서 및 정보 보기.
const DEBUG_PRINT_EXECUTE_TIME = true;      // 메인 컨텐츠 처리 시간 표시
//################################################################################################
// 사이트 실행관련 셋팅
//################################################################################################
// 시스템 점검 또는 사이트 이동 안내등...
// SYS_NORMAL   : 정상동작
// SYS_REDIRECT : 사이트 이동(이전) 안내
// SYS_CHECK    : 사이트 점검중 안내
const SYS_ACTIVATION = SYS_NORMAL;

// 기능 활성과 관련
const HAS_LOGOUT_ALERT = true;              // 로그아웃시 컨펌 Alert 사용
const HAS_USER_HOME = true;                 // true : home page를 띄움 , false login page를 띄움 PRJ_START_MENU는 무시됨.
const HAS_ATTENDANCE_MENU = true;           // true : 근태관리 나오게 ,  false : 근태관리 안나오게

// 사이트 동작관련
const PRJ_START_MENU = 'dashboard';             // 사이트 시작메뉴
const PRJ_START_MENU_GROUP = 'calendar';        // 사이트 시작메뉴 그룹
const PRJ_START_MENU_ITEM = 'calendar';         // 사이트 시작메뉴

// 세션 유지 시간
const PRJ_SESSION_TIME = 604800;            // 세션유지시간 = 3600초 = 1시간 , 604800 = 7일

//구글 통계 관련 셋팅
const HAS_GOOGLE_ANALYTICS = false;
const PRJ_GOOGLE_ANALYTICS_ID = '';

//################################################################################################
// 기능관련 셋팅(
//################################################################################################
const HAS_ATTENDANCE_MENU = true;   //근태관리


//################################################################################################
// 기능관련 셋팅(전자결재)
//################################################################################################
//결재 차례가 오지 않은 경우 리스트에서 보여줄지 말지를 처리
//  true : 자기차례가 된 결재만 보임.
// false : 자기차례가 되지 않은 결재는 보이지 않음.
const APPROVAL_VIEW_ONLY_MY_TURN = true;

//  true : 배지 나오게
// false : 배지 안나오게
const APPROVAL_VIEW_BADGE = true;
const APPROVAL_COUNT_MY_START_CONFIRM_ZERO = true;  //상신결재 카운트는 표시하지 않음.
const APPROVAL_COUNT_MY_CONFIRM_OK_ZERO = true;     //결재완료 카운트는 표시하지 않음.
const APPROVAL_COUNT_MY_CONFIRM_DONE_ZERO = true;   //최종(승인/반려) 카운트는 표시하지 않음.
const APPROVAL_COUNT_MY_START_TEMP_SAVE_ZERO = true; //임시저장함 카운트는 표시하지 않음.
