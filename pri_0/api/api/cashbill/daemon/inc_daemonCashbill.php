<?php
/**
 * @author tony on 2022. 4. 25.
 * @author Tony Kang <bluein007@gmail.com>
 * Description
 *
 */

___log($logHandle,'<br><br>');

//-------------------------------------------------------------------------------------------------------------------
// 현금영수증 발행 대상 찾기
//-------------------------------------------------------------------------------------------------------------------
$qField  = 'T.*';   //,CONTT.RENT_AMT as rentAmt
$q = ' totalCashBill < totalPureRentAmount';
if ($daemonId) {
    $q .= ' and daemonId = "'.$daemonId.'"';      // 각 단지마다 데몬을 돌릴경우
}
//$q .= '  and CONTT.CONTT_NO = T.CONTT_NO';
$q .= ' and noCashBill = 0 ';
$q .= ' order by CONTT_NO DESC limit 0,1 ';      // 각 단지마다 데몬을 돌릴경우

$daemon = sql_getDbData(S_DB,'CONTT_MST_I as CONTT,salt_cashBill_mst',$qField,$q);
___log($logHandle,$daemon['q']);

$cashBillAmount = (int)$daemon['totalPureRentAmount'] - (int)$daemon['totalCashBill'];


if (is_array($_SERVER['argv'])) {
//    echo $daemon['q'];
//    echo "\n";
}

//exit; //테스트 종료

if ($cashBillAmount == 0) {
    ___logEnd($logHandle);
    exit;
}
//___debug($daemon['CONTT_NO']);
//___print($daemon);
//exit;
//-------------------------------------------------------------------------------------------------------------------
// 발행대상 정보
//-------------------------------------------------------------------------------------------------------------------
    $COMPX_CD = $daemon['COMPX_CD'];
    $CONTT_NO = $daemon['CONTT_NO'];
    $DONG_NO = $daemon['DONG_NO'];
    $HO_NO = $daemon['HO_NO'];
    $nextStep = false;
    $code = $message = '';  //No Error;
    $alertMessage = "";
    $memo = '자동발행';    // 메모
___log($logHandle,sprintf('[%s][%s][%s][%s][%s] 발행대상',date("Y-m-d H:i:s"),$COMPX_CD,$CONTT_NO,$DONG_NO,$HO_NO));

$saltComplex = sql_getDbData(S_DB,'salt_COMPX_COMP_I','*','COMPX_CD = "'.$COMPX_CD.'"');
$cashbillNumberType = $saltComplex['cashbill_number_type'];


//-------------------------------------------------------------------------------------------------------------------
// 계약 정보
//-------------------------------------------------------------------------------------------------------------------
$conttWhere = 'COMPX_CD="'.$COMPX_CD.'" and CONTT_NO="'.$CONTT_NO.'" and DONG_NO="'.$DONG_NO.'" and HO_NO="'.$HO_NO.'"';
$contt = sql_getDbData(S_DB,'CNTR_MST_I','*,aes_decrypt(unhex(RSNO),"odn-key") as rs_no_str',$conttWhere);
if (!array_key_exists('CONTT_NO',$contt)) {
    $conttWhere .= ' order by SEQ DESC limit 0,1 ';
    $contt = sql_getDbData(S_DB,'CNTR_MST_HIS_I','*,aes_decrypt(unhex(RSNO),"odn-key") as rs_no_str',$conttWhere);
    ___log($logHandle,'퇴거 세대 : ');
}

___log($logHandle,$contt['q']);
//-------------------------------------------------------------------------------------------------------------------
// 최근 현금영수증 발행 내역
//-------------------------------------------------------------------------------------------------------------------
$cashBill = sql_getDbData(S_DB,'salt_cashBill','*',$conttWhere.' and canceled = 0 order by no DESC limit 0,1');

//-------------------------------------------------------------------------------------------------------------------
// 발행 정보
//-------------------------------------------------------------------------------------------------------------------
if (array_key_exists('no',$cashBill)) {
    //최근 발행 정보 이용
    $orderPhoneNo   = ___phoneNo($cashBill['orderPhoneNo']);
    $orderEmail     = $cashBill['orderEmail'];
    $identityNum    = $cashBill['identityNum'];   	//소득공제용 - 주민등록/휴대폰/카드번호 기재가능 , 지출증빙용 - 사업자번호/주민등록/휴대폰/카드번호 기재가능
    $identityType   = $cashBill['identityType'];
    $customerName   = $cashBill['customerName'];
    $itemName       = $cashBill['itemName'];                  //상품명
    $orderNumber    = $cashBill['orderNumber'];  //주문번호
    $tradeUsage     = ($cashBill['tradeUsage'] == 0) ? '소득공제용' : '지출증빙용';    // [필수] 거래구분, (소득공제용, 지출증빙용) 중 기재
    $tradeType      = '승인거래';      // [필수] 문서형태, (승인거래, 취소거래) 중 기재
    $tradeOpt       = '일반';         // [필수] 거래유형, (일반, 도서공연, 대중교통) 중 기재
    $taxationType   = ($cashBill['taxationType'] == 1) ? '비과세' : '과세';    	// [필수] 과세형태, (과세, 비과세) 중 기재
    $supplyCost     = (int)$cashBillAmount;               // [필수] 공급가액, ','콤마 불가 숫자만 가능
    $tax            = 0;                     // [필수] 부가세, ','콤마 불가 숫자만 가능
    $totalAmount    = (int)$supplyCost + (int)$tax;      		// [필수] 거래금액, ','콤마 불가 숫자만 가능
    $serviceFee     = 0;                        				// [필수] 봉사료, ','콤마 불가 숫자만 가능

} else {
    $orderPhoneNo   = ___phoneNo($contt['TEL_NO']);
    $orderEmail     = $contt['EMAIL'];

    //최초 발행시 단지별 셋팅에 따라 전화번호 또는 주민번호를 선택한다.
    //$identityNum    = $contt['TEL_NO'];   	//소득공제용 - 주민등록/휴대폰/카드번호 기재가능 , 지출증빙용 - 사업자번호/주민등록/휴대폰/카드번호 기재가능
    $identityNum    = ($cashbillNumberType == 'phone') ? $contt['TEL_NO'] : $contt['rs_no_str'];
    //___log($logHandle,$cashbillNumberType.','.$contt['TEL_NO'].','.$contt['rs_no_str']);

    $identityType   = ($cashbillNumberType == 'phone') ? 0 : 1;                  //전화번호
    $customerName   = $contt['NAME'];
    $itemName       = '임대료';                  //상품명
    $orderNumber    = '';  //주문번호
    $tradeUsage     = '소득공제용';    // [필수] 거래구분, (소득공제용, 지출증빙용) 중 기재
    $tradeType      = '승인거래';      // [필수] 문서형태, (승인거래, 취소거래) 중 기재
    $tradeOpt       = '일반';         // [필수] 거래유형, (일반, 도서공연, 대중교통) 중 기재
    $taxationType   = '비과세';
    $supplyCost     = (int)$cashBillAmount;             // [필수] 공급가액, ','콤마 불가 숫자만 가능
    $tax            = 0;                                // [필수] 부가세, ','콤마 불가 숫자만 가능
    $totalAmount    = (int)$supplyCost + (int)$tax;     // [필수] 거래금액, ','콤마 불가 숫자만 가능
    $serviceFee     = 0;                        		// [필수] 봉사료, ','콤마 불가 숫자만 가능
}

    //---------------------------------------------
    // 테스트를 위한 전화번호 및 이메일
    //---------------------------------------------
    if ($_pg['cashBillTest']) {
        if ($COMPX_CD == 'C201900004') {
            //개봉
            $orderEmail = 'bluein007@gmail.com';
            $orderPhoneNo = '010-6503-3593';
        } else {
            //서교
            $orderEmail = 'ssamx@naver.com';
            $orderPhoneNo = '010-9946-5137';
        }
        $orderEmail = 'bluein007@gmail.com';
        $orderPhoneNo = '010-6503-3593';
    }
    //---------------------------------------------


//-------------------------------------------------------------------------------------------------------------------
// 단지 정보 : 발행회사 정보
//-------------------------------------------------------------------------------------------------------------------
//$myData = sql_getDbData(S_DB,'salt_CS_ADMIN','*','no = '.$_SESSION['mbr_uid']);
//$myComplex = sql_getDbData(S_DB,'COMPX_MST_I','*','COMPX_CD = "'.$COMPX_CD.'"');
$saltComplex = sql_getDbData(S_DB,'salt_COMPX_COMP_I','*','COMPX_CD = "'.$COMPX_CD.'"');
    $testCorpNum = $saltComplex['BREG_NO'];         // 팝빌 회원 사업자번호, '-' 제외 10자리
    $testUserID = $saltComplex['popbill_id'];       // 팝빌회원 아이디
    $testTel = $saltComplex['RENT_OFIICE_TEL'];           	// 팝빌회원 전화번호

//-------------------------------------------------------------------------------------------------------------------
// 문서 번호 채번
//-------------------------------------------------------------------------------------------------------------------
$todayListCashbill =  sql_getDbData(S_DB,'salt_cashBill','*','canceled = 0 and COMPX_CD="'.$COMPX_CD.'" and LEFT(regDate,8)="'.$today.'" order by no DESC limit 0,1');
___log($logHandle,$todayListCashbill['q'],__FILE__,__LINE__);
$lastMgt = $todayListCashbill['mgtKey'];
if (empty($lastMgt)) {
    $newIdx = 1;
} else {
    list($ddd,$idx) = explode('-',$lastMgt);
    $newIdx = (int)$idx + 1;
}
    $mgtKey = sprintf('%s-%03d',$today,$newIdx);       // 문서번호, 최대 24자리, 영문, 숫자 '-', '_'를 조합하여 사업자별로 중복되지 않도록 구성
    //___debug('check['.$mgtKey.']');
___log($logHandle,'Today Last Index = '.$newIdx);
//-------------------------------------------------------------------------------------------------------------------
// 팝빌 : 문서번호 검사
// 문서번호, 최대 24자리, 영문, 숫자 '-', '_'를 조합하여 사업자별로 중복되지 않도록 구성
//-------------------------------------------------------------------------------------------------------------------
try {
    for ($i = 0; $i<=1000; $i++) {
        $mgtKey = sprintf('%s-%06d',$today,($newIdx+$i));       // 문서번호, 최대 24자리, 영문, 숫자 '-', '_'를 조합하여 사업자별로 중복되지 않도록 구성
        $result = $CashbillService->CheckMgtKeyInUse($testCorpNum, $mgtKey);
        ___log($logHandle,'check['.$mgtKey.'] = ['.$result.']');
        //$result ? $result = '사용중' : $result = '미사용중';
        if ($result == false) break;
        $i += 10;
    }
    $nextStep = $result ? false : true;
    ___log($logHandle,'['.$testCorpNum.']['.$mgtKey.']['.$nextStep.']');
}
catch(PopbillException $pe) {
    $code = $pe->getCode();
    $message = $alertMessage = $pe->getMessage();
    ___log($logHandle,'code['.$code.']'.$message);
}

//___debug('문서번호['.$mgtKey.'] ['.$nextStep.']');

if ($nextStep)
{
    try {
        $testCorp = $CashbillService->GetCorpInfo($testCorpNum);

        // 발행안내메일 제목
        // 미기재시 기본양식으로 전송
        $emailSubject = '';

        // 현금영수증 객체 생성
        $Cashbill = new Cashbill();
        $Cashbill->mgtKey = $mgtKey;        // [필수] 현금영수증 문서번호,

        $Cashbill->tradeType = $tradeType;      // [필수] 문서형태, (승인거래, 취소거래) 중 기재
        $Cashbill->tradeUsage = $tradeUsage;    // [필수] 거래구분, (소득공제용, 지출증빙용) 중 기재
        $Cashbill->tradeOpt = $tradeOpt;          // [필수] 거래유형, (일반, 도서공연, 대중교통) 중 기재
        $Cashbill->taxationType = $taxationType;     // [필수] 과세형태, (과세, 비과세) 중 기재
        $Cashbill->supplyCost = $supplyCost;        // [필수] 공급가액, ','콤마 불가 숫자만 가능
        $Cashbill->tax = $tax;                      // [필수] 부가세, ','콤마 불가 숫자만 가능
        $Cashbill->totalAmount = $totalAmount;      // [필수] 거래금액, ','콤마 불가 숫자만 가능


        $Cashbill->serviceFee = $serviceFee;        // [필수] 봉사료, ','콤마 불가 숫자만 가능
        $Cashbill->franchiseCorpNum = $testCorpNum; // [필수] 가맹점 사업자번호
        $Cashbill->franchiseCorpName = $testCorp->corpName; // 가맹점 상호
        $Cashbill->franchiseCEOName = $testCorp->ceoname;   // 가맹점 대표자 성명
        $Cashbill->franchiseAddr = $testCorp->addr;         // 가맹점 주소
        $Cashbill->franchiseTEL = $testTel;                 // 가맹점 전화번호


        // 소득공제용 - 주민등록/휴대폰/카드번호 기재가능
        // 지출증빙용 - 사업자번호/주민등록/휴대폰/카드번호 기재가능
        $Cashbill->identityNum = $identityNum;      // [필수] 식별번호, 거래구분에 따라 작성
        $Cashbill->customerName = $customerName;    // 주문자명
        $Cashbill->itemName = $itemName;            // 주문상품명
        $Cashbill->orderNumber = $orderNumber;      // 주문주문번호

        // 주문자 이메일
        // 팝빌 개발환경에서 테스트하는 경우에도 안내 메일이 전송되므로,
        // 실제 거래처의 메일주소가 기재되지 않도록 주의
        $Cashbill->email = $orderEmail; // 주문자 이메일
        $Cashbill->hp = $orderPhoneNo;  // 주문자 휴대폰

        // 발행시 알림문자 전송여부
        $Cashbill->smssendYN = false;

        try {
            $result = $CashbillService->RegistIssue($testCorpNum, $Cashbill, $memo, $testUserID, $emailSubject);
            $code = $resultCode = $result->code;
            $message = $resultMessage = $alertMessage = $result->message;
            $confirmNum = $resultConfirm = $result->confirmNum;
            $tradeDate = $resultTradeDate = $result->tradeDate;

            $iField = 'COMPX_CD';       $iValue  = sprintf('"%s"',$COMPX_CD);
            $iField .= ',CONTT_NO';     $iValue .= sprintf(',"%s"',$CONTT_NO);
            $iField .= ',DONG_NO';      $iValue .= sprintf(',"%s"',$DONG_NO);
            $iField .= ',HO_NO';        $iValue .= sprintf(',"%s"',$HO_NO);
            $iField .= ',testCorpNum';  $iValue .= sprintf(',"%s"',$testCorpNum);
            $iField .= ',testUserID';   $iValue .= sprintf(',"%s"',$testUserID);
            $iField .= ',mgtKey';       $iValue .= sprintf(',"%s"',$mgtKey);
            $iField .= ',memo';         $iValue .= sprintf(',"%s"',$memo);
            $iField .= ',identityNum';  $iValue .= sprintf(',"%s"',$identityNum);
            $iField .= ',identityType'; $iValue .= sprintf(',%d',$identityType);
            $iField .= ',orderPhoneNo'; $iValue .= sprintf(',"%s"',$orderPhoneNo);
            $iField .= ',orderEmail';   $iValue .= sprintf(',"%s"',$orderEmail);
            $iField .= ',customerName'; $iValue .= sprintf(',"%s"',$customerName);
            $iField .= ',itemName';     $iValue .= sprintf(',"%s"',$itemName);
            $iField .= ',orderNumber';  $iValue .= sprintf(',"%s"',$orderNumber);
            $iField .= ',tradeType';    $iValue .= sprintf(',%d',$tradeType);
            $iField .= ',tradeUsage';   $iValue .= sprintf(',%d',$tradeUsage);
            $iField .= ',tradeOpt';     $iValue .= sprintf(',%d',$tradeOpt);
            $iField .= ',taxationType'; $iValue .= sprintf(',%d',$taxationType);
            $iField .= ',supplyCost';   $iValue .= sprintf(',%d',$supplyCost);
            $iField .= ',tax';          $iValue .= sprintf(',%d',$tax);
            $iField .= ',totalAmount';  $iValue .= sprintf(',%d',$totalAmount);
            $iField .= ',serviceFee';   $iValue .= sprintf(',%d',$serviceFee);
            $iField .= ',regDate';      $iValue .= sprintf(',"%s"',$now);
            $iField .= ',resultCode';       $iValue .= sprintf(',%d',(int)$resultCode);
            $iField .= ',resultMessage';    $iValue .= sprintf(',"%s"',$resultMessage);
            $iField .= ',resultConfirm';    $iValue .= sprintf(',"%s"',$resultConfirm);
            $iField .= ',resultTradeDate';  $iValue .= sprintf(',"%s"',$resultTradeDate);
            $sql = sql_insertDbData(S_DB,'salt_cashBill',$iField,$iValue);
            $cashBillNo = $sql['insertedId'];
            ___log($logHandle,$sql['q']);

            //현금영수증 발행분 차감
            $updateWhere = 'COMPX_CD = "'.$COMPX_CD.'" and CONTT_NO="'.$CONTT_NO.'" and DONG_NO="'.$DONG_NO.'" and HO_NO="'.$HO_NO.'"';
            $updateData = 'totalCashBill = totalCashBill + '.$supplyCost;
            $updateData .= ',lastCashBill = '.$supplyCost;
            $updateData .= ',lastCashBillNo = '.$cashBillNo;
            //$updateData .= ',daemonId = ""';
            $u = sql_updateDbData(S_DB,'salt_cashBill_mst',$updateWhere,$updateData);
            ___log($logHandle,$u['q']);
        }
        catch(PopbillException $pe) {
            $code = $pe->getCode();
            $message = $alertMessage = $pe->getMessage();
            ___log($logHandle,'code['.$code.']'.$message);

            $updateWhere = 'COMPX_CD = "'.$COMPX_CD.'" and CONTT_NO="'.$CONTT_NO.'" and DONG_NO="'.$DONG_NO.'" and HO_NO="'.$HO_NO.'"';
            $updateData = 'noCashBill = 1';
            $updateData .= ',errorCode = "'.$code.'"';
            $updateData .= ',errorMsg = "'.$message.'"';
            $u = sql_updateDbData(S_DB,'salt_cashBill_mst',$updateWhere,$updateData);
            ___log($logHandle,$u['q']);
        }
    }
    catch(PopbillException $pe) {
        $code = $pe->getCode();
        $message = $alertMessage = $pe->getMessage();
        ___log($logHandle,'code['.$code.']'.$message);
    }
}
___log($logHandle,sprintf('[%s][%s][%s][%s] %s',$COMPX_CD,$CONTT_NO,$DONG_NO,$HO_NO,$alertMessage));
