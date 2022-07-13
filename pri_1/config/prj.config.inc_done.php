<?php
/**
 * @author tony on 2022. 7. 8.
 * @author Tony Kang <bluein007@gmail.com>
 * Description
 *
 */

// 웹사이트 기능 구현 준비완료 단계
if (___loginState()) {
    // 로그인 되어 있는 경우 필요한 기능 수행

    $myData = $_SESSION['mbr'];

    if (empty($myData['COMPX_CD'])) {
        $myData['COMPX_CD'] = ___get('complex');
        if (empty($myData['COMPX_CD'])) {
            $myData['COMPX_CD'] = 'C201900004'; //'C202000007'; //
        }
    }

    $saltComplex = db_getDbData(S_DB, 'salt_COMPX_COMP_I', '*', 'COMPX_CD = "' . $myData['COMPX_CD'] . '"');

    $my = $myData;
    $my['uid'] = $myData['uid'];
    $my['COMPX_CD'] = ___aString($saltComplex, 'COMPX_CD');
    $my['COMPX_NM'] = ___aString($saltComplex, 'COMPX_NM');
    $my['RENT_BILL_STD_DAY'] = ___aString($saltComplex, 'RENT_BILL_STD_DAY');

    $my['manageComp'] = ___aString($saltComplex, 'COMP_NM');
    $my['smsCallback'] = ___aString($saltComplex, 'sms_callback');
    $my['rentOfficeTel'] = ___aString($saltComplex, 'RENT_OFFICE_TEL');
    $my['bankName'] = ___aString($saltComplex, 'bank_name');
    $my['cashbillNumberType'] = ___aString($saltComplex, 'cashbill_number_type');   //ssn or phone = 주민번호 or 전화번호
    //2021.09.29
    $giArr = explode('|', ___aString($saltComplex, 'GI_CALC_WAY_old'));
    $my['giStartDate_old'] = $giArr[0] ?? '';
    $my['giEndDate_old'] = $giArr[1] ?? '';
    $my['giRate_old'] = $giArr[2] ?? '';
    $my['giDiscountRate_old'] = $giArr[3] ?? '';

    $giArr = explode('|', ___aString($saltComplex, 'GI_CALC_WAY_new'));
    $my['giStartDate'] = $giArr[0] ?? '';
    $my['giEndDate'] = $giArr[1] ?? '';
    $my['giRate'] = $giArr[2] ?? '';
    $my['giDiscountRate'] = $giArr[3] ?? '';

    //2021.12.30
    $my['cashbill_id'] = ___aString($saltComplex, 'popbill_id');
    //$my['cashbill_compTel'] = ___array($saltComplex,'RENT_OFIICE_TEL');
    $my['cashbill_BREG_NO'] = ___aString($saltComplex, 'BREG_NO');
    $my['cashbill_tel'] = ___aString($saltComplex, 'RENT_OFFICE_TEL');

    //___print($my);
}
//___print($my,__FILE__,__LINE__);
//___debug($saltComplex['q']);
//___debug($myComp['comp_name']);
//___print($loginCounselor);

