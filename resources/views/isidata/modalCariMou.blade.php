<table class="table table-striped  table-bordered table-hover" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>#</th>
            <th>Nomor Mou Udb</th>
            <th>Tanggal Expired</th>
            <th>file</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>
        @php $i=1; @endphp
        @foreach($draftMou as $dm)
        <tr>
            <td>{{$i++}}</td>
            <td>{{$dm->nomorMouUdb}}</td>
            <td>{{$dm->tanggalExpired}}</td>
            <td>{{ link_to('/file/'.$dm->file, $dm->file) }}</td>
            @if($dm->status == 'revisi')
            <td class="text-warning">{{$dm->status}}</td>
            @elseif($dm->status == 'acc')
            <td class="text-success">{{$dm->status}}</td>
            @else
            <td class="text-danger">{{$dm->status}}</td>
            @endif
            <td  style="min-width: 100px"> <button @if($dm->status != 'acc') disabled @endif
                class="btn btn-primary btn-sm pull-center" data-toggle="modal" data-target="#modalCariMou" onclick="pilihMou('{{$dm->nomorMouUdb}}')" > <i class="fa fa-check" aria-hidden="true"></i></button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
