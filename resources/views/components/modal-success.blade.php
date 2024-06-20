<template id="modal-success">
    <swal-title>
        {{ $slot }}
    </swal-title>
    <swal-icon type="success"></swal-icon>
    <swal-button type="confirm">
        Ok
    </swal-button>
    <swal-param name="allowEscapeKey" value="false" />
    <swal-param name="customClass" value='{ "popup": "my-popup" }' />
    <swal-function-param name="didOpen" value="popup => console.log(popup)" />
</template>
