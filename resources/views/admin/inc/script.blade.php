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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<script>
    Pusher.logToConsole = true;

    var pusher = new Pusher('0b44e06044b07726d365', {
        cluster: 'ap2',
    });

    var channel = pusher.subscribe('user.{{ auth()->user()->id }}');

    channel.bind('pusher:subscription_succeeded', function () {
        console.log('Successfully subscribed to the channel!');
    });
    channel.bind('friend_request', function (data) {
        console.log("Received data:", data);


        var newNotificationHtml = `
        <li onclick="markNotificationAsRead(${data.data.id})">
            <a href="#">
                <span class="avatar"><img src="http://placehold.it/80x80" alt=""></span>
                <span class="name"><strong>Friend Request</strong></span>
                <span class="desc">${JSON.parse(data.data.data).message}</span>
                <span class="time">Just now</span>
            </a>
        </li>`;

        $('#notification-popup .notice-list').prepend(newNotificationHtml);
    });

</script>
<script>
    function markNotificationAsRead(notificationId) {
        fetch('/notifications/' + notificationId + '/mark-read', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Ensure CSRF token is included if using POST
            }
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    console.log('Notification marked as read');
                    window.location.reload();
                    // Update the notification UI here if needed
                }
            })
            .catch(error => console.error('Error:', error));
    }

</script>
<script>
    $(document).ready(function () {
        loadNotifications();
    });

    function loadNotifications() {
        fetch('/notifications') // Replace with your actual API endpoint
            .then(response => response.json())
            .then(notifications => {
                const notificationList = $('#notification-popup .notice-list');
                notificationList.empty(); // Clear existing notifications

                notifications.forEach(notification => {
                    const isRead = notification.read_at !== null;
                    const formattedType = capitalizeWords(notification.type); // Capitalize the notification type
                    const notificationHtml = `
                    <li class="${isRead ? 'read' : 'unread'}" onclick="markNotificationAsRead(${notification.id})">
                        <a href="#">
                            <span class="avatar"><img src="http://placehold.it/80x80" alt=""></span>
                            <span class="name">${formattedType}</span> <!-- Customize as per your data structure -->
                            <span class="desc">${JSON.parse(notification.data).message}</span> <!-- Customize as per your data structure -->
                            <span class="time">${formatTime(notification.created_at)}</span>
                        </a>
                    </li>`;
                    notificationList.append(notificationHtml);
                });
            })
            .catch(error => console.error('Error loading notifications:', error));
    }

    // Optional: Utility function to format time as needed
    function formatTime(dateTimeString) {
        // Implement time formatting logic here, if necessary
        return new Date(dateTimeString).toLocaleTimeString(); // Example: Convert to locale-specific time
    }

    function capitalizeWords(str) {
        return str.split('_')
            .map(word => word.charAt(0).toUpperCase() + word.slice(1))
            .join(' ');
    }

</script>
@stack('js')
