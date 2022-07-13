$('[data-obj-action="ajax_hoContractHistory"').on('click',function(e) {
    var target = $(this).data('target');
    var hoNo = $(this).data('ho-no');
    $('#'+target).html('불러온 데이타가 보일 것입니다.');
});
