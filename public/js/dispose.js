$('.disposeBtn').click(function () {
    $('#model_name').val($(this).data('model-name'));
    $('#dispose_id').val($(this).data('model-id'));
    $('#model_type').val($(this).data('model-type'));
    $('#requestDisposal').modal('show');
});
