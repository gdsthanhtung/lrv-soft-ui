<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<!--   Core JS Files   -->
<script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
{{-- <script src="{{ asset('assets/js/plugins/fullcalendar.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/chartjs.min.js') }}"></script> --}}

@stack('dashboard')
<script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
        damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
</script>

<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js') }}"></script>
<!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
<script src="{{ asset('assets/js/soft-ui-dashboard.min.js?v=1.0.3') }}"></script>

<!-- CUSTOM JS Files -->
{{-- <script src="{{ asset('assets/gds-custom/datepicker/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('assets/gds-custom/selectpicker/js/bootstrap-multiselect.js') }}"></script>
<script src="{{ asset('assets/gds-custom/moment/moment.min.js') }}"></script> --}}

<!-- CUSTOM JS Files -->
{{-- <script src="{{ asset('assets/gds-custom/gds/js/modules.js') }}"></script> --}}

@yield('modules_script')
