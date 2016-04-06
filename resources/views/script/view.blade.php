<!DOCTYPE html>
<html lang="de">
<head>
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="{{ URL::asset('css/materialize.min.css') }}"  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="{{ URL::asset('css/script/view.css') }}"  media="screen,projection"/>
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta charset="utf-8">
    <title>Script Builder</title>
</head>
<body class="grey darken-4">
<nav id="navBar" class="blue darken-3">

</nav>
<script type="text/javascript" src="{{ URL::asset('js/jquery.min.js') }}"></script>
<script src="https://sagecell.sagemath.org/static/embedded_sagecell.js"></script>
<link rel="stylesheet" type="text/css" href="https://sagecell.sagemath.org/static/sagecell_embed.css">
<script>$(function () {
        // Make the div with id 'mycell' a Sage cell
        sagecell.makeSagecell({inputLocation:  '#mycell',
            template:       sagecell.templates.minimal,
            evalButtonText: 'Activate'});
        // Make *any* div with class 'compute' a Sage cell
        sagecell.makeSagecell({inputLocation: 'div.compute',
            evalButtonText: 'Evaluate',
            autoeval: true,
            template:       sagecell.templates.minimal,
            hide: ["evalButton","permalink","editor"]});
    });
</script>

<div class="white" id="output">
    <div class="compute">
        <script type="text/x-sage">{!! $script->function !!}</script>
    </div>
</div>
<script type="text/javascript" src="{{ URL::asset('js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/materialize.min.js') }}"></script>
<script type="text/javascript">
    function reload_script(){
        $('#navBar').load("{{Request::root()}}/comment/{{$script->id}}/script_list", function(){
            $(".button-collapse").sideNav({
                menuWidth: 300, // Default is 240
                edge: 'right' // Choose the horizontal origin
            });

            $("#comment_btn").click(function(){
                $.ajax({
                    method: "GET",
                    url: "{{Request::root()}}/comment",
                    data: {
                        'text' : $('#comment').val(),
                        'isScript' : 1,
                        'idScript' : '{{$script->id}}'
                    },
                    success: function(result){
                        reload_script();
                    }
                });
            });
        });
    }

    function reload_comment(){
        $('#navBar').load("{{Request::root()}}/comment/{{$script->id}}/script_list", function(){
            $(".button-collapse").sideNav({
                menuWidth: 300, // Default is 240
                edge: 'right' // Choose the horizontal origin
            });

            $("#comment_btn").click(function(){
                $.ajax({
                    method: "GET",
                    url: "{{Request::root()}}/comment",
                    data: {
                        'text' : $('#comment').val(),
                        'isScript' : 0,
                        'idScript' : '{{$script->id}}'
                    },
                    success: function(result){
                        reload_comment();
                    }
                });
            });
        });
    }

    $(document).ready(function() {
        //Comment
        reload_script();
    });

</script>
@foreach ($errors->all() as $error)
    <script>Materialize.toast("{{$error}}",3000)</script>
@endforeach
</body>
</html>