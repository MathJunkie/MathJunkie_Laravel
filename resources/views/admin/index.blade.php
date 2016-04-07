<html>
<head>
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="{{ URL::asset('css/materialize.min.css') }} "  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="{{ URL::asset('css/mainpage/mainpage.css') }} "  media="screen,projection"/>

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta charset="utf-8">

</head>
<body class="teal darken-4">

<header>
</header>

<ul id="dropdown_user" class="dropdown-content">
    <li><a href="#!"><i class="mdi-action-perm-identity right"></i>Profile</a></li>
    <li><a href="#!"><i class="mdi-action-settings right"></i>Options</a></li>
    <li class="divider"></li>
    <form action="/auth/logout" method="GET">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <li><a type="submit"><i class="mdi-action-exit-to-app right"></i>Log out</a></li>
    </form>
</ul>

<div class="navbar-fixed">
    <nav class="teal">
        <div class="nav-wrapper row">
            <div class="col s1">
                <a href="#!"><img class="left circle" src="{{ URL::asset('images/Icon.png') }}" style="height: 100%"></a>
            </div>
            <div class="col s5">
                <ul class="center">
                    <li><button class="btn waves-effect waves-light navigation">Script builder</button></li>
                    <form action="/block" method="GET">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <li><button type="submit" class="btn waves-effect waves-light navigation">Block builder</button></li>
                    </form>
                </ul>
            </div>
            <div class="col s2">
                <a href="#!" class="center brand-logo">MathJunkie</a>
            </div>
            <div class="col s5">
                <a class="right btn-floating btn waves-effect waves-light red navigation" style="top: 15px;"></a>
            </div>
            <div class="col s1">
                @if (Auth::check())
                    <a class="dropdown-button right" href="#!" data-activates="dropdown_user" style="text-align: center; min-width:150px;">{{ Auth::user()->name }}<i class="mdi-navigation-arrow-drop-down right"></i></a>
                @else
                <a class="btn waves-effect waves-light right" type="submit" style="text-align: center; min-width:150px;">Sign in</a>
                @endif
            </div>
        </div>
    </nav>
</div>

<main>
    <div class="teal darken-2 welcome">
        <h1>Welcome</h1>
    </div>

    <div id="carousel_slider">
        <div class="carousel_header">Newest scripts</div>
        <div class="carousel">
            <a class="carousel-item" href="#one!"><img src="http://lorempixel.com/250/250/nature/1"></a>
            <a class="carousel-item" href="#two!"><img src="http://lorempixel.com/250/250/nature/2"></a>
            <a class="carousel-item" href="#three!"><img src="http://lorempixel.com/250/250/nature/3"></a>
            <a class="carousel-item" href="#four!"><img src="http://lorempixel.com/250/250/nature/4"></a>
            <a class="carousel-item" href="#five!"><img src="http://lorempixel.com/250/250/nature/5"></a>
        </div>
        <div class="carousel_header">Newest blocks</div>
        <div class="carousel">
            <a class="carousel-item" href="#one!"><img src="http://lorempixel.com/250/250/nature/1"></a>
            <a class="carousel-item" href="#two!"><img src="http://lorempixel.com/250/250/nature/2"></a>
            <a class="carousel-item" href="#three!"><img src="http://lorempixel.com/250/250/nature/3"></a>
            <a class="carousel-item" href="#four!"><img src="http://lorempixel.com/250/250/nature/4"></a>
            <a class="carousel-item" href="#five!"><img src="http://lorempixel.com/250/250/nature/5"></a>
        </div>
    </div>
</main>

<footer class="teal">
    <div class="footer-copyright">
        <div class="container">
            © 2016 MathJunkie
            <a class="grey-text text-lighten-4 right" href="https://github.com/MathJunkie/MathJunkie_Laravel">GitHub</a>
        </div>
    </div>
</footer>

<!--script-->
<script type="text/javascript" src="{{ URL::asset('js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/materialize.min.js') }}"></script>

<script>
    $(document).ready(function(){
        $(".dropdown-button").dropdown();
        $('.carousel').carousel();
    });
</script>

</body>
</html>