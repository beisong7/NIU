@extends('layouts.main')

@section('content')
    <!-- Page-Title -->
    <div class="page-title-box">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h4 class="page-title mb-1">NIU CMS </h4>
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">Analytics</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title end breadcrumb -->

    <div class="page-content-wrapper">
        <div class="container-fluid">
            <div class="row">

                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <form class="form-inline float-right" onclick="event.preventDefault()">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control form-control-sm datepicker-here datevalue" data-range="true"  data-multiple-dates-separator=" - " data-language="en" placeholder="Select Date" />
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="far fa-calendar font-size-12"></i></span>
                                    </div>
                                    <button class="btn btn-sm btn-outline-primary ml-2 updatedate">Update Chart</button>
                                </div>

                            </form>

                            <h5 class="header-title mb-4">Analysis</h5>
                            <div id="yearly-sale-chart" class="apex-charts"></div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- end row -->
        </div>
    </div>
@endsection

@section('custom_js')
    <script src="{{ asset('admin/libs/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('admin/libs/jqvmap/maps/jquery.vmap.usa.js') }}"></script>

    <script>
        $(function () {
            $('[data-plugin="knob"]').knob()
        });

        console.log('{{ date('Y')."-01-01" }}');
        console.log('{{ date('Y-m-d', strtotime('today')) }}');

        let chartData = {
            expect: null,
            secured: null,
            months: null
        };

        let chart = null;

        async function endpointCall(url) {
            await $.get(url, function(data, status){

                chartData.expect = data[1];
                chartData.secured = data[2];
                chartData.months = data[0];

            });
        }

        async function initChart() {
            await endpointCall('{{ route('accounts.financial', [date('Y')."-01-01", date('Y-m-d', strtotime('today'))]) }}');
            buildChart(chartData);
            console.log(chartData);
        }

        function buildChart(chartData){
            var options = {
                chart: {
                    height: 350,
                    type: "area",
                    toolbar: {
                        show: !1
                    }
                },
                colors: ["#e4cc37","#2fa97c"],
                dataLabels: {
                    enabled: !1
                },
                series: [{
                    name: "Expected",
                    data: chartData.expect
                },
                    {
                        name: "Sales",
                        data: chartData.secured
                    }],

                grid: {
                    yaxis: {
                        lines: {
                            show: !1
                        }
                    }
                },
                stroke: {
                    width: 3,
                    curve: "stepline"
                },
                markers: {
                    size: 0
                },
                yaxis:{
                    type: 'numeric',
                    labels: {
                        formatter: function (value) {
                            return "N"+format_number(value);
                        }
                    }
                },
                xaxis: {
                    categories: chartData.months,
                    title: {
                        text: "Month"
                    }
                },
//                fill: {
//                    type: "gradient",
//                    gradient: {
//                        shadeIntensity: 1,
//                        opacityFrom: .7,
//                        opacityTo: .9,
//                        stops: [0, 90, 100]
//                    }
//                },
                legend: {
                    position: "top",
                    horizontalAlign: "right",
                    floating: !0,
                    offsetY: -25,
                    offsetX: -5
                }
            };

            chart = new ApexCharts(document.querySelector("#yearly-sale-chart"), options);


            chart.render();
        }
        
        async function updateChart(date) {
            //split dates to range
            let range = date.split(" - ");
            let start = await toTimestamp(range[0]);
            let end = await toTimestamp(range[1]);
            console.log(range.length);
            if(range.length === 2){
              await endpointCall('{{ route('accounts.update.financial') }}'+`?start=${start}&end=${end}`);
              console.log(chartData);

                chart.updateOptions( {
                    xaxis: {
                        categories: chartData.months,
                        title: {
                            text: "Month"
                        }
                    }
                });

              chart.updateSeries([
                  {
                      name: "Expected",
                      data: chartData.expect
                  },
                  {
                      name: "Sales",
                      data: chartData.secured
                  }
              ])

//                chart.updateSeries([
//                    {
//                        series: [
//                            {
//                                name: "Expected",
//                                data: chartData.expect
//                            },
//                            {
//                                name: "Sales",
//                                data: chartData.secured
//                            }
//                            ],
//                        xaxis: {
//                            categories: chartData.months,
//                            title: {
//                                text: "Month"
//                            }
//                        }
//                    }
//                ])
            }


        }

        function format_number(num)
        {
            var num_parts = num.toString().split(".");
            num_parts[0] = num_parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            return num_parts.join(".");
        }

        $('.updatedate').click(function (e) {
            let val  = $('.datevalue').val()
            console.log(val==null||val==""?'empty':val)
            updateChart(val)
        })

        initChart();

        async function toTimestamp(strDate){
            let datum = await Date.parse(strDate);
            return datum/1000;
        }


    </script>

@endsection





