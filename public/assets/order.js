$(function () {
    $(document).on('click', '.btn-action', function () {
        const url = $(this).attr('data-url');
        const elm = $(this).parents('tr');
        var orderId = elm.data('order-id');

        const elm_text_status = elm.find('.text-status');
        const elm_approve =  elm.find('.btn-approve-order');
        const elm_delivering = elm.find('.btn-delivering');
        const elm_delivering_success = elm.find('.btn-delivering-success');

        $.ajax({
            url: url,
            type: 'PUT',
            beforeSend: function () {

            },
            success : (data) => {
                if (data.result) {
                    console.log(data.status);
                    switch (data.status) {
                        case "0":
                            elm_approve.removeClass('btn-success');
                            elm_approve.addClass('btn-primary');
                            elm_approve.text('Xét duyệt');
                            elm_text_status.text(data.text);
                            elm_delivering.attr('disabled', 'disabled');
                            elm_approve.attr('data-url', 'http://shopvip.com/admin/order?orderId='+orderId+'&status='+1);
                            break;
                        case "1":
                            elm_approve.removeClass('btn-primary');
                            elm_approve.addClass('btn-success');
                            elm_approve.text('Hủy xét duyệt');
                            elm_text_status.text(data.text);
                            elm_delivering.removeAttr('disabled');
                            elm_approve.attr('data-url', 'http://shopvip.com/admin/order?orderId='+orderId+'&status='+0);
                            break;
                        case "2":
                            elm_delivering.removeClass('btn-primary');
                            elm_delivering.addClass('btn-success');
                            elm_approve.attr('disabled', 'disabled');
                            elm_text_status.text(data.text);
                            elm_delivering_success.removeAttr('disabled');
                            break;
                        case "3":
                            elm_delivering.attr('disabled', 'disabled');
                            elm_delivering_success.attr('disabled', 'disabled');
                            elm_text_status.text(data.text);
                            elm_delivering_success.addClass('btn-success');
                            break;
                    }
                }
            },
            error: function () {

            },
            complete: function () {

            }
        });
    });


    $(document).on('click', '.btn-cancel-order', function () {
        const elm = $(this).parents('tr');
        var orderId = elm.data('order-id');

        $.ajax({
            url: url,
            type: 'PUT',
            beforeSend: function () {

            },
            success : (data) => {
                if (data.result) {
                    console.log(data.status);
                    switch (data.status) {
                        case "0":
                            elm_approve.removeClass('btn-success');
                            elm_approve.addClass('btn-primary');
                            elm_approve.text('Xét duyệt');
                            elm_text_status.text(data.text);
                            elm_delivering.attr('disabled', 'disabled');
                            elm_approve.attr('data-url', 'http://shopvip.com/admin/order?orderId='+orderId+'&status='+1);
                            break;
                        case "1":
                            elm_approve.removeClass('btn-primary');
                            elm_approve.addClass('btn-success');
                            elm_approve.text('Hủy xét duyệt');
                            elm_text_status.text(data.text);
                            elm_delivering.removeAttr('disabled');
                            elm_approve.attr('data-url', 'http://shopvip.com/admin/order?orderId='+orderId+'&status='+0);
                            break;
                        case "2":
                            elm_delivering.removeClass('btn-primary');
                            elm_delivering.addClass('btn-success');
                            elm_approve.attr('disabled', 'disabled');
                            elm_text_status.text(data.text);
                            elm_delivering_success.removeAttr('disabled');
                            break;
                        case "3":
                            elm_delivering.attr('disabled', 'disabled');
                            elm_delivering_success.attr('disabled', 'disabled');
                            elm_text_status.text(data.text);
                            elm_delivering_success.addClass('btn-success');
                            break;
                    }
                }
            },
            error: function () {

            },
            complete: function () {

            }
        });
    })
})
