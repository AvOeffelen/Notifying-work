@extends('layouts.dashboard')
@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#"><i class="fa fa-home"></i> </a>
        </li>
        <li id="Notification" class="breadcrumb-item">Notifications</li>
        <li id="Push" class="breadcrumb-item active">Push</li>
    </ol>
    @include('notification.push.company_owner.template.index')
@endsection
@section('scripts')
    @parent
    <script>
        var variables ={
            get_employees: '{{url('axios/owner/company/{0}/employees/get')}}',
            get_departments: '{{url('axios/owner/company/{0}/get/departments')}}',
            get_unFilteredEmployees: '{{url('axios/owner/employees/unfiltered/get')}}',
            send_pushNotification: '{{url('axios/owner/notifications/push/send')}}',
        };
    </script>
@endsection
