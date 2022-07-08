<?php
/**
 * @author tony on 2022. 6. 20.
 * @author Tony Kang <bluein007@gmail.com>
 * Description
 *
 */

$sql = new TonySql(S_DB);
$sql->addTable('CONTT_MST_HIS_I', 'A');
$sql->addTable('CNTR_MST_HIS_I', 'B');
$sql->addTable('DONG_HO_MST_I', 'T');

// 테이블의 필드 가져오기
// 여러테이블을 중복하다보면 불필요한 필드를 제거해야 될 때가 많다. 일일이 타이핑 하기엔 필드가 너무 많아서...
//___debug(db_getTableField(S_DB,'CONTT_MST_HIS_I','A'));
//___debug(db_getTableField(S_DB,'CNTR_MST_HIS_I','B'));
//___debug(db_getTableField(S_DB,'DONG_HO_MST_I','T'));

$sql->addField('A.COMPX_CD ,A.CONTT_NO ,A.SEQ ,A.BIZ_CD ,A.STS_CD ,A.UC_STS_CD ,A.DONG_NO ,A.HO_NO ,A.CONTT_YMD ,A.CONTT_PATH ,A.SUP_TYPE ,A.CONTT_CHNG_RSN ,A.LEAS_STR_YMD ,A.LEAS_END_YMD ,A.FINAL_RNT_AMT_EST_YMD ,A.LEAS_DPST_AMT ,A.PREMM_AMT ,A.RENT_AMT ,A.LNS_YN ,A.LNS_AMT ,A.LES_SET_YN ,A.RMK ,A.MVN_CK_YN ,A.PRE_CK_YN ,A.THS_CK_YN ,A.CLC_CK_YN ,A.RE_PNL_AMT ,A.REG_PSN ,A.REG_DT ,A.UPDT_PSN ,A.UPDT_DT ,A.WIN_TP ,A.MOVE_IN_START_YMD ,A.MOVE_IN_END_YMD ,A.SCAN_IMAGE_ORI_FILE ,A.SCAN_IMAGE_UPD_FILE ');
$sql->addField('B.COMPX_CD ,B.CONTT_NO ,B.SEQ ,B.CNTR_SEQ ,B.BIZ_CD ,B.STS_CD ,B.UC_STS_CD ,B.DONG_NO ,B.HO_NO ,B.NAME ,B.BIRTH_YMD ,B.SEX ,B.RSNO ,B.TEL_NO ,B.EMAIL ,B.ZIP_CD ,B.ADDR ,B.POST_ZIP_CD ,B.POST_ADDR ,B.REPR_CNTR_YN ,B.RMK ,B.REG_PSN ,B.REG_DT ,B.UPDT_PSN ,B.UPDT_DT');
$sql->addField('T.COMPX_CD ,T.DONG_NO ,T.HO_NO ,T.EXSUE_AREA ,T.CMUSE_AREA ,T.PARK_AREA ,T.SUP_AREA ,T.ETC_CMUSE_AREA ,T.ROOM_CNT ,T.TOILET_CNT ,T.ROOM_TP ,T.TERCE_YN ,T.LEAS_DPST_AMT ,T.PREMM_AMT ,T.RENT_AMT ,T.FCTR_AMT ,T.MVIH_YMD ,T.MVIH_EST_YMD ,T.EGRSN_EST_YMD ,T.FINAL_RNT_AMT_EST_YMD ,T.MVIH_CHAPN ,T.USE_YN ,T.EPTRM_YN ,T.RMK ,T.REG_PSN ,T.REG_DT ,T.UPDT_PSN ,T.UPDT_DT ,T.SPARE_1 ,T.SPARE_2');
$sql->addField('aes_decrypt(unhex(B.RSNO),"odn-key") as rs_no_str');

$sql->addWhere('A.COMPX_CD = B.COMPX_CD');
$sql->addWhere('and A.DONG_NO = B.DONG_NO');
$sql->addWhere('and A.HO_NO = B.HO_NO');
$sql->addWhere('and A.CONTT_NO = B.CONTT_NO');
$sql->addWhere('and A.DONG_NO = T.DONG_NO');
$sql->addWhere('and A.HO_NO = T.HO_NO');
$sql->addWhere('and A.COMPX_CD = T.COMPX_CD');
$sql->addWhere('and A.COMPX_CD = "' . $_pg['complex'] . '"');

$sql->addWhere('and A.STS_CD = "O"');
$sql->addWhere('and A.STS_CD = B.STS_CD');
$sql->addWhere('and B.REPR_CNTR_YN = "Y"');

$sql->addWhere('and B.REPR_CNTR_YN = "Y"');
$sql->addWhere('and NA.BIZ_CD = "NC"');

include_once 'common_searchQuery.php';

$sql->orderBy('CAST(A.DONG_NO AS SIGNED), CAST(A.HO_NO AS SIGNED)');

$sql->page($_pg['page'], $_pg['pSize']);
$_listArr = $sql->getRows();