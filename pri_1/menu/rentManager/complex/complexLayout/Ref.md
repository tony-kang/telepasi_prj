```php
-- 계약 만료대상 또는 이사 신청중 또는 강제퇴거 대상
SELECT 
	A.COMPX_CD
  , A.CONTT_NO
  , A.DONG_NO
  , A.HO_NO
  , A.ROOM_TP
  , A.NAME
  , A.TEL_NO
  , A.LEAS_END_YMD
  , A.INFOM_EST_YMD
  , A.INFOM_END_YMD
  , A.NOTICE_SEND_YN
  , A.NOTICE_SEND_YMD
  , A.RENEW_CONTT_YN
  , A.ORI_RENEW_CONTT_YN
  , A.MAKE_RE_CONTT
  , A.MAKE_EXPIR
  , A.AFFIR_YMD
  , A.AFFIR_INDRT_ORI_FILE
  , A.AFFIR_INDRT_UPD_FILE
  , CASE WHEN A.RENEW_CONTT_YN = 'N' THEN A.MOVE_STATUS ELSE A.RENEW_CONTT_YN END AS EDIT_YN
  , CASE WHEN A.MOVE_STATUS = 'MC' THEN '이사신청중' 
        ELSE 
        CASE WHEN A.RENEW_CONTT_YN = 'N' AND DLY_YN = 'Y' 
            THEN '강제퇴거대상'
                ELSE 
                CASE WHEN A.RENEW_CONTT_YN = 'N' AND A.INFOM_EST_YMD <= REPLACE(DATE_FORMAT(NOW(),'%Y%m%d'),'-','')
                    THEN '만료대상'
                    ELSE ''
                END
            END
        END AS STA_NM
FROM ( 
           SELECT A.COMPX_CD
                , A.CONTT_NO
                , A.DONG_NO
                , A.HO_NO
                , C.ROOM_TP
                , B.NAME
                , B.TEL_NO
                , A.LEAS_END_YMD
                , NVL( D.INFOM_EST_YMD, DATE_FORMAT(SUBDATE(A.LEAS_END_YMD, INTERVAL 6 MONTH),'%Y%m%d') ) AS INFOM_EST_YMD
                , NVL( D.INFOM_END_YMD, DATE_FORMAT(SUBDATE(A.LEAS_END_YMD, INTERVAL 3 MONTH),'%Y%m%d') ) AS INFOM_END_YMD
                , NVL(D.NOTICE_SEND_YN,'N') AS NOTICE_SEND_YN
                , D.NOTICE_SEND_YMD
                , NVL(D.RENEW_CONTT_YN,'N') AS RENEW_CONTT_YN
                , NVL(D.RENEW_CONTT_YN,'N') AS ORI_RENEW_CONTT_YN
                , 'N' AS MAKE_RE_CONTT
                , 'N' AS MAKE_EXPIR
                , D.AFFIR_YMD
                , D.AFFIR_INDRT_ORI_FILE
                , D.AFFIR_INDRT_UPD_FILE
                , NVL((SELECT N.BIZ_CD FROM NEW_CONTT_MST_I N WHERE N.COMPX_CD = A.COMPX_CD AND N.CONTT_NO = A.CONTT_NO AND N.BIZ_CD ='MC'),'N') AS MOVE_STATUS
             FROM CONTT_MST_I A LEFT OUTER JOIN CONTT_DDTARV_I D ON A.COMPX_CD = D.COMPX_CD AND A.CONTT_NO = D.CONTT_NO AND A.DONG_NO = D.DONG_NO AND A.HO_NO = D.HO_NO 
                , CNTR_MST_I B
                , DONG_HO_MST_I C
            WHERE A.COMPX_CD = "C201900004" 
              AND A.COMPX_CD = B.COMPX_CD
              AND A.CONTT_NO = B.CONTT_NO
              AND A.DONG_NO = B.DONG_NO
              AND A.HO_NO = B.HO_NO
              AND B.REPR_CNTR_YN = 'Y'
              AND A.COMPX_CD = C.COMPX_CD
              AND A.DONG_NO = C.DONG_NO
              AND A.HO_NO = C.HO_NO
              AND C.USE_YN = 'Y'
    ) A
                    
LEFT JOIN (   
        /*3개월미납여부*/
        SELECT COMPX_CD, CONTT_NO, DONG_NO, HO_NO, MAX(DLY_YN) AS DLY_YN
        FROM (
                 /*
                 SELECT COMPX_CD, CONTT_NO, DONG_NO, HO_NO, CASE WHEN SUM(REM_MNTST_AMT) >= (SELECT A.RENT_AMT * 3 FROM CONTT_MST_I A WHERE A.COMPX_CD = ranked.COMPX_CD AND A.CONTT_NO = ranked.CONTT_NO AND A.DONG_NO = ranked.DONG_NO AND A.HO_NO = ranked.HO_NO) THEN 'Y' ELSE 'N' END AS DLY_YN, country_rank
                   FROM
                         (
                          	SELECT COMPX_CD, CONTT_NO, DONG_NO, HO_NO, OCCR_YYMM, REM_MNTST_AMT,
                                 @country_rank := IF(@current_country = CONTT_NO, @country_rank + 1, 1) AS country_rank,
                                 @current_country := CONTT_NO
                        	FROM MNTST_UNITE_AMT_I
                           	WHERE COMPX_CD = "C201900004" 
                           	ORDER BY COMPX_CD, CONTT_NO, DONG_NO, HO_NO, OCCR_YYMM DESC
                         ) ranked
                  WHERE 1=1
                  GROUP BY COMPX_CD, CONTT_NO, DONG_NO, HO_NO
                  UNION ALL
                  */
                  SELECT COMPX_CD, CONTT_NO, DONG_NO, HO_NO, CASE WHEN SUM(CASE WHEN OSDSM_EST_AMT > 0 THEN 1 ELSE 0 END) = 3 THEN 'Y' ELSE 'N' END AS DLY_YN, country_rank
                  FROM
                        (  	SELECT COMPX_CD, CONTT_NO, TP_SEQ, DONG_NO, HO_NO, OSDSM_EST_AMT,
                                 @country_rank := IF(@current_country = CONTT_NO, @country_rank + 1, 1) AS country_rank,
                                 @current_country := CONTT_NO
                        	FROM RNT_CONTT_PYMT_I
                           	WHERE COMPX_CD = "C201900004" AND RCMNY_EST_YMD <= REPLACE(DATE_FORMAT(NOW(),'%Y%m%d'),'-','')
                           	ORDER BY COMPX_CD, CONTT_NO, DONG_NO, HO_NO, TP_SEQ DESC
                         ) ranked
                  WHERE country_rank <= 3
                  GROUP BY COMPX_CD, CONTT_NO, DONG_NO, HO_NO
            ) A
        GROUP BY COMPX_CD, CONTT_NO, DONG_NO, HO_NO

) B ON A.COMPX_CD = B.COMPX_CD AND A.CONTT_NO = B.CONTT_NO AND A.DONG_NO = B.DONG_NO AND A.HO_NO = B.HO_NO    

having STA_NM != ''              
```


```php
-- 연체세대
-- _LATE.DLY_CNT : 연체 개월수
-- _LATE.lateMonthFee : 마지막으로 연체료를 납부한 달까지의 연체료
-- _LATE.totalLateFee : 특정날짜 까지의 최종 연체료 예> 2022년 7월 10일까지의 연체료는 아래와 같다. , 날짜를 입력하지 않으면 조회하는 당일 날짜까지의 연체료가 계산됨.
------ ,(SUM( F.OSDSM_EST_AMT ) + SUM( FN_GET_LATE_FEE("C201900004", F.OSDSM_EST_AMT, "2", F.OVERDUE_YMD, F.DLY_AMT, "20220701"))) as totalLateFee
------ totalLateFee 쿼리는 시간 많이 걸림.
-- 정보만 필요한 경우 _LATE.DLY_CNT(연체개월수) 만 있으면 됨
select 
	/* _LATE.lateMonthFee, */
	distinct
	_LATE.DLY_CNT
	,_DH.ROOM_TP ,_DH.TERCE_YN ,_DH.MVIH_YMD ,_DH.EGRSN_EST_YMD ,_DH.USE_YN ,_DH.EPTRM_YN
	,if (_DH.COMPX_CD is NULL, 'N', 'Y') as hoExist
	,H.*
FROM
	rm_ho as H,
	CONTT_MST_I as _CONTT,
	CNTR_MST_I as _CNTR,
	DONG_HO_MST_I as _DH,
	(
		select
			SUM(CASE WHEN OSDSM_EST_AMT > 0 THEN 1 ELSE 0 END) AS DLY_CNT
			,SUM( F.OSDSM_EST_AMT ) as lateMonthFee
			/* ,(SUM( F.OSDSM_EST_AMT ) + SUM( FN_GET_LATE_FEE("C201900004", F.OSDSM_EST_AMT, "2", F.OVERDUE_YMD, F.DLY_AMT, "20220710"))) as totalLateFee */
			,DONG_NO
			,HO_NO
			,CONTT_NO
			,COMPX_CD
		from 
			RNT_CONTT_PYMT_I F 
		where 
			COMPX_CD="C201900004" and BILL_MONTH < "202207" 
		group by 
			CONTT_NO 
		having 
			lateMonthFee > 0
	) as _LATE 
WHERE
	H.complex = _CONTT.COMPX_CD and _CONTT.COMPX_CD = _CNTR.COMPX_CD and _CNTR.COMPX_CD = _DH.COMPX_CD and _DH.COMPX_CD = _LATE.COMPX_CD
	and H.complex="C201900004"
	and H.dong = _DH.DONG_NO and H.ho = _DH.HO_NO
	and _CONTT.CONTT_NO = _CNTR.CONTT_NO and _CNTR.CONTT_NO = _LATE.CONTT_NO
	and _CONTT.DONG_NO = _DH.DONG_NO and _CONTT.HO_NO = _DH.HO_NO
	and _LATE.DONG_NO = _DH.DONG_NO and _LATE.HO_NO = _DH.HO_NO
ORDER BY 
	_LATE.DLY_CNT DESC
	/* ,_LATE.lateMonthFee DESC */
	  



-- 단지의 동별 공실 수
SELECT DONG_NO,count(*) as dongEmptyCnt FROM DONG_HO_MST_I WHERE COMPX_CD = "C201900004" and EPTRM_YN = 'Y' group by DONG_NO

-- 단지의 공실 수
SELECT count(*) as complexEmptyCnt FROM DONG_HO_MST_I WHERE COMPX_CD = "C201900004" and EPTRM_YN = 'Y'

-- 단지의 입주 예정 세대
select group_concat(H.no) as reContract from
	rm_ho as H
	,NEW_CONTT_MST_I as _NCONTT
	,NEW_CNTR_MST_I as _NCNTR
	,DONG_HO_MST_I as _DH
where 
	H.complex = _NCONTT.COMPX_CD and _NCONTT.COMPX_CD = _NCNTR.COMPX_CD and _NCNTR.COMPX_CD = _DH.COMPX_CD
	and _NCONTT.CONTT_NO = _NCNTR.CONTT_NO
	and _NCONTT.BIZ_CD = "NC" and _NCNTR.REPR_CNTR_YN = "Y" 
	and H.dong = _NCONTT.DONG_NO and H.ho = _NCONTT.HO_NO
	and H.dong = _DH.DONG_NO and H.ho = _DH.HO_NO
	and H.complex = "C201900004"
order by 
	cast(H.dong as signed) asc , 
	cast(H.floor as signed) desc, 
	cast(H.ho as signed) asc

-- 단지의 갱신 세대
select group_concat(H.no) as reContract from
	rm_ho as H
	,NEW_CONTT_MST_I as _NCONTT
	,NEW_CNTR_MST_I as _NCNTR
	,DONG_HO_MST_I as _DH
where 
	H.complex = _NCONTT.COMPX_CD and _NCONTT.COMPX_CD = _NCNTR.COMPX_CD and _NCNTR.COMPX_CD = _DH.COMPX_CD
	and _NCONTT.CONTT_NO = _NCNTR.CONTT_NO
	and _NCONTT.BIZ_CD = "RC" and _NCNTR.REPR_CNTR_YN = "Y" 
	and H.dong = _NCONTT.DONG_NO and H.ho = _NCONTT.HO_NO
	and H.dong = _DH.DONG_NO and H.ho = _DH.HO_NO
	and H.complex = "C201900004"
order by 
	cast(H.dong as signed) asc , 
	cast(H.floor as signed) desc, 
	cast(H.ho as signed) asc


-- 단지의 퇴거 예정 세대
select group_concat(H.no) as tbMoveOut from
	rm_ho as H
	,CONTT_MST_I as _CONTT
	,CNTR_MST_I as _CNTR
	,DONG_HO_MST_I as _DH
	,CONTT_EXPIR_I as _EX
where 
	H.complex = _CONTT.COMPX_CD and _CONTT.COMPX_CD = _CNTR.COMPX_CD and _CNTR.COMPX_CD = _DH.COMPX_CD and _DH.COMPX_CD = _EX.COMPX_CD
	and _EX.CONTT_NO = _CONTT.CONTT_NO and _CONTT.CONTT_NO = _CNTR.CONTT_NO
	and _CNTR.REPR_CNTR_YN = "Y"
	and H.dong = _CONTT.DONG_NO and H.ho = _CONTT.HO_NO
	and H.dong = _DH.DONG_NO and H.ho = _DH.HO_NO
	and H.complex = "C201900004"
order by 
	cast(H.dong as signed) asc , 
	cast(H.floor as signed) desc, 
	cast(H.ho as signed) asc

-- 단지의 퇴거 세대
select group_concat(H.no) as moveComplete from
	rm_ho as H
	,CONTT_MST_HIS_I as _CONTT_H
	,CNTR_MST_HIS_I as _CNTR_H
	,DONG_HO_MST_I as _DH
where 
	H.complex = _CONTT_H.COMPX_CD and _CONTT_H.COMPX_CD = _CNTR_H.COMPX_CD and _CNTR_H.COMPX_CD = _DH.COMPX_CD
	and _CONTT_H.STS_CD = _CNTR_H.STS_CD and _CNTR_H.REPR_CNTR_YN = "Y" and _CONTT_H.STS_CD = "O"
	and _CONTT_H.CONTT_NO = _CNTR_H.CONTT_NO
	and H.dong = _CONTT_H.DONG_NO and H.ho = _CONTT_H.HO_NO
	and H.dong = _DH.DONG_NO and H.ho = _DH.HO_NO
	and _CONTT_H.COMPX_CD = "C201900004"
order by 
	cast(H.dong as signed) asc , 
	cast(H.floor as signed) desc, 
	cast(H.ho as signed) asc
```

```php
-- 동호의 기본 정보
select 
	H.*
	/* ,_DH.LEAS_DPST_AMT  ,_DH.RENT_AMT ,_DH.EXSUE_AREA ,_DH.CMUSE_AREA ,_DH.PARK_AREA ,_DH.SUP_AREA ,_DH.ROOM_CNT ,_DH.TOILET_CNT */
	,_DH.ROOM_TP ,_DH.TERCE_YN ,_DH.MVIH_YMD ,_DH.EGRSN_EST_YMD ,_DH.USE_YN ,_DH.EPTRM_YN
	,if (_DH.COMPX_CD is NULL, 'N', 'Y') as hoExist
from rm_dong as D
	join rm_ho as H on D.no = H.dongNo
	left join DONG_HO_MST_I as _DH on _DH.COMPX_CD = H.complex and _DH.DONG_NO = H.dong and _DH.HO_NO = H.ho
where
	H.complex = "C201900004" 
order by 
	cast(D.dong as signed) asc , 
	cast(H.floor as signed) desc, 
	cast(H.ho as signed) asc
	
```