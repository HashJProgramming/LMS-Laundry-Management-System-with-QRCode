(function ($) {

    $.fn.togglepassword = function (btnclass) {
        this.each(function(){
            let id = $(this).attr('id') ?? ($(this).attr('name') ?? '');
            let autofocus = $(this).prop('autofocus') !== true ? '' : ' autofocus';
            let name = $(this).attr('name') ?? '';
            let classlist = $(this).attr('class') ?? '';
            let value = $(this).val();
            let content = '<i class="fas fa-eye-slash"></i>';
            let title = 'Show password';
            btnclass = btnclass ?? '';
            return $(this).replaceWith(
                $('<div class="input-group mb-3"></div>')
                    .append($('<input type="password" class="' + classlist + '" id="' + id + '" name="' + name + '" placeholder="Password" value="' + value + '"' + autofocus + '>'))
                    .append('<span class="input-group-text" id="basic-addon1"><button type="button" class="' + btnclass + '" data-role="togglepassword" data-target="#' + id + '" title="' + title + '" tabindex="-1">' + content + '</button></span>')
            );
        });
    };

})(jQuery);

$(() => {

    $(document).on('click', '[data-role="togglepassword"]', function () {
        let target = $(this).data('target');
        let is_password = $(target).attr('type') === 'password';
        $(target).attr('type', (is_password ? 'text' : 'password'));
        $(this).html('<i class="fas fa-eye' + (is_password ? '' : '-slash') + '"></i>');
        $(this).attr('title', is_password ? 'Show password' : 'Hide password');
    });

});
