@include('dashboard.layouts.scripts')
<script>
    $(document).ready(function () {
        window.parent.postMessage({
            name: '{{ Request::cookie('wannasale_name') }}',
            email: '{{ Request::cookie('wannasale_email') }}',
            phone: '{{ Request::cookie('wannasale_phone') }}',
            country: '{{ Request::cookie('wannasale_country') }}'
        }, "*");
    });
</script>
