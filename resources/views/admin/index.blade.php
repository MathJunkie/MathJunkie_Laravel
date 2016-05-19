<html>
<head>
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="{{ URL::asset('css/materialize.min.css') }} "  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="{{ URL::asset('css/jquery.webui-popover.min.css') }}"/>
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
                    <p>made by {{$script->user->name}}</p>
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
                        <p>made by {{$block->user->name}}</p>
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
<script type="text/javascript" src="{{ URL::asset('js/jquery.webui-popover.min.js') }}"></script>

<script>
    $(document).ready(function(){
        $('.carousel').carousel();
        $('#home_comment_btn').webuiPopover({
            type:'async',
            animate:'pop',
            url:'{{Request::root()}}/admin/getNews/2'
        });
    });
</script>
<!-- Console Log is bad -->
<script src="{{ URL::asset('js/log.js') }}"></script>
<script>
    var textStyle = "font-family: \'Roboto\'; color:#000; font-size: 24px";
    var textError = "font-family: \'Roboto\'; color:#f00; font-size: 20px";
    var errorheader = "font-family: \'Helvetica Neue\', " +
            "Helvetica, Arial, sans-serif; " +
            "color: #fff; " +
            "font-size: 20px; " +
            "padding: 15px 20px; " +
            "background: #7f0000; " +
            "border-radius: 4px; " +
            "line-height: 100px; " +
            "text-shadow: 0 1px #000";

    log('[c='+errorheader+']' + 'MathJunkie Development View[c]\n'+
        '[c='+textStyle+']' + 'Please note that this application heavily depends on Javascript. Tinkering with setting in this console, could break the application. You have been warned !!![c]\n'+
        '[c='+textError+']' + 'PS: No Caro, NOOOO!!![c]');
</script>

</body>
</html>