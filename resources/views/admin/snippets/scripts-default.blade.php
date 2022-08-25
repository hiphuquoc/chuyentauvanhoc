<!-- === START:: Scripts Default === -->
<script src="{{ asset('sources/admin/app-assets/vendors/js/vendors.min.js') }}"></script>
<script src="{{ asset('sources/admin/app-assets/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('sources/admin/app-assets/js/core/app-menu.js') }}"></script>
<!-- === END:: Scripts Default === -->
<!-- BEGIN: Page Vendor JS-->
<script src="{{ asset('sources/admin/app-assets/vendors/js/pickers/pickadate/picker.js') }}"></script>
<script src="{{ asset('sources/admin/app-assets/vendors/js/pickers/pickadate/picker.date.js') }}"></script>
<script src="{{ asset('sources/admin/app-assets/vendors/js/pickers/pickadate/picker.time.js') }}"></script>
<script src="{{ asset('sources/admin/app-assets/vendors/js/pickers/pickadate/legacy.js') }}"></script>
<script src="{{ asset('sources/admin/app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js') }}"></script>
<script src="{{ asset('sources/admin/app-assets/js/scripts/forms/pickers/form-pickers.js') }}"></script>
<script src="{{ asset('sources/admin/app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
<script src="{{ asset('sources/admin/app-assets/js/scripts/forms/form-select2.min.js') }}"></script>
<script src="{{ asset('sources/admin/app-assets/js/scripts/forms/form-validation.js') }}"></script>

<script src="{{ asset('sources/admin/app-assets/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>

<!-- END: Page Vendor JS-->
<script defer>
    $(window).on('load', function () {
        if (feather) {
            feather.replace({
                width: 14,
                height: 14
            });
        }
    })

    $(function () {
        $('[data-toggle="tooltip"]').tooltip({ html : true })
    })
    /* COUNT CHARACTOR */
    $('input, textarea').on('input', function(){
        const idElemt           = $(this).attr('id');
        if(idElemt){
            const lengthInput   = $(this).val().length;
            const elemtShow     = $(document).find("[data-charactor='" + idElemt + "']");
            elemtShow.html(lengthInput);
        }
    })

    function showHideLoadingFull(action = 'show'){
        if(action=='show'){
            $('#js_loadingFull').css('display', 'flex');
            $('body').css('overflow', 'hidden');
        }else {
            $('#js_loadingFull').css('display', 'none');
            $('body').css('overflow', 'unset');
        }
    }

    
</script>