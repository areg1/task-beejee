$(document).ready(function() {
    $('.page-link').on('click', function (e) {

        e.preventDefault();
        const i = $(this).attr('value');
    
        window.location.href = '/home?page=' + i;
    });
    $('textarea').each(function () {
        $(this).val($(this).val().trim());
    });
});