q<div class="table-responsive-lg">
    <table class="table table-striped  table-bordered table-hover" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Nomor Moa Mitra</th>
                <th>Nomor Moa Udb</th>
                <th>Tanggal Pembuatan</th>
                <th>Tanggal Expired</th>
                <th>Catatan dari Admin</th>
                <th>file</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>
            @php $i=1; @endphp
            @foreach($draftMoa as $dm)
            <tr>
                <td>{{$i++}}</td>
                <td>{{$dm->nomorMoaMitra}}</td>
                <td>{{$dm->nomorMoaUdb}}</td>
                <td>{{$dm->tanggalPembuatan}}</td>
                <td>{{$dm->tanggalExpired}}</td>
                <td>{{$dm->keterangan}}</td>
                <td>{{ link_to('/file/'.$dm->file, $dm->file) }}</td>
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
