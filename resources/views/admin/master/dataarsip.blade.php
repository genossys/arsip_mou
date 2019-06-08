@extends('admin.master')

@section('judul')
Data Arsip
@endsection

@section('content')


<!-- Button to Open the Modal -->
<div>
    <button id="tambahModal" style="margin-bottom: 10px; margin-top: 20px" type="button" class="btn btn-primary box-tools pull-right" data-toggle="modal" data-target="#modaltambahArsip">
        Tambah Data Arsip
    </button>

</div>

<div class="table-responsive-lg">
    <table id="example2" class="table table-striped  table-bordered table-hover" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>#</th>
                <th>ID Arsip</th>
                <th>Judul Arsip</th>
                <th>Keterangan</th>
                <th>Tanggal</th>
                <th>File</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
</div>

<!--Srart Modal -->
<div class="modal fade" id="modaltambahArsip">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data Arsip</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <form action="" method="POST" id="formSimpanArsip" class="form">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="alert alert-danger" style="display:none"></div>
                    <div class="alert alert-success" style="display:none"></div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>ID Arsip </label>
                                <input type="text" class="form-control" placeholder="ID Arsip" id="txtIdArsip" name="txtIdArsip">
                            </div>
                        </div>


                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Judul Arsip</label>
                                <input type="text" class="form-control" placeholder="Judul Arsip" id="txtJudulArsip" name="txtJudulArsip">
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <label id="labelKetSnack">Keterangan Arsip </label>
                        <textarea class="form-control" rows="3" id="txtKeterenganArsip" name="txtKeterenganArsip"></textarea>
                    </div>

                    <div class="form-group">
                        <label>Tanggal</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-calendar"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control float-right datepicker" name="dateTanggal" id="dateTanggal">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>File Arsip </label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="fileArsip" name="fileArsip">
                            <label class="custom-file-label" for="customFile">Pilih file</label>
                        </div>
                    </div>


                    <div class="text-right">
                        <button id="btnSimpan" class="btn btn-primary"></button>
                    </div>
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
<script src="{{ asset('/js/tampilan/changemodal.js') }}"></script>
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

@endsection
