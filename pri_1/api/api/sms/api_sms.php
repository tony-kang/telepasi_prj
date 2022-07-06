<?php
include_once MY_LIB_PATH.'/extApi/sms/gabia_API/my_gabiaSms.php';

//------------------------------------------------------------------------
//------------------------------------------------------------------------
function _sendSms($sO) {
    $logHandle = ___logStart($sO['apiFile']);
    ___logArray($logHandle,$sO);
    //------------------------------------------------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------------------------------------------
    ___logArray($logHandle,$sO,__FILE__,__LINE__);

    $_param['manager'] = $sO['mbrInfo'];
    $_param['toNumber'] = $sO['toNumber'];
    $_param['senderCallback'] = $sO['senderCallback'];
    $_param['smsSubject'] = urldecode($sO['smsSubject']);
    $_param['smsMessage'] = urldecode($sO['smsMessage']);
    $_param['complexCd'] = $sO['complexCd'];
    $_param['dong'] = $sO['dong'];
    $_param['ho'] = $sO['ho'];

    if (empty($_param['smsSubject'])) $_param['smsSubject'] = '[알림]';

    $_sendSms = array('callback' => ___justNumber($_param['senderCallback'])
    ,'to_number' => ___justNumber($_param['toNumber'])
    ,'message' => $_param['smsMessage']
    ,'subject' => $_param['smsSubject']
    ,'sms_comp'=>'gabia'
    ,'COMPX_CD'=>$_param['complexCd'] , 'DONG_NO'=>$_param['dong'] , 'HO_NO'=>$_param['ho']
    );

    $r = gabia_sms_send($_sendSms);
    ___logArray($logHandle,$r,__FILE__,__LINE__);

    $_result = $r['result'];
    if ((int)$_result['code'] == 200 && $_result['result'] == 'Success') {
        $retPara = '';
        $html = '';
        $ret = sprintf("%s@@%s@@%s@@%s","OK",'전송성공',$retPara,$html);
    }
    else {
        $retPara = '';
        $html = '';
        $ret = sprintf("%s@@%s@@%s@@%s","ER",'전송실패['.$_result['code'].']',$retPara,$html);
    }

    //------------------------------------------------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------------------------------------------
    ___log($logHandle,$ret);
    ___logEnd($logHandle);
    echo $ret;
}

function changeSmsTemplate($sO) {
    $logHandle = ___logStart($sO['apiFile']);
    ___logArray($logHandle,$sO);
    //------------------------------------------------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------------------------------------------
    $complexCd = $sO['complexCd'];
    $conttNo = $sO['conttNo'];
    $dong = $sO['dong'];
    $ho = $sO['ho'];
    $template = $sO['template'];
    $paymentAmount = $sO['paymentAmount'] ?? 0;
    $paymentNotYetAmount = $sO['paymentNotYetAmount'] ?? 0;

    $sql = db_getDbData(S_DB,'CNTR_MST_I','*','CONTT_NO="'.$conttNo.'"');
    ___log($logHandle,$sql['q']);
    $_r['NAME'] = $sql['NAME'];
    $_r['DONG'] = $sql['DONG_NO'];
    $_r['HO'] = $sql['HO_NO'];
    $_r['SENDER'] = '임대관리센터('.___myRentOfficeTel().')';
    $_r['SENDER_CALLBACK'] = ___mySmsCallback();


    $sql = sql_getDbData(S_DB,'DONG_HO_MST_I','*','COMPX_CD="'.$complexCd.'" and DONG_NO="'.$dong.'" and HO_NO="'.$ho.'"');
    ___log($logHandle,$sql['q']);
    $_r['BANK_NAME'] = ___myManageBank();          //은행
    $_r['BANK_ACCOUNT'] = $sql['SPARE_1'];         //계좌번호
    $_r['ACCOUNT_NAME'] = $sql['SPARE_2'];    //입금자

    $_r['PAYMENT_AMOUNT'] = number_format($paymentAmount);    //입금액
    $_r['PAYMENT_NOT_YET_AMOUNT'] = number_format($paymentNotYetAmount);    //연체금액
    $_r['PAYMENT_EXPIRE_DATE'] = sprintf('%s %s월 %s일',date('Y'),date('m'),date('d'));    //입금기한

    $_r['SENDER_CALLBACK'] = ___mySmsCallback();
    $_r['COMPLEX_NAME'] = ___myManageHouse();

    $sql = db_getDbData(S_DB,'salt_smsTemplate','*','no='.$template);
    $msg = $sql['template'];
    $msg = str_replace('{SENDER_CALLBACK}',$_r['SENDER_CALLBACK'],$msg);
    $msg = str_replace('{SENDER}',$_r['SENDER'],$msg);
    $msg = str_replace('{ACCOUNT_NAME}',$_r['ACCOUNT_NAME'],$msg);
    $msg = str_replace('{BANK_ACCOUNT}',$_r['BANK_ACCOUNT'],$msg);
    $msg = str_replace('{BANK_NAME}',$_r['BANK_NAME'],$msg);
    $msg = str_replace('{NAME}',$_r['NAME'],$msg);
    $msg = str_replace('{DONG}',$_r['DONG'],$msg);
    $msg = str_replace('{HO}',$_r['HO'],$msg);
    $msg = str_replace('{COMPLEX_NAME}',$_r['COMPLEX_NAME'],$msg);
    $msg = str_replace('{PAYMENT_NOT_YET_AMOUNT}',$_r['PAYMENT_NOT_YET_AMOUNT'],$msg);
    $msg = str_replace('{PAYMENT_AMOUNT}',$_r['PAYMENT_AMOUNT'],$msg);
    $msg = str_replace('{PAYMENT_EXPIRE_DATE}',$_r['PAYMENT_EXPIRE_DATE'],$msg);
    $msg = str_replace('_NL_',"\n",$msg);
    //------------------------------------------------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------------------------------------------
    //___log($logHandle,$msg);
    ___logEnd($logHandle);
    echo $msg;
}
?>
<?php
	//------------------------------------------------------------------------------------------------------------------------
	//------------------------------------------------------------------------------------------------------------------------
	switch($sO['cmd'])
	{
	case "send.sms":
		$ret = _sendSms($sO);
		break;
	case 'change.sms.template':
		$ret = changeSmsTemplate($sO);
		break;
	}
	//------------------------------------------------------------------------------------------------------------------------
	//------------------------------------------------------------------------------------------------------------------------
?>