@extends('layouts.main')

@section('title_menu', 'Saklar')
@section('button')
    <button class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#tambah"><i
            class="fas fa-plus fa-sm text-white-50"></i>
        Tambah Saklar</button>
@endsection

@section('content')
    <div class="row">
        @foreach ($lamps as $key => $item)
            @if ($item->mode !== 'CUSTOM')
                <div class="modal" id="delete{{ $item->code }}" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title text-danger"><b>Warning</b></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>Yakin mau apus?</p>
                                <form method="POST" id="formDelete">
                                    @csrf
                                    @method('DELETE')
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Hapus</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="card-sm shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between">
                            <div class="d-flex gap-3">
                                <i class="far fa-lightbulb"></i>
                                <h6 class="m-0 font-weight-bold ml-2">{{ $item->name }}</h6>
                            </div>
                            <div class="dropdown no-arrow">
                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                    aria-labelledby="dropdownMenuLink">
                                    <div class="dropdown-header">Action:</div>
                                    <a class="dropdown-item" data-toggle="modal"
                                        data-target="#edit{{ $item->code }}">Edit</a>
                                    <a class="dropdown-item" data-toggle="modal"
                                        data-target="#delete{{ $item->code }}">Delete</a>
                                </div>
                            </div>
                        </div>
                        @include('components.saklarcomponent')
                    </div>
                </div>
            @endif
            @if ($item->mode === 'CUSTOM')
                <div class="modal" id="delete{{ $item->code }}" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title text-danger"><b>Warning</b></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>Yakin mau apus?</p>
                                <form method="POST" id="formDelete">
                                    @csrf
                                    @method('DELETE')
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Hapus</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4">
                    <div class="card-sm shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between">
                            <div class="d-flex gap-3">
                                <i class="far fa-lightbulb"></i>
                                <h6 class="m-0 font-weight-bold ml-2">{{ $item->name }}</h6>
                            </div>
                            <div class="dropdown no-arrow">
                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                    aria-labelledby="dropdownMenuLink">
                                    <div class="dropdown-header">Action:</div>
                                    <a class="dropdown-item" data-toggle="modal"
                                        data-target="#edit{{ $item->code }}">Edit</a>
                                    <a class="dropdown-item" data-toggle="modal"
                                        data-target="#delete{{ $item->code }}">Delete</a>
                                </div>
                            </div>
                        </div>

                        @include('components.customcomponent')


                    </div>
                </div>
            @endif
        @endforeach
    </div>

    <!-- Modal Tambah Saklar-->
    <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="tambahSaklar" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h5 class="modal-title text-primary" id="exampleModalLabel"><b>Tambah Saklar</b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" id="formTambah">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="namaSaklar" class="text-primary">Nama Saklar</label>
                            <input type="text" class="form-control" id="namaSaklar" name="name"
                                aria-describedby="saklarHelp">
                        </div>
                        <div class="form-group">
                            <label for="kode" class="text-primary">Kode</label>
                            <input type="text" class="form-control" name="code">
                            <span style="font-size: 12px;">Kode Saklar tidak dapat diubah</span>
                        </div>
                        <div class="form-group">
                            <label for="pin" class="text-primary">PIN</label>
                            <input type="text" class="form-control" name="pin">
                        </div>
                        <div class="form-group">
                            <label for="modeLampu" class="text-primary">Jenis Lampu</label> <br>
                            <div class="radio-button-mode">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="lamp_type" id="option1"
                                        value="SWITCH">
                                    <label class="form-check-label" for="option1">Switch</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="lamp_type" id="option2"
                                        value="RGB">
                                    <label class="form-check-label" for="option2">RGB</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="lamp_type" id="option3"
                                        value="DIMMABLE">
                                    <label class="form-check-label" for="option3">Dimmable</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="modeLampu" class="text-primary">Mode Lampu</label> <br>
                            <div class="radio-button-mode">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="mode" id="option1"
                                        value="MANUAL">
                                    <label class="form-check-label" for="option1">Manual</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="mode" id="option2"
                                        value="LIGHT_SENSOR">
                                    <label class="form-check-label" for="option2">Sensor Cahaya</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="mode" id="optionSchedule"
                                        value="SCHEDULE">
                                    <label class="form-check-label" for="optionSchedule">Schedule</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="mode" id="option4"
                                        value="CUSTOM">
                                    <label class="form-check-label" for="option3">Custom</label>
                                </div>
                            </div>
                            <div class="form-group mt-2" id="tambahScheduleForm" style="display:none;">
                                <label for="waktuMulai" class="text-primary">Waktu Nyala</label>
                                <input type="time" class="form-control" id="waktuMulai" name="waktuMulai">

                                <label for="waktuSelesai" class="text-primary mt-2">Waktu Mati</label>
                                <input type="time" class="form-control" id="waktuSelesai" name="waktuSelesai">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit Saklar-->
    @foreach ($lamps as $item)
        <div class="modal fade" id="edit{{ $item->code }}" tabindex="-1" aria-labelledby="editSaklar"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <h5 class="modal-title text-primary" id="exampleModalLabel"><b>Edit Saklar</b></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="formEdit" method="POST" action="{{ route('lamps.update', $item->code) }}">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="namaSaklar" class="text-primary">Nama Saklar</label>
                                <input type="text" class="form-control" id="namaSaklar" value="{{ $item->name }}"
                                    name="name" aria-describedby="saklarHelp">
                            </div>
                            <div class="form-group">
                                <label for="kode" class="text-primary">Kode</label>
                                <input type="text" class="form-control" name="edit_code" id="kodeSaklar"
                                    value="{{ $item->code }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="pin" class="text-primary">PIN</label>
                                <input type="text" class="form-control" name="pin" value="{{ $item->pin }}">
                            </div>
                            <div class="form-group">
                                <label for="jenisLampu" class="text-primary">Jenis Lampu</label> <br>
                                <div class="radio-button-mode">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="lamp_type" id="option1"
                                            value="SWITCH" {{ $item->lamp_type === 'SWITCH' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="option1">Switch</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="lamp_type" id="option2"
                                            value="RGB" {{ $item->lamp_type === 'RGB' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="option2">RGB</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="lamp_type" id="option3"
                                            value="DIMMABLE" {{ $item->lamp_type === 'DIMMABLE' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="option3">Dimmable</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="modeLampu" class="text-primary">Mode Lampu</label> <br>
                                <div class="radio-button-mode">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio"
                                            name="edit_mode_lampu{{ $item->code }}" id="option1" value="MANUAL"
                                            {{ $item->mode === 'MANUAL' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="option1">Manual</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio"
                                            name="edit_mode_lampu{{ $item->code }}" id="option2"
                                            value="LIGHT_SENSOR" {{ $item->mode === 'LIGHT_SENSOR' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="option2">Sensor Cahaya</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio"
                                            name="edit_mode_lampu{{ $item->code }}"
                                            id="edit_mode_lampu{{ $item->code }}" data-code="{{ $item->code }}"
                                            value="SCHEDULE" {{ $item->mode === 'SCHEDULE' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="optionSchedule">Schedule</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio"
                                            name="edit_mode_lampu{{ $item->code }}" id="option4" value="CUSTOM"
                                            {{ $item->mode === 'CUSTOM' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="option4">Custom</label>
                                    </div>
                                </div>
                                <div class="form-group mt-2" id="editScheduleForm{{ $item->code }}"
                                    style="{{ $item->mode === 'SCHEDULE' ? '' : 'display: none;' }}"">
                                    <label for="waktuMulai" class="text-primary mt-2">Waktu Nyala</label>
                                    <input type="time" class="form-control" id="waktuMulai" name="waktuMulai"
                                        value="{{ $item->mode === 'SCHEDULE' ? $item->data_json->schedule->on : '' }}">

                                    <label for="waktuSelesai" class="text-primary mt-2">Waktu Mati</label>
                                    <input type="time" class="form-control" id="waktuSelesai" name="waktuSelesai"
                                        value="{{ $item->mode === 'SCHEDULE' ? $item->data_json->schedule->off : '' }}">
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    @push('scripts')
        <script>
            $(document).ready(function() {

                @foreach ($lamps as $item)
                    $('#edit{{ $item->code }} #formEdit').submit(function(e) {
                        e.preventDefault();
                        var formData = $(this).serialize();

                        $.ajax({
                            type: 'PUT',
                            url: $(this).attr('action'),
                            data: formData,
                            success: function(data) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Sukses!',
                                    text: 'Data saklar berhasil diedit.'
                                }).then(() => {
                                    window.location.replace('/saklar');
                                });
                            },
                            error: function(xhr, status, error) {
                                console.error('Kesalahan:', error);
                            }
                        });
                    });
                @endforeach
            });
        </script>
    @endpush


    <!-- jQuery dari CDN -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"
        integrity="sha256-oP6HI/tf1FqSEDqokD6RJ8RB4Vp3zZOu1+O8/pEjByw=" crossorigin="anonymous"></script>

    <!--Tambah Saklar -->
    <script>
        $(document).ready(function() {
            $('#formTambah').submit(function(e) {
                e.preventDefault();
                var formData = $(this).serialize();
                $.ajax({
                    type: 'POST',
                    url: '{{ route('lamps.store') }}',
                    data: formData,
                    success: function(data) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Sukses!',
                            text: 'Data saklar berhasil ditambah.'
                        }).then((result) => {
                            // This code will be executed after the user clicks the "OK" button on the first Swal alert
                            if (result.isConfirmed) {
                                // Additional actions or another Swal alert can be added here

                                location.reload();
                            }
                        });
                    },
                    error: function(xhr, status, error) {

                        if (xhr.responseJSON && xhr.responseJSON.data) {
                            errorMessage = xhr.responseJSON.data;
                        }

                        Swal.fire({
                            icon: 'error',
                            title: 'Tambah Saklar Gagal',
                            text: errorMessage,
                        });

                        // console.error('Error toggling status:', error);
                    }


                });
            });
        });
    </script>

    <!--Hapus Saklar -->
    <script>
        $(document).ready(function() {
            @foreach ($lamps as $item)
                $('#delete{{ $item->code }} #formDelete').submit(function(e) {
                    e.preventDefault(); // Prevent the default form submission

                    // You may not need the following line if the form doesn't have any inputs
                    // var formData = $(this).serialize(); // Serialize the form data

                    $.ajax({
                        type: 'DELETE',
                        url: "{{ route('lamps.delete', $item->code) }}",
                        // If you have form data, you can include it like this:
                        // data: formData,
                        success: function(data) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Sukses!',
                                text: 'Data saklar berhasil dihapus.'
                            }).then((result) => {
                                window.location.reload();
                            });
                        },
                        error: function(xhr, status, error) {
                            console.error('Kesalahan:', error);
                        }
                    });
                });
            @endforeach
        });
    </script>


    <!--Form Schedule Time (tambah) -->
    <script>
        $(document).ready(function() {
            $('input[name="mode"]').change(function() {
                if ($(this).val() === 'SCHEDULE') {
                    $('#tambahScheduleForm').show();
                } else {
                    $('#tambahScheduleForm').hide();
                }
            });
        });
    </script>

    <!--Form Schedule Time (edit) -->
    <script>
        $(document).ready(function() {
            @foreach ($lamps as $item)
                $('input[name="edit_mode_lampu{{ $item->code }}"]').change(function() {
                    var code = $(this).data('code');
                    var editScheduleForm = $('#editScheduleForm{{ $item->code }}');

                    if ($(this).val() === 'SCHEDULE') {
                        editScheduleForm.show();
                    } else {
                        editScheduleForm.hide();
                    }
                });
            @endforeach
        });
    </script>


    <!--DIMMABLE-->
    <script>
        $(document).ready(function() {
            // Mendengarkan perubahan pada input range
            $('#brightnessRange').on('input', function() {
                var brightnessValue = $(this).val();
                $.ajax({
                    type: 'POST',
                    url: 'url_anda_di_sini', // Ganti dengan URL yang sesuai di sisi server
                    data: {
                        brightness: brightnessValue
                    },
                    success: function(data) {
                        // Tindakan yang diambil jika permintaan berhasil
                        console.log('Berhasil:', data);
                    },
                    error: function(xhr, status, error) {
                        // Tindakan yang diambil jika terjadi kesalahan
                        console.error('Kesalahan:', error);
                    }
                });
            });
        });
    </script>
    <script>
        // Initialize the Bootstrap slider
        var brightnessSlider = new Slider('#brightnessRange', {
            tooltip: 'always', // Show tooltip always
            tooltip_position: 'bottom', // Set tooltip position
        });

        // Example: Update brightness value on slide
        brightnessSlider.on('slide', function(value) {
            // Add your code to handle the brightness change
            console.log('Brightness value:', value);
            // You may want to send this value to the server or use it in your application
        });
    </script>

    <!--SWITCH-->
    <script>
        $(document).ready(function() {
            // Use class selector since ID should be unique
            @foreach ($lamps as $items)
                var saklarSwitch = document.querySelector('.saklarSwitch');
                var switchery = new Switchery(saklarSwitch, {
                    color: '#039cfd'
                });

                // Add a click event listener to the switch
                saklarSwitch.addEventListener('change', function() {
                    // Get the current state of the switch (ON or OFF)
                    var isSwitchOn = this.checked;

                    // Check if $item is defined
                    if (typeof $item !== null) {
                        // Perform an AJAX request to toggle the lamp status
                        $.ajax({
                            type: 'POST',
                            url: "{{ route('lamps.toogle', $item->code) }}",
                            data: {
                                _token: "{{ csrf_token() }}",
                                status: isSwitchOn ? 1 : 0
                            },
                            success: function(response) {
                                // Update your UI or perform any other actions as needed
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Sukses!',
                                    text: 'Status Saklar Berubah'
                                }).then((result) => {
                                    // This code will be executed after the user clicks the "OK" button on the first Swal alert
                                    if (result.isConfirmed) {
                                        // Additional actions or another Swal alert can be added here
                                        location.reload();
                                    }
                                });
                            },
                            error: function(xhr, status, error) {
                                console.error('Error toggling status:', error);
                            }
                        });
                    } else {
                        console.error('Error: $item is undefined');
                        // Handle the error or provide a meaningful fallback
                    }
                });
            @endforeach
        });
    </script>

@endsection
