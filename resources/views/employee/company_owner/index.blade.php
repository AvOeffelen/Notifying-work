@extends('layouts.dashboard')
@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#"><i class="fa fa-home"></i> </a>
        </li>
        <li id="client" class="breadcrumb-item active">Employees</li>
    </ol>
    @include('employee.company_owner.template.index')
@endsection
@section('scripts')
    @parent
    <script>
        var variables ={
            get_employees: '{{url('axios/owner/employees/get')}}',
            get_unFilteredEmployees: '{{url('axios/owner/employees/unfiltered/get')}}',
        };
    </script>
@endsection
