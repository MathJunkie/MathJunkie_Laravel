<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="{{ URL::asset('css/materialize.min.css') }}"  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="{{ URL::asset('css/startpage/startpage.css') }}"  media="screen,projection"/>

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta charset="utf-8">

    <title>MathJunkie</title>
</head>

<body>

<header>
    <div id="headline">
        <br>
        <h1 class="center-align shadow-text">MathJunkie</h1>
        <h5 class="center-align shadow-text">Who said Math has to be difficult and ugly?</h5>
    </div>

    <nav>
        <div class="nav-wrapper">
            <img src="{{URL::asset('images/Icon.png')}}" class="brand-logo center" alt="Logo"/>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li><a href="sass.html">Log In</a></li>
            </ul>
            <ul id="tutorial" class="left hide-on-med-and-down">
                <li><a href="tutorial.html">Tutorial</a></li>
            </ul>
        </div>
    </nav>
</header>

<main class="row">
    <div id="sidebar" style="padding-top:100px;"  class="col s2 blue lighten-3 valign">
    @if (isset($scripts))
        @foreach($scripts as $script)
            <p><a href="{{Request::url()."/".$script->id}}">{{$script->name}}</a></p>
        @endforeach
    @endif
    </div>
    <div id="wrapper" class="col s10 row blue lighten-4">
        <div id="content" class="col s10 row">
@if (!isset ($data) && !isset($script))
            <div id="input">
                <form action="/script" method="post" class="col s12">
                    <div class="row">
                        <div class="input-field col s6">
                            <i class="mdi-editor-mode-edit prefix"></i>
                            <input id="icon_prefix" name="name" type="text" class="validate">
                            <label for="icon_prefix">Name</label>
                        </div>
                        <div class="input-field col s12">
                            <i class="mdi-action-perm-data-setting prefix"></i>
                            <textarea id="data" name="data" class="materialize-textarea"></textarea>
                            <label for="data">Data</label>
                        </div>
                    </div>
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <input class="btn" type="submit"/>
                </form>
            </div>
            @elseif(isset($script))
                <div id="input">
                    <form action="{{Request::url()}}" method="post" class="col s12">
                        <div class="row">
                            <div class="input-field col s6">
                                <i class="mdi-editor-mode-edit prefix"></i>
                                <input id="icon_prefix" name="name" type="text" value="{{$script->name}}" class="validate">
                                <label for="icon_prefix">Name</label>
                            </div>
                            <div class="input-field col s12">
                                <i class="mdi-action-perm-data-setting prefix"></i>
                                <textarea id="data" name="data" class="materialize-textarea">{{$script->data}}</textarea>
                                <label for="data">Data</label>
                            </div>
                        </div>
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <input class="btn" type="submit"/>
                    </form>
                </div>
            @else
                {{$data->data}}
                @if (Auth::user()->email == $data->owner)
                <p><a href="{{Request::url()}}/edit">edit</a></p>
                <p><a href="{{Request::url()}}/delete">delete</a></p>
                @endif
                <script src="https://sagecell.sagemath.org/static/jquery.min.js"></script>
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

            <div id="output">
                <div class="compute">
                    <script type="text/x-sage">{{$data->data}}</script>
                </div>
            </div>
@endif
        </div>
    </div>

</main>
<footer>
    <div class="footer-copyright cyan">
        <div class="container" >
            <p>© 2015 MathJunkie</p>
        </div>
    </div>
</footer>

<script type="text/javascript" src="{{ URL::asset('js/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{ URL::asset('js/materialize.min.js')}}"></script>


</body>
</html>