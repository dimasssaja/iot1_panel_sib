@extends('layouts.main')

@section('title_menu', 'Temperatures')

@section('content')
<div id="container"></div>
@endsection

@push('scripts')
<script src="https://unpkg.com/mqtt/dist/mqtt.min.js"></script>
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
       // setTimeout(requestData, 5000);
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

    const protocol = 'wss'
            const host = 'efeeee8f.ala.us-east-1.emqxsl.com'
            const port = '8084'
            const url = `${protocol}://${host}:${port}/mqtt`

            const username = 'dimas'
            const password = 'dimas'
            const clientId =  `mqtt_${Math.random().toString(16).slice(3)}`;

            const options = {
                clientId,
                clean: true,
                connectTimeout: 4000,
                username,
                password,
                reconnectPeriod: 1000,
                ca: `-----BEGIN CERTIFICATE-----
MIIDrzCCApegAwIBAgIQCDvgVpBCRrGhdWrJWZHHSjANBgkqhkiG9w0BAQUFADBh
MQswCQYDVQQGEwJVUzEVMBMGA1UEChMMRGlnaUNlcnQgSW5jMRkwFwYDVQQLExB3
d3cuZGlnaWNlcnQuY29tMSAwHgYDVQQDExdEaWdpQ2VydCBHbG9iYWwgUm9vdCBD
QTAeFw0wNjExMTAwMDAwMDBaFw0zMTExMTAwMDAwMDBaMGExCzAJBgNVBAYTAlVT
MRUwEwYDVQQKEwxEaWdpQ2VydCBJbmMxGTAXBgNVBAsTEHd3dy5kaWdpY2VydC5j
b20xIDAeBgNVBAMTF0RpZ2lDZXJ0IEdsb2JhbCBSb290IENBMIIBIjANBgkqhkiG
9w0BAQEFAAOCAQ8AMIIBCgKCAQEA4jvhEXLeqKTTo1eqUKKPC3eQyaKl7hLOllsB
CSDMAZOnTjC3U/dDxGkAV53ijSLdhwZAAIEJzs4bg7/fzTtxRuLWZscFs3YnFo97
nh6Vfe63SKMI2tavegw5BmV/Sl0fvBf4q77uKNd0f3p4mVmFaG5cIzJLv07A6Fpt
43C/dxC//AH2hdmoRBBYMql1GNXRor5H4idq9Joz+EkIYIvUX7Q6hL+hqkpMfT7P
T19sdl6gSzeRntwi5m3OFBqOasv+zbMUZBfHWymeMr/y7vrTC0LUq7dBMtoM1O/4
gdW7jVg/tRvoSSiicNoxBN33shbyTApOB6jtSj1etX+jkMOvJwIDAQABo2MwYTAO
BgNVHQ8BAf8EBAMCAYYwDwYDVR0TAQH/BAUwAwEB/zAdBgNVHQ4EFgQUA95QNVbR
TLtm8KPiGxvDl7I90VUwHwYDVR0jBBgwFoAUA95QNVbRTLtm8KPiGxvDl7I90VUw
DQYJKoZIhvcNAQEFBQADggEBAMucN6pIExIK+t1EnE9SsPTfrgT1eXkIoyQY/Esr
hMAtudXH/vTBH1jLuG2cenTnmCmrEbXjcKChzUyImZOMkXDiqw8cvpOp/2PV5Adg
06O/nVsJ8dWO41P0jmP6P6fbtGbfYmbW0W5BjfIttep3Sp+dWOIrWcBAI+0tKIJF
PnlUkiaY4IBIqDfv8NZ5YBberOgOzW6sRBc4L0na4UU+Krk2U886UAb3LujEV0ls
YSEY1QSteDwsOoBrp+uvFRTp2InBuThs4pFsiv9kuXclVzDAGySj4dzp30d8tbQk
CAUw7C29C79Fv1C5qfPrmAESrciIxpg0X40KPMbp1ZWVbd4=
-----END CERTIFICATE-----`,
            }
            const client = mqtt.connect(url, options)

            const topic = 'temperatures'

            client.on('connect', () => {
                console.log('Connected')

                client.subscribe([topic], () => {
                    console.log(`Subscribe to topic '${topic}'`)
                })
            })

            client.on('message', (topic, payload) => {
                console.log('Received Message:', topic, payload.toString())

                // jika data yang diterima adalah data temperatures maka request data
                if (topic === 'temperatures') {
                    requestData();
                }

            })
});
</script>
@endpush
