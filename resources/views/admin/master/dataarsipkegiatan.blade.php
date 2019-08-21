@extends('admin.master')

@section('judul')
Data Arsip Kegiatan
@endsection

@section('content')


<!-- Button to Open the Modal -->
<section class="mb-5">
    <div class="pt-3">
        <button id="btnTambah" type="button" class="btn btn-primary btn box-tools pull-left" data-toggle="modal" data-target="#modalEditDraftArsip">
            <i class="fa fa-plus-circle" aria-hidden="true"></i>
        </button>
        <div class="pull-right">
            <input id="caridata" type="text" class="form-control" name='caridata' onkeyup="showData()" />
        </div>
        <label class="pull-right mt-2"> Cari &nbsp;</label>
    </div>

</section>

<div id="tabelDisini"></div>

</div>

<!--Srart Modal -->
<div class="modal fade" id="modalEditDraftArsip">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Data Arsip</h6>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <form method="post" id="insertform" enctype="multipart/form-data">
                <div class="modal-body" id="modalEdit">
                    <div class="form-group">
                        <label>Nomor Arsip</label>
                        <input type="text" class="form-control" placeholder="Nomor Arsip" id="nomorArsip" name="nomorArsip">
                    </div>


                    <div class="form-group">
                        <label>Mitra </label>
                        <div class="input-group">
                            <input type="text" placeholder="Mitra" disabled id="mitra2" class="form-control mr-2">
                            <input type="text" hidden class="form-control mr-2" id="mitra" name="mitra">
                            <button type='button' class="btn btn-info" onclick="showCariMitra()" data-toggle="modal" data-target="#modalCariMitra"><i class="fa fa-search" aria-hidden="true"></i></button>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>File Lapoaran Kegiatan (maxs 2Mb) </label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="file" name="file">
                            <label class="custom-file-label" for="customFile">Pilih file</label>
                        </div>
                    </div>

                    <input class="btn btn-primary" type="submit" value="Simpan">
                </div>
            </form>
        </div>
    </div>
</div>
<!-- EndModal -->

<!--Srart Modal -->
<div class="modal fade" id="modalCariMitra">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Cari Mitra</h6>
                <input type="text" id="carimitra" class="form-control">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div id="tabelCariMitra">

                </div>
            </div>
        </div>
    </div>
</div>
<!-- EndModal -->
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
        var caridata = $("#caridata").val();

        $.ajax({
            type: 'GET',
            url: '/admin/arsip/showArsipKegiatan',
            data: {
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

    $('#insertform').on('submit', function(event) {
        event.preventDefault();
        $.ajax({
            method: 'post',
            url: '/admin/arsip/insertArsipKegiatan',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                $('#modalEditDraftArsip').modal('toggle');
                Swal.fire({
                    type: 'success',
                    title: 'Laporan kegiatan berhasil di masukan',
                    showConfirmButton: false,
                    timer: 1500
                })
                showData();
            }
        });
    });

    function showEditData(id) {

        $.ajax({
            type: 'GET',
            url: '/admin/draftArsip/showArsipModalEdit',
            data: {
                id: id,
            },
            success: function(response) {

                $("#modalEdit").html(response.html);
            },
            error: function(response) {
                alert('gagal \n' + response.responseText);
            }
        });
    }

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
                    url: '/admin/arsip/deleteArsip',
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

    function showCariMitra() {
        var mitra = $("#carimitra").val();

        $.ajax({
            type: 'GET',
            url: '/admin/mitra/showCariMitra',
            data: {
                mitra: mitra,
            },
            success: function(response) {

                $("#tabelCariMitra").html(response.html);
            },
            error: function(response) {
                alert('gagal \n' + response.responseText);
            }
        });
    }

    function pilihData(mitra) {
        $('#mitra2').val(mitra);
        $('#mitra').val(mitra);
    }

    $(window).on("load", function() {
        showData();
    });
</script>

@endsection
