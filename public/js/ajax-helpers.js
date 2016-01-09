(function () {

    var submitAjaxRequest = function(e) {
        var form = $(this);
        var method = form.find('input[name="_method"]').val() || 'POST';

        $.ajax({
            headers: {
                'X-CSRF-Token': form.find('input[name="_token"]').val()
            },
            type: method,
            url: form.prop('action'),
            data: form.serialize(),
            success: function(){
                $.publish('form-submitted', form);
            }
        });

        e.preventDefault();
    };

    // Form marked with "data-submitted" attribute will submit via AJAX
    $('form[data-remote]').on('submit', submitAjaxRequest);

    // The "data-click-submits-form" attribute immediately submits the form on change
    $('*[data-click-submits-form]').on('change', function() {
        $(this).closest('form').submit();
    });
})();