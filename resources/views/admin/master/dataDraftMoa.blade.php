@extends('admin.master')

@section('judul')
Data DraftMoa
@endsection

@section('content')



<!-- Button to Open the Modal -->
<section class="mb-5">
    <div class="pt-3">
        <!-- <button id="btnTambah" type="button" class="btn btn-primary btn box-tools pull-left" data-toggle="modal" data-target="#modalEditDraftMoa">
            <i class="fa fa-plus-circle" aria-hidden="true"></i>
        </button> -->
        <div class="pull-right">
            <input id="caridata" type="text" class="form-control" name='caridata' onkeyup="showData()" />
        </div>
        <label class="pull-right mt-2"> Cari &nbsp;</label>
    </div>

</section>

<div id="tabelDisini"></div>

</div>

<!--Srart Modal -->
<div class="modal fade" id="modalEditDraftMoa">
    <div class="modal-dialog modal-lg">

        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Data DraftMoa</h6>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <form method="post" id="insertform" enctype="multipart/form-data">
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
            url: '/admin/draftMoa/showMoa',
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
            url: '/admin/draftMoa/AdminEditMoa',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                $('#modalEditDraftMoa').modal('toggle');
                Swal.fire({
                    type: 'success',
                    title: 'Moa berhasil di ubah',
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
            url: '/admin/draftMoa/showMoaModalEdit',
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

    function insertArsip(id) {

        $.ajax({
            type: 'POST',
            url: '/admin/arsip/insertArsipMOA',
            data: {
                id: id,
            },
            success: function(response) {
                Swal.fire({
                    type: 'success',
                    title: 'insert arsip',
                    showConfirmButton: false,
                    timer: 1500
                })

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
