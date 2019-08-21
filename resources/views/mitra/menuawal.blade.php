@extends('mitra.master')
@section('content')
<!-- Content Header (Page header) -->

@if ($message = Session::get('warning'))
<script>
    Swal.fire({
        type: 'success',
        title: 'Pendaftaran berhasil, Silahkan upload surat anda sebelum membuat MOU dan MOA...',
        showConfirmButton: false,
        timer: 3000
    })
</script>
@endif

<section class="content-header">


</section>

<!-- Main content -->
<section class="content">

</section>
<!-- /.content -->

@endsection
