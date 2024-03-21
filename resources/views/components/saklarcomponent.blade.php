{{-- @section('body_saklar') --}}
@if ($item->mode == 'MANUAL' && $item->lamp_type == 'SWITCH')
    <div class="card-body">
        <div class="row justify-content-between px-3">
            <div class="">
                @if ($item->status == true)
                    <h4 class="text-success">ON</h4>
                @else
                    <h4 class="text-danger">OFF</h4>
                @endif
                <p style="font-size: 12px">Mode Lampu: Manual</p>
            </div>
            <div class="">
                <div class="form-check form-switch mt-3">
                    <form>
                        @csrf
                        <input id="saklarSwitch_{{ $item->code }}" type="checkbox"
                            {{ $item->status ? 'checked' : '' }} />
                    </form>
                </div>
            </div>
        </div>
    </div>
@endif

<!-- Manual Dimmable -->
@if ($item->mode == 'MANUAL' && $item->lamp_type == 'DIMMABLE')
    <div class="card-body">
        <div class="row justify-content-between px-3">
            @if ($item->status == true)
                <div class="">
                    <h4 class="text-success ">ON</h4>
                    <p style="font-size: 12px">Mode Lampu: Manual</p>
                </div>
            @else
                <div class="">
                    <h4 class="text-danger ">OFF</h4>
                    <p style="font-size: 12px">Mode Lampu: Manual</p>
                </div>
            @endif
            <div class="">
                <div class="form-check form-switch mt-3">
                    <form>
                        @csrf
                        <input id="saklarSwitch_{{ $item->code }}" type="checkbox"
                            {{ $item->status ? 'checked' : '' }} />
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <p class="mb-2">Atur Kecerahan</p>
        <p style="font-size: 12px">Jenis Lampu: Dimmable</p>
        <div class="row px-3 align-items-center mb-3">
            <div class="col-2">
                <i class="far fa-lightbulb"></i>
            </div>
            <div class="col-xl-8">
                {{-- <div class="progress mb-2"> --}}
                <form action="">
                    <input type="range" class="form-range w-100" id="brightnessRange" min="0" max="100">
                </form>
                {{-- </div> --}}
            </div>
            <div class="col-2">
                <i class="fas fa-lightbulb"></i>
            </div>
        </div>

    </div>
@endif
<!-- Manual RGB -->
@if ($item->mode == 'MANUAL' && $item->lamp_type == 'RGB')
    <div class="card-body" data-mode="{{ $item->mode }}" data-lamp-type="{{ $item->lamp_type }}">
        <div class="row justify-content-between px-3">
            @if ($item->status == true)
                <div class="">
                    <h4 class="text-success ">ON</h4>
                    <p style="font-size: 12px">Mode Lampu: Manual</p>
                </div>
            @else
                <div class="">
                    <h4 class="text-danger ">OFF</h4>
                    <p style="font-size: 12px">Mode Lampu: Manual</p>
                </div>
            @endif
            <div class="">
                <div class="form-check form-switch mt-3">
                    <form>
                        @csrf
                        <input id="saklarSwitch_{{ $item->code }}" type="checkbox"
                            {{ $item->status ? 'checked' : '' }} />
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <p class="mb-2">Pilih Warna</p>
        <p style="font-size: 12px">Jenis Lampu: RGB</p>
        <div class="row align-items-center mb-3">
            <div class="col-xl-8">
                <div class="color-picker-container">
                    <input class="color-picker" value='rgb(39, 108, 184)' />
                </div>
            </div>
        </div>
    </div>
@endif
<!-- Light Sensor Switcher -->
@if ($item->mode == 'LIGHT_SENSOR' && $item->lamp_type == 'SWITCH')
    {{-- <div class="card-body">
        <div class="row align-items-center">
            <div class="col-xl-2">
                <b id="lightIndicator">0%</b>
            </div>
            <div class="col-xl-8">
                <div class="text-center">
                    <b id="lightStatus"></b>
                </div>
                <div class="progress mb-2">
                    <div class="progress-bar bg-success" id="lightBar" role="progressbar" style="width: 25%"
                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
            <div class="col-2">
                <i class="far fa-lightbulb"></i>
            </div>
        </div>
        <p style="font-size: 12px">Mode Lampu: Light Sensor</p>
    </div> --}}
    <div class="card-footer">
        <div class="row justify-content-between px-3">
            @if ($item->status == true)
                <div class="">
                    <h4 class="text-success ">ON</h4>
                    <p style="font-size: 12px">Jenis Lampu: Switch</p>
                </div>
            @else
                <div class="">
                    <h4 class="text-danger ">OFF</h4>
                    <p style="font-size: 12px">Jenis Lampu: Switch</p>
                </div>
            @endif
            <div class="">
                <div class="form-check form-switch mt-3">
                    <form>
                        @csrf
                        <input id="saklarSwitch_{{ $item->code }}" type="checkbox"
                            {{ $item->status ? 'checked' : '' }} />
                    </form>
                </div>
            </div>
        </div>
    </div>
@endif
<!-- Light Sensor Dimmable -->
@if ($item->mode == 'LIGHT_SENSOR' && $item->lamp_type == 'DIMMABLE')
    <div class="card-body">
        <div class="row align-items-center">
            <div class="col-xl-2">
                <b id="lightIndicator">0%</b>
            </div>
            <div class="col-xl-8">
                <div class="text-center">
                    <b></b> <!-- Updated dynamically based on light conditions -->
                </div>
                <div class="progress mb-2">
                    <div class="progress-bar bg-success lightBar" id="" role="progressbar" style="width: 25%"
                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>

            </div>
            <div class="col-2">
                <i class="far fa-lightbulb"></i> <!-- You can use a lightbulb icon or customize as needed -->
            </div>
        </div>
        <p style="font-size: 12px">Mode Lampu: Light Sensor</p>
    </div>
    <div class="card-footer">
        <p class="mb-2">Atur Kecerahan</p>
        <p style="font-size: 12px">Jenis Lampu: Dimmable</p>
        <div class="row px-3 align-items-center mb-3">
            <div class="col-2">
                <i class="far fa-lightbulb"></i>
            </div>
            <div class="col-xl-8">
                {{-- <div class="progress mb-2"> --}}
                <form action="">
                    <input type="range" class="form-range w-100" id="brightnessRange" min="0" max="100">
                </form>
                {{-- </div> --}}
            </div>
            <div class="col-2">
                <i class="fas fa-lightbulb"></i>
            </div>
        </div>

    </div>
@endif
<!-- Light Sensor RGB -->
@if ($item->mode == 'LIGHT_SENSOR' && $item->lamp_type == 'RGB')
    <div class="card-body">
        <div class="row align-items-center">
            <div class="col-xl-2">
                <b id="lightIndicator">0%</b>
            </div>
            <div class="col-xl-8">
                <div class="text-center">
                    <b></b> <!-- Updated dynamically based on light conditions -->
                </div>
                <div class="progress mb-2">
                    <div class="progress-bar bg-success lightBar" id="" role="progressbar" style="width: 25%"
                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>

            </div>
            <div class="col-2">
                <i class="far fa-lightbulb"></i> <!-- You can use a lightbulb icon or customize as needed -->
            </div>
        </div>
        <p style="font-size: 12px">Mode Lampu: Light Sensor</p>
    </div>
    <div class="card-footer">
        <p class="mb-2">Pilih Warna</p>
        <p style="font-size: 12px">Jenis Lampu: RGB</p>
        <div class="row align-items-center mb-3">
            <div class="col-xl-8">
                <div class="color-picker-container">
                    <input class="color-picker" value='rgb(39, 108, 184)' />
                </div>
            </div>
        </div>
    </div>
@endif
<!-- Schedule Switcher -->
@php
    use Carbon\Carbon;
    setlocale(LC_TIME, 'id_ID');
    $now = Carbon::now();
    $dayName = $now->formatLocalized('%A');
@endphp
@if ($item->mode == 'SCHEDULE' && $item->lamp_type == 'SWITCH')

    <div class="card-body">
        <div class="row">
            <div>
                <h5><b>{{ $dayName }}, {{ $item->data_json->schedule->on }}
                        - {{ $item->data_json->schedule->off }}</b></h5>
                <p style="font-size: 12px">Mode Lampu: Schedule</p>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <div class="row justify-content-between align-items-center px-3">
            @if ($item->status == true)
                <div class="">
                    <h4 class="text-success ">ON</h4>
                    <p style="font-size: 12px">Jenis Lampu: Switch</p>
                </div>
            @else
                <div class="">
                    <h4 class="text-danger ">OFF</h4>
                    <p style="font-size: 12px">Jenis Lampu: Switch</p>
                </div>
            @endif
            <div class="">
                <div class="form-check form-switch mt-3">
                    <form>
                        @csrf
                        <input id="saklarSwitch_{{ $item->code }}" type="checkbox"
                            {{ $item->status ? 'checked' : '' }} />
                    </form>
                </div>
            </div>
        </div>
    </div>
@endif
<!-- Schedule Dimmable -->
@if ($item->mode == 'SCHEDULE' && $item->lamp_type == 'DIMMABLE')
    <div class="card-body">
        <div class="row">
            <div>
                <h5><b>{{ $dayName }}, {{ $item->data_json->schedule->on }}
                        - {{ $item->data_json->schedule->off }}</b></h5>
                <p style="font-size: 12px">Mode Lampu: Schedule</p>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <p class="mb-2">Atur Kecerahan</p>
        <p style="font-size: 12px">Jenis Lampu: Dimmable</p>
        <div class="row px-3 align-items-center mb-3">
            <div class="col-2">
                <i class="far fa-lightbulb"></i>
            </div>
            <div class="col-xl-8">
                {{-- <div class="progress mb-2"> --}}
                <form action="">
                    <input type="range" class="form-range w-100" id="brightnessRange" min="0"
                        max="100">
                </form>
                {{-- </div> --}}
            </div>
            <div class="col-2">
                <i class="fas fa-lightbulb"></i>
            </div>
        </div>

    </div>
@endif
<!-- Schedule RGB -->
@if ($item->mode == 'SCHEDULE' && $item->lamp_type == 'RGB')
    <div class="card-body" data-mode="{{ $item->mode }}" data-lamp-type="{{ $item->lamp_type }}">
        <div class="row">
            <div>
                <h5><b>{{ $dayName }}, {{ $item->data_json->schedule->on }}
                        - {{ $item->data_json->schedule->off }}</b></h5>
                <p style="font-size: 12px">Mode Lampu: Schedule</p>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <p class="mb-2">Pilih Warna</p>
        <div class="row align-items-center mb-3">
            <div class="col-xl-8">
                <div class="color-picker-container">
                    <input class="color-picker" value='rgb(39, 108, 184)' />
                </div>
            </div>
        </div>
    </div>
@endif


<script>
    $(document).ready(function() {
        // Initialize Spectrum for all color pickers with a common class
        $('.color-picker-container').each(function() {
            var mode = $(this).closest('.card-body').data('mode');
            var lampType = $(this).closest('.card-body').data('lamp-type');

            // Customize Spectrum options based on mode and lamp type
            var options = {
                type: "component",
                preferredFormat: "rgb",
                showInput: true,
                showAlpha: true,
                // Add more options as needed based on your requirements
            };

            // Initialize Spectrum for the current color picker container
            $(this).find('.color-picker').spectrum(options);
        });
    });
</script>

<script>
    $(document).ready(function() {
        var saklarSwitch = document.getElementById('saklarSwitch_{{ $item->code }}');

        if (saklarSwitch) {
            var switchery = new Switchery(saklarSwitch, {
                color: '#039cfd'
            });

            saklarSwitch.addEventListener('change', function() {
                var isSwitchOn = this.checked;

                $.ajax({
                    type: 'POST',
                    url: "{{ route('lamps.toogle', $item->code) }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        status: isSwitchOn ? 1 : 0
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Sukses!',
                            text: 'Status Saklar Berubah'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload();
                            }
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error('Error toggling status:', error);
                    }
                });
            });
        }
    });
</script>

<script>
    $(document).ready(function() {
        @if ($item->mode == 'LIGHT_SENSOR')
            function updateLightSensorCard() {
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
                            console.log(latestLightPercentage);
                            var progressBar = $(".lightBar");
                            progressBar.css("width", latestLightPercentage + "%");
                            progressBar.attr('aria-valuenow', latestLightPercentage);
                            $("#lightIndicator").text(latestLightPercentage + "%");

                            // Add conditional statements for light description
                            var lightPercentage = $(".col-xl-2 b");
                            var lightDescription = $(".col-xl-8 .text-center b");
                            var lightIcon = $(".col-2 i");
                            // var lightProgressBar = $("#lightBar .progress-bar .bg-success")

                            if (latestLightPercentage > 40) {
                                // lightProgressBar.css("width", latestLightPercentage + "%");
                                // lightProgressBar.attr('aria-valuenow', latestLightPercentage);
                                lightPercentage.text(latestLightPercentage + "%");
                                lightDescription.text("OFF");
                                lightIcon.attr("class", "fas fa-sun");
                            } else {
                                // lightProgressBar.css("width", latestLightPercentage + "%");
                                // lightProgressBar.attr('aria-valuenow', latestLightPercentage);
                                lightPercentage.text(latestLightPercentage + "%");
                                lightDescription.text("ON");
                                lightIcon.attr("class", "fas fa-moon");
                            }
                        }

                        setTimeout(updateLightSensorCard, 5000);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching light sensor data:');
                        console.log('XHR:', xhr);
                        console.log('Status:', status);
                        console.log('Error:', error);
                        setTimeout(updateLightSensorCard, 5000);
                    }
                });
            }

            updateLightSensorCard();
        @endif
    });
</script>
