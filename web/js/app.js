(function($) {
    "use strict";

    $('div.row div.boardItem').each(function(index, item) {
        var $refresh = parseInt($(item).data('refresh'));

        function updateItem() {
            $.ajax({
                url: $(item).data('src'),
                success:  function(data) {
                    $(item).html(data);
                },
                cache: false
            });
        }

        if ($refresh > 0) {
            setInterval(updateItem, $refresh * 1000);
        }

        updateItem();
    });
}(jQuery));
