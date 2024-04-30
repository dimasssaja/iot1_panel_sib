@extends('layouts.main')

@section('title_menu', 'Temperatures')

@section('content')
<div id="container"></div>
@endsection

@push('scripts')
<script src="https://code.highcharts.com/highcharts.js"></script>

<script>
    let chart; // global

/**
 * Request data from the server, add it to the graph and set a timeout to request again
 */
async function requestData() {
    let baseUrl = '{{ url('') }}';
    let endpoint = 'api/v1/temperatures';

    const result = await fetch(`${baseUrl}/${endpoint}`);
    if (result.ok) {
        const data = await result.json();
        const temperatures=data.data;
        const firstTemperature = temperatures[0];

        const date = firstTemperature.created_at;
        const value = Number(firstTemperature.value);
        console.log(date,value);

        const point = [new Date(date).getTime(), value];
        const series = chart.series[0],
            shift = series.data.length > 20; // shift if the series is longer than 20

        // add the point
        chart.series[0].addPoint(point, true, shift);
        // call it again after one second
        setTimeout(requestData, 1000);
    }
}

window.addEventListener('load', function () {
    chart = new Highcharts.Chart({
        chart: {
            renderTo: 'container',
            defaultSeriesType: 'spline',
            events: {
                load: requestData
            }
        },
        title: {
            text: 'Monitoring Temperature'
        },
        xAxis: {
            type: 'datetime',
            tickPixelInterval: 150,
            maxZoom: 20 * 1000
        },
        yAxis: {
            minPadding: 0.2,
            maxPadding: 0.2,
            title: {
                text: 'Temperature (C)',
                margin: 80
            }
        },
        series: [{
            name: 'Temperature',
            data: []
        }]
    });
});
</script>
@endpush
