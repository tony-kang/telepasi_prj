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
$productDrawNo = ___getDecodeValue($sO['productDraw']);
___log($logHandle,sprintf('productNo=%d',$productNo));
___log($logHandle,sprintf('productDrawNo=%d',$productDrawNo));

//--------------------------------------------------------------------------------
//--------------------------------------------------------------------------------
$product = ___getProduct($productNo);
___log($logHandle,$product['q']);

$_editDb['table'] = 'erp_productDrawing';
$_editDb['puField'] = 'no';
$_editDb['puType'] = NUMBER_FIELD;
$_editDb['puValue'] = $productDrawNo;

$jsonArr = [
    'result'=>'OK',
    'productNo'=>$product['no'],
    'productName'=>$product['name'],
    'productDrawNo'=>$productDrawNo,
    'productDraw'=>['result'=>'none']
];
___logArray($logHandle,$_editDb);
$jsonArr['dataDbPara'] = ___encode(___make_dbKey(array($_editDb['table'],$_editDb['puField'],$_editDb['puType'],$_editDb['puValue'])));


if ($productDrawNo) {
    $productDraw = ___getProductDrawing($productDrawNo);
    ___log($logHandle,$productDraw['q']);
    if (is_array($productDraw)) {
        $draw = ___getDrawing($productDraw['drawingNo']);
        ___log($logHandle,$draw['q']);
        $jsonArr['productDraw'] = [
                'result'=>'OK',
                'no'=>$draw['no'],
                'name'=>$draw['name'],
                'code'=>$draw['code'],
                'percentRate'=>$productDraw['percentRate'],
                'comment'=>$productDraw['comment'],
            ];
    }
}

//--------------------------------------------------------------------------------
___logArray($logHandle,$jsonArr);

//-------------------------------------------------------------------------------------
___logEnd($logHandle);
echo json_encode($jsonArr);