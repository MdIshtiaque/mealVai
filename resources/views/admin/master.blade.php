<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="author" content="">

    <title>Home - Meal Vai</title>

    @include('admin.inc.style')
</head>

<body>
<div class="main-menu">
    @include('admin.partials.sidebar')
</div>

@include('admin.partials.header')


@include('admin.partials.notifications')


@include('admin.partials.messages')


<div id="wrapper">
    <div class="main-content">
        @yield('content')
    </div>
</div>

@include('admin.inc.script')
</body>
</html>
