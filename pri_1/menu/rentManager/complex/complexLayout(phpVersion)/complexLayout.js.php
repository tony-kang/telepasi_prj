//function new_eContact(e) {
//    console.log('new_eContact');
//    console.log(e.data('complex'));
//    console.log(e.data('dong'));
//    console.log(e.data('ho'));
//}
//
//function update_eContact(e) {
//    console.log('update_eContact');
//    console.log(e.data('complex'));
//    console.log(e.data('dong'));
//    console.log(e.data('ho'));
//}
//
//function cancel_eContact(e) {
//    console.log('cancel_eContact');
//    console.log(e.data('complex'));
//    console.log(e.data('dong'));
//    console.log(e.data('ho'));
//}
//
//makeContextMenu({
//    "menuTitle": {'name':'메뉴타이틀' , 'class':'d-block bg-primary-500'},
//    "view_complexDongHo": {
//        'name':'전자계약',
//        'items': {
//            'new_eContact': { 'name':'전자계약(신규)' },
//            'update_eContact': { 'name':'전자계약(갱신)' },
//            'cancel_eContact': { 'name':'전자계약(취소)' },
//        }
//    },
//});
//

String.prototype.format = function() {
    var formatted = this, i = 0;
    while (/%s/.test(formatted))
    	formatted = formatted.replace("%s", arguments[i++]);
    return formatted;
}
//console.log("%s + %s = %s".format(4, 5, 9));

$('[data-obj-action="edit_ho"').on('click',function(e) {
    var ho = $(this).data('ho');
    ___GET('edit=exist,ho='+ho);
});

$(document).ready(function () {
    let start = new Date();  // 시작
    var sO = new Object();
        sO.jsonPrj = true;
        sO.jsonGroup = '';
        sO.jsonFile = 'json_complexLayout';
        sO.cmd = 'get.complex.layout';

    console.log(sO);
    ___ajaxCallback('?cfg=postJson',sO,function (jsonData) {
        //console.log(jsonData);
        var json = $.parseJSON(jsonData);
        var g_dongList = json.dongList;
        var g_hoList = json.hoList;
        var g_overdueList = json.overdueList;
        var g_inReadyList = json.inReadyList;
        //var g_reContract = json.reContractList;
        var g_hoBoxWidth = 40;
        var g_hoBoxHeight = 15;


        drawComplex(g_dongList);
        let end = new Date();  // 종료
        console.log('수행시간 = ' + (end - start) + 'ms');

        function drawComplex(dongList) {
            var $html,
                hoStartIdx = 0,
                dong;

            for( var dongIdx = 0; dongIdx < dongList.length; dongIdx++) {
                dong = dongList[dongIdx];
                $html = drawDong(dong,hoStartIdx);
                $('#id_jsDongCanvas').append($html);
                hoStartIdx += (dong['maxFloor'] * dong['hoCnt']);
            }
        }

        function drawDongBase(dong) {
            var w = (dong.hoCnt * g_hoBoxWidth) - dong.hoCnt + 1;
            var dongText = dong['dong'];
            var $html;

            $html = '<div class="text-center bg-primary-500"';
            $html += ' style="width:%spx; max-width:%spx; %s"'.format(w,w,'margin-top:2px; border:solid 1px #aaa;');
            $html += '>' + dongText + ' 동</div>';

            return $html;
        }

        function drawDong(dong,hoStartIdx) {
            var $html = '<div class="dongLayout">';

            var maxFloor = dong.maxFloor;
            var hoCnt = dong.hoCnt;
            var hoIdx = hoStartIdx;
            for (var fIdx = maxFloor; fIdx > 0 ; fIdx--) {
                var $floorHtml = '<div class="floorLayout" style="%s">'.format((fIdx < maxFloor) ? 'margin-top:-1px;' : '');
                for (var i = 0; i<hoCnt; i++) {
                    $floorHtml += drawHo(g_hoList[hoIdx]);
                    hoIdx++;
                }
                $floorHtml += '</div>';

                $html += $floorHtml;
            }
            $html += drawDongBase(dong);
            $html += '</div>';

            return $html;
        }

        function drawHo(ho) {
            var nickClass = ho['nickClass'] ? 'bg-info-500' : '';
            var hoClass = ho['disableClass'] ? 'cross-line' : '';
            var supType = ho['supType'];
            var roomType = ho['roomType'];
            var supArea = ho['SUP_AREA'];
            var exArea = ho['EXSUE_AREA'];
            var inUse = (ho['inUse'] === 'Y');
            var isEmpty = (ho['isEmpty'] === 'Y');
            var w = g_hoBoxWidth;
            var h = g_hoBoxHeight;
            var hoBackColor = isEmpty ? 'background-color:#f00; color:#fff;' : '';
            var hoForeColor = '';
            var hoLineColor = inUse ? 'border:solid 1px #aaa;' : '';
            var hoText = inUse ? ho['ho'] : '&nbsp;';
            var overDue = g_overdueList.find(overDue=>overDue.no === ho['no']);
            var inReady = g_inReadyList.find(inReady=>inReady.no === ho['no']);

            //var reContract = g_reContract.find(reContract=>reContract.no === ho['no']);
            //else if (reContract !== undefined) {
            //    hoBackColor = 'background-color:#707;';
            //    hoForeColor = 'color:#fff;';
            //}

            if (!inUse && ho['floor'] == 1) {
                hoClass += ' cross-line ho-not-in-use';
            } else if (inReady !== undefined) {
                hoClass += ' ho-in-ready';
            } else if (overDue !== undefined) {
                if (overDue['dMonth'] >= 3) {
                    hoClass += ' ho-overdue-3';
                } else if (overDue['dMonth'] == 2) {
                    hoClass += ' ho-overdue-2';
                } else {
                    hoClass += ' ho-overdue-1';
                }
            }

            var $html = '<div';
                $html += ' class="%s %s my-inline-block ho-text text-center"'.format(nickClass,hoClass);
                $html += ' title="[%s] [%s] [공급:%s ㎡ ,전용:%s ㎡]"'.format(supType,roomType,supArea,exArea);
                $html += ' style="height:%spx; margin-right:-1px; width:%spx; max-width:%spx; %s %s %s"'.format(h,w,w,hoBackColor,hoLineColor,hoForeColor);
                $html += '>';
                $html += hoText;
                $html += '</div>';

            return $html;
        }


    });
});
