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
$('[data-obj-action="edit_ho"]').on('click',function(e) {
    var ho = $(this).data('ho');
    ___GET('edit=exist,ho='+ho);
});
