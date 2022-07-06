<?php
/**
 * @author tony on 2022. 7. 7.
 * @author Tony Kang <bluein007@gmail.com>
 * Description
 *
 */


/**
 * @author tony on 2022. 5. 13.
 * @author Tony Kang <bluein007@gmail.com>
 * Description
 *
 */
if (___loginState()) {
    $myData = $_SESSION['mbr'];

    if (empty($myData['COMPX_CD'])) {
        $myData['COMPX_CD'] = ___get('complex');
        if (empty($myData['COMPX_CD'])) {
            $myData['COMPX_CD'] = 'C201900004';
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

//------------------------------------------------------------------------------------------------------------------------
// SOLUTION Global
//------------------------------------------------------------------------------------------------------------------------
function ___myUid()
{
    global $my;
    return $my['no'];
}

function ___myName()
{
    global $my;
    return $my['L_NAME'] . ' ' . $my['F_NAME'];
}

function ___myEmail()
{
    global $my;
    return $my['email'];
}

function ___mbrInfo()
{
    global $my;
    return ___encode($my['uid']);
}

function ___myManageHouse()
{
    global $my;
    return $my['COMPX_NM'];
}

function ___myManageComplex()
{
    global $my;
    return $my['COMPX_CD'];
}

function ___myManageBank()
{
    global $my;
    return $my['bankName'];
}

function ___mySmsCallback()
{
    global $my;
    return $my['smsCallback'];
}

function ___myRentOfficeTel()
{
    global $my;
    return $my['rentOfficeTel'];
}

function ___myBillDay()
{
    global $my;
    return $my['RENT_BILL_STD_DAY'];
}

function ___myCashbillCompNum()
{
    global $my;
    return $my['cashbill_BREG_NO'];
}    //사업자번호
function ___myCashbillId()
{
    global $my;
    return $my['cashbill_id'];
}

function ___myCashbillTel()
{
    global $my;
    return $my['cashbill_tel'];
}

function ___myCashbillNumberType()
{
    global $my;
    return $my['cashbillNumberType'];
}

function ___myGiStartDate()
{
    global $my;
    return $my['giStartDate'];
}

function ___myGiEndDate()
{
    global $my;
    return $my['giEndDate'];
}

function ___myGiRate()
{
    global $my;
    return $my['giRate'];
}

function ___myGiDiscountRate()
{
    global $my;
    return $my['giDiscountRate'];
}

function ___myGiStartDate_old()
{
    global $my;
    return $my['giStartDate_old'];
}

function ___myGiEndDate_old()
{
    global $my;
    return $my['giEndDate_old'];
}

function ___myGiRate_old()
{
    global $my;
    return $my['giRate_old'];
}

function ___myGiDiscountRate_old()
{
    global $my;
    return $my['giDiscountRate_old'];
}