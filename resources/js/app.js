// Libraries
window._ = require('lodash');
window.$ = window.jQuery = require('jquery');

require('bootstrap');
require('datatables.net');
require('datatables.net-bs');
require('datatables.net-buttons-bs');
require('datatables.net-buttons/js/buttons.colVis.js');
window.datatablesClickable = require('./datatables-clickable');
require('bootstrap-select');

// Helpers for creating correct urls
window.url = (url) => {
    return Controller.global.url + '/' + url;
};

window.asset = (url) => {
    return Controller.global.asset + '/' + url;
};

window.redirect = (url) => {
    window.location.href = window.url(url);
};


// Bootstrapping
let token = document.head.querySelector('meta[name="csrf-token"]');
if (token) {
    window.$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).ajaxError(function (event, jqxhr, settings, thrownError) {
        let statusCode = jqxhr.status;
        if([401, 403].includes(statusCode)) {
            redirect('/');
        }
    });
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

$('div.alert').not('.alert-important').delay(3000).fadeOut(350);

$.extend(true, $.fn.dataTable.defaults, {
    language: require('./datatables-german')
});