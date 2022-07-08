//리스트 테이블 action - new
$('[data-obj-action="edit_newComplexDong"').on('click',function(e) {
    ___GET('edit=new','dong');
});

$('[data-obj-action="edit_complexDong"').on('click',function(e) {
    var dong = $(this).data('dong');
    ___GET('edit=exist,dong='+dong);
});

$('[data-obj-action="delete_complexDong"').on('click',function(e) {
    var dong = $(this).data('dong');
    ___GET('edit=delete,dong='+dong);
});

$('[data-obj-action="make_complexDongHoData"').on('click',function(e) {
    var dong = $(this).data('dong');
    var dongText = $(this).data('dong-text');
    var c = confirm(dongText + '동의 호실정보를 자동생성 하시겠습니까?');
    if (!c) return;

    var sO = new Object();
        sO.apiPrj = true;
        sO.apiGroup = 'complex';
        sO.dong = dong;
        sO.cmd = 'make.dong.ho.data';

    console.log(sO);
    ___ajax('?cfg=api&api=api_complex',sO,true,null);
});

$('[data-obj-action="delete_complexDongHoData"').on('click',function(e) {
    var dong = $(this).data('dong');
    var dongText = $(this).data('dong-text');
    var c = confirm(dongText + '동의 호실정보를 완전히 하시겠습니까?' + "\n" + '삭제도면 복구가 불가능 합니다.');
    if (!c) return;

    var sO = new Object();
        sO.apiPrj = true;
        sO.apiGroup = 'complex';
        sO.dong = dong;
        sO.cmd = 'delete.dong.ho.data';

    console.log(sO);
    ___ajax('?cfg=api&api=api_complex',sO,true,null);
});
