<div class="alert alert-danger" style="display:none"></div>
<div class="alert alert-success" style="display:none"></div>
<div class="form-group">
    <label>User Name </label>
    <input type="text" class="form-control" placeholder="Username" id="username" name="username" readonly value="{{$user->username}}">
    <input type="text" class="form-control" placeholder="Username" id="id" name="id" hidden value="{{$user->id}}">
</div>

<div class="form-group">
    <label>email</label>
    <input type="email" class="form-control" placeholder="Email" id="email" name="email" value="{{$user->email}}">
</div>

<div class="form-group">
    <label>Hak Akses</label>
    <select class="form-control" id="hakAkses" name="hakAkses">
        <option value="{{$user->hakAkses}}">{{$user->hakAkses}}</option>
        <option disabled>____________________________________</option>
        <option value="admin">Admin</option>
        <option value="pimpinan">Pimpinan</option>
        <option value="unit">Unit</option>
    </select>
</div>

<div class="form-group">
    <label>Alamat </label>
    <textarea class="form-control" rows="3" id="alamat" name="alamat">{{$user->alamat}}</textarea>
</div>

<div class="form-group">
    <label>No. Hp</label>
    <input type="text" class="form-control" placeholder="noHp" id="noHp" name="noHp" value="{{$user->noHp}}">
</div>

<div class="text-right">
    <!-- <input id="btnSimpan" class="btn btn-primary" type="submit">Simpan <i id="iconbtn" class="fa fa-floppy-o" aria-hidden="true"></i></inp> -->
    <button name="btnSimpan" id="btnSimpan" class="btn btn-primary">Simpan</button>
</div>
