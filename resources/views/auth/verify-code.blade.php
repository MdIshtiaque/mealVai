<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Home</title>
    <link rel="stylesheet" href="{{ asset('assets/styles/style.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/plugin/waves/waves.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugin/bootstrap/css/bootstrap.css') }}">
    <style>
        /* Center the card vertically and horizontally */
        body, html {
            height: 100%;
        }
        .container {
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .form-control {
            padding: 6px 165px;
        }
    </style>
</head>

<body>

<div class="container" id="single-wrapper">
    <div class="row justify-center">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Verification Code</h5>
                    <form action="{{ route('verify') }}" method="post">
                        @csrf
                        <!-- Verification Code Input -->
                        <div class="form-group">
                            <label for="code">Enter Code:</label>
                            <input type="text" id="code" name="code" maxlength="6" pattern="\d{6}" required>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('assets/script/html5shiv.min.js') }}"></script>
<script src="{{ asset('assets/script/respond.min.js') }}"></script>
<script src="{{ asset('assets/scripts/jquery.min.js') }}"></script>
<script src="{{ asset('assets/scripts/modernizr.min.js') }}"></script>
<script src="{{ asset('assets/plugin/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/plugin/nprogress/nprogress.js') }}"></script>
<script src="{{ asset('assets/plugin/waves/waves.min') }}.js"></script>

<script src="{{ asset('assets/scripts/main.min.js') }}"></script>
</body>
</html>
