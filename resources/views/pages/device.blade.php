@extends('layouts.main')

@section('title_menu', 'Devices')

@section('button')
    <button class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal"
        data-target="#tambahDevice"><i class="fas fa-plus fa-sm text-white-50"></i>
        Tambah Device</button>
@endsection

@section('style')

    <link href="{{ url('https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ url('https://cdn.datatables.net/responsive/2.2.5/css/responsive.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
@endsection

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Device</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="deviceTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Kode</th>
                            <th>Last Ping</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Tambah -->
    <div class="modal fade" id="tambahDevice" tabindex="-1" aria-labelledby="tambahDevice" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h5 class="modal-title text-primary" id="exampleModalLabel"><b>Tambah Device</b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" id="formTambah">
                    @csrf

                    <div class="modal-body">
                        <div class="form-group">
                            <label for="namaSaklar" class="text-primary">Nama</label><span class="text-danger ms-1">*</span>
                            <input type="text" name="name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="code" class="text-primary">Kode</label><span class="text-danger ms-1">*</span>
                            <input type="text" name="code" class="form-control">
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

    <!-- Modal Edit -->
    @foreach ($device as $item)
        <div class="modal fade" id="editDevice{{ $item->code }}" tabindex="-1" aria-labelledby="editDevice"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <h5 class="modal-title text-primary" id="exampleModalLabel"><b>Edit Device</b></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" class="formEdit">
                        @csrf
                        @method('PUT')
                        <input type="text" name="code" value="{{ $item->code }}" hidden>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="namaSaklar" class="text-primary">Nama</label><span
                                    class="text-danger ms-1">*</span>
                                <input type="text" name="name" class="form-control" value="{{ $item->name }}">
                            </div>
                            <div class="form-group">
                                <label for="code" class="text-primary">Kode</label><span
                                    class="text-danger ms-1">*</span>
                                <input type="text" name="code" class="form-control" readonly
                                    value="{{ $item->code }}">
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

    @foreach ($device as $item)
        <div class="modal" id="deleteDevice{{ $item->id }}" tabindex="-1">
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
                        <button type="button" onclick="hapusData({{ $item->id }})"
                            class="btn btn-primary">Hapus</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach



    @push('scripts')
        <script src="{{ url('https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ url('https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ url('https://cdn.datatables.net/responsive/2.2.5/js/dataTables.responsive.min.js') }}"></script>
        <script src="{{ url('https://cdn.datatables.net/responsive/2.2.5/js/responsive.bootstrap4.min.js') }}"></script>
        <script>
            $(document).ready(function() {
                $('#deviceTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: '{{ route('devices.get.json') }}',
                        type: 'GET',
                    },
                    columns: [{
                            data: null,
                            render: function(data, type, full, meta) {
                                var iterationNumber = meta.row + meta.settings._iDisplayStart + 1;
                                return iterationNumber;
                            }
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'code',
                            name: 'code'
                        },
                        {
                            data: 'last_ping',
                            name: 'last_ping'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        }
                    ],
                    order: [
                        [0, 'asc']
                    ],
                    responsive: true
                });
            });
        </script>
        <script>
            $(document).ready(function() {
                $('#formTambah').submit(function(e) {
                    e.preventDefault();
                    var formData = $(this).serialize();
                    $.ajax({
                        type: 'POST',
                        url: "{{ route('devices.store') }}",
                        data: formData,
                        success: function(data) {
                            $('#tambahDevice').modal('hide');
                            Swal.fire({
                                icon: 'success',
                                title: 'Sukses!',
                                text: 'Data device berhasil ditambah.'
                            }).then((result) => {
                                window.location.reload();
                        });
                        },
                        error: function(error) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Warning',
                                text: error.responseJSON.message
                            })
                        }
                    });
                });
            });
        </script>

        <script>
            $(document).ready(function() {
                $('.formEdit').submit(function(e) {
                    e.preventDefault();
                    var formData = $(this).serialize();
                    var code = $(this).find('input[name=code]').val();

                    // Check if code is null or empty, provide a default value if needed
                    code = code || 'defaultCode';

                    $.ajax({
                        type: 'PUT',
                        url: "{{ route('devices.update', ['code' => 'codePlaceholder']) }}".replace(
                            'codePlaceholder', code),
                        data: formData,
                        success: function(data) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Sukses!',
                                text: 'Data device berhasil diupdate.'
                            }).then((result) => {
                                // This code will be executed after the user clicks the "OK" button on the first Swal alert
                                if ($('#deviceTable').length) {
                                    // Additional actions or another Swal alert can be added here

                                    window.location.reload();
                                }
                            });
                        },
                        error: function(error) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Warning',
                                text: error.responseJSON ? error.responseJSON.message :
                                    'Error occurred.'
                            })
                        }
                    });
                });
            });
        </script>


        <script>
            function hapusData(code) {
                $.ajax({
                    type: "DELETE",
                    url: "{{ route('devices.delete', $item->code) }}",
                    data: {
                        id: code,
                    },
                    success: function(response) {
                        $('#deleteDevice{{ $item->code }}').modal('hide');
                        Swal.fire({
                            icon: 'success',
                            title: 'Sukses!',
                            text: 'Data device berhasil dihapus.'
                        }).then((result) => {
                            window.location.reload();
                        });
                    },
                    error: function(error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Warning',
                            text: error.responseJSON.message
                        })
                    }
                })
            }
        </script>
    @endpush
@endsection
