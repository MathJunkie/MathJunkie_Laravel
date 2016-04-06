<!DOCTYPE html>
<html lang="de">
<head>
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="{{ URL::asset('css/materialize.min.css') }}"  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="{{ URL::asset('css/builder/home.css') }}"  media="screen,projection"/>
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta charset="utf-8">
    <title>Blöcke Home</title>
</head>
<body class="teal darken-4">

<header>
</header>

<ul id="dropdown_user" class="dropdown-content">
    <li><a href="#!"><i class="mdi-action-perm-identity right"></i>Profile</a></li>
    <li><a href="#!"><i class="mdi-action-settings right"></i>Options</a></li>
    <li class="divider"></li>
    <form action="/auth/logout" method="GET">
        <li><a type="submit"><i class="mdi-action-exit-to-app right"></i>Log out</a></li>
    </form>
</ul>

<div class="navbar-fixed">
    <nav class="teal">
        <div class="nav-wrapper row">
            <div class="col s1">
                <a href="#!"><img class="left circle" src="{{ URL::asset('images/Icon.png') }}" style="height: 65px"></a>           <!--Ging aus irgendeinem Grund nicht anpassen ;)-->
            </div>
            <div class="col s5">
                <ul class="center">
                    <li><a class="btn waves-effect waves-light">Script builder</a></li>
                    <li><a class="btn waves-effect waves-light">Block builder</a></li>
                </ul>
            </div>
            <div class="col s2">
                <a href="#!" class="center brand-logo">MathJunkie</a>
            </div>
            <div class="col s5">
                <a class="right btn-floating btn waves-effect waves-light red" style="top: 15px;"></a>
            </div>
            <div class="col s1">
                @if (Auth::check())
                <a class="dropdown-button right" href="#!" data-activates="dropdown_user" style="text-align: center; min-width:150px;">{{ Auth::user()->name }}<i class=" right"></i></a>
                @else
                <a class="btn waves-effect waves-light right" type="submit" style="text-align: center; min-width:150px;">Sign in</a>
                @endif
            </div>
        </div>
    </nav>
</div>

<main>
    <div class="teal darken-2 welcome">
        <nav>
            <div class="nav-wrapper">
                <div>
                    <div class="input-field">
                        <input id="search" type="search" required class="red lighten-1">
                        <label for="search"><i class="mdi-action-search"></i></label>
                        <i class="mdi-navigation-close"></i>
                    </div>
                </div>
            </div>
        </nav>
        <form action="/block" method="post" id="mainContainer" class="container row">
            <div class="input-field col s8">
                <input value="" id="block_name" name="name" type="text" class="validate white-text">
                <label class="active" for="block_name">Name of the new block</label>
            </div>
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <input type="submit" value="Create" id="create_block" class="btn teal lighten-1 col s4"/>
        </form>
        <ul id="ownBlock" class="collection">
        </ul>
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
    };
</script>

<script type="text/javascript">
    $('#search').keypress(function(){
        $('#ownBlock').html('');
        $.ajax({
            url: "{{Request::url()}}/list?search="+$('#search').val(),
            success: function(result){
                for (var i = 0; i < result.length; i++){
                    $('#ownBlock').html('<a href="{{Request::url()}}/'+result[i].id+'" class="collection-item"><h3>'+result[i].name+'</h3><p>'+result[i].description+'</p></a>');

                }
            }
        })
    })
</script>

@foreach ($errors->all() as $error)
<script>Materialize.toast("{{$error}}",3000)</script>
@endforeach

</body>
</html>