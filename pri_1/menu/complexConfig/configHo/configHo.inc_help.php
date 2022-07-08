<?php
/**
 * @author tony on 2021. 11. 6.
 * @author Tony Kang <bluein007@gmail.com>
 * Description
 *
 */

if (empty($_pg['dong'])) {
    $_mHelp = [
        '호실관리는 동이 지정되어야 합니다.',
        '<my style="color:red;">동 구성관리 메뉴에서 동을 클릭하여 호실을 관리 할 수 있습니다.</my>'
    ];
    ___masterHelp($_mHelp, '알림');
}