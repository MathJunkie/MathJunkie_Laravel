<!DOCTYPE html>
<html lang="de">
<head>
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="{{ URL::asset('css/materialize.min.css') }}"  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="{{ URL::asset('css/script/builder.css') }}"  media="screen,projection"/>
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta charset="utf-8">
    <title>Script Builder</title>
</head>
<body class="grey darken-4">
<nav id="navBar" class="blue darken-3">

</nav>
<form class="sidebar row">
    <div style="position: absolute; top: 60px; left: 0;" class="red col s6">
        <div class="" id="blockly"></div>
    </div>
    <div class="col s6" style="top: 60px; right: 0; position: absolute;">
        <div>
            <ul class="tabs">
                <li class="tab col s6"><a href="#tabSageCode">Generated</a> </li>
                <li class="tab col s6"><a href="#tabSageCodeSave">Saved</a> </li>
            </ul>
        </div>
        <div id="tabSageCode">
            <textarea readonly id="sageCode" class="blue lighten-3" ></textarea>
            <div id="btnSageCode" class="btn waves-effect btn-flat green">Copy to Saved</div>
        </div>
        <div id="tabSageCodeSave"><textarea name="function" id="sageCodeSave" class="blue lighten-3" >{{ $script->function }}</textarea></div>
        <div class="row white">
            <div class="input-field col s12">
                <input name="description" id="desc" type="text" value="{{$script->description}}"/>
                <label for="desc">Beschreibung</label>
            </div>
            <input type="submit" id="saveBtn" class="green btn col s12" value="Save"/>
        </div>
    </div>
    <input type="hidden" name="xml" id="xmlhidden_input" value="{{ $script->xml }}">
    <input type="hidden" name="_token" value="{{csrf_token()}}">
</form>
{!! $content['xml'] !!}
<script type="text/javascript" src="{{ URL::asset('js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/materialize.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/Blockly/blockly_compressed.js') }}"></script>
<script>
    'use strict';
    {!! $content['structure'] !!}
</script>
<script>
    'use strict';
    {!! $content['function'] !!}
</script>
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
                        'isScript' : true,
                        'idScript' : '{{$script->id}}'
                    },
                    success: function(result){
                        reload_script();
                    }
                });
            });
        });
    }

    function edit_script(i){
        $.ajax({
            method: "GET",
            url: "{{Request::root()}}/comment/"+i+"/update",
            data: {
                'text' : prompt("Please enter your updated Text", "")
            },
            success: function(result){
                reload_script();
            }
        });
    }

    function updateCode(){

    }

    function delete_script(i){

        if (confirm("You sure?"))
        {
            $.ajax({
                method: "GET",
                url: "{{Request::root()}}/comment/"+i+"/delete",
                success: function(result){
                    reload_script();
                }
            });
        }
    }

    $(document).ready(function() {
        //Comment
        reload_script();

        var toolbox = document.getElementById('toolbox');
        var mainWorkspace = Blockly.inject('blockly',
                {
                    toolbox: document.getElementById('toolbox'),
                    grid:
                    {
                        spacing: 25,
                        length: 3,
                        colour: '#ccc',
                        snap: true
                    },
                    zoom:
                    {
                        controls: true,
                        wheel: false
                    }
                }
        );

        // Create the root block
                @if (empty($script->xml))
        var xml = '';
                @else
        var xml = $('#xmlhidden_input').val();
        @endif

        if (xml != '') {
            Blockly.Xml.domToWorkspace(mainWorkspace, Blockly.Xml.textToDom(xml));

            mainWorkspace.clearUndo();

            mainWorkspace.addChangeListener(updateCode);
        }
    });

</script>
@foreach ($errors->all() as $error)
    <script>Materialize.toast("{{$error}}",3000)</script>
@endforeach
</body>
</html>