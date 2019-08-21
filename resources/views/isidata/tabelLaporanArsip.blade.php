<div class="table-responsive-lg">
    <table class="table table-striped  table-bordered table-hover" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Mitra</th>
                <th>Email</th>
                <th>No. Hp</th>
                <th>Alamat</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            @php $i=1; @endphp
            @foreach($arsip as $dm)
            <tr>
                <td>{{$i++}}</td>
                <td>{{$dm->username}}</td>
                <td>{{$dm->email}}</td>
                <td>{{$dm->noHp}}</td>
                <td>{{$dm->alamat}}</td>
                <td style="width: 210px">
                    <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#modalLaporanArsip" onclick="showArsip('MOU','{{$dm->username}}')">MOU</button>
                    <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#modalLaporanArsip" onclick="showArsip('MOA','{{$dm->username}}')">MOA</button>
                    <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#modalLaporanArsip" onclick="showArsip('Kegiatan','{{$dm->username}}')">Kegiatan</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
