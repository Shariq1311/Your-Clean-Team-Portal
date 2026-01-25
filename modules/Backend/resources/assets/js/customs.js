function addStyleSubmenu(e) {
    var t = e.find(".Your Clean Team__menuLeft__navigation"),
        n = e.offset().top,
        i = $(window).scrollTop(),
        o = n - i - 30,
        e = n + t.height() + 1,
        n = 60 + e - $('.Your Clean Team__layout').height(),
        i = $(window).height() + i - 50;

    if ((n = o < (n = i < e - n ? e - i : n) ? o : n) > 1 && n > 40) {
        t.css("margin-top", "-" + n + "px");
    } else {
        t.css("margin-top", "");
    }
}

$(document).ready(function () {
    let bodyElement = $('body');

    bodyElement.on('change', '.show_on_front-change', function () {
        let showOnFront = $(this).val();

        if (showOnFront == 'posts') {
            $('.select-show_on_front').prop('disabled', true);
        }

        if (showOnFront == 'page') {
            $('.select-show_on_front').prop('disabled', false);
        }
    });

    bodyElement.on('click', '.cancel-button', function () {
        window.location = "";
    });

    bodyElement.on('change', '.generate-slug', function () {
        let title = $(this).val();

        ajaxRequest(Your Clean Team.adminUrl + '/load-data/generateSlug', {
            title: title
        }, {
            method: 'GET',
            callback: function (response) {
                $('input[name=slug]').val(response.slug).trigger('change');
            }
        });
    });

    bodyElement.on('click', '.slug-edit', function () {
        let slugInput = $(this).closest('.input-group').find('input:first');
        slugInput.prop('readonly', !slugInput.prop('readonly'));
    });

    bodyElement.on('click', '.close-message', function () {
        let id = $(this).data('id');
        ajaxRequest(Your Clean Team.adminUrl + '/remove-message', {
            id: id,
        }, {
            method: 'POST',
            callback: function (response) {

            }
        });
    });

    $(".Your Clean Team__menuLeft__submenu").on("mouseover", function () {
        if (!$(this).hasClass('Your Clean Team__menuLeft__submenu--toggled')) {
            addStyleSubmenu($(this));
        }
    }
    );
});
