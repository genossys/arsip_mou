<div class="table-responsive-lg">
    <table class="table table-striped  table-bordered table-hover" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>#</th>
                <th>username</th>
                <th>email</th>
                <th>noHp</th>
                <th>alamat</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            @php $i=1; @endphp
            @foreach($mitra as $m)
            <tr>
                <td>{{$i++}}</td>
                <td>{{$m->username}}</td>
                <td>{{$m->email}}</td>
                <td>{{$m->noHp}}</td>
                <td>{{$m->alamat}}</td>
                <td style="min-width: 100px"> <button class="btn btn-warning btn-sm pull-center" data-toggle="modal" data-target="#" onclick="setid('{{$m->username}}')"> <i class="fa fa-edit" aria-hidden="true"></i></button>
                    <button class="btn btn-danger btn-sm pull-center" onclick="deletePesanan('{{$m->username}}')"> <i class="fa fa-close" aria-hidden="true"></i></button>
                </td>
            </tr>
            @endforeach

        </tbody>

    </table>
</div>
