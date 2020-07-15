window._ = require('lodash');
import CookieService from "./services/CookieService";

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
    window.Popper = require('popper.js').default;
    // window.$ = window.jQuery = require('jquery');

    // require('bootstrap');
} catch (e) {}

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.axios.defaults.headers.common['Accept'] = 'application/json';
window.axios.defaults.headers.common['Authorization'] = 'Bearer ' + CookieService.get('access_token');

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

import Echo from 'laravel-echo'

window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: '84a7b4c63127f7636646',
    cluster: 'ap1',
    forceTLS: true
});

if (CookieService.get('access_token')) {
    axios({
        url: 'https://ttd.com/api/user',
        method: 'get'
    }).then(response => {
        let likeCommentChannel = window.Echo.channel('likeComment-channel.'+response.data.id);
        likeCommentChannel.listen('.likeComment-event', function(data) {
            console.log(data);
        });
    });
}
