@extends('admin.master')

@section('judul')
Data User
@endsection

@section('content')



<!-- Button to Open the Modal -->
<section class="mb-5">
    <div class="pt-3">
        <button id="btnTambah" type="button" class="btn btn-primary btn box-tools pull-left" data-toggle="modal" data-target="#modalTambahUser">
            <i class="fa fa-plus-circle" aria-hidden="true"></i>
        </button>
        <div class="pull-right">
            <input id="caridata" type="text" class="form-control" name='caridata' onkeyup="showData()" />
        </div>
        <label class="pull-right mt-2"> Cari &nbsp;</label>
    </div>
</section>

<div id="tabelDisini">

</div>

<!--Srart Modal -->
<div class="modal fade" id="modalTambahUser">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Data User</h6>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <form method="post" id="insertform" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="alert alert-danger" style="display:none"></div>
                    <div class="alert alert-success" style="display:none"></div>
                    <input type="hidden" id="oldkdUser" name="oldkdUser">
                    <input value="{{auth()->user()->username}}" hidden id="user" name="user">
                    <div class="form-group">
                        <label>User Name </label>
                        <input type="text" class="form-control" placeholder="Username" id="username" name="username">
                    </div>
                    <div class="form-group">
                        <label>email</label>
                        <input type="email" class="form-control" placeholder="Email" id="email" name="email">
                    </div>

                    <div class="form-group">
                        <label>Hak Akses</label>
                        <select class="form-control" id="hakAkses" name="hakAkses">
                            <option value="admin">Admin</option>
                            <option value="pimpinan">Pimpinan</option>
                            <option value="unit">Unit</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Alamat </label>
                        <textarea class="form-control" rows="3" id="alamat" name="alamat"></textarea>
                    </div>

                    <div class="form-group">
                        <label>No. Hp</label>
                        <input type="text" class="form-control" placeholder="noHp" id="noHp" name="noHp">
                    </div>

                    <div class="form-group">
                        <label for="password">{{ __('Password') }}</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password-confirm">{{ __('Confirm Password') }}</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>

                    <div class="text-right">
                        <!-- <input id="btnSimpan" class="btn btn-primary" type="submit">Simpan <i id="iconbtn" class="fa fa-floppy-o" aria-hidden="true"></i></inp> -->
                        <button name="btnSimpan" id="btnSimpan" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- EndModal -->

<!--Srart Modal -->
<div class="modal fade" id="modalEditUser">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Data User</h6>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form method="post" id="editform" enctype="multipart/form-data">
                <div class="modal-body" id="wadahModalEdit">

                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('/css/bootstrap-datepicker.min.css')}}">
@endsection


@section('script')
<script src="{{ asset('/js/tampilan/fileinput.js') }}"></script>
<script src="{{ asset('/js/bootstrap-datepicker.min.js') }}"></script>
<script type="text/javascript">
    $(function() {
        $(".datepicker").datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayHighlight: true,
        });
    });
</script>
<script src="{{ asset('js/handlebars.js') }}"></script>

<script>
    function showData() {
        var user = $("#user").val();
        var caridata = $("#caridata").val();

        $.ajax({
            type: 'GET',
            url: '/admin/user/showUser',
            data: {
                user: user,
                caridata: caridata,
            },
            success: function(response) {

                $("#tabelDisini").html(response.html);
            },
            error: function(response) {
                alert('gagal \n' + response.responseText);
            }
        });
    }

    function showEditData(user) {

        $.ajax({
            type: 'GET',
            url: '/admin/user/showEditUser',
            data: {
                user: user,
            },
            success: function(response) {

                $("#wadahModalEdit").html(response.html);
            },
            error: function(response) {
                alert('gagal \n' + response.responseText);
            }
        });
    }

    $('#insertform').on('submit', function(event) {
        event.preventDefault();
        $.ajax({
            method: 'post',
            url: '/admin/user/insertUser',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                $('#modalTambahUser').modal('toggle');
                Swal.fire({
                    type: 'success',
                    title: 'User berhasil di buat',
                    showConfirmButton: false,
                    timer: 1500
                })
                showData();
            }
        });
    });

    $('#editform').on('submit', function(event) {
        event.preventDefault();
        $.ajax({
            method: 'post',
            url: '/admin/user/editUser',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                $('#modalEditUser').modal('toggle');
                Swal.fire({
                    type: 'success',
                    title: 'User berhasil di edit',
                    showConfirmButton: false,
                    timer: 1500
                })
                showData();
            }
        });
    });

    function deleteData(id) {
        Swal.fire({
            title: 'Anda yakin?',
            text: "data ini akan di hapus!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus saja!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: 'DELETE',
                    url: '/admin/user/deleteUser',
                    data: {
                        id: id,
                    },
                    success: function(response) {

                        Swal.fire(
                            'Deleted!',
                            'Data berhasil di hapus',
                            'success'
                        )
                        showData();
                    },
                    error: function(response) {
                        alert('gagal \n' + response.responseText);
                    }
                });
            }
        })
    }

    $(window).on("load", function() {
        showData();
    });
</script>
@endsection
