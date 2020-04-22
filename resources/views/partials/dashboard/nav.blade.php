@include('partials.dashboard.template.nav')
@section('scripts')
    @parent
    <script>
        var variables ={
            get_notifications: '{{url('axios/notifications/{0}/push/get')}}',
        };
    </script>
@endsection



