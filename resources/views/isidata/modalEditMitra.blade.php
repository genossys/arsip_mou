<div class="alert alert-danger" style="display:none"></div>
<div class="alert alert-success" style="display:none"></div>
<div class="form-group">
    <label>User Name </label>
    <input type="text" class="form-control" placeholder="Username" id="username" name="username" readonly value="{{$mitra->username}}">
</div>

<div class="form-group">
    <label>email</label>
    <input type="email" class="form-control" placeholder="Email" id="email" name="email" value="{{$mitra->email}}">
</div>


<div class="form-group">
    <label>Alamat </label>
    <textarea class="form-control" rows="3" id="alamat" name="alamat">{{$mitra->alamat}}</textarea>
</div>

<div class="form-group">
    <label>No. Hp</label>
    <input type="text" class="form-control" placeholder="noHp" id="noHp" name="noHp" value="{{$mitra->noHp}}">
</div>

<div class="form-group">
    <label>Status</label>
    <select class="form-control" id="status" name="status">
        <option value="{{$mitra->status}}">{{$mitra->status}}</option>
        <option disabled>____________________________________</option>
        <option value="Acc">Acc</option>
        <option value="Tolak">Tolak</option>
    </select>
</div>

<div class="text-right">
    <!-- <input id="btnSimpan" class="btn btn-primary" type="submit">Simpan <i id="iconbtn" class="fa fa-floppy-o" aria-hidden="true"></i></inp> -->
    <button name="btnSimpan" id="btnSimpan" class="btn btn-primary">Simpan</button>
</div>
