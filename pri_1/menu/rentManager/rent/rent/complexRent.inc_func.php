<?php
/**
 * @author tony on 2022. 5. 17.
 * @author Tony Kang <bluein007@gmail.com>
 * Description
 *
 */

function ___hoState($state) {
    $hoStateArr = ___envArr('M002','env_prj.txt','colorClass');

    return $hoStateArr[$state];
}