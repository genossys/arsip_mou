@extends('admin.master')

@section('judul')
Laporan Mou
@endsection

@section('content')



<!-- Button to Open the Modal -->
<section>
    <div class="pt-3">
        <form action="{{route('cetakMou')}}" method="get" target="_blank">
            <div class="row container">
                <div class="col-md-3 offset-5">
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" id="status" name='status' onchange="showData()">
                            <option value="">Semua</option>
                            <option value="acc">Acc</option>
                            <option value="pending">pending</option>
                            <option value="revisi">Revisi</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <label mt-2"> Cari &nbsp;</label>

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
            url: '/admin/draftMou/showLaporanMou',
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


    $(window).on("load", function() {
        showData();
    });
</script>
@endsection
