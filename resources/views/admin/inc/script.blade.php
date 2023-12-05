
<!-- Placed at the end of the document so the pages load faster -->
<script src="{{ asset('assets/scripts/jquery.min.js') }}"></script>
<script src="{{ asset('assets/scripts/modernizr.min.js') }}"></script>
<script src="{{ asset('assets/plugin/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/plugin/mCustomScrollbar/jquery.mCustomScrollbar.concat.min.js') }}"></script>
<script src="{{ asset('assets/plugin/nprogress/nprogress.js') }}"></script>
<script src="{{ asset('assets/plugin/sweet-alert/sweetalert.min.js') }}"></script>
<script src="{{ asset('assets/plugin/waves/waves.min.js') }}"></script>
<!-- Full Screen Plugin -->
<script src="{{ asset('assets/plugin/fullscreen/jquery.fullscreen-min.js') }}"></script>

<!-- Google Chart -->
<script type="text/javascript" src="{{ asset('https://www.gstatic.com/charts/loader.js') }}"></script>

<!-- chart.js Chart -->
<script src="{{ asset('assets/plugin/chart/chartjs/Chart.bundle.min.js') }}"></script>
<script src="{{ asset('assets/scripts/chart.chartjs.init.min.js') }}"></script>

<!-- FullCalendar -->
<script src="{{ asset('assets/plugin/moment/moment.js') }}"></script>
<script src="{{ asset('assets/plugin/fullcalendar/fullcalendar.min.js') }}"></script>
<script src="{{ asset('assets/scripts/fullcalendar.init.js') }}"></script>

<!-- Sparkline Chart -->
<script src="{{ asset('assets/plugin/chart/sparkline/jquery.sparkline.min.js') }}"></script>
<script src="{{ asset('assets/scripts/chart.sparkline.init.min.js') }}"></script>

<script src="{{ asset('assets/scripts/main.min.js') }}"></script>
<script src="{{ asset('assets/color-switcher/color-switcher.min.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<script>
    Pusher.logToConsole = true;

    var pusher = new Pusher('0b44e06044b07726d365', {
        cluster: 'ap2',
    });

    var channel = pusher.subscribe('user.{{ auth()->user()->id }}');

    channel.bind('pusher:subscription_succeeded', function() {
        console.log('Successfully subscribed to the channel!');
    });
    channel.bind('friend_request_sent', function( data = "Emon") {
        console.log("Received data:", data);


        var newNotificationHtml = `
        <li>
            <a href="#">
                <span class="avatar"><img src="http://placehold.it/80x80" alt=""></span>
                <span class="name">${data.requestedId}</span>
                <span class="desc">${data.message}</span>
                <span class="time">Just now</span>
            </a>
        </li>`;

        $('#notification-popup .notice-list').prepend(newNotificationHtml);
    });

</script>
@stack('js')
