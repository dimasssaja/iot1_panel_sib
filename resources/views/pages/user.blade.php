@extends('layouts.main')

@section('title_menu', 'User')

@section('button')
    <button class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#tambahUser"><i
            class="fas fa-plus fa-sm text-white-50"></i>
        Tambah User</button>
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
            <h6 class="m-0 font-weight-bold text-primary">Daftar User</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="userTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Tambah -->
    <div class="modal fade" id="tambahUser" tabindex="-1" aria-labelledby="tambahUser" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h5 class="modal-title text-primary" id="exampleModalLabel"><b>Tambah User</b></h5>
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
                            <label for="email" class="text-primary">Email</label><span class="text-danger ms-1">*</span>
                            <input type="email" name="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="password" class="text-primary">Password</label><span
                                class="text-danger ms-1">*</span>
                            <input type="password" name="password" class="form-control">
                            <span style="font-size: 12px;">min. 8 karakter</span>
                        </div>
                        <div class="form-group">
                            <label for="email" class="text-primary">Konfirmasi Password</label><span
                                class="text-danger ms-1">*</span>
                            <input type="password" name="password_confirmation" class="form-control">
                            <span style="font-size: 12px;">masukkan password yang sama</span>
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
    @foreach ($user as $item)
        <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" aria-labelledby="editModal"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <h5 class="modal-title text-primary" id="exampleModalLabel"><b>Edit User</b></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" class="formEdit">
                        @csrf
                        {{-- @method('PUT') --}}
                        <input type="number" name="id" value="{{ $item->id }}" hidden>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="namaSaklar" class="text-primary">Nama</label><span
                                    class="text-danger ms-1">*</span>
                                <input type="text" name="name" class="form-control" value="{{ $item->name }}">
                            </div>
                            <div class="form-group">
                                <label for="email" class="text-primary">Email</label><span
                                    class="text-danger ms-1">*</span>
                                <input type="email" name="email" class="form-control" value="{{ $item->email }}">
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-primary">Password</label>
                                <input type="password" name="password" class="form-control">
                                <span style="font-size: 12px;">kosongkan jika tidak ingin mengganti password</span>
                            </div>
                            <div class="form-group">
                                <label for="email" class="text-primary">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation" class="form-control">
                                <span style="font-size: 12px;">kosongkan jika tidak ingin mengganti password</span>
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

    <!-- Modal Detail -->
    @foreach ($user as $item)
        <div class="modal fade" id="viewModal{{ $item->id }}" tabindex="-1" aria-labelledby="viewModal"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <h5 class="modal-title text-primary" id="exampleModalLabel"><b>Detail User</b></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    {{-- <form method="POST">
                    @csrf
                    @method('PUT') --}}
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="namaSaklar" class="text-primary">Nama</label><span
                                class="text-danger ms-1">*</span>
                            <input type="text" name="name" class="form-control" value="{{ $item->name }}"
                                disabled>
                        </div>
                        <div class="form-group">
                            <label for="email" class="text-primary">Email</label><span
                                class="text-danger ms-1">*</span>
                            <input type="email" name="email" class="form-control" value="{{ $item->email }}"
                                disabled>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                    {{-- </form> --}}
                </div>
            </div>
        </div>
    @endforeach

    @foreach ($user as $item)
        <div class="modal" id="deleteModal{{ $item->id }}" tabindex="-1">
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
                $('#userTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: '{{ route('users.get') }}',
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
                            data: 'email',
                            name: 'email'
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
                        url: "{{ route('users.store') }}",
                        data: formData,
                        success: function(data) {
                            $('#tambahUser').modal('hide');
                            Swal.fire({
                                icon: 'success',
                                title: 'Sukses!',
                                text: 'Data user berhasil ditambah.'
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
                    var id = $(this).find('input[name=id]').val();
                    $.ajax({
                        type: 'PUT',
                        url: `api/v1/users/${id}`,
                        data: formData,
                        success: function(data) {
                            $(`#editModal${id}`).modal('hide');
                            Swal.fire({
                                icon: 'success',
                                title: 'Sukses!',
                                text: 'Data user berhasil diupdate.'
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
            function hapusData(userId) {
                $.ajax({
                    type: "DELETE",
                    url: "{{ route('users.delete') }}",
                    data: {
                        id: userId,
                    },
                    success: function(response) {
                        $('#deleteModal{{ $item->id }}').modal('hide');
                        Swal.fire({
                            icon: 'success',
                            title: 'Sukses!',
                            text: 'Data user berhasil dihapus.'
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
