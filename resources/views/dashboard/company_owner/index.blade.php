@extends('layouts.dashboard')
@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#"><i class="fa fa-home"></i> </a>
        </li>
    </ol>
    @include('dashboard.company_owner.template.index')
@endsection
@section('scripts')
    @parent
    <script>
        var variables ={
            get_employees: '{{url('axios/home/employees/get')}}',
            get_departments: '{{url('axios/owner/departments/get')}}',
            send_pushNotification: '{{url('axios/notifications/push/send')}}',
        };
    </script>
@endsection
