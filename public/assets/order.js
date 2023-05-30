$(function () {
    $(document).on('click', '.btn-approve-order', function () {
        const url = $(this).data('url');
        const orderId = $(this).data('order-id');
        console.log(url)
        $.ajax({
            url: url,
            type: 'PUT',
            beforeSend: function () {

            },
            success: (data) => {
                if (data.status) {
                    if (!data.update) {
                        $(this).removeClass('btn-danger');
                        $(this).addClass('btn-success');
                        $(this).text('Đã xét duyệt');
                        $(this).data('url', 'http://127.0.0.1:8000/admin/order/1/'+orderId);
                    } else {
                        $(this).removeClass('btn-success');
                        $(this).addClass('btn-danger');
                        $(this).text('Chưa xét duyệt');
                        $(this).data('url', 'http://127.0.0.1:8000/admin/order/0/'+orderId);
                    }
                }
            },
            error: function () {

            },
            complete: function () {

            }
        });
    });
})
