$('[data-obj-action="edit_newSurvey"').on('click',function(e) {
    ___GET('edit=new','survey');
});

$('[data-obj-action="edit_surveyData"]').on('click',function(e) {
    var survey = $(this).data('obj-survey');
    ___GET('edit=exist,survey='+survey);
});

//리스트 테이블 action - delete
$('[data-obj-action="delete_surveyData"]').on('click',function(e) {
    var survey = $(this).data('obj-survey');
    ___GET('edit=delete,survey='+survey);
    ___ajax()
});
