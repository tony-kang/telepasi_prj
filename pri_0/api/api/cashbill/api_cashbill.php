<?php
    $_pg['cashBillTest'] = true;    // true = Test , flase = 서비스
    require_once MY_LIB_PATH.'/extApi/bill/popbill/my_popbillCommon.php';

	function _popbillCashBill($sO) {
		global $_pg,$CashbillService;
		$logHandle = ___logStart($sO['apiFile']);

		//------------------------------------------------------------------------------------------------------------------------
		//------------------------------------------------------------------------------------------------------------------------
		___logArray($logHandle,$sO);

		$COMPX_CD = ___myManageComplex();
		$CONTT_NO = $sO['CONTT_NO'];
		$DONG_NO = $sO['DONG_NO'];
		$HO_NO = $sO['HO_NO'];

	    $testCorpNum = ___myCashbillCompNum();  // 팝빌 회원 사업자번호, '-' 제외 10자리
    	$testUserID = ___myCashbillId();        // 팝빌회원 아이디
    	$tel = ___myCashbillTel();           	// 팝빌회원 전화번호
		$cashbillNumberType = ___myCashbillNumberType();	// ssn = 주민번호 , phone = 전화번호

		$todayListCashbill =  sql_getDbData(S_DB,'salt_cashBill','*','LEFT(regDate,8)="'.date('Ymd').'" and tradeType=1 order by no DESC limit 0,1');
		___log($logHandle,$todayListCashbill['q']);
		if (!array_key_exists('mgtKey',$todayListCashbill)) {
			$newIdx = 1;
		} else {
			[$ddd,$idx] = explode('-',$todayListCashbill['mgtKey']);
			$newIdx = (int)$idx + 1;
		}
		$mgtKey = sprintf('%s-%03d',date('Ymd'),$newIdx);       // 문서번호, 최대 24자리, 영문, 숫자 '-', '_'를 조합하여 사업자별로 중복되지 않도록 구성

		$memo = urldecode($sO['memo']);    // 메모
		$identityNum = $sO['identityNum'];   	//소득공제용 - 주민등록/휴대폰/카드번호 기재가능 , 지출증빙용 - 사업자번호/주민등록/휴대폰/카드번호 기재가능
		$identityType = $sO['identityType'];
		$orderPhoneNo = $sO['orderPhoneNo'];
		$orderEmail = $sO['orderEmail'];
		$customerName = urldecode($sO['customerName']);
		$itemName = urldecode($sO['itemName']);
		$orderNumber = '';  //주문번호

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

		$tradeType = '승인거래';      // [필수] 문서형태, (승인거래, 취소거래) 중 기재
		$tradeUsage = ($sO['tradeUsage'] == 0) ? '소득공제용' : '지출증빙용';    // [필수] 거래구분, (소득공제용, 지출증빙용) 중 기재
		$tradeOpt = '일반';          										// [필수] 거래유형, (일반, 도서공연, 대중교통) 중 기재
		$taxationType = ($sO['taxationType'] == 1) ? '비과세' : '과세';    	// [필수] 과세형태, (과세, 비과세) 중 기재
		$supplyCost = (int)$sO['supplyCost'];                   // [필수] 공급가액, ','콤마 불가 숫자만 가능
		$tax = $sO['tax'] ? $sO['tax'] : 0;                     // [필수] 부가세, ','콤마 불가 숫자만 가능
		$totalAmount = (int)$supplyCost + (int)$tax;      		// [필수] 거래금액, ','콤마 불가 숫자만 가능
		$serviceFee = 0;                        				// [필수] 봉사료, ','콤마 불가 숫자만 가능

		$today = date('Ymd');
		$now = date('YmdHis');
		$nextStep = false;
		$code = $message = '';  //No Error;
		$alertMessage = "";
		// 문서번호 검사
		// 문서번호, 최대 24자리, 영문, 숫자 '-', '_'를 조합하여 사업자별로 중복되지 않도록 구성
		try {
			for ($i = 0; $i<=1000; $i++) {
				$mgtKey = sprintf('%s-%06d',$today,($newIdx+$i));       // 문서번호, 최대 24자리, 영문, 숫자 '-', '_'를 조합하여 사업자별로 중복되지 않도록 구성
				$result = $CashbillService->CheckMgtKeyInUse($testCorpNum, $mgtKey);
				___log($logHandle,'check['.$mgtKey.'] = ['.$result.']');
				//$result ? $result = '사용중' : $result = '미사용중';
				if ($result == false) break;
				$i += 10;
			}
//			for ($i = 1; $i<=10; $i++) {
//				$newIdx += $i;
//				$mgtKey = sprintf('%s-%03d',date('Ymd'),$newIdx);       // 문서번호, 최대 24자리, 영문, 숫자 '-', '_'를 조합하여 사업자별로 중복되지 않도록 구성
//				$result = $CashbillService->CheckMgtKeyInUse($testCorpNum, $mgtKey);
//				//$result ? $result = '사용중' : $result = '미사용중';
//				if ($result == false) break;
//			}
			$nextStep = $result ? false : true;
			___log($logHandle,'['.$testCorpNum.']['.$mgtKey.']['.$nextStep.']');
		}
		catch(PopbillException $pe) {
			$code = $pe->getCode();
			$message = $alertMessage = $pe->getMessage();
			___log($logHandle,'code['.$code.']'.$message);
		}

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
				$Cashbill->franchiseTEL = $tel;                     // 가맹점 전화번호


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
					$iField .= ',regDate';      $iValue .= sprintf(',"%s"',date('YmdHis'));
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
					$u = sql_updateDbData(S_DB,'salt_cashBill_mst',$updateWhere,$updateData);
					___log($logHandle,$u['q']);
				}
				catch(PopbillException $pe) {
					$code = $pe->getCode();
					$message = $alertMessage = $pe->getMessage();
					___log($logHandle,'code['.$code.']'.$message);
				}
			}
			catch(PopbillException $pe) {
				$code = $pe->getCode();
				$message = $alertMessage = $pe->getMessage();
				___log($logHandle,'code['.$code.']'.$message);
			}
		}

		$retPara = '';
		$html = '';
		$ret = sprintf("%s@@%s@@%s@@%s","OK",$alertMessage,$retPara,$html);

		//------------------------------------------------------------------------------------------------------------------------
		//------------------------------------------------------------------------------------------------------------------------
		___log($logHandle,$ret);
		___logEnd($logHandle);
		echo $ret;
	}

	function _popbillCashBillCancel($sO) {
		global $CashbillService;
		$logHandle = ___logStart($sO['apiFile']);

		//------------------------------------------------------------------------------------------------------------------------
		//------------------------------------------------------------------------------------------------------------------------
		___logArray($logHandle,$sO);

		[$cancelNo,$mgtKey,$cancelAmount,$cancelTiming,$resultTradeDate,$resultConfirm] = $aaa = ___decodeList($sO['cancelInfo'],'@@');
		___logArray($logHandle,$aaa);
		$testCorpNum = ___myCashbillCompNum();  // 팝빌 회원 사업자번호, '-' 제외 10자리

		//	$cancelNo = 25;
		//  $mgtKey = '20220302-0001';   // 문서번호
	    $memo = '현금영수증 발행취소'; // 메모

		try	{
			if ($cancelTiming == 'before') {
				$result = $CashbillService->CancelIssue($testCorpNum, $mgtKey, $memo);
				$code = $result->code;
				$message = $result->message;
				$confirmNum = 'before';
				$tradeDate = date('Ymd');
			} else if ($cancelTiming == 'after') {
				$orgConfirmNum = $resultConfirm;     // 원본현금영수증 승인번호, 문서정보 확인(GetInfo API)을 통해 확인가능.
				$orgTradeDate = $resultTradeDate;    // 원본현금영수증 거래일자, 문서정보 확인(GetInfo API)을 통해 확인가능.

				$result = $CashbillService->RevokeRegistIssue($testCorpNum, uniqid(date('Ymd').'_C'), $orgConfirmNum, $orgTradeDate);
				$code = $result->code;
				$message = $result->message;
				$confirmNum = $result->confirmNum;
				$tradeDate = $result->tradeDate;
			}

			if ($code == 1) {
				if ($cancelTiming == 'before') {
					//국세청 전송전에만 원래대로 처리
					$updateWhere = 'lastCashBillNo = ' . $cancelNo;
					$updateData = 'totalCashBill = totalCashBill - '.$cancelAmount;
					$updateData .= ',lastCashBill = 0';
					$u = sql_updateDbData(S_DB, 'salt_cashBill_mst', $updateWhere, $updateData);//
					___log($logHandle, $u['r'] . ':원상복구:' . $u['q']);
				} else {
					// 발급 이후에는 발급대상을 원상복구 시키지 않음.
					___log($logHandle, '원상복구 시키지 않음:');
				}

				$updateWhere = 'no = ' . $cancelNo;
				$updateData = 'canceled = 1';
				$updateData .= ' ,cancelTradeDate = "'.$tradeDate.'"';
				$updateData .= ' ,cancelConfirm = "'.$confirmNum.'"';
				$u = sql_updateDbData(S_DB, 'salt_cashBill', $updateWhere, $updateData);//
				___log($logHandle, $u['r'] . ':' . $u['q']);
			} else {
				___log($logHandle, $code . ':' . $message);
			}
		} catch ( PopbillException $pe ) {
			$code = $pe->getCode();
			$message = $pe->getMessage();
		}

		$retPara = '';
		$html = '';
		$ret = sprintf("%s@@%s@@%s@@%s","OK",$message.'['.$code.']['.$cancelNo.']',$retPara,$html);

		//------------------------------------------------------------------------------------------------------------------------
		//------------------------------------------------------------------------------------------------------------------------
		___log($logHandle,$ret);
		___logEnd($logHandle);
		echo $ret;
	}

	function _cashBillDaemonStart($sO) {
		$logHandle = ___logStart($sO['apiFile']);

		//------------------------------------------------------------------------------------------------------------------------
		//------------------------------------------------------------------------------------------------------------------------
		___logArray($logHandle,$sO);

		$COMPX_CD = ___myManageComplex();
		$updateWhere = 'COMPX_CD = "'.$COMPX_CD.'" and totalCashBill < totalPureRentAmount';
		$updateData = 'daemonId = "'.$COMPX_CD.'"';
		$u = sql_updateDbData(S_DB,'salt_cashBill_mst',$updateWhere,$updateData);
		___log($logHandle,$u['q']);

		$retPara = '';
		$html = '';
		$ret = sprintf("%s@@%s@@%s@@%s","OK",'1건 자동발급을 시작합니다.',$retPara,$html);

		//------------------------------------------------------------------------------------------------------------------------
		//------------------------------------------------------------------------------------------------------------------------
		___log($logHandle,$ret);
		___logEnd($logHandle);
		echo $ret;
	}

	function _setCashBill($sO,$set) {
		$logHandle = ___logStart($sO['apiFile']);

		//------------------------------------------------------------------------------------------------------------------------
		//------------------------------------------------------------------------------------------------------------------------
		___logArray($logHandle,$sO);

		$conttInfo = $sO['conttInfo'];
		[$complex,$conttNo,$listType] = ___decodeList($conttInfo,'@@');

		$COMPX_CD = ___myManageComplex();
		$updateWhere = 'COMPX_CD = "'.$COMPX_CD.'" and CONTT_NO = "'.$conttNo.'" ';
		$updateData = 'noCashBill = '.$set;
		$updateData .= ' , noCashBillDate = "'.date('YmdHis').'"';
		$u = sql_updateDbData(S_DB,'salt_cashBill_mst',$updateWhere,$updateData);
		___log($logHandle,$u['q']);

		$alert  = $set ? '현급영수증 발급제외 처리되었습니다.' : '현급영수증 발급대상으로 처리되었습니다.';
		$retPara = '';
		$html = '';
		$ret = sprintf("%s@@%s@@%s@@%s","OK",$alert,$retPara,$html);

		//------------------------------------------------------------------------------------------------------------------------
		//------------------------------------------------------------------------------------------------------------------------
		___log($logHandle,$ret);
		___logEnd($logHandle);
		echo $ret;
	}

	function _clearCashBillOverfee($sO) {
		$logHandle = ___logStart($sO['apiFile']);

		//------------------------------------------------------------------------------------------------------------------------
		//------------------------------------------------------------------------------------------------------------------------
		___logArray($logHandle,$sO);

		$conttInfo = $sO['conttInfo'];
		[$complex,$conttNo,$listType] = ___decodeList($conttInfo,'@@');
		$clearAmount = ___justNumber($sO['clearAmount']);

		$COMPX_CD = ___myManageComplex();
		$updateWhere = 'COMPX_CD = "'.$COMPX_CD.'" and CONTT_NO = "'.$conttNo.'" ';
		$updateData = 'totalPureRentAmount = totalPureRentAmount - '.$clearAmount;
		$u = sql_updateDbData(S_DB,'salt_cashBill_mst',$updateWhere,$updateData);
		___log($logHandle,$u['q']);

		$alert  = sprintf('%s 원이 현금영수증 발행금액에서 제외처리 되었습니다.',$sO['clearAmount']);
		$retPara = '';
		$html = '';
		$ret = sprintf("%s@@%s@@%s@@%s","OK",$alert,$retPara,$html);

		//------------------------------------------------------------------------------------------------------------------------
		//------------------------------------------------------------------------------------------------------------------------
		___log($logHandle,$ret);
		___logEnd($logHandle);
		echo $ret;
	}

	//------------------------------------------------------------------------
    // 현금영수증 발행
	//------------------------------------------------------------------------
	function _popbillCashbill_registIssue($sO) {
		global $CashbillService;
		$logHandle = ___logStart($sO['apiFile']);
		___logArray($logHandle,$sO);

		//------------------------------------------------------------------------------------------------------------------------
		//------------------------------------------------------------------------------------------------------------------------
        $COMPX_CD = $sO['complexCD'];       // 개봉동 = C201900004 , 서교동 = C202000007
        $CONTT_NO = $sO['conttNo'];
        $DONG_NO = $sO['dongNo'];
        $HO_NO = $sO['hoNo'];
        $mgtKey = $sO['mgtKey'];       // 문서번호, 최대 24자리, 영문, 숫자 '-', '_'를 조합하여 사업자별로 중복되지 않도록 구성
        $memo = $sO['memo'];    // 메모
        $identityNum = $sO['identityNum'];   //소득공제용 - 주민등록/휴대폰/카드번호 기재가능 , 지출증빙용 - 사업자번호/주민등록/휴대폰/카드번호 기재가능
        $orderPhoneNo = $sO['orderPhoneNo'];  //'010-6503-3593';
        $orderEmail = $sO['orderEmail'];
        $customerName = $sO['customerName'];
        $itemName = $sO['itemName'];            //'임대료';  //
        $orderNumber = $sO['itemName'];         //주문번호 default empty = '';
        $tradeType = '승인거래';                   // [필수] 문서형태, (승인거래, 취소거래) 중 기재
        $tradeUsage = $sO['tradeUsage'];        // [필수] 거래구분, (소득공제용, 지출증빙용) 중 기재
        $tradeOpt = '일반';                       // [필수] 거래유형, (일반, 도서공연, 대중교통) 중 기재
        $taxationType = $sO['taxationType'];    // [필수] 과세형태, (과세, 비과세) 중 기재
        $supplyCost = $sO['supplyCost'];        // [필수] 공급가액, ','콤마 불가 숫자만 가능
        $tax = $sO['tax'];                      // [필수] 부가세, ','콤마 불가 숫자만 가능
        $totalAmount = $supplyCost + $tax;      // [필수] 거래금액, ','콤마 불가 숫자만 가능
        $serviceFee = 0;                        // [필수] 봉사료, ','콤마 불가 숫자만 가능

        // 문서번호 검사
        // 문서번호, 최대 24자리, 영문, 숫자 '-', '_'를 조합하여 사업자별로 중복되지 않도록 구성
        try {
            $result = $CashbillService->CheckMgtKeyInUse($testCorpNum, $mgtKey);
            //$result ? $result = '사용중' : $result = '미사용중';
            $nextStep = $result ? false : true;
        }
        catch(PopbillException $pe) {
            $code = $pe->getCode();
            $message = $pe->getMessage();
            //------------------------------------------------------------------------------------------------------------------------
            //------------------------------------------------------------------------------------------------------------------------
            $retPara = '';
            $html = '';
            $ret = sprintf("%s@@%s@@%s@@%s","OK",'문서번호 Error['.$code.'] '.$message,$retPara,$html);
            ___log($logHandle,$ret);
            ___logEnd($logHandle);
            echo $ret;
            return;
        }


        $complex = sql_getDbData(S_DB,'salt_COMPX_COMP_I','*','COMPX_CD="'.$COMPX_CD.'"');
        $testCorpNum = $complex['COMPX_CD'];    // 팝빌 회원 사업자번호, '-' 제외 10자리
        $testUserID = $complex['popbill_id'];   // 팝빌회원 아이디
        $corpTel = $complex['comp_tel'];   // 발행사업자 전화번호

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
            $Cashbill->franchiseTEL = $corpTel;                 // 가맹점 전화번호


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

            $result = $CashbillService->RegistIssue($testCorpNum, $Cashbill, $memo, $testUserID, $emailSubject);
            $code = $resultCode = $result->code;
            $message = $resultMessage = $result->message;
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
            $iField .= ',regDate';      $iValue .= sprintf(',"%s"',date('YmdHis'));
            $iField .= ',resultCode';       $iValue .= sprintf(',%d',(int)$resultCode);
            $iField .= ',resultMessage';    $iValue .= sprintf(',"%s"',$resultMessage);
            $iField .= ',resultConfirm';    $iValue .= sprintf(',"%s"',$resultConfirm);
            $iField .= ',resultTradeDate';  $iValue .= sprintf(',"%s"',$resultTradeDate);
            $sql = sql_insertDbData(S_DB,'salt_cashBill',$iField,$iValue);
            ___log($logHandle,$sql['q']);
            //------------------------------------------------------------------------------------------------------------------------
            //------------------------------------------------------------------------------------------------------------------------
            $retPara = '';
            $html = '';
            $ret = sprintf("%s@@%s@@%s@@%s","OK",'승인번호['.$resultConfirm.'] '.$resultMessage,$retPara,$html);
        }
        catch(PopbillException $pe) {
            $code = $pe->getCode();
            $message = $pe->getMessage();
            //------------------------------------------------------------------------------------------------------------------------
            //------------------------------------------------------------------------------------------------------------------------
            $retPara = '';
            $html = '';
            $ret = sprintf("%s@@%s@@%s@@%s","OK",'문서번호 Error['.$code.'] '.$message,$retPara,$html);
        }

		//------------------------------------------------------------------------------------------------------------------------
		//------------------------------------------------------------------------------------------------------------------------
		___log($logHandle,$ret);
		___logEnd($logHandle);
		echo $ret;
	}

?>
<?php
	//------------------------------------------------------------------------------------------------------------------------
	//------------------------------------------------------------------------------------------------------------------------
	switch($sO['cmd'])
	{
	case 'set.cash.bill':
		_setCashBill($sO,0);
		break;

	case 'set.no.cash.bill':
		_setCashBill($sO,1);
		break;

	case 'popbill.cash.bill':
		_popbillCashBill($sO);
		break;

	case 'popbill.cash.cancel':
		_popbillCashBillCancel($sO);
		break;

	case 'cash.bill.daemon.start':
		_cashBillDaemonStart($sO);
		break;

	case 'clear.cash.bill.overfee':
		_clearCashBillOverfee($sO);
		break;

	case "popbill.cashbill.regist.issue":
		_popbillCashbill_registIssue($sO);
		break;
	}
	//------------------------------------------------------------------------------------------------------------------------
	//------------------------------------------------------------------------------------------------------------------------
?>