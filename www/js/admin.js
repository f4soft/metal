$(function () {
    $('#offices-city_id').on('change', function (e) {
        e.preventDefault();
        checkIsMainOffice(this);
    });
    if( $('#offices-city_id').length) {
        checkIsMainOffice(this);
    }

    function checkIsMainOffice(that) {
        $.ajax({
            url: '/admin/offices/is-main?cityID=' + $(that).find(':selected').val(),
            type: 'post',
            success: function (response) {
                if(response != "[]") {
                    $('.field-offices-is_main').hide();
                    if(typeof $('.field-offices-is_main input:checked').val() !== 'undefined'){
                        $('.field-offices-is_main').show();
                    }
                }else {
                    $('.field-offices-is_main').show();
                }
            }
        });
    }
});