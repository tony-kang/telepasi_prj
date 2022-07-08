//리스트 테이블 action - new
$('[data-obj-action="edit_newComplexDong"').on('click',function(e) {
    ___GET('edit=new','dong');
});

$('[data-obj-action="edit_complexDong"').on('click',function(e) {
    var dong = $(this).data('dong');
    ___GET('edit=exist,dong='+dong);
});

$('[data-obj-action="make_complexDongHoData"').on('click',function(e) {
    var dong = $(this).data('dong');

    var sO = new Object();
        sO.apiPrj = true;
        sO.apiGroup = 'complex';
        sO.dong = dong;
        sO.cmd = 'make.dong.ho.data';

    console.log(sO);
    ___ajax('?cfg=api&api=api_complex',sO,true,null);
});

