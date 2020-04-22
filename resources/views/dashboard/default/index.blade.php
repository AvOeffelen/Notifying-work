@extends('layouts.dashboard')
@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#"><i class="fa fa-home"></i> </a>
        </li>
    </ol>
    @include('dashboard.default.template.index')
@endsection
@section('scripts')
    @parent
    <script>
        var variables ={
            get_employees: '{{url('axios/home/employees/get')}}',
        };
    </script>
@endsection
