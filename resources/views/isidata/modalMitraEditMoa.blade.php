<div class="alert alert-danger" style="display:none"></div>
<div class="alert alert-success" style="display:none"></div>
<input value="{{auth()->user()->username}}" hidden id="mitra" name="mitra">
<input value="{{$draftMoa->id}}" hidden id="id" name="id">

<div class="form-group">
    <label>Nomor MOU </label>
    <div class="input-group">
        <input type="text" placeholder="Nomor MOU" disabled id="nomorMou2" class="form-control mr-2" value="{{$draftMoa->nomorMou}}">
        <input type="text" hidden class="form-control mr-2" id="nomorMou" name="nomorMou" value="{{$draftMoa->nomorMou}}">
        <button type='button' class="btn btn-info" onclick="showCariMou()" data-toggle="modal" data-target="#modalCariMou"><i class="fa fa-search" aria-hidden="true"></i></button>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>Nomor MOA (Mitra) </label>
            <input type="text" class="form-control" placeholder="Nomor MOU Mitra" id="nomorMoaMitra" name="nomorMoaMitra" value="{{$draftMoa->nomorMoaMitra}}">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>Nomor MOA (UDB)</label>
            <input disabled type="text" class="form-control" placeholder="Nomor MOU UDB" id="nomorMoaUdb" name="nomorMoaUdb" value="{{$draftMoa->nomorMoaUdb}}">
        </div>
    </div>
</div>

<div class="form-group">
    <label>Nama Kegiatan</label>
    <input type="text" class="form-control" placeholder="Nama Kegiatan" id="namaKegiatan" name="namaKegiatan" value="{{$draftMoa->namaKegiatan}}">
</div>
<div class="form-group">
    <label>Tanggal Expired</label>
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text">
                <i class="fa fa-calendar"></i>
            </span>
        </div>
        <input type="text" class="form-control float-right datepicker" name="tanggalExpired" id="tanggalExpired" value="{{$draftMoa->tanggalExpired}}">
        <input type="text" class="form-control float-right" hidden value="{{date('Y-m-d')}}" name="tanggalPembuatan" id="tanggalPembuatan">
    </div>
</div>
<div class="form-group">
    <label>File MOA </label>
    <div class="custom-file">
        <input type="file" class="custom-file-input" id="file" name="file">
        <label class="custom-file-label" for="customFile">Pilih file</label>
    </div>
</div>

<div class="text-right">
    <!-- <input id="btnSimpan" class="btn btn-primary" type="submit">Simpan <i id="iconbtn" class="fa fa-floppy-o" aria-hidden="true"></i></inp> -->
    <input type="submit" name="upload" id="upload" class="btn btn-primary" value="Simpan"></td>
</div>
