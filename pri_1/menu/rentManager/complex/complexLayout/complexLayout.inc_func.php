<?php

/***
 *  단지구성도 칼라 설명
 */
function ___complexColorDesc() {
    echo '<div>';
    echo '<span class="complex-desc-box"><my class="complex-desc-text">입주 준비중</my><my class="color-box ho-in-ready"></my></span>';
    echo '<span class="complex-desc-box"><my class="complex-desc-text">3개월이상 연체</my><my class="color-box ho-overdue-3"></my></span>';
    echo '<span class="complex-desc-box"><my class="complex-desc-text">2개월 연체</my><my class="color-box ho-overdue-2"></my></span>';
    echo '<span class="complex-desc-box"><my class="complex-desc-text">1개월 연체</my><my class="color-box ho-overdue-1"></my></span>';
    echo '<span class="complex-desc-box"><my class="complex-desc-text">공실</my><my class="color-box ho-empty"></my></span>';
    echo '<span class="complex-desc-box"><my class="complex-desc-text">쉐어타입</my><my class="color-box ho-shared"></my></span>';
    echo '</div>';
}