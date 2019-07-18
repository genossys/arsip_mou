<div class="table-responsive-lg">
    <table class="table table-striped  table-bordered table-hover" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Jenis Arsip</th>
                <th>Nomor Arsip</th>
                <th>Mitra</th>
                <th>Tanggal</th>
                <th>file</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            @php $i=1; @endphp
            @foreach($draftArsip as $dm)
            <tr>
                <td>{{$i++}}</td>
                <td>{{$dm->jenisArsip}}</td>
                <td>{{$dm->nomorArsip}}</td>
                <td>{{$dm->mitra}}</td>
                <td>{{$dm->tanggal}}</td>
                <td>{{ link_to('/file/'.$dm->file, $dm->file) }}</td>

                <td style="min-width: 50px">
                    <button class="btn btn-danger btn-sm pull-center" onclick="deletePesanan('{{$dm->id}}')"> <i class="fa fa-close" aria-hidden="true"></i></button>
                </td>
            </tr>
            @endforeach

        </tbody>

    </table>
</div>
