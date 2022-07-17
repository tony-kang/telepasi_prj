$('[data-obj-action="edit_newData"').on('click',function(e) {
    ___GET('edit=new','gPara');
});

$('[data-obj-action="edit_demoData"]').on('click',function(e) {
    var gPara = $(this).data('obj-para');
    ___GET('edit=exist,gPara='+gPara);
});

//리스트 테이블 action - delete
$('[data-obj-action="delete_demoData"]').on('click',function(e) {
    var gPara = $(this).data('obj-para');
    ___GET('edit=delete,gPara='+gPara);
});

$(document).ready(function() {
    $htmlEditor = new_htmlEditor('.my-wysiwyg-editor');
});
