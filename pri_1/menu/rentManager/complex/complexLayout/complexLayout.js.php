/***
 * 단지 레이아웃 출력 Class
 * @type {ComplexLayout}
 */
let ComplexLayout = class {
    #json;
    #g_dongList;
    #g_hoList;
    #g_overdueList;
    #g_inReadyList;
    #g_hoBoxWidth;
    #g_hoBoxHeight;
    #g_bindDivId;
    #g_rentBaseFloor;

    constructor(jsonData,bindDivId) {
        this.#json = $.parseJSON(jsonData);
        this.#g_dongList = this.#json.dongList;
        this.#g_hoList = this.#json.hoList;
        this.#g_overdueList = this.#json.overdueList;
        this.#g_inReadyList = this.#json.inReadyList;
        this.#g_hoBoxWidth = this.#json.hoWidth;
        this.#g_hoBoxHeight = this.#json.hoHeight;
        this.#g_bindDivId = bindDivId;
        this.#g_rentBaseFloor = this.#json.rentBaseFloor;
    }

    drawComplex() {
        var dongList = this.#g_dongList;
        var $html,
            hoStartIdx = 0,
            dong;

        for( var dongIdx = 0; dongIdx < dongList.length; dongIdx++) {
            dong = dongList[dongIdx];
            $html = this.#drawDong(dong,hoStartIdx);
            $(this.#g_bindDivId).append($html);
            hoStartIdx += (dong['maxFloor'] * dong['hoCnt']);
        }
    }

    #drawDongBase(dong) {
        var w = (dong.hoCnt * this.#g_hoBoxWidth) - dong.hoCnt + 1;
        var dongText = dong['dong'];
        var $html;

        $html = '<div class="text-center bg-primary-500"';
        $html += ' style="width:%spx; max-width:%spx; %s"'.format(w,w,'margin-top:2px; border:solid 1px #aaa;');
        $html += '>' + dongText + ' 동</div>';

        return $html;
    }

    #drawDong(dong,hoStartIdx) {
        var $html = '<div class="dongLayout">';

        var maxFloor = dong.maxFloor;
        var hoCnt = dong.hoCnt;
        var hoIdx = hoStartIdx;
        for (var fIdx = maxFloor; fIdx > 0 ; fIdx--) {
            var $floorHtml = '<div class="floorLayout" style="%s">'.format((fIdx < maxFloor) ? 'margin-top:-1px;' : '');
            for (var i = 0; i<hoCnt; i++) {
                $floorHtml += this.#drawHo(this.#g_hoList[hoIdx],i,hoCnt);
                hoIdx++;
            }
            $floorHtml += '</div>';

            $html += $floorHtml;
        }
        $html += this.#drawDongBase(dong);
        $html += '</div>';

        return $html;
    }

    #drawHo(ho,hoIdx,hoCnt) {
        var nickClass = ho['nickClass'] ? 'bg-info-500' : '';
        var hoClass = ho['disableClass'] ? 'cross-line' : '';
        var roomType = ho['roomType'];
        var supArea = ho['supArea'];
        var exArea = ho['exArea'];
        var inUse = (ho['inUse'] === 'Y');
        var isEmpty = (ho['isEmpty'] === 'Y');
        var hoType = ho['hoType'];
        var w = this.#g_hoBoxWidth;
        var h = this.#g_hoBoxHeight;
        var hoForeColor = '';
        var hoLineColor = inUse ? 'border:solid 1px #aaa;' : '';
        var hoText = inUse ? ho['ho'] : '&nbsp;';
        var overDue = this.#g_overdueList.find(overDue=>overDue.no === ho['no']);
        var inReady = this.#g_inReadyList.find(inReady=>inReady.no === ho['no']);

        if (inReady !== undefined) {
            hoClass += ' ho-in-ready';
        } else if (overDue !== undefined) {
            if (overDue['dMonth'] >= 3) {
                hoClass += ' ho-overdue-3';
            } else if (overDue['dMonth'] == 2) {
                hoClass += ' ho-overdue-2';
            } else {
                hoClass += ' ho-overdue-1';
            }
        } else if (isEmpty) {
            hoClass += ' ho-empty';
        } else if (!inUse && ho['floor'] <= this.#g_rentBaseFloor) {
            hoClass += ' cross-line ho-not-use';
        }
        //else if (!inUse && (hoIdx == 0 || hoIdx == (hoCnt-1))) {
        //    hoClass += ' cross-line ho-not-use';
        //}

        if (hoType == 1) {
            //쉐어 타입
            hoText = ho['ho'];
            hoClass += ' ho-shared';
        } else if (!inUse && isEmpty) {
            //쉐어 타입
            hoText = ho['ho'];
            hoClass += ' ho-shared';
        }
        //if (ho['ho'] === "2203") {
        //    alert('a');
        //}

        var $html = '<div';
            $html += ' class="%s %s my-inline-block ho-text text-center"'.format(nickClass,hoClass);
            $html += ' title="[%s] [공급:%s ㎡ ,전용:%s ㎡]"'.format(roomType,supArea,exArea);
            $html += ' style="height:%spx; margin-right:-1px; width:%spx; max-width:%spx; %s %s"'.format(h,w,w,hoLineColor,hoForeColor);
            $html += '>';
            $html += hoText;
            $html += '</div>';

        return $html;
    }
}

$(document).ready(function () {
    let start = new Date();  // 시작
    var sO = new Object();
        sO.jsonPrj = true;
        sO.jsonGroup = '';
        sO.jsonFile = 'json_complexLayout';
        sO.cmd = 'get.complex.layout';

    //console.log(sO);
    ___ajaxCallback('?cfg=postJson',sO,function (jsonData) {
        let complexLayout = new ComplexLayout(jsonData,'#id_jsDongCanvas');
        complexLayout.drawComplex();
    });
});