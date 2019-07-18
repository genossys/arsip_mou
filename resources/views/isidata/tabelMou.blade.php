<div class="table-responsive-lg">
    <table class="table table-striped  table-bordered table-hover" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Nomor Mou Mitra</th>
                <th>Nomor Mou Udb</th>
                <th>Tanggal Pembuatan</th>
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
                <td>{{$dm->nomorMouMitra}}</td>
                <td>{{$dm->nomorMouUdb}}</td>
                <td>{{$dm->tanggalPembuatan}}</td>
                <td>{{$dm->tanggalExpired}}</td>
                <td>{{ link_to('/file/'.$dm->file, $dm->file) }}</td>
                @if($dm->status == 'revisi')
                <td class="text-warning">{{$dm->status}}</td>
                @elseif($dm->status == 'acc')
                <td class="text-success">{{$dm->status}}</td>
                @else
                <td class="text-danger">{{$dm->status}}</td>
                @endif
                <td style="min-width: 130px"> <button class="btn btn-warning btn-sm pull-center" data-toggle="modal" data-target="#modalEditDraftMou" onclick="showEditData('{{$dm->id}}')"> <i class="fa fa-edit" aria-hidden="true"></i></button>
                    <button class="btn btn-info btn-sm pull-center" @if($dm->status != 'acc') disabled @endif onclick="insertArsip('{{$dm->id}}')"> <i class="fa fa-upload" aria-hidden="true"></i></button>
                    <button class="btn btn-danger btn-sm pull-center" onclick="deletePesanan('{{$dm->id}}')"> <i class="fa fa-close" aria-hidden="true"></i></button>
                </td>
            </tr>
            @endforeach

        </tbody>

    </table>
</div>
