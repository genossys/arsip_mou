<div class="table-responsive-lg">
    <table class="table table-striped  table-bordered table-hover" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Nomor Mou</th>
                <th>Nomor Moa Mitra</th>
                <th>Nomor Moa Udb</th>
                <th>Nama Kegiatan</th>
                <th>Tanggal Pembuatan</th>
                <th>Tanggal Expired</th>
                <th>file</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            @php $i=1; @endphp
            @foreach($draftMoa as $dm)
            <tr>
                <td>{{$i++}}</td>
                <td>{{$dm->nomorMou}}</td>
                <td>{{$dm->nomorMoaMitra}}</td>
                <td>{{$dm->nomorMoaUdb}}</td>
                <td>{{$dm->namaKegiatan}}</td>
                <td>{{$dm->tanggalPembuatan}}</td>
                <td class={{notifExpired($dm->tanggalExpired)}}>{{$dm->tanggalExpired}}</td>
                <td>{{$dm->keterangan}}</td>
                <td>{{ link_to('/file/'.$dm->file, $dm->file) }}</td>
                @if($dm->status == 'revisi')
                <td class="text-warning">{{$dm->status}}</td>
                @elseif($dm->status == 'acc')
                <td class="text-success">{{$dm->status}}</td>
                @else
                <td class="text-danger">{{$dm->status}}</td>
                @endif
                <td style="min-width: 100px"> <button class="btn btn-warning btn-sm pull-center" data-toggle="modal" data-target="#modalEditDraftMou" onclick="showEditData('{{$dm->id}}')"> <i class="fa fa-edit" aria-hidden="true"></i></button>
                </td>
            </tr>
            @endforeach

        </tbody>

    </table>
</div>
