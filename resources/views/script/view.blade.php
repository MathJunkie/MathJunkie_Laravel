<!DOCTYPE html>
<html lang="de">
<head>
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="{{ URL::asset('css/materialize.min.css') }}"  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="{{ URL::asset('css/script/view.css') }}"  media="screen,projection,print"/>
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta charset="utf-8">
    <title>Script Builder</title>
</head>
<body class="grey darken-4">
@include('template/header_builder')
<script type="text/javascript" src="{{ URL::asset('js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/slide.js') }}"></script>
<script src="https://sagecell.sagemath.org/static/embedded_sagecell.js"></script>
<link rel="stylesheet" type="text/css" href="https://sagecell.sagemath.org/static/sagecell_embed.css">
<script>$(function () {
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
@include('template/include_comments')
</body>
</html>