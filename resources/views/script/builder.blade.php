<!DOCTYPE html>
<html lang="de">
<head>
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="{{ URL::asset('css/materialize.min.css') }}"  media="screen,projection"/>
    <!--<link type="text/css" rel="stylesheet" href="{{ URL::asset('css/script/builder.css') }}"  media="screen,projection"/>-->
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta charset="utf-8">
    <title>Script Builder</title>
</head>
<body style="overflow-y:hidden">
    @include('template/header_builder')

    <form id="structure" class="row" action="{{Request::url()}}" method="post">
        <div style="position: relative; width: 100%; height: 100%;">
            <div style="position: relative; width: 100%; height: 100%; float: left;">
                <div id="blockly" style="position: relative; height: 90vh;"></div>
            </div>

            <!--?????-->
            <input type="hidden" name="function" id="hidden_function">
            <input type="hidden" name="xml" id="xmlhidden_input" value="{{ $script->structure }}">
            <input type="hidden" name="_token" value="{{csrf_token()}}">

        </div>
    </form>
    <div id="code" style="width: 100%; height: 100%; z-index: 999">
        <ul class="tabs row">
            <li class="tab col s6 red accent-2"><a href="#tabSageCode" style="color: white;">Generated</a> </li>
            <li class="tab col s6 teal darken-1"><a href="#tabSageCodeSave" style="color: white;">Saved</a> </li>
        </ul>
        <div id="tabSageCode" style="position: relative; height: 68vh;">
            <textarea readonly id="sageCode" class="white" style="position: relative; height: 100%;"></textarea>
            <div id="btnSageCode" class="left btn waves-effect btn-flat teal accent-3">Copy to Saved</div>
        </div>
        <div id="tabSageCodeSave" style="position: relative; height: 70vh;">
            <pre id="sageCodeSave" style="position: relative; height: 100%;">{{ $script->function }}</pre>
        </div>

        <div class="row white">
            <div class="input-field col s12">
                <input name="description" id="desc" type="text" value="{{$script->description}}"/>
                <label for="desc">Beschreibung</label>
            </div>
            <input type="submit" id="saveBtn" class="teal accent-4 btn col s12" value="Save"/>
        </div>
    </div>

    @include('template/footer_main')

    {!! $content['xml'] !!}
    <script type="text/javascript" src="{{ URL::asset('js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/materialize.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/Blockly/blockly_compressed.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/Blockly/de.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/Blockly/python.js') }}"></script>
    <script>
        'use strict';
        {!! $content['structure'] !!}
    </script>
    <script>
        'use strict';
        {!! $content['function'] !!}
    </script>
    <script type="text/javascript" charset="utf-8" src="{{ URL::asset('js/Editor/ace.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/Editor/ext-language_tools.js') }}"></script>
    <script>
        ace.require("ace/ext/language_tools");
        var editor = ace.edit("sageCodeSave");
        editor.setTheme("ace/theme/monokai");
        editor.session.setMode("ace/mode/python");
        editor.setOptions({
            fontSize: "11pt",
            showInvisibles: true,
            enableBasicAutocompletion: true,
            enableSnippets: true,
            enableLiveAutocompletion: false
        });
        window.Codeeditor = editor;
    </script>
    @include('template/include_comments')

    <script type="text/javascript">

        function updateCode(){
            var mainWorkspace = Blockly.getMainWorkspace();
            var code = Blockly.Python.workspaceToCode(mainWorkspace);
            $('#sageCode').val(code);
        }

        $(document).ready(function() {
            //Comment


            $('form').submit(function(){

                var dom = Blockly.Xml.workspaceToDom(Blockly.getMainWorkspace());
                $('#xmlhidden_input').val('');
                $('#xmlhidden_input').val(Blockly.Xml.domToPrettyText(dom));
                $('#function_hidden').val(window.Codeeditor.getValue());
                return true;
            });


            $('#btnSageCode').click(function(){
                window.Codeeditor.setValue($('#sageCode').val());
            });

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
                    @if (empty($script->structure))
            var xml = '';
                    @else
            var xml = $('#xmlhidden_input').val();
            @endif

            if (xml != '') {
                Blockly.Xml.domToWorkspace(mainWorkspace, Blockly.Xml.textToDom(xml));

                mainWorkspace.clearUndo();
            }
            mainWorkspace.addChangeListener(updateCode);
        });

    </script>
</body>
</html>