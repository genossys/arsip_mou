<div class="table-responsive-lg">
    <table class="table table-striped  table-bordered table-hover" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>#</th>
                <th>username</th>
                <th>email</th>
                <th>status</th>
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
                @if($m->status == "acc")
                <td class="text-success">{{$m->status}}</td>
                @elseif($m->status == "tolak")
                <td class="text-danger">{{$m->status}}</td>
                @else
                <td class="text-warning">{{$m->status}}</td>
                @endif

                <td style="min-width: 100px">
                    <button class="btn btn-info btn-sm pull-center" onclick="pilihData('{{$m->username}}')" data-toggle="modal" data-target="#modalCariMitra"> <i class="fa fa-check" aria-hidden="true"></i></button>
                </td>
            </tr>
            @endforeach

        </tbody>

    </table>
</div>
