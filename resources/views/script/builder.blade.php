<!DOCTYPE html>
<html lang="de" xmlns="http://www.w3.org/1999/html">
<head>
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="{{ URL::asset('css/materialize.min.css') }}"  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="{{ URL::asset('css/splitter.css') }}"  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="{{ URL::asset('css/jquery.webui-popover.min.css') }}"  media="screen,projection"/>
    <!--<link type="text/css" rel="stylesheet" href="{{ URL::asset('css/script/builder.css') }}"  media="screen,projection"/>-->
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta charset="utf-8">
    <title>Script Builder</title>
</head>
<body style="overflow-y:hidden">

    <div id="preview_modal" class="modal" style="width:100%; height:100%;">
        <div class="modal-content">
            <div id="preview_update" class="btn">Update</div><br/>
            <iframe id='sageOutput' seamless frameborder="0" style="overflow: hidden; height: 100%; width: 100%; position: absolute;" height="100%" width="100%">
            </iframe>

        </div>
    </div>
    @include('template/header_builder')

    <div style="position:absolute; left:0; top:64px; width: 100%; height: calc(100vh - 64px);" id="structure" class="row">
        <div id="blockly" style="height: 100%;"></div>
    </div>
    <form id="code" style="position:absolute; top: calc(100vh + 64px); left: 0; width: 100%; height: calc(100vh - 64px);" action="{{Request::url()}}" method="post">
        <div style="margin-top:5%; height: 100%">
            <pre id="sageCodeSave" style="height: 75%;">{{ $script->function }}</pre>

            <div class="row white" style="height: 15%">
                <div class="input-field col s12">
                    <input name="description" id="desc" type="text" value="{{$script->description}}"/>
                    <label for="desc">Beschreibung</label>
                </div>
                <input type="hidden" name="function" id="hidden_function">
                <input type="hidden" name="xml" id="xmlhidden_input" value='{{ $script->structure }}'>
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <input type="submit" id="saveBtn" class="teal accent-4 btn col s12" value="Save"/>
            </div>
        </div>
    </form>
    <a id="modal_preview_trigger" class="btn btn-floating mdi-navigation-refresh" href="#preview_modal" style="position:absolute; right: 60px; top: calc(120%);"></a>
    <div id="settingsMenuBtn" class="btn btn-floating mdi-action-settings" style="position:absolute; right: 20px; top: calc(120%);"></div>
    <div id="settingsMenu" class="row">
        @include('template/editor_themeSelector')

        <div class="input-field col s12">
            <input type="number" id="fontsize" value="13">
            <label for="fontsize">Font Size</label>
        </div>


    </div>

    @include('template/footer_main')

    {!! $content['xml'] !!}
    <script type="text/javascript" src="{{ URL::asset('js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/enhsplitter.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/slide.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/jquery.webui-popover.min.js') }}"></script>
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
    <script type="text/javascript" src="{{ URL::asset('js/Editor.js') }}"></script>
    <script>
        var f = new Factory();
        var editor = f.createEditor("sageCodeSave","python");
        editor.commands.addCommand({
            name: "insertgenerated",
            bindKey: {
                mac:        "Command-I",
                win:        "Ctrl-I"
            },
            exec: function(editor) {
                editor.setValue(editor.getValue()+"\n"+$('#hidden_function').val()); }
        });
        window.Codeeditor = editor;
    </script>
    @include('template/include_comments')

    <script type="text/javascript">

        function updateCode(){
            var code = Blockly.Python.workspaceToCode(Blockly.getMainWorkspace());
            $('#hidden_function').val(code);
        }

        $(document).ready(function() {
            $('#preview_update').click(function(){

                $.ajax({
                    url: "{{Request::url()}}/updatePreview",
                    method: "GET",
                    data: {
                        "function_temp": window.Codeeditor.getValue()
                    },
                    success: function(result){
                        var previewUrl = "{{Request::url()."/preview"}}";
                        $("#sageOutput").attr('src', previewUrl);
                    }
                });

            });
            $('#modal_preview_trigger').leanModal();

            $('form').submit(function(){

                var dom = Blockly.Xml.workspaceToDom(Blockly.getMainWorkspace());
                $('#xmlhidden_input').val('');
                $('#xmlhidden_input').val(Blockly.Xml.domToPrettyText(dom));
                $('#hidden_function').val(window.Codeeditor.getValue());
                return true;
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
                            wheel: true
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

            $('#settingsMenuBtn').webuiPopover({
                width:400,
                title:"Settings",
                height:200,
                padding:false,
                offsetTop: 50,
                dismissible: false,
                closeable:true,
                placement:'left',
                animation:'pop',
                url:'#settingsMenu'
            });


            $('#settingsMenu').hide();

            $('select').not('.disabled').material_select();
            $('.themeSelector').on('change', function(e) {
                window.Codeeditor.setTheme($('.themeSelector').val());
            });
            $('#fontsize').change(function(){
                window.Codeeditor.setFontSize($(this).val()+"px");
            });
        });

    </script>
</body>
</html>