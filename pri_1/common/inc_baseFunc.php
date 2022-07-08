<?php
/**
 * @author tony on 2022. 5. 13.
 * @author Tony Kang <bluein007@gmail.com>
 * Description
 *
 */

//------------------------------------------------------------------------------------------------------------------------
// 임대관리 관리단지 정보관련 함수.
//------------------------------------------------------------------------------------------------------------------------
function ___myUid() { global $my; return $my['no']; }
function ___myName() { global $my; return $my['L_NAME'].' '.$my['F_NAME']; }
function ___myEmail() { global $my; return $my['email']; }
function ___mbrInfo() { global $my; return ___encode($my['uid']); }
function ___myManageHouse() { global $my; return $my['COMPX_NM']; }
function ___myManageComplex() { global $my; return $my['COMPX_CD']; }
function ___myManageBank() { global $my; return $my['bankName']; }
function ___mySmsCallback() { global $my; return $my['smsCallback']; }
function ___myRentOfficeTel() { global $my; return $my['rentOfficeTel']; }
function ___myBillDay() { global $my; return $my['RENT_BILL_STD_DAY']; }
function ___myCashbillCompNum() { global $my; return $my['cashbill_BREG_NO']; }    //사업자번호
function ___myCashbillId() { global $my; return $my['cashbill_id']; }
function ___myCashbillTel() { global $my; return $my['cashbill_tel']; }
function ___myCashbillNumberType() { global $my; return $my['cashbillNumberType']; }

function ___myGiStartDate() { global $my; return $my['giStartDate']; }
function ___myGiEndDate() { global $my; return $my['giEndDate']; }
function ___myGiRate() { global $my; return $my['giRate']; }
function ___myGiDiscountRate() { global $my; return $my['giDiscountRate']; }
function ___myGiStartDate_old() { global $my; return $my['giStartDate_old']; }
function ___myGiEndDate_old() { global $my; return $my['giEndDate_old']; }
function ___myGiRate_old() { global $my; return $my['giRate_old']; }
function ___myGiDiscountRate_old() { global $my; return $my['giDiscountRate_old']; }
