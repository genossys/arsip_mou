@extends('admin.master')

@section('judul')
Laporan Arsip
@endsection

@section('content')



<!-- Button to Open the Modal -->
<section>
    <div class="pt-3">
        <form action="{{route('cetakArsip')}}" method="get" target="_blank">
            <div class="row container mb-2">
                <div class="col-md-3 offset-5">
                </div>
                <div class="col-md-3">
                    <label> Cari &nbsp;</label>
                    <div>
                        <input id="caridata" type="text" class="form-control" name='caridata' onkeyup="showData()" />
                    </div>
                </div>
                <div class="col-md-1">
                    <label for=""><br></label>
                    <button class="btn btn-warning"><i class="fa fa-print" aria-hidden="true"></i>&nbsp;Cetak</button>
                </div>
            </div>
        </form>
    </div>
</section>

<!--Srart Modal -->
<div class="modal fade" id="modalLaporanArsip">
    <div class="modal-dialog modal-lg">

        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Laporan Arsip</h6>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <form method="post" id="insertform" enctype="multipart/form-data">
                <div class="modal-body" id="modalArsip">

                </div>
            </form>
        </div>
    </div>
</div>
<!-- EndModal -->


<div id="tabelDisini"></div>

</div>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('/css/bootstrap-datepicker.min.css')}}">
@endsection


@section('script')

<script src="{{ asset('js/handlebars.js') }}"></script>

<script>
    function showData() {
        var status = $("#status").val();
        var caridata = $("#caridata").val();

        $.ajax({
            type: 'GET',
            url: '/admin/arsip/showLaporanArsip',
            data: {
                status: status,
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

    function showArsip(jenis, mitra) {

        $.ajax({
            type: 'GET',
            url: '/admin/arsip/jenisLaporanArsip',
            data: {
                jenis: jenis,
                mitra: mitra,
            },
            success: function(response) {
                $("#modalArsip").html(response.html);
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
