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

</head>

<body>

<div id="single-wrapper">
    <form action="{{ route('register') }}" method="post" class="frm-single">
        @csrf
        <div class="inside">
            <div class="title"><strong>Admin</strong>Bhai</div>
            <div class="frm-title">Register</div>
            <div class="frm-input"><input type="email" name="email" placeholder="Email" class="frm-inp"><i
                    class="fa fa-envelope frm-ico"></i></div>
            <div class="frm-input"><input type="text" name="name" placeholder="Full Name" class="frm-inp"><i
                    class="fa fa-user frm-ico"></i></div>
            <div class="frm-input"><input type="password" name="password" id="pass" placeholder="Password" class="frm-inp"><i
                    class="fa fa-lock frm-ico"></i></div>
            <div class="frm-input"><input type="password" name="password_confirmation" id="confirmPass" placeholder="Confirm Password"
                                          class="frm-inp"><i class="fa fa-lock frm-ico"></i><span id="msg" hidden></span></div>
            <button type="submit" class="frm-submit">Register<i class="fa fa-arrow-circle-right"></i></button>
            <div class="row small-spacing">
                <div class="col-sm-12">
                    <div class="txt-login-with txt-center">or register with</div>
                </div>
                <div class="col-sm-6">
                    <button type="button"
                            class="btn btn-sm btn-icon btn-icon-left btn-social-with-text btn-facebook text-white waves-effect waves-light">
                        <i class="ico fa fa-facebook"></i><span>Facebook</span></button>
                </div>
                <div class="col-sm-6">
                    <button type="button"
                            class="btn btn-sm btn-icon btn-icon-left btn-social-with-text btn-google-plus text-white waves-effect waves-light">
                        <i class="ico fa fa-google-plus"></i>Google+
                    </button>
                </div>
            </div>
            <a href="{{ route('login') }}" class="a-link"><i class="fa fa-sign-in"></i>Already have account? Login.</a>
            <div class="frm-footer">Meal Bhai Admin © 2023.</div>
        </div>
    </form>
</div>
<script src="{{ asset('assets/script/html5shiv.min.js') }}"></script>
<script src="{{ asset('assets/script/respond.min.js') }}"></script>
<script src="{{ asset('assets/scripts/jquery.min.js') }}"></script>
<script src="{{ asset('assets/scripts/modernizr.min.js') }}"></script>
<script src="{{ asset('assets/plugin/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/plugin/nprogress/nprogress.js') }}"></script>
<script src="{{ asset('assets/plugin/waves/waves.min') }}.js"></script>

<script src="{{ asset('assets/scripts/main.min.js') }}"></script>
<script>
    var pass = document.getElementById('pass');
    var confirmPass = document.getElementById('confirmPass');
    var msg = document.getElementById('msg');
    confirmPass.addEventListener('input', function() {
        if(pass.value === confirmPass.value) {
            msg.textContent = "Password matched";
            msg.style.color = 'green';
            msg.hidden = false
        }else {
            msg.textContent = "Password not matched";
            msg.style.color = 'red';
            msg.hidden = false
        }
    });
</script>
</body>
</html>
