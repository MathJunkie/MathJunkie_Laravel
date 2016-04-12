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
<body>
    @include('template/header_builder')

    <form class="sidebar row" action="{{Request::url()}}" method="post">
        <div style="position: relative; width: 100%; height: 100%;">
            <div style="position: relative; width: 50%; height: 100%; float: left;">
                <div id="blockly" style="position: relative; height: 90vh;"></div>
            </div>
            <div style="position: relative; width: 50%; height: 100%; float: right;">
                <ul class="tabs row">
                    <li class="tab col s6 red accent-2"><a href="#tabSageCode" style="color: white;">Generated</a> </li>
                    <li class="tab col s6 teal darken-1"><a href="#tabSageCodeSave" style="color: white;">Saved</a> </li>
                </ul>
                <div id="tabSageCode" style="position: relative; height: 66vh;">
                    <textarea readonly id="sageCode" class="white" style="position: relative; height: 100%;"></textarea>
                </div>
                <div id="tabSageCodeSave" style="position: relative; height: 66vh;">
                    <textarea name="function" id="sageCodeSave" class="white" style="position: relative; height: 100%;">{{ $script->function }}</textarea>
                </div>
                <div id="btnSageCode" class="btn waves-effect btn-flat teal accent-3" style="position: relative; bottom: 0px;">Copy to Saved</div>
                <div class="row white">
                    <div class="input-field col s12">
                        <input name="description" id="desc" type="text" value="{{$script->description}}"/>
                        <label for="desc">Beschreibung</label>
                    </div>
                    <input type="submit" id="saveBtn" class="teal accent-4 btn col s12" value="Save"/>
                </div>
            </div>

            <!--?????-->
            <input type="hidden" name="xml" id="xmlhidden_input" value="{{ $script->structure }}">
            <input type="hidden" name="_token" value="{{csrf_token()}}">

        </div>
    </form>

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
    <script type="text/javascript">

        function updateCode(){
            var mainWorkspace = Blockly.getMainWorkspace();
            var code = Blockly.Python.workspaceToCode(mainWorkspace);
            $('#sageCode').val(code);
        }

        $(document).ready(function() {
            //Comment
            @include('template/include_comments')

            $('form').submit(function(){

                var dom = Blockly.Xml.workspaceToDom(Blockly.getMainWorkspace());
                $('#xmlhidden_input').val('');
                $('#xmlhidden_input').val(Blockly.Xml.domToPrettyText(dom));
                return true;
            });


            $('#btnSageCode').click(function(){
                $('#sageCodeSave').val($('#sageCode').val());
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