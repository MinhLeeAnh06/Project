@extends('admin.layout.master')
@section('title' , 'Orders')
@section('body')
    <style>
        #container {
            height: 400px;
        }

        .highcharts-figure,
        .highcharts-data-table table {
            min-width: 310px;
            max-width: 800px;
            margin: 1em auto;
        }

        #datatable {
            font-family: Verdana, sans-serif;
            border-collapse: collapse;
            border: 1px solid #ebebeb;
            margin: 10px auto;
            text-align: center;
            width: 100%;
            max-width: 500px;
        }

        #datatable caption {
            padding: 1em 0;
            font-size: 1.2em;
            color: #555;
        }

        #datatable th {
            font-weight: 600;
            padding: 0.5em;
        }

        #datatable td,
        #datatable th,
        #datatable caption {
            padding: 0.5em;
        }

        #datatable thead tr,
        #datatable tr:nth-child(even) {
            background: #f8f8f8;
        }

        #datatable tr:hover {
            background: #f1f7ff;
        }


    </style>
    <div class="app-main__inner">
        <div class="d-flex">
            <div>
                <input type="text" name="dates" data-url="{{ route('admin.chart.sales_statistics') }}" readonly>
            </div>
            <div>
                <button class="btn btn-primary month">Doanh thu theo tháng</button>
            </div>
            <div>
                <button class="btn btn-primary year">Doanh thu theo năm</button>
            </div>
        </div>
        <figure class="highcharts-figure">
            <div id="container"></div>
            <p class="highcharts-description"></p>
        </figure>
    </div>
@endsection

@section('chart-js')
    <script>
        const data = JSON.parse('{!!json_encode($data)!!}');
        const dataText = JSON.parse('{!!json_encode($dataText)!!}');

        // Data retrieved from https://fas.org/issues/nuclear-weapons/status-world-nuclear-forces/
        function loadChart(data, dataText) {
            Highcharts.chart('container', {
                data: {
                    table: 'datatable'
                },
                chart: {
                    type: 'column'
                },
                title: {
                    text: dataText.title
                },
                xAxis: {
                    categories: data.map(item => item.time), // Use the first element of each data point as category label
                    title: {
                        text: dataText.x_title
                    }
                },
                yAxis: {
                    allowDecimals: false,
                    title: {
                        text: dataText.y_title
                    }
                },
                series: [{
                    name: 'Doanh số (VND)',
                    data: data.map(item => item.total_amount)
                }]
            });

        }

        loadChart(data, dataText);
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
                        type: 4
                    },
                    success: (data) => {
                        loadChart(data.data, data.dataText)
                        $('.highcharts-description').text(data.dataText.description);
                    },
                });
            });

            $(document).on('click', '.month', function () {
                const url = $('input[name="dates"]').data('url');
                ajaxChart(url, 2);

            });

            $(document).on('click', '.year', function () {
                const url = $('input[name="dates"]').data('url');
                ajaxChart(url, 3);
            });

            function ajaxChart(url, type) {
                $.ajax({
                    url: url,
                    type: 'GET',
                    data: {
                        type: type
                    },
                    success: (data) => {
                        loadChart(data.data, data.dataText)
                        $('.highcharts-description').text(data.dataText.description);
                    },
                });
            }
        })

    </script>
@endsection
