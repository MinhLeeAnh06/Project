@extends('admin.layout.master')
@section('title' , 'Orders')
@section('body')
    <style>
        .highcharts-figure,
        .highcharts-data-table table {
            min-width: 310px;
            max-width: 800px;
            margin: 1em auto;
        }

        .highcharts-data-table table {
            font-family: Verdana, sans-serif;
            border-collapse: collapse;
            border: 1px solid #ebebeb;
            margin: 10px auto;
            text-align: center;
            width: 100%;
            max-width: 500px;
        }

        .highcharts-data-table caption {
            padding: 1em 0;
            font-size: 1.2em;
            color: #555;
        }

        .highcharts-data-table th {
            font-weight: 600;
            padding: 0.5em;
        }

        .highcharts-data-table td,
        .highcharts-data-table th,
        .highcharts-data-table caption {
            padding: 0.5em;
        }

        .highcharts-data-table thead tr,
        .highcharts-data-table tr:nth-child(even) {
            background: #f8f8f8;
        }

        .highcharts-data-table tr:hover {
            background: #f1f7ff;
        }

        #button-bar {
            min-width: 310px;
            max-width: 800px;
            margin: 0 auto;
        }
    </style>
    <div class="app-main__inner">
        <div class="d-flex">
            <div>
                <input type="text" name="dates" data-url="{{ route('admin.chart.order_statistics') }}" readonly>
            </div>
            <div>
                <button class="btn btn-primary month">Trạng thái đơn theo tháng</button>
            </div>
            <div>
                <button class="btn btn-primary year">Trạng thái đơn theo năm</button>
            </div>
        </div>
        <figure class="highcharts-figure">
            <div id="container"></div>
            <p class="highcharts-description"></p>
        </figure>
        <div class="mt-5">
            <table class="table">
                <thead>
                <tr class="text-center">
                    <th scope="col">Mặt hàng bán chạy nhất</th>
                    <th scope="col">Màu bán chạy nhất</th>
                    <th scope="col">Size bán chạy nhất</th>
                </tr>
                </thead>
                <tbody>
                    <tr class="text-center">
                        <td>{{ $dataStatistical->best_selling_product ?? '' }}</td>
                        <td>{{ $dataStatistical->best_selling_color ?? '' }}</td>
                        <td>{{ $dataStatistical->best_selling_size ?? ''}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="mt-5">
            <h2 class="text-center">Thống kê sản phẩm còn lại trong kho</h2>
            <table class="table">
                <thead>
                <tr class="text-center">
                    <th scope="col">Tên sản phẩm</th>
                    <th scope="col">Màu</th>
                    <th scope="col">Size</th>
                    <th scope="col">Số lượng còn trong kho</th>
                </tr>
                </thead>
                <tbody class="load-product_detail">
                    @include('render.chart.tbl_product_detail')
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('chart-js')
    <script>
        const data = JSON.parse('{!!json_encode($data)!!}');
        const dataText = JSON.parse('{!!json_encode($dataText)!!}');

        function convert(data) {
            let objCheck = {
                cancel_order: [],
                delivering_order: [],
                success_order: [],
                time: [],
            }

            data.map(item => {
                let {success_order, delivering_order, cancel_order, time} = item;
                objCheck.cancel_order = [...objCheck.cancel_order, parseInt(cancel_order)]
                objCheck.delivering_order = [...objCheck.delivering_order, parseInt(delivering_order)]
                objCheck.success_order = [...objCheck.success_order, parseInt(success_order)]
                objCheck.time = [...objCheck.time, time]
            })

            return objCheck;
        }


        function loadChart(objCheck, dataText) {
            Highcharts.chart('container', {
                chart: {
                    type: 'column'
                },

                title: {
                    text: dataText.title
                },
                legend: {
                    align: 'right',
                    verticalAlign: 'middle',
                    layout: 'vertical'
                },

                xAxis: {
                    categories: objCheck.time,
                    labels: {
                        x: -10
                    }
                },

                yAxis: {
                    allowDecimals: false,
                    title: {
                        text: 'Số lượng'
                    }
                },

                series: [{
                    name: 'Success order',
                    data: objCheck.success_order,
                    color: 'green'

                }, {
                    name: 'Delivering order',
                    data: objCheck.delivering_order,
                }, {
                    name: 'Cancel order',
                    data: objCheck.cancel_order,
                    color: 'red'
                }],

                responsive: {
                    rules: [{
                        condition: {
                            maxWidth: 500
                        },
                        chartOptions: {
                            legend: {
                                align: 'center',
                                verticalAlign: 'bottom',
                                layout: 'horizontal'
                            },
                            yAxis: {
                                labels: {
                                    align: 'left',
                                    x: 0,
                                    y: -5
                                },
                                title: {
                                    text: null
                                }
                            },
                            subtitle: {
                                text: null
                            },
                            credits: {
                                enabled: false
                            }
                        }
                    }]
                }
            });
        }

        loadChart(convert(data), dataText);
        $('.highcharts-description').text(dataText.description);

        $(function () {
            $('input[name="dates"]').daterangepicker();

            $(document).on('click', '.applyBtn', function () {
                const date = $('input[name="dates"]').val();
                const url = $('input[name="dates"]').data('url');

                $.ajax({
                    url: url,
                    type: 'GET',
                    data: {
                        date: date.replace(/\s/g, ""),
                        type: 6
                    },
                    success: (data) => {
                        loadChart(convert(data.data), data.dataText);
                        $('.highcharts-description').text(data.dataText.description);
                    },
                });
            });

            $(document).on('click', '.month', function () {
                const url = $('input[name="dates"]').data('url');
                ajaxChart(url, 7);

            });

            $(document).on('click', '.year', function () {
                const url = $('input[name="dates"]').data('url');
                ajaxChart(url, 8);
            });

            function ajaxChart(url, type) {
                $.ajax({
                    url: url,
                    type: 'GET',
                    data: {
                        type: type
                    },
                    success: (data) => {
                        loadChart(convert(data.data), data.dataText);
                        $('.load-product_detail').html(data.view);
                        $('.highcharts-description').text(data.dataText.description);
                    },
                });
            }
        })

    </script>
@endsection
