@extends('layouts.main')

@section('title_menu', 'Dashboard')

@section('style')
    <style>
        .radio label {
            padding: .5em 1em;
            border: 1px solid #4e73df;
            color: #4e73df;
            border-radius: .25em;
            cursor: pointer;
        }

        .radio input[type='radio'] {
            display: none;

        }

        .radio input[type='radio']:checked+label {
            background-color: #1cc88a;
            color: #fff;
        }

        .radio label {
            margin: 0;
        }
    </style>
@endsection
@section('content')

    <!--Cahaya dan Hujan -->
    <div class="row">
        <div class="col-xl-6 col-sm-12">
            <div class="card-sm shadow mb-4" style="height: 144px;">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Sensor Hujan</h6>
                </div>
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-xl-2 col-sm-1">
                            <div id="rainIndicator">
                                <b>0</b>
                            </div>
                        </div>
                        <div class="rain col-xl-8  col-sm-10">
                            <div class="text-center">
                                <b>Hujan</b>
                            </div>
                            <div class="progress mb-2">
                                <div id="rainBar" class="progress-bar bg-success" role="progressbar" style="width: 0%"
                                    aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="col-xl-2  col-sm-1">
                            <i class="fas fa-cloud-showers-heavy"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6  col-sm-12">
            <div class="card-sm shadow mb-4" style="height: 144px;">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Sensor Cahaya</h6>
                </div>
                <div class="card-body ">
                    <div class="row align-items-center">
                        <div id="lightIndicator" class="col-xl-2  col-sm-1">
                            <b>0</b>
                        </div>
                        <div class="light col-xl-8 col-sm-10">
                            <div class="progress mb-2">
                                <div id="lightBar" class="progress-bar bg-success" role="progressbar" style="width: 0%"
                                    aria-valuenow="22" aria-valuemin="0" aria-valuemax="100">
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2  col-sm-1">
                            <i class="far fa-sun"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="row">
        {{-- Suhu --}}
        <div class="col-xl-6 col-sm-12">
            <div class="card-sm shadow mb-4">
                <div class="card-header py-3">
                    <div class="row justify-content-between px-3">
                        <h6 class="m-0 font-weight-bold text-primary">Sensor Suhu</h6>
                        <div>
                            <b id="degree"></b>
                            <i class="fas fa-temperature-high"></i>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <div id="chartTemp"></div>
                    </div>
                </div>
                <div class="card-footer">
                    <!--Make filter by hour-->

                    <div class="d-flex justify-content-start">
                        {{-- <div class="">
                            <i class="fas fa-arrow-circle-down" style="color: red"></i>
                            <b>35'C</b>
                        </div>
                        <div class="ml-4">
                            <i class="fas fa-arrow-circle-up" style="color: blue"></i>
                            <b>35'C</b>
                        </div> --}}

                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <div class="radio">
                                <input class="d-none" value="1 hour" type="radio" name="time-filter_temp"
                                    id="temp-time_1h">
                                <label for="temp-time_1h">1 Hour</label>
                            </div>
                            <div class="radio">
                                <input class="d-none" value="5 hours" type="radio" name="time-filter_temp"
                                    id="temp-time_5h">
                                <label for="temp-time_5h">5 Hours</label>
                            </div>
                            <div class="radio">
                                <input class="d-none" value="1 day" type="radio" name="time-filter_temp"
                                    id="temp-time_1d">
                                <label for="temp-time_1d">1 Day</label>
                            </div>
                            <div class="radio">
                                <input class="d-none" value="7 days" type="radio" name="time-filter_temp"
                                    id="temp-time_7d">
                                <label for="temp-time_7d">7 Days</label>
                            </div>
                            <div class="radio">
                                <input class="d-none" checked value="LIVE" type="radio" name="time-filter_temp"
                                    id="temp-time_live">
                                <label for="temp-time_live">Live</label>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>

        {{-- Kelembapan --}}
        <div class="col-xl-6 col-sm-12">
            <div class="card-sm shadow mb-4">
                <div class="card-header py-3">
                    <div class="row justify-content-between px-3">
                        <h6 class="m-0 font-weight-bold text-primary">Sensor Kelembapan</h6>
                        <div>
                            <b id="humidity"></b>
                            <i class="fas fa-temperature-high"></i>
                        </div>
                    </div>
                </div>
                <div class="card-body" style="min-height: 80%">
                    <div class="chart-area">
                        <div id="chartHumid"></div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-start">
                        {{-- <div class="">
                            <i class="fas fa-arrow-circle-down" style="color: red"></i>
                            <b>35'C</b>
                        </div>
                        <div class="ml-4">
                            <i class="fas fa-arrow-circle-up" style="color: blue"></i>
                            <b>35'C</b>
                        </div> --}}

                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <div class="radio">
                                <input class="d-none" value="1 hour" type="radio" name="time-filter_humid"
                                    id="humid-time_1h">
                                <label for="humid-time_1h">1 Hour</label>
                            </div>
                            <div class="radio">
                                <input class="d-none" value="5 hours" type="radio" name="time-filter_humid"
                                    id="humid-time_5h">
                                <label for="humid-time_5h">5 Hours</label>
                            </div>
                            <div class="radio">
                                <input class="d-none" value="1 day" type="radio" name="time-filter_humid"
                                    id="humid-time_1d">
                                <label for="humid-time_1d">1 Day</label>
                            </div>
                            <div class="radio">
                                <input class="d-none" value="7 days" type="radio" name="time-filter_humid"
                                    id="humid-time_7d">
                                <label for="humid-time_7d">7 Days</label>
                            </div>
                            <div class="radio">
                                <input class="d-none" checked value="LIVE" type="radio" name="time-filter_humid"
                                    id="humid-time_live">
                                <label for="humid-time_live">Live</label>
                            </div>

                        </div>
                        {{-- <div class="input-group-prepend">
                            <button class="btn btn-outline-primary" type="button" data-action="changeFilterHumid"
                                data-value="1 hour">1
                                hour</button>
                            <button class="btn btn-outline-primary" type="button" data-action="changeFilterHumid"
                                data-value="5 hours">5
                                hours</button>
                            <button class="btn btn-outline-primary" type="button" data-action="changeFilterHumid"
                                data-value="1 day">1
                                day</button>
                            <button class="btn btn-outline-primary" type="button" data-action="changeFilterHumid"
                                data-value="7 days">7
                                days</button>
                            <button class="btn btn-success" type="button" data-action="changeFilterHumid"
                                data-value="LIVE">LIVE</button>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="row">
        <div class="col-xl-4">
            <div class="card-sm shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between">
                    <div class="d-flex gap-3">
                        <i class="far fa-lightbulb"></i>
                        <h6 class="m-0 font-weight-bold ml-2">Saklar A</h6>
                    </div>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Action:</div>
                            <a class="dropdown-item" href="#">Edit</a>
                            <a class="dropdown-item" href="#">Delete</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row justify-content-between px-3">
                        <div class="">
                            <h4 class="text-danger ">OFF</h4>
                            <p style="font-size: 12px">Mode Lampu: Manual</p>
                        </div>
                        <div class="c">
                            <div class="form-check form-switch mt-3">
                                <input type="checkbox" checked data-switchery="true" data-plugin="switchery"
                                    data-color="#039cfd" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card-sm shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between">
                    <div class="d-flex gap-3">
                        <i class="far fa-lightbulb"></i>
                        <h6 class="m-0 font-weight-bold ml-2">Saklar A</h6>
                    </div>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Action:</div>
                            <a class="dropdown-item" href="#">Edit</a>
                            <a class="dropdown-item" href="#">Delete</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row justify-content-between px-3">
                        <div class="">
                            <h4 class="text-danger ">OFF</h4>
                            <p style="font-size: 12px">Mode Lampu: Manual</p>
                        </div>
                        <div class="c">
                            <div class="form-check form-switch mt-3">
                                <input type="checkbox" checked data-switchery="true" data-plugin="switchery"
                                    data-color="#039cfd" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card-sm shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between">
                    <div class="d-flex gap-3">
                        <i class="far fa-lightbulb"></i>
                        <h6 class="m-0 font-weight-bold ml-2">Saklar A</h6>
                    </div>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Action:</div>
                            <a class="dropdown-item" href="#">Edit</a>
                            <a class="dropdown-item" href="#">Delete</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row justify-content-between px-3">
                        <div class="">
                            <h4 class="text-danger ">OFF</h4>
                            <p style="font-size: 12px">Mode Lampu: Manual</p>
                        </div>
                        <div class="c">
                            <div class="form-check form-switch mt-3">
                                <input type="checkbox" checked data-switchery="true" data-plugin="switchery"
                                    data-color="#039cfd" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}


@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script>
        let updatedCategories = [];
        let oldPayload = {};
        let tempChart;
        let oldSortType = 'hour';
        let tempOptions;
        let currentFilter = '30 minute';

        $(document).ready(function() {
            tempOptions = {
                series: [],
                chart: {
                    id: "realtimeTemp",
                    height: 350,
                    type: "line",
                    zoom: {
                        enabled: false,
                    },
                },
                dataLabels: {
                    enabled: false,
                },
                stroke: {
                    curve: "smooth",
                },
                grid: {
                    row: {
                        colors: ["#f3f3f3", "transparent"],
                        opacity: 0.5,
                    },
                },
                xaxis: {
                    categories: updatedCategories,
                },
            };
            $('[name="time-filter_temp"]').on('change', function() {
                updatedCategories = [];
                oldPayload = {};
                currentFilter = $(this).val();
                tempChart.updateOptions({
                    xaxis: {
                        categories: [],
                    },
                    series: [],
                });
                @foreach ($sensors as $item)
                    @if ($item->sensor_type == 'TEMPERATURE')
                        requestData('{{ $item->code }}', $(this).val());
                    @endif
                @endforeach
            })

            tempChart = new ApexCharts(document.querySelector("#chartTemp"), tempOptions);
            tempChart.render();
            renderChart();

            setInterval(() => {
                renderChart();
            }, 5000);

        });

        function requestData(sensorCode, currentFilter) {
            $.ajax({
                url: "{{ route('sensor-logs.get.value') }}",
                method: "GET",
                data: {
                    code: sensorCode,
                    time_filter: currentFilter,
                },
                success: function(data) {
                    const curfilter = $('[name="time-filter_temp"]:checked').val();
                    const sortType = curfilter.includes('hour') ? 'hour' : (curfilter == 'LIVE' ? 'hour' :
                        'day')
                    const newCategories = data.data.map(function(item) {
                        return sortType == 'day' ? item.date :
                            item.label;
                    });

                    // make timestamp unique
                    updatedCategories = sortTime(new Set([...newCategories, ...updatedCategories]),
                        sortType);
                    oldPayload[data.code] = [...data.data, ...(oldPayload[data.code] ?? [])];

                    let newCartPayload = [];
                    for (const key in oldPayload) {
                        let index = parseInt(key.substring(key.length - 1));
                        newCartPayload[index - 1] = {
                            name: `Sensor ${index}`,
                            data: combineValues(updatedCategories, oldPayload[key], sortType)
                        };
                    }

                    tempChart.updateOptions({
                        xaxis: {
                            categories: updatedCategories,
                        },
                        series: newCartPayload,
                    });

                },
                error: function(error) {

                },
            });
        }

        function renderChart() {
            @foreach ($sensors as $item)
                @if ($item->sensor_type == 'TEMPERATURE')
                    requestData('{{ $item->code }}', currentFilter);
                @endif
            @endforeach
        }

        function sortTime(times, type = 'day') {

            if (type == 'date') {
                return [...times].sort((a, b) => {
                    return new Date(a) - new Date(b);
                });

            } else {
                return [...times].sort((a, b) => {
                    let aTime = a.split(':');
                    let bTime = b.split(':');

                    let aMinutes = parseInt(aTime[0]) * 60 + parseInt(aTime[1]);
                    let bMinutes = parseInt(bTime[0]) * 60 + parseInt(bTime[1]);

                    return aMinutes - bMinutes;
                });
            }

        }

        function combineValues(stamp, data, filterType = 'day') {

            if (filterType == 'day') {
                return [...stamp].map((item, index) => {

                    const found = data.find((element) => element.date === item);
                    if (found) {

                        return parseInt(found.value);
                    } else {
                        return 0;
                    }
                });
            } else {
                return [...stamp].map((item, index) => {
                    const found = data.find((element) => element.label === item);
                    if (found) {
                        return parseInt(found.value);
                    } else {
                        return 0;
                    }
                });
            }



        }
    </script>

    <!-- Chart Humidity -->
    <script>
        let updatedHumidCategories = [];
        let oldHumidPayload = {};
        let humidChart;
        let oldHumidSortType = 'hour';
        let humidOptions;
        let currentHumidFilter = '30 minute';

        $(document).ready(function() {
            humidOptions = {
                series: [],
                chart: {
                    id: "realtimeHumid",
                    height: 350,
                    type: "line",
                    zoom: {
                        enabled: false,
                    },
                },
                dataLabels: {
                    enabled: false,
                },
                stroke: {
                    curve: "smooth",
                },
                grid: {
                    row: {
                        colors: ["#f3f3f3", "transparent"],
                        opacity: 0.5,
                    },
                },
                xaxis: {
                    categories: updatedHumidCategories,
                },
            };
            $('[name="time-filter_humid"]').on('change', function() {
                updatedHumidCategories = [];
                oldHumidPayload = {};
                currentHumidFilter = $(this).val();
                humidChart.updateOptions({
                    xaxis: {
                        categories: [],
                    },
                    series: [],
                });
                @foreach ($sensors as $item)
                    @if ($item->sensor_type == 'HUMIDITY')
                        requestHumidData('{{ $item->code }}', $(this).val());
                    @endif
                @endforeach
            })

            humidChart = new ApexCharts(document.querySelector("#chartHumid"), humidOptions);
            humidChart.render();
            renderChart();

            setInterval(() => {
                renderChart();
            }, 5000);

        });

        function requestHumidData(sensorCode, currentHumidFilter) {
            $.ajax({
                url: "{{ route('sensor-logs.get.value') }}",
                method: "GET",
                data: {
                    code: sensorCode,
                    time_filter: currentHumidFilter,
                },
                success: function(data) {
                    if (data.data.length > 0) {

                        const filterNow = $('[name="time-filter_humid"]:checked').val();
                        const sortTypeHumid = filterNow.includes('hour') ? 'hour' : (filterNow == 'LIVE' ?
                            'hour' :
                            'day')
                        var newCategories = data.data.map(function(item) {
                            return sortTypeHumid == 'day' ? item.date :
                                item.label;
                        });

                        // make timestamp unique
                        updatedHumidCategories = sortTime(new Set([...newCategories, ...
                                updatedHumidCategories
                            ]),
                            sortTypeHumid);
                        oldHumidPayload[data.code] = [...data.data, ...(oldHumidPayload[data.code] ?? [])];
                        let newCartPayloadHumid = [];
                        for (const key in oldHumidPayload) {
                            let index = parseInt(key.substring(key.length - 1));
                            newCartPayloadHumid[index - 1] = {
                                name: `Sensor ${index}`,
                                data: combineHumidValues(updatedHumidCategories, oldHumidPayload[key],
                                    sortTypeHumid)
                            };
                        }
                        console.log(newCartPayloadHumid)
                        humidChart.updateOptions({
                            xaxis: {
                                categories: updatedHumidCategories,
                            },
                            series: newCartPayloadHumid,
                        });
                    }
                },
                error: function(error) {

                },
            });
        }

        function renderChart() {
            @foreach ($sensors as $item)
                @if ($item->sensor_type == 'HUMIDITY')
                    requestHumidData('{{ $item->code }}', currentHumidFilter);
                @endif
            @endforeach
        }

        function sortTime(times, type = 'day') {

            if (type == 'day') {
                return [...times].sort((a, b) => {
                    return new Date(a) - new Date(b);
                });

            } else {
                return [...times].sort((a, b) => {
                    let aTime = a.split(':');
                    let bTime = b.split(':');

                    let aMinutes = parseInt(aTime[0]) * 60 + parseInt(aTime[1]);
                    let bMinutes = parseInt(bTime[0]) * 60 + parseInt(bTime[1]);

                    return aMinutes - bMinutes;
                });
            }

        }

        function combineHumidValues(stamp, data, filterType = 'day') {
            return [...stamp].map((item, index) => {
                const found = data.find((element) => {
                    if (filterType === 'day') {
                        return element.date === item;
                    } else if (filterType === 'hour') {
                        return element.label === item;
                    }
                });

                if (found) {
                    return parseInt(found.value);
                } else {
                    return 0;
                }
            });
        }
    </script>


    {{-- <script>
        var updatedHumidCategories = [];
        var sensorHumidSeries = [];
        var humidChart;
        var humidOptions;
        var currentFilterHumid = '30 minute';

        $(document).ready(function() {
            humidOptions = {
                series: sensorHumidSeries,
                chart: {
                    id: "realtimeHumid",
                    height: 350,
                    type: "line",
                    zoom: {
                        enabled: false,
                    },
                },
                dataLabels: {
                    enabled: false,
                },
                stroke: {
                    curve: "smooth",
                },
                grid: {
                    row: {
                        colors: ["#f3f3f3", "transparent"],
                        opacity: 0.5,
                    },
                },
                xaxis: {
                    categories: updatedHumidCategories,
                },
            };

            $('[data-action="changeFilterHumid"]').on('click', function() {
                @foreach ($sensors as $item)
                    @if ($item->sensor_type == 'HUMIDITY')
                        requestDataHumid('{{ $item->code }}', $(this).data('value'));
                    @endif
                @endforeach
            })


            humidChart = new ApexCharts(document.querySelector("#chartHumid"), humidOptions);
            humidChart.render();
            renderChartHumid();

            setInterval(() => {
                renderChartHumid();
            }, 5000);
        });

        function requestDataHumid(sensorCode, currentFilterHumid) {
            $.ajax({
                url: "{{ route('sensor-logs.get.value') }}",
                method: "GET",
                data: {
                    code: sensorCode,
                    time_filter: currentFilterHumid,
                },
                success: function(data) {
                    if (data.data.length > 0) {
                        var newHumidCategories = data.data.map(function(item) {
                            return item.label;
                        });
                        // make timestamp unique
                        updatedHumidCategories = sortTimeHumid(new Set([...newHumidCategories, ...
                            updatedHumidCategories
                        ]));
                        oldPayload[data.code] = [...data.data, ...(oldPayload[data.code] ?? []), ];
                        let newHumidCartPayload = [];
                        for (const key in oldPayload) {
                            let index = parseInt(key.substring(key.length - 1));
                            newHumidCartPayload[index - 1] = {
                                name: `Sensor ${index}`,
                                data: combineValuesHumid(updatedHumidCategories, oldPayload[key])
                            };
                        }

                        humidChart.updateSeries(sensorHumidSeries);
                        humidChart.updateOptions({
                            xaxis: {
                                categories: updatedHumidCategories,
                            },
                            series: newHumidCartPayload,
                        });
                    }
                },
                error: function(error) {

                },
            });
        }


        function renderChartHumid() {
            @foreach ($sensors as $item)
                @if ($item->sensor_type == 'HUMIDITY')
                    requestDataHumid('{{ $item->code }}', currentFilterHumid);
                @endif
            @endforeach
        }

        function sortTimeHumid(times) {
            return [...times].sort((a, b) => {
                let aTime = a.split(':');
                let bTime = b.split(':');

                let aMinutes = parseInt(aTime[0]) * 60 + parseInt(aTime[1]);
                let bMinutes = parseInt(bTime[0]) * 60 + parseInt(bTime[1]);

                return aMinutes - bMinutes;
            });
        }

        function combineValuesHumid(stamp, data) {

            return [...stamp].map((item, index) => {
                const found = data.find((element) => element.label === item);
                if (found) {
                    return parseInt(found.value);
                } else {
                    return 0;
                }
            });

        }
    </script> --}}

    <!-- Bar Rain -->
    <script>
        $(document).ready(function() {
            function updateRainCard() {
                $.ajax({
                    url: "{{ route('sensor-logs.get.value') }}",
                    method: 'GET',
                    data: {
                        code: "RIN_001",
                        type: "RAIN"
                    },

                    success: function(data) {
                        // console.log('Received rain data:', data);
                        if (data.data && data.data.length > 0) {
                            var latestRainPercentage = data.data[data.data.length - 1].value;
                            var progressBar = document.querySelector('#rainBar');
                            progressBar.style.width = latestRainPercentage + "%";
                            progressBar.setAttribute('aria-valuenow', latestRainPercentage);
                            document.querySelector('#rainIndicator b').innerText =
                                latestRainPercentage + "%";

                            // Add conditional statements for rain description
                            var rainDescription = document.querySelector('.col-xl-8 .text-center b');
                            var rainIcon = document.querySelector('.col-2 i');

                            if (latestRainPercentage > 50) {
                                rainDescription.innerText = "Hujan Lebat";
                                rainIcon.className = "fas fa-cloud-showers-heavy";
                            } else if (latestRainPercentage > 25) {
                                rainDescription.innerText = "Hujan Sedang";
                                rainIcon.className = "fas fa-cloud-rain";
                            } else {
                                rainDescription.innerText = "Hujan Ringan";
                                rainIcon.className = "fas fa-cloud-sun-rain";
                            }
                        }

                        setTimeout(updateRainCard, 5000);
                    },
                    error: function(xhr, status, error) {
                        setTimeout(updateRainCard, 5000);
                    }
                });
            }
            updateRainCard();
        });
    </script>

    <!-- Bar Light -->

    <script>
        function updateLightCard() {
            $.ajax({
                url: "{{ route('sensor-logs.get.value') }}",
                method: 'GET',
                data: {
                    code: "LHT_001",
                    type: "LIGHT"
                },
                success: function(data) {
                    if (data.data && data.data.length > 0) {
                        var latestLightPercentage = data.data[data.data.length - 1].value;
                        var progressBar = document.querySelector('#lightBar');
                        progressBar.style.width = latestLightPercentage + "%";
                        progressBar.setAttribute('aria-valuenow', latestLightPercentage);
                        document.querySelector('#lightIndicator b').innerText = latestLightPercentage + "%";

                        // Add conditional statements for rain description
                        // var rainDescription = document.querySelector('.col-xl-8 .text-center b');
                        // var rainIcon = document.querySelector('.col-2 i');

                        // if (latestRainPercentage > 50) {
                        //     rainDescription.innerText = "Hujan Lebat";
                        //     rainIcon.className = "fas fa-cloud-showers-heavy";
                        // } else if (latestRainPercentage > 25) {
                        //     rainDescription.innerText = "Hujan Sedang";
                        //     rainIcon.className = "fas fa-cloud-rain";
                        // } else {
                        //     rainDescription.innerText = "Hujan Ringan";
                        //     rainIcon.className = "fas fa-cloud-sun-rain";
                        // }
                    }

                    setTimeout(updateLightCard, 5000);
                },
                error: function(error) {
                    console.error('Gagal memperbarui data cahaya:', error);
                    setTimeout(updateLightCard, 5000);
                }
            });
        }
        updateLightCard();
    </script>
@endpush
