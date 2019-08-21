<div class="alert alert-danger" style="display:none"></div>
<div class="alert alert-success" style="display:none"></div>
<input id="id" name="id" hidden value="{{$draftMoa->id}}">

<div class="row">
    <div class="col-md-6">

        <div class="form-group">
            <label>Mitra </label>
            <input type="text" hidden class="form-control" placeholder="Mitra" id="mitra" name="mitra" value="{{$draftMoa->mitra}}">
            <input type="text" disabled class="form-control" placeholder="Mitra" value="{{$draftMoa->mitra}}">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>Nomor MOA (Mitra) </label>
            <input type="text" class="form-control" hidden placeholder="Nomor MOA Mitra" id="nomorMoaMitra" name="nomorMoaMitra" value="{{$draftMoa->nomorMoaMitra}}">
            <input type="text" class="form-control" disabled placeholder="Nomor MOA Mitra" value="{{$draftMoa->nomorMoaMitra}}">
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class=" form-group">
            <label>Tanggal Pembuatan</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fa fa-calendar"></i>
                    </span>
                </div>
                <input type="text" disabled class="form-control float-right" value="{{date('Y-m-d')}}" name="tanggalPembuatan" id="tanggalPembuatan" value="{{$draftMoa->tanggalPembuatan}}">
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class=" form-group">
            <label>Tanggal Expired</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fa fa-calendar"></i>
                    </span>
                </div>
                <input type="text" disabled class="form-control float-right datepicker" name="tanggalExpired" id="tanggalExpired" value="{{$draftMoa->tanggalExpired}}">
            </div>
        </div>
    </div>
</div>

<div class=" form-group">
    <label>File MOA </label>
    <div class="custom-file">
        <input type="file" class="custom-file-input" id="file" name="file">
        <label class="custom-file-label" for="customFile">Pilih file</label>
    </div>
</div>

<div class="form-group">
    <label>Nomor Moa (UDB)</label>
    <input type="text" class="form-control" placeholder="Nomor MOA UDB" id="nomorMoaUdb" name="nomorMoaUdb" value="{{$draftMoa->nomorMoaUdb}}">
</div>

<div class="form-group">
    <label>Status</label>
    <select class="form-control" id="status" name="status">
        <option value="revisi">Revisi</option>
        <option value="acc">Acc</option>
    </select>
</div>

<div class="form-group">
    <label>Catatan </label>
    <textarea class="form-control" rows="3" id="keterangan" name="keterangan"></textarea>
</div>

<div class="text-right">
    <!-- <input id="btnSimpan" class="btn btn-primary" type="submit">Simpan <i id="iconbtn" class="fa fa-floppy-o" aria-hidden="true"></i></inp> -->
    <input type="submit" name="upload" id="upload" class="btn btn-primary" value="Edit"></td>
</div>

<script src="{{ asset('/js/tampilan/fileinput.js') }}"></script>
