//리스트 테이블 action - new
//$('[data-obj-action="edit_newHo"').on('click',function(e) {
//    ___GET('edit=new','ho');
//});

$('[data-obj-action="edit_ho"').on('click',function(e) {
    var ho = $(this).data('ho');
    ___GET('edit=exist,ho='+ho);
});

function hoSaveCallback(data) {
    //저장하면 이전화면으로 돌아가도록 한다.
    history.back();
}