(function ($) {
    'use strict'

    $(document).ready(function () {
        svg4everybody({})
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

    })
})
