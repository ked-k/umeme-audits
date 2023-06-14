<div>
   
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">Dashboard</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </div>
        <div>
            <button class="right-side-toggle waves-effect waves-light btn-inverse btn btn-circle btn-sm pull-right m-l-10"><i class="ti-settings text-white"></i></button>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <div class="card-group">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <h2 class="m-b-0"><i class="fa fa-sitemap text-info"></i></h2>
                            <h3 class="">{{$feeders}}</h3>
                            <h6 class="card-subtitle">Total Feeders</h6></div>
                        <div class="col-12">
                            <div class="progress">
                                <div class="progress-bar bg-info" role="progressbar" style="width: 85%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <!-- Column -->
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <h2 class="m-b-0"><i class="fa fa-map-marker text-success"></i></h2>
                            <h3 class="">{{$zones}}</h3>
                            <h6 class="card-subtitle">Total Zones Registered</h6></div>
                        <div class="col-12">
                            <div class="progress">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 40%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <!-- Column -->
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <h2 class="m-b-0"><i class="fa fa-map text-purple"></i></h2>
                            <h3 class="">{{$districts}}</h3>
                            <h6 class="card-subtitle">Total Districts</h6></div>
                        <div class="col-12">
                            <div class="progress">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 56%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <!-- Column -->
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <h2 class="m-b-0"><i class="fa fa-users text-warning"></i></h2>
                            <h3 class="">{{$users}}</h3>
                            <h6 class="card-subtitle">Total Users</h6></div>
                        <div class="col-12">
                            <div class="progress">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: 26%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <livewire:management.admin.mainbar-component /> 
            </div> 
        </div>
           <div class="row">
                <div class="col-12 col-lg-8 col-xl-8 d-flex">
                    <div class="card radius-10 w-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <h6 class="mb-0"> {{ __('Total Count per Anomaly type') }}</h6>
                                </div>
                                <div class="font-22 ms-auto"><i class="bx bx-dots-horizontal-rounded"></i>
                                </div>
                            </div>

                            <div class="chart-container-1" wire:ignore.self>
                                <div wire:ignore id="anomalyCounts"></div>
                            </div>
                        </div>
                        <br>
                    </div>
                </div>
                <div class="col-12 col-lg-4 col-xl-4 d-flex">
                    <div class="card radius-10 overflow-hidden w-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <h6 class="mb-0"> {{ __('Visits Status') }}</h6>
                                </div>
                                <div class="font-22 ms-auto"><i class="bx bx-dots-horizontal-rounded"></i>
                                </div>
                            </div>
                            <div class="chart-container-2 my-3" wire:ignore.self>
                                <div wire:ignore id="anomalyStatus"></div>
                                {{-- <canvas id="sampleSchart"></canvas> --}}
                            </div>
                        </div>
                    </div>
                </div>
          </div>
    </div>
    
    @push('scripts')


      

        
        <script>
            var options = {
                series: [
                    @foreach ($anomaly_status as $value)
                        {{ $value->audit_count }},
                    @endforeach
                ],
                chart: {
                    width: '100%',
                    type: 'pie',
                },
                labels: [
                    @foreach ($anomaly_status as $value)
                        "{{ $value->status }}",
                    @endforeach
                ],

                plotOptions: {
                    pie: {
                        dataLabels: {
                            offset: -5
                        },

                        fill: {
                    type: 'gradient',
                    gradient: {
                        shade: 'light',
                        type: "vertical",
                        shadeIntensity: 0.5,
                        gradientToColors: ["#A7E7AE", "#ff6a00"],
                        inverseColors: true,
                        opacityFrom: 1,
                        opacityTo: 1,
                        //stops: [0, 50, 100],
                        //colorStops: []
                    }
                },
                    }
                },
                dataLabels: {
                    formatter(val, opts) {
                        const name = opts.w.globals.labels[opts.seriesIndex]
                        return [name, val.toFixed(1) + '%']
                    }
                },
                legend: {
                    show: false
                }
            };

            var chart = new ApexCharts(document.querySelector("#anomalyStatus"), options);
            chart.render();
        </script>
        
        <script>


            
            // Monthly samples line chart
            var options2 = {
                series: [{
                        name: 'Total Counts',
                        data: [
                            @foreach ($anomaly_counts as $data)
                                        {{ $data->audit_count }},
                            @endforeach
                        ]
                        
                    },
                    
                ],
                chart: {
                    foreColor: '#9a9797',
                    type: "area",
                    //width: 130,
                    height: 360,
                    toolbar: {
                        show: !1
                    },
                    zoom: {
                        enabled: !1
                    },
                    dropShadow: {
                        enabled: 0,
                        top: 3,
                        left: 14,
                        blur: 4,
                        opacity: .12,
                        color: "#3461ff"
                    },
                    sparkline: {
                        enabled: !1
                    }
                },
                markers: {
                    size: 0,
                    colors: ["#3461ff", "#12bf24"],
                    strokeColors: "#fff",
                    strokeWidth: 2,
                    hover: {
                        size: 7
                    }
                },
                plotOptions: {
                    bar: {
                        horizontal: !1,
                        columnWidth: "35%",
                        endingShape: "rounded"
                    }
                },
                legend: {
                    show: false,
                    position: 'top',
                    horizontalAlign: 'left',
                    offsetX: -20
                },
                dataLabels: {
                    enabled: !1
                },
                grid: {
                    show: true,
                    // borderColor: '#eee',
                    // strokeDashArray: 4,
                },
                stroke: {
                    show: !0,
                    width: 3,
                    curve: "smooth"
                },
                fill: {
                    type: 'gradient',
                    gradient: {
                        shade: 'light',
                        type: "vertical",
                        shadeIntensity: 0.9,
                        gradientToColors: ["#B2BE36", "#CDD380"],
                        inverseColors: true,
                        opacityFrom: 0.8,
                        opacityTo: 0.2,
                        //stops: [0, 50, 100],
                        //colorStops: []
                    }
                },
                colors: ["#B2BE36", "#CDD380"],
                xaxis: {
                    categories: [
                        @foreach ($anomaly_counts as $data)
                                    '{{ $data->anomaly }}',
                    @endforeach
                    ]

                },
                tooltip: {
                    theme: 'dark',
                    y: {
                        formatter: function(val) {
                            return "" + val + ""
                        }
                    }
                }
            };

            var tests_chart = new ApexCharts(document.querySelector("#anomalyCounts"), options2);
            tests_chart.render();


           
        </script>
       
    @endpush
</div>
