// Libraries
window._ = require('lodash');
window.$ = window.jQuery = require('jquery');

require('bootstrap');
require('datatables.net');
require('datatables.net-bs');

// Bootstrapping
let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}