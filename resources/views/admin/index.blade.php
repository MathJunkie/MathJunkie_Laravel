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

@include('template/header_main')

<main>
    <div class="teal darken-2 welcome">
        <h1>Welcome</h1>
    </div>

    <div id="carousel_slider">
        <div class="carousel_header">Newest scripts</div>
        <div class="carousel">
            @foreach($scripts as $script)
            <div class="carousel-item">
                <div class="center" style="background-color: #9ccc65;">
                    <a href="{{Request::root()}}/script/{{$script->id}}" class="flow-text">{{$script->name}}</a>
                    <p>{{$script->description}}</p>
                    <p>made by {{$script->owner}}</p>
                </div>
            </div>
            @endforeach
        </div>
        <div class="carousel_header">Newest blocks</div>
        <div class="carousel">
            @foreach($blocks as $block)
                <div class="carousel-item">
                    <div class="center" style="background-color: #9ccc65;" onselectstart="return false" ondragstart="return false">
                        <a href="{{Request::root()}}/block/{{$block->id}}" class="flow-text">{{$block->name}}</a>
                        <p>{{$block->description}}</p>
                        <p>made by {{$block->owner}}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</main>

@include('template/footer_main')

<!--script-->
<script type="text/javascript" src="{{ URL::asset('js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/materialize.min.js') }}"></script>

<script>
    $(document).ready(function(){
        $('.carousel').carousel();
    });
</script>

</body>
</html>