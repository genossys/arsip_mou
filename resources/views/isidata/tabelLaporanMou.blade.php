<div class="table-responsive-lg">
    <table class="table table-striped  table-bordered table-hover" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Nomor Mou Mitra</th>
                <th>Nomor Mou Udb</th>
                <th>Tanggal Pembuatan</th>
                <th>Tanggal Expired</th>
                <th>Catatan dari Admin</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>
            @php $i=1; @endphp
            @foreach($draftMou as $dm)
            <tr>
                <td>{{$i++}}</td>
                <td>{{$dm->nomorMouMitra}}</td>
                <td>{{$dm->nomorMouUdb}}</td>
                <td>{{$dm->tanggalPembuatan}}</td>
                <td>{{$dm->tanggalExpired}}</td>
                <td>{{$dm->keterangan}}</td>
                @if($dm->status == 'revisi')
                <td class="text-warning">{{$dm->status}}</td>
                @elseif($dm->status == 'acc')
                <td class="text-success">{{$dm->status}}</td>
                @else
                <td class="text-danger">{{$dm->status}}</td>
                @endif

            </tr>
            @endforeach

        </tbody>

    </table>
</div>
