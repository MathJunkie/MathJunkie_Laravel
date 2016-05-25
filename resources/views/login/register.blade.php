<!DOCTYPE html>
<html lang="de">
<head>
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="css/login/index.css"  media="screen,projection"/>

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta charset="utf-8">
    <title>Register</title>
</head>
<body>
    <div id="login" class="row">
        <div class="col s12 z-depth-3 card-panel">
            <form action="/auth/register" method="POST" class="login-form">
                {!! csrf_field() !!}
                <div class="row">
                    <div class="input-field col s12 center">
                        <img src="images/Icon.png" alt class="circle responsive-img valign login-image">
                        <p class="center login-text">Sign up</p>
                    </div>
                </div>
                <div class="row margin">
                    <div class="input-field col s12">
                        <i class="mdi-communication-email prefix"></i>
                        <input id="email" name="email" type="email">
                        <label for="email" class="center-align label">Email</label>
                    </div>
                </div>
                <div class="row margin">
                    <div class="input-field col s12">
                        <i class="mdi-social-person-outline prefix"></i>
                        <input id="name" name="name" type="text">
                        <label for="name" class="center-align label">Username</label>
                    </div>
                </div>
                <div class="row margin">
                    <div class="input-field col s12">
                        <i class="mdi-action-lock-outline prefix"></i>
                        <input id="pass1" name="password" type="password">
                        <label for="pass1">Password</label>
                    </div>
                </div>
                <div class="row margin">
                    <div class="input-field col s10 offset-s2">
                        <input id="pass2" name="password_confirmation" type="password">
                        <label for="pass2">Repeat Password</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <button type="submit" name="register" class="btn waves-effect waves-light col s12 orange">Register</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <canvas class="grey darken-4"></canvas>
    <script type="text/javascript" src="{{URL::asset('js/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('zepto.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('js/materialize.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('js/login-background.js')}}"></script>

    @foreach ($errors->all() as $error)
        <script>Materialize.toast("{{$error}}",3000)</script>
    @endforeach
</body>
</html>