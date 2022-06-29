<?php
/**
 * @author tony on 2022. 6. 28.
 * @author Tony Kang <bluein007@gmail.com>
 * Description
 *
 */

//템플릿 문서를 Load시 replace되는 문자열을 처리합니다.
//이 함수를 삭제하지 마시고 내용을 수정하세요.
function prj___templateReplace($templateStr)
{
    $_my = ___getSession('mbr');
    $temleteReplaceArr = [
        '[_TODAY_]' => date('Y.m.d'),
        // TemplateText => ReplaceText
    ];

    $r = $templateStr;
    foreach($temleteReplaceArr as $shortCut => $rData) {
        //___debug($shortCut.' : '.$rData);
        $r = str_replace($shortCut,$rData,$r);
    }

    return $r;
}