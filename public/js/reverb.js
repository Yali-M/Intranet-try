window.Echo = new Echo({
    broadcaster: 'reverb',
    key: '9dwtxnfe6irxs9gxh2fi',
    wsHost: '127.0.0.1',
    wsPort: 8080,
    wssPort: 8080,
    forceTLS: false,
    enabledTransports: ['ws', 'wss'],
});

Echo.private(`App.Models.User.1`)
    .listen('TestEvent', (e) => {
        console.log(e);
    });
