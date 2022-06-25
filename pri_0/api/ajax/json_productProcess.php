<?php
/**
 * @author tony on 2021. 10. 24.
 * @author Tony Kang <bluein007@gmail.com>
 * Description
 *
 */


$logHandle = ___logStart($sO['jsonFile']);
___logArray($logHandle,$sO);

//--------------------------------------------------------------------------------
//--------------------------------------------------------------------------------
$productNo = ___getDecodeValue($sO['product']);
$productProcNo = ___getDecodeValue($sO['productProc']);
___log($logHandle,sprintf('productNo=%d',$productNo));
___log($logHandle,sprintf('productProcNo=%d',$productProcNo));

//--------------------------------------------------------------------------------
//--------------------------------------------------------------------------------
$product = ___getProduct($productNo);
___log($logHandle,$product['q']);

$_editDb['table'] = 'erp_productProcess';
$_editDb['puField'] = 'no';
$_editDb['puType'] = NUMBER_FIELD;
$_editDb['puValue'] = $productProcNo;

$jsonArr = [
    'result'=>'OK',
    'productNo'=>$product['no'],
    'productName'=>$product['name'],
    'productProcNo'=>$productProcNo,
    'productProc'=>['result'=>'none']
];
___logArray($logHandle,$_editDb);
$jsonArr['dataDbPara'] = ___encode(___make_dbKey(array($_editDb['table'],$_editDb['puField'],$_editDb['puType'],$_editDb['puValue'])));


if ($productProcNo) {
    $productProc = ___getProductProcess($productProcNo);
    ___log($logHandle,$productProc['q']);
    if (is_array($productProc)) {
        $proc = ___getProcess($productProc['processNo']);
        ___log($logHandle,$proc['q']);
        $jsonArr['productProc'] = [
                'result'=>'OK',
                'no'=>$proc['no'],
                'name'=>$proc['name'],
                'code'=>$proc['code'],
                'percentRate'=>$productProc['percentRate'],
                'comment'=>$productProc['comment'],
            ];
    }
}

//--------------------------------------------------------------------------------
___logArray($logHandle,$jsonArr);

//-------------------------------------------------------------------------------------
___logEnd($logHandle);
echo json_encode($jsonArr);