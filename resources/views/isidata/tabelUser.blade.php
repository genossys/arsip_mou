<div class="table-responsive-lg">
    <table class="table table-striped  table-bordered table-hover" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>#</th>
                <th>username</th>
                <th>email</th>
                <th>hakAkses</th>
                <th>alamat</th>
                <th>noHp</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            @php $i=1; @endphp
            @foreach($user as $u)
            <tr>
                <td>{{$i++}}</td>
                <td>{{$u->username}}</td>
                <td>{{$u->email}}</td>
                <td>{{$u->hakAkses}}</td>
                <td>{{$u->alamat}}</td>
                <td>{{$u->noHp}}</td>
                <td style="min-width: 100px"> <button class="btn btn-warning btn-sm pull-center" data-toggle="modal" data-target="#exampleModal" onclick="setid('{{$u->username}}')"> <i class="fa fa-edit" aria-hidden="true"></i></button>
                    <button class="btn btn-danger btn-sm pull-center" onclick="deletePesanan('{{$u->username}}')"> <i class="fa fa-close" aria-hidden="true"></i></button>
                </td>
            </tr>
            @endforeach

        </tbody>

    </table>
</div>
