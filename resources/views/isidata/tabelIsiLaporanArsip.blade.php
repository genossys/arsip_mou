<div class="table-responsive-lg">
    <table class="table table-striped  table-bordered table-hover" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Mitra</th>
                <th>Nomor Arsip</th>
                <th>Tanggal</th>
                <th>File</th>
            </tr>
        </thead>

        <tbody>
            @php $i=1; @endphp
            @foreach($arsip as $dm)
            <tr>
                <td>{{$i++}}</td>
                <td>{{$dm->mitra}}</td>
                <td>{{$dm->nomorArsip}}</td>
                <td>{{formatDateToSurat($dm->tanggal)}}</td>
                <td><a class="btn btn-info" target="_blank" href="{{asset ('file/'.$dm->file)}}"><i class="fa fa-download" aria-hidden="true"></i></a></td>

            </tr>
            @endforeach

        </tbody>

    </table>
</div>
