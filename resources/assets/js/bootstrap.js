
window._ = require('lodash');

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
    window.$ = window.jQuery = require('jquery');


    window.Popper = require('popper.js').default;

    require('bootstrap');
} catch (e) {}


require( 'jquery-ui/ui/widgets/datepicker');



/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-CSRF-TOKEN'] = window.Laravel.csrfToken;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';


window.dt = require( 'datatables.net' );
require( 'jszip' );
require( 'pdfmake/build/pdfmake.js' );
require('pdfmake/build/vfs_fonts.js');
require( 'datatables.net-bs4' );
require( 'datatables.net-buttons-bs4' );
require( 'datatables.net-buttons/js/buttons.html5' );
require( 'datatables.net-buttons/js/buttons.print' );


/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */


import Echo from 'laravel-echo'

window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: '9dfe2c42e868cc3c6cf4',
    cluster: 'us2',
    encrypted: false
});

window.Echo.channel('test-channel')
    .listen('.NewMessage', (e) => {
        $(".alert").html(e.data).fadeIn();
});