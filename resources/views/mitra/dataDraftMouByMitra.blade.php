@extends('mitra.master')

@section('judul')
Data Draft MOU
@endsection

@section('content')



<!-- Button to Open the Modal -->
<section class="mb-5">
    <div class="pt-3">

        <button @if($mitra->status != 'acc') disabled @endif  id="btnTambah" type="button" class="btn btn-primary btn box-tools pull-left" data-toggle="modal" data-target="#modalTambahDraftMou">
            <i class="fa fa-plus-circle" aria-hidden="true"></i>
        </button>
        @if($mitra->status != 'acc') <a class="text-danger text-sm "> &nbsp; *MOU belum bisa di buat karena surat anda belum di setujui.</a> @endif
        <div class="pull-right">
            <input id="caridata" type="text" class="form-control" name='caridata' onkeyup="showData()" />
        </div>
        <label class="pull-right mt-2"> Cari &nbsp;</label>
    </div>

</section>

<div id="tabelDisini"></div>

</div>

<!--Srart Modal -->
<div class="modal fade" id="modalTambahDraftMou">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Data DraftMou</h6>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <form method="post" id="insertform" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="alert alert-danger" style="display:none"></div>
                    <div class="alert alert-success" style="display:none"></div>
                    <input type="hidden" id="oldkdDraftMou" name="oldkdDraftMou">
                    <input value="{{auth()->user()->username}}" hidden id="mitra" name="mitra">
                    <div class="form-group">
                        <label>Nomor MOU (Mitra) </label>
                        <input type="text" class="form-control" required placeholder="Nomor MOU Mitra" id="nomorMouMitra" name="nomorMouMitra">
                    </div>
                    <div class="form-group">
                        <label>Nomor Mou (UDB)</label>
                        <input disabled type="text" required class="form-control" placeholder="Nomor MOU UDB" id="nomorMouUdb" name="nomorMouUdb">
                    </div>
                    <div class="form-group">
                        <label>Tanggal Expired</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-calendar"></i>
                                </span>
                            </div>
                            <input type="text" required class="form-control float-right datepicker" name="tanggalExpired" id="tanggalExpired">
                            <input type="text" class="form-control float-right" hidden value="{{date('Y-m-d')}}" name="tanggalPembuatan" id="tanggalPembuatan">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>File MOA (*maxs 2Mb)</label>
                        <div class="custom-file">
                            <input type="file"  required class="custom-file-input" id="file" name="file">
                            <label class="custom-file-label" for="customFile">Pilih file</label>
                        </div>
                    </div>

                    <div class="text-right">
                        <!-- <input id="btnSimpan" class="btn btn-primary" type="submit">Simpan <i id="iconbtn" class="fa fa-floppy-o" aria-hidden="true"></i></inp> -->
                        <input type="submit" name="upload" id="upload" class="btn btn-primary" value="Upload"></td>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- EndModal -->

<!--Srart Modal -->
<div class="modal fade" id="modalEditDraftMou">
    <div class="modal-dialog">

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
            url: '/mitra/draftMou/showMou',
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

    $('#editform').on('submit', function(event) {
        event.preventDefault();
        $.ajax({
            method: 'post',
            url: '/mitra/draftMou/MitraEditMou',
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
            url: '/mitra/draftMou/MitraInsertMou',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                $('#modalTambahDraftMou').modal('toggle');
                Swal.fire({
                    type: 'success',
                    title: 'Mou berhasil di buat',
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
            url: '/mitra/draftMou/showMitraEditMou',
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
