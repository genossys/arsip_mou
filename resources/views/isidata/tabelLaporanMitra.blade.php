<div class="table-responsive-lg">
    <table class="table table-striped  table-bordered table-hover" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>#</th>
                <th>username</th>
                <th>email</th>
                <th>noHp</th>
                <th>alamat</th>
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


            </tr>
            @endforeach

        </tbody>

    </table>
</div>
