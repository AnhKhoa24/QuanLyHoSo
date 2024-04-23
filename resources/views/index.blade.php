@extends('layouts.layout')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-12 mb-4 order-0">
                <div class="card">

                    <form action="/" method="get">
                        <div class="row">
                            <div class="mb-3 col-md-4">
                                <label class="form-label">Ngày bắt đầu</label>
                                <input type="date" class="form-control" name="batdau" value="{{ $batdau }}">
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="form-label">Ngày kết thúc</label>
                                <input type="date" class="form-control" name="ketthuc" value="{{ $ketthuc }}">
                            </div>
                            <div class="mb-3 col-md-2">
                              <label class="form-label">Chọn tìm để xem kết quả</label>
                                <button type="submit" class="btn btn-primary me-2">Tìm</button>
                            </div>
                        </div>
                    </form>


                </div>
            </div>
            <!-- Total Revenue -->
            <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2 mb-4">
                <div class="card">
                    <div class="row row-bordered g-0">
                        <div class="col-md-12">
                            <div id="chartContainer" class="px-2" style="height: 370px; width: 98%;"></div>

                        </div>
                    </div>
                </div>
            </div>
            <!--/ Total Revenue -->

        </div>
    </div>


    <script>
        window.onload = function() {

            var cvschart = {!! json_encode($cvschart) !!};
            var tkdlarr = {!! json_encode($cvdlchart) !!};

            var dataPoints1 = [];
            var dataPoints2 = [];

            for (var i = 0; i < cvschart.length; i++) {
                dataPoints1.push({
                    x: new Date(cvschart[i].x),
                    y: cvschart[i].y
                });
                dataPoints2.push({
                    x: new Date(tkdlarr[i].x),
                    y: tkdlarr[i].y
                });
            }

            var options = {
                exportEnabled: true,
                animationEnabled: true,
                title: {
                    text: "Thống kê công việc"
                },
                axisX: {
                    title: "Ngày tháng"
                },
                toolTip: {
                    shared: true
                },
                legend: {
                    cursor: "pointer",
                    itemclick: toggleDataSeries
                },
                data: [{
                        type: "spline",
                        name: "Số công việc",
                        showInLegend: true,
                        xValueFormatString: "DD/MM/YYYY",
                        yValueFormatString: "#,##0 công việc",
                        dataPoints: dataPoints1,
                    },
                    {
                        type: "spline",
                        name: "Công việc đã làm",
                        axisYType: "secondary",
                        showInLegend: true,
                        xValueFormatString: "MMM YYYY",
                        yValueFormatString: "#,##0 công việc",
                        dataPoints: dataPoints2,
                    }
                ]
            };
            $("#chartContainer").CanvasJSChart(options);

            function toggleDataSeries(e) {
                if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                    e.dataSeries.visible = false;
                } else {
                    e.dataSeries.visible = true;
                }
                e.chart.render();
            }

        }
    </script>
    {{-- <script src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script> --}}
    <script src="https://cdn.canvasjs.com/jquery.canvasjs.min.js"></script>
@endsection
