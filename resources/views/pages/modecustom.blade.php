@extends('layouts.main')

@section('title_menu', 'Kustomisasi Lampu')

@php
    $daysOfWeek = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
@endphp

@section('content')
    <div>
        <form id="updateCustomize">
            <input type="hidden" name="lamp_type" value="{{ $lamp->lamp_type }}">
            <input type="hidden" name="mode" value="{{ $lamp->mode }}">
            <input type="hidden" name="name" value="{{ $lamp->name }}">
            @method('PUT')
            @csrf
            <div class="row">
                <div class="col-12 mb-3">
                    <div class="card">
                        <div class="card-body">
                            Jenis Lampu : <b>{{ $lamp->lamp_type }}</b>
                        </div>
                    </div>
                </div>
                @foreach ($daysOfWeek as $key => $day)
                    <div class="col-12 mb-3">
                        <div class="card shadow">
                            <div class="card-header">
                                <b>{{ $day }}: </b>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="modeLampu" class="text-primary">Mode Lampu</label> <br>
                                    <div class="radio-button-mode">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio"
                                                name="custom_mode_lampu{{ $key }}" id="optionManual" value="MANUAL"
                                                checked>
                                            <label class="form-check-label" for="option1">Manual</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio"
                                                name="custom_mode_lampu{{ $key }}" id="optionLightSensor"
                                                value="LIGHT_SENSOR">
                                            <label class="form-check-label" for="option2">Sensor Cahaya</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio"
                                                name="custom_mode_lampu{{ $key }}" id="optionSchedule"
                                                value="SCHEDULE">
                                            <label class="form-check-label" for="optionSchedule">Schedule</label>
                                        </div>
                                    </div>
                                    <div class="form-group mt-2" id="customScheduleForm{{ $key }}"
                                        style="display:none;">
                                        <label for="waktuMulai" class="text-primary">Waktu Nyala</label>
                                        <input type="time" class="form-control" id="waktuMulai{{ $key }}"
                                            name="waktuMulai{{ $key }}">

                                        <label for="waktuSelesai" class="text-primary mt-2">Waktu Mati</label>
                                        <input type="time" class="form-control" id="waktuSelesai{{ $key }}"
                                            name="waktuSelesai{{ $key }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="">
                <button type="submit" class="btn btn-primary btn-lg">Simpan</button>
            </div>
        </form>
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#updateCustomize').on('submit', function(e) {
            e.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                type: 'POST',
                url: "{{ route('lamps.update.customize', ['code' => $lamp->code]) }}",
                data: formData,
                success: function(data) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Sukses!',
                        text: 'Kustom mode lampu berhasil'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = '/saklar';
                        }
                    });
                },
                error: function(error) {
                    if (xhr.responseJSON && xhr.responseJSON.data) {
                        errorMessage = xhr.responseJSON.data;
                    }

                    Swal.fire({
                        icon: 'error',
                        title: 'Tambah Saklar Gagal',
                        text: errorMessage,
                    });
                }
            });
        });
    });
</script>
@push('scripts')
    <script>
        $(document).ready(function() {
            @foreach ($daysOfWeek as $key => $day)
                var customModeValue{{ $key }} = '{{ $lamp->data_json->days[$key]->mode ?? '' }}';
                var radioInput{{ $key }} = $('input[name="custom_mode_lampu{{ $key }}"]');
                var scheduleForm{{ $key }} = $('#customScheduleForm{{ $key }}');
                var waktuMulai{{ $key }} = $('#waktuMulai{{ $key }}');
                var waktuSelesai{{ $key }} = $('#waktuSelesai{{ $key }}');

                if (customModeValue{{ $key }} !== "") {
                    radioInput{{ $key }}.filter('[value="' + customModeValue{{ $key }} + '"]')
                        .prop('checked', true);

                    if (customModeValue{{ $key }} === 'SCHEDULE') {
                        scheduleForm{{ $key }}.show();
                        waktuMulai{{ $key }}.val(
                            '{{ $lamp->data_json->days[$key]->schedule->on ?? '' }}');
                        waktuSelesai{{ $key }}.val(
                            '{{ $lamp->data_json->days[$key]->schedule->off ?? '' }}');
                    }
                }

                radioInput{{ $key }}.change(function() {
                    var customModeValue{{ $key }} = $(this).val();

                    if (customModeValue{{ $key }} === 'SCHEDULE') {
                        scheduleForm{{ $key }}.show();
                    } else {
                        scheduleForm{{ $key }}.hide();
                    }
                });
            @endforeach
        });
    </script>
@endpush
