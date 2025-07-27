define(['jquery', 'jquery/validate'], function ($) {
    'use strict';

    $.validator.addMethod(
        'validate-phone-india',
        function (value) {
            return /^\+91-\d{10}$/.test(value);
        },
        'Phone number must be in the format +91-XXXXXXXXXX (e.g., +91-9876543210).'
    );
});