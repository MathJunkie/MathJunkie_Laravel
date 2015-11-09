<html>
<head>
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="resource/css/materialize.min.css"  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="resource/css/login/index.css"  media="screen,projection"/>

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta charset="utf-8">

    <title>Admin</title>
</head>
<body>
    @if (Auth::check())
        <h1>Willkommen {{ Auth::user()->name }}</h1>
        <form action="/auth/logout" method="GET">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <button type="submit" class="btn right waves-effect waves-light red">Log out</button>
        </form>
    @else
        <h1><i class="mdi-hardware-phone-android"></i>Keine Berechtigung</h1>
    @endif

    <script type="text/javascript" src="resource/js/jquery.min.js"></script>
    <script type="text/javascript" src="resource/js/materialize.min.js"></script>
</body>
</html>
