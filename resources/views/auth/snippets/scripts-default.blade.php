<!-- BEGIN: Vendor JS-->
<script src="{{ asset('sources/admin/app-assets/vendors/js/vendors.min.js') }}"></script>
<!-- BEGIN Vendor JS-->
<!-- BEGIN: Page Vendor JS-->
<script src="{{ asset('sources/admin/app-assets/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
<!-- END: Page Vendor JS-->
<!-- BEGIN: Theme JS-->
<script src="{{ asset('sources/admin/app-assets/js/core/app-menu.min.js') }}"></script>
<script src="{{ asset('sources/admin/app-assets/js/core/app.min.js') }}"></script>
<!-- END: Theme JS-->
<!-- BEGIN: Page JS-->
<script src="{{ asset('sources/admin/app-assets/js/scripts/pages/auth-login.js') }}"></script>
<!-- END: Page JS-->
<script>
$(window).on('load',  function(){
    if (feather) {
    feather.replace({ width: 14, height: 14 });
    }
})
</script>