@extends('mitra.master')

@section('judul')
File Surat Mitra
@endsection

@section('content')
<div class="container pt-5">
    <form method="POST" action="{{ route('uploadSurat') }}" id="mitraForm" enctype="multipart/form-data">
        @csrf
        <input id="username" type="text" class="form-control" name="username" value="{{$mitra->username}}" hidden>
        <!-- <div class="form-group row">
            <label for="username" class="col-md-4 col-form-label text-md-right">UserName</label>

            <div class="col-md-6">
                <input id="username" type="text" class="form-control" name="username" value="{{$mitra->username}}" readonly>
            </div>
        </div>

        <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

            <div class="col-md-6">
                <input id="email" type="text" class="form-control" name="email" value="{{$mitra->email}}" readonly>
            </div>
        </div>

        <div class="form-group row">
            <label for="nohp" class="col-md-4 col-form-label text-md-right">{{ __('No. Hp') }}</label>

            <div class="col-md-6">
                <input id="email" type="text" class="form-control" name="email" value="{{$mitra->noHp}}" readonly>
            </div>
        </div>

        <div class="form-group row">
            <label for="alamat" class="col-md-4 col-form-label text-md-right">{{ __('Alamat') }}</label>

            <div class="col-md-6">
                <input id="email" type="text" class="form-control" name="email" value="{{$mitra->alamat}}" readonly>
            </div>
        </div> -->


        <p class="text-center">Silahkan upload surat permohonan kerjasama</p>
        <div class="form-group row">
            <label class="col-md-4 col-form-label text-md-right">File Surat (*maxs 2Mb)</label>
            <div class="col-md-6">
                <div class="custom-file">
                    <input type="file" id="file" name="file" class="custom-file-input">
                    <label class="custom-file-label" for="customFile">{{$mitra->fileSurat}}</label>
                </div>
            </div>

            <button type="submit"
            @if($mitra->status == 'acc' || $mitra->status == 'tolak')
                disabled
            @endif
            class="btn btn-info" style="width: 53px"><i class="fa fa-upload" aria-hidden="true"></i></button>
            <a class="btn btn-success" style="width: 53px;margin-left: 5px" href="/file/{{$mitra->fileSurat}}"><i class="fa fa-download" aria-hidden="true"></i></a>
        </div>

        <div class="form-group row">
            <label for="status" class="col-md-4 col-form-label text-md-right">Status</label>

            <div class="col-md-6 mt-1">
                @if($mitra->status == 'pending')
                <a id="status" class="text-warning">{{$mitra->status}}</a>
                @elseif($mitra->status == 'acc')
                <a id="status" class="text-success">{{$mitra->status}}</a>
                @else
                <a id="status" class="text-danger">{{$mitra->status}}</a>
                @endif
            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary" hidden>
                    Simpan
                </button>
            </div>
        </div>
    </form>
</div>
@endsection

@section('css')
@endsection


@section('script')
<script src="{{ asset('/js/tampilan/fileinput.js') }}"></script>


<script>
    $('#mitraForm').on('submit', function(event) {
        event.preventDefault();
        $.ajax({
            method: 'post',
            url: '/mitra/mitra/uploadSurat',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                Swal.fire({
                    type: 'success',
                    title: 'Surat Berhasil di upload',
                    showConfirmButton: false,
                    timer: 1500
                })
                location.reload();
            }
        });
    });
</script>
@endsection
