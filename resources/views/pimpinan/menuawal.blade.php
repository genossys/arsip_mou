@extends('pimpinan.master')
@section('content')
<!-- Content Header (Page header) -->

@if (auth()->check())

@if (auth()->user()->hakAkses == 'mitra')
<script type="text/javascript">
    window.location = "/mitra"; //here double curly bracket
</script>
@endif

@endif

<section class="content-header">


</section>

<!-- Main content -->
<section class="content">

</section>
<!-- /.content -->

@endsection
