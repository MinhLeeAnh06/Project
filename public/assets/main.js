$(function () {
    $(".pd-color-choose").find('.change-color:first').css('border', 'black solid 2px');

    /**
     * Quantity change
     * @type {*|jQuery|HTMLElement}
     */
    $(document).on('click', '.qtybtn', function () {
        var $button = $(this);
        var oldValue = $button.parent().find('input').val();
        if ($button.hasClass('inc')) {
            var newVal = parseFloat(oldValue) + 1;
        } else {
            // Don't allow decrementing below zero
            if (oldValue > 1) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 1;
            }
        }
        $button.parent().find('input').val(newVal);

        let url = $button.parent().find('input').data('url');
        let productId = $button.parent().find('input').data('product-id');
        updateCartItem(newVal, productId, url);
    });

    /**
     * Add cart item
     * @type {*|jQuery|Ajax}
     */
    $(document).on('click', '.btn-add-to-cart', function () {
        const url = $(this).data('url');
        const productId = $(this).data('product-id');
        const color= null;
        const size= null;

        $.ajax({
            url: url,
            type: 'POST',
            data: {
                productId,
                color,
                size
            },
            beforeSend: function () {
                $(".btn-add-to-cart").css("background-color", "#a39d9d");
            },
            success: function (data) {

            },
            error: function () {

            },
            complete: function () {
                $(".btn-add-to-cart").removeAttr("style");
            }
        });
    });

    /**
     * Delete cart item
     * @type {*|jQuery|Ajax}
     */
    $(document).on('click', '.delete-cart-item', function () {
        const url = $(this).data('url');

        $.ajax({
            url: url,
            type: 'DELETE',
            beforeSend: function () {

            },
            success: function (data) {
                if (data.status) {
                    $('tbody.render-view-cart').html(data.view_cart);
                    $('.render-view-cart-total').html(data.view_total);
                }
            },
            error: function () {

            },
            complete: function () {

            }
        });
    });

    /**
     * Update cart item
     * @type {*|jQuery|Ajax}
     */
    const updateCartItem = (quantity, productId, url) => {
        $.ajax({
            url: url,
            type: 'PUT',
            data: {
                quantity,
                productId
            },
            beforeSend: function () {

            },
            success: function (data) {
                if (data.status) {
                    $('tbody.render-view-cart').html(data.view_cart);
                    $('.render-view-cart-total').html(data.view_total);
                }
            },
            error: function () {

            },
            complete: function () {

            }
        });
    }
})
