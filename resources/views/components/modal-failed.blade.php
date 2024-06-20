<template id="modal-failed">
    <swal-title>
        {{ $slot }}
    </swal-title>
    <swal-icon type="error"></swal-icon>
    <swal-button type="confirm">
        Ok
    </swal-button>
    <swal-param name="allowEscapeKey" value="false" />
    <swal-param name="customClass" value='{ "popup": "my-popup" }' />
    <swal-function-param name="didOpen" value="popup => console.log(popup)" />
</template>
@push('customscript')
    <script>
        Swal.fire({
            template: "#modal-failed"
        });
    </script>
@endpush
