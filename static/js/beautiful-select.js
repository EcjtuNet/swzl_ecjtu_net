$(document).ready(function () {
    $('#sslb').css('display', 'none');
    $('.beautiful-select').removeAttr('style');
    $('.bs-label a').on('click', function (event) {
        var $bslist = $(this).parent().siblings('ul');
        if ($bslist.hasClass('bs-list-close') ) {
            $bslist.removeClass('bs-list-close');
            $bslist.addClass('bs-list-open');
        } else if ($bslist.hasClass('bs-list-open') ) {
            $bslist.removeClass('bs-list-open');
            $bslist.addClass('bs-list-close');
        }
        event.preventDefault();
        return false;
    });
    $('.bs-option a').each(function () {
        $(this).on('click', function (event) {
            $('.bs-label a').html($(this).text() );
            $('#sslb').val($(this).attr('value') );
            $('.beautiful-select ul').removeClass('bs-list-open');
            $('.beautiful-select ul').addClass('bs-list-close');
            event.preventDefault();
            return false;
        });
    });
})