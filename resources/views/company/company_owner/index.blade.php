@extends('layouts.dashboard')
@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#"><i class="fa fa-home"></i> </a>
        </li>
        <li id="client" class="breadcrumb-item active">My company</li>
    </ol>
    @include('company.company_owner.template.index')
@endsection
@section('scripts')
    @parent
    <script>
        var variables ={
            get_department: '{{url('axios/owner/company/{0}/get/departments')}}',
            delete_department: '{{url('axios/owner/department/{0}/delete')}}',
            edit_department: '{{url('axios/owner/department/{0}/edit')}}',
            post_department: '{{url('axios/owner/department/create')}}',
            edit_company: '{{url('axios/owner/company/{0}/update')}}',
            get_employees_for_company: '{{url('axios/owner/company/{0}/employees/get')}}',
            detach_employee: '{{url('axios/owner/company/{0}/department/{1}/employees/detach')}}',
            attach_employee: '{{url('axios/owner/company/{0}/department/{1}/employees/attach')}}',
        };
    </script>
@endsection
