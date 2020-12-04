@extends('layouts.app', ['title' => __('QR')])
@section('admin_title')
{{__('QR Builder')}}
@endsection
@section('content')
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
</div>
<div class="container-fluid mt--7">
        <div id="qrgen" data='{{ $data }}'></div>
    @include('layouts.footers.auth')
</div>
@endsection
  
@section('js')
    <script type="text/javascript" src="{{ asset('js/appreact.js') }}"></script>
@endsection
