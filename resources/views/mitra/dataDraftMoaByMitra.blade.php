@extends('mitra.master')

@section('judul')
Data Draft MOA
@endsection

@section('content')
<!-- Button to Open the Modal -->
<section class="mb-5">
    <div class="pt-3">
        <button id="btnTambah" type="button" class="btn btn-primary btn box-tools pull-left" data-toggle="modal" data-target="#modalTambahDraftMoa">
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
<div class="modal fade" id="modalTambahDraftMoa">
    <div class="modal-dialog modal-lg">

        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Data DraftMoa</h6>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <form method="post" id="insertform" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="alert alert-danger" style="display:none"></div>
                    <div class="alert alert-success" style="display:none"></div>
                    <input value="{{auth()->user()->username}}" hidden id="mitra" name="mitra">

                    <div class="form-group">
                        <label>Nomor MOU </label>
                        <div class="input-group">
                            <input type="text" placeholder="Nomor MOU" disabled id="nomorMou2" class="form-control mr-2">
                            <input type="text" hidden class="form-control mr-2" id="nomorMou" name="nomorMou">
                            <button type='button' class="btn btn-info" onclick="showCariMou()" data-toggle="modal" data-target="#modalCariMou"><i class="fa fa-search" aria-hidden="true"></i></button>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nomor MOA (Mitra) </label>
                                <input type="text" required class="form-control" placeholder="Nomor MOA Mitra" id="nomorMoaMitra" name="nomorMoaMitra">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nomor MOA (UDB)</label>
                                <input disabled type="text" class="form-control" placeholder="Nomor MOA UDB" id="nomorMoaUdb" name="nomorMoaUdb">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Nama Kegiatan</label>
                        <input type="text" class="form-control" required placeholder="Nama Kegiatan" id="namaKegiatan" name="namaKegiatan">
                    </div>
                    <div class="form-group">
                        <label>Tanggal Expired</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-calendar"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control float-right datepicker" required name="tanggalExpired" id="tanggalExpired">
                            <input type="text" class="form-control float-right" hidden value="{{date('Y-m-d')}}" name="tanggalPembuatan" id="tanggalPembuatan">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>File MOA </label>
                        <div class="custom-file">
                            <input type="file" required class="custom-file-input" id="file" name="file">
                            <label class="custom-file-label" for="customFile">Pilih file</label>
                        </div>
                    </div>

                    <div class="text-right">
                        <!-- <input id="btnSimpan" class="btn btn-primary" type="submit">Simpan <i id="iconbtn" class="fa fa-floppy-o" aria-hidden="true"></i></inp> -->
                        <input type="submit" disabled name="upload" id="upload" class="btn btn-primary" value="Simpan"></td>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- EndModal -->

<!--Srart Modal -->
<div class="modal fade" id="modalEditDraftMou">
    <div class="modal-dialog modal-lg">

        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Data DraftMou</h6>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <form method="post" id="editform" enctype="multipart/form-data">
                <div class="modal-body" id="modalEdit">

                </div>
            </form>
        </div>
    </div>
</div>
<!-- EndModal -->


<!--Srart Modal -->
<div class="modal fade" id="modalCariMou">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Cari MOU</h6>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div id="tabelCariMou">

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
        var mitra = $("#mitra").val();
        var caridata = $("#caridata").val();

        $.ajax({
            type: 'GET',
            url: '/mitra/draftMoa/showMoa',
            data: {
                mitra: mitra,
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

    function showCariMou() {
        var mitra = $("#mitra").val();

        $.ajax({
            type: 'GET',
            url: '/mitra/draftMou/showCariMou',
            data: {
                mitra: mitra,
            },
            success: function(response) {

                $("#tabelCariMou").html(response.html);
            },
            error: function(response) {
                alert('gagal \n' + response.responseText);
            }
        });
    }

    function pilihMou(nomorMou) {
        $('#nomorMou2').val(nomorMou);
        $('#nomorMou').val(nomorMou);
        $('#upload').removeAttr("disabled");
    }

    $('#editform').on('submit', function(event) {
        event.preventDefault();
        $.ajax({
            method: 'post',
            url: '/mitra/draftMoa/MitraEditMoa',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                $('#modalEditDraftMou').modal('toggle');
                Swal.fire({
                    type: 'success',
                    title: 'Mou berhasil di ubah',
                    showConfirmButton: false,
                    timer: 1500
                })
                showData();
            }
        });
    });

    $('#insertform').on('submit', function(event) {
        event.preventDefault();
        $.ajax({
            method: 'post',
            url: '/mitra/draftMoa/MitraInsertMoa',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                $('#modalTambahDraftMoa').modal('toggle');
                Swal.fire({
                    type: 'success',
                    title: 'Draft MOA berhasil di buat',
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
            url: '/mitra/draftMoa/showMitraEditMoa',
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

    $(window).on("load", function() {
        showData();
    });
</script>
@endsection
