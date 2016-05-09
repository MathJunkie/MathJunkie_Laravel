<!DOCTYPE html>
<html lang="de">
<head>
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="{{ URL::asset('css/materialize.min.css') }}"  media="screen,projection"/>
    <!--<link type="text/css" rel="stylesheet" href="{{ URL::asset('css/builder/builder.css') }}"  media="screen,projection"/>-->
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta charset="utf-8">
    <title>BlockBuilder</title>
</head>
<body style="overflow-y: hidden">

<div id="preview_modal" class="modal">
    <div class="modal-content">
        <div class="teal accent-3" style="height: 25px;">
            <div class="switch right" style="position: relative; right: 5px;">
                <label>
                    <i style="color: black;">Generierten</i>
                    <input id="selPreview" type="checkbox">
                    <span class="lever"></span>
                    <i style="color: black;">Gespeicherten</i>
                </label>
            </div>
        </div>
        <div id="preview" style="position: relative; height: 15vh;">
            <!-- review -->
        </div>
    </div>
</div>

    @include('template/header_builder')
          <!--top-->
        <form action="{{Request::url()}}" method="post" style="width: 100%;">
                <div id="blockly" style="height: calc(90vh - 150px)"></div>
                <div class="row white" style="width: 100%; height: calc(10vh - 150px)">
                    <input type="submit" class="teal accent-4 btn col s4" style="position: relative; top: 15px;" value="Save" />
                    <div class="input-field col s8">
                        <input name="category" id="cate" type="text" value="{{$block->category}}"/>
                        <label for="cate">Category</label>
                    </div>
                    <div class="input-field col s12">
                        <input name="description" id="desc" type="text" value="{{$block->description}}"/>
                        <label for="desc">Description</label>
                    </div>
                </div>
                <input type="hidden" name="structure" id="structure_hidden">
                <input type="hidden" name="function" id="function_hidden">
                <input type="hidden" name="xml" id="xmlhidden_input" value="{{ $block->xml }}">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
        </form>
            <!--down-->

        <div class="teal accent-2" style="width: 100%; height: 105vh">
                <ul class="collapsible" data-collapsible="accordion">
                    <li>
                        <div class="collapsible-header">Structure</div>
                        <div class="collapsible-body">
                            <ul class="tabs">
                                <li class="tab col s6 red accent-2"><a href="#tabBlockCode" style="color: white;">Generated</a> </li>
                                <li class="tab col s6 teal darken-1"><a href="#tabBlockCodeSave" style="color: white;">Saved</a> </li>
                            </ul>
                            <div id="tabBlockCode" style="height: 75vh;">
                                <textarea readonly id="blockCode" class="white" style="position: relative; height:calc(100% - 100px)"></textarea>
                                <a id="btnBlockCode" style="height:30px" class="btn waves-effect btn-flat teal accent-1">Copy to Saved</a>
                            </div>
                            <div id="tabBlockCodeSave" style="position: relative; height: 75vh;">
                                <pre id="blockCodeSave" style="position: relative; height:100%;">{{ $block->structure }}</pre>
                            </div>

                        </div>
                    </li>
                    <li>
                        <div class="collapsible-header">Generating Code</div>
                        <div class="collapsible-body">
                            <ul class="tabs">
                                <li class="tab col s6 red accent-2"><a href="#tabSageCode" style="color: white;">Generated</a> </li>
                                <li class="tab col s6 teal darken-1"><a href="#tabSageCodeSave" style="color: white;">Saved</a> </li>
                            </ul>
                            <div id="tabSageCode" style="height: 75vh;">
                                <textarea readonly id="sageCode" class="white" style="position: relative; height:calc(100% - 100px)"></textarea>
                                <a id="btnSageCode" style="height:30px" class=" btn waves-effect btn-flat teal accent-1">Copy to Saved</a>
                            </div>
                            <div id="tabSageCodeSave" style="height: 75vh;">
                                <pre id="sageCodeSave" style="width: 100%;height: 100%;">{{ $block->function }}</pre>
                            </div>

                        </div>
                    </li>
                </ul>

                <!--Necessary to save the xml data of the builder and we need to generate a token for the laravel framework-->
            </div>

    @include('template/footer_main')
    @include('block/default_blocks')

</body>
<script type="text/javascript" src="{{ URL::asset('js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/materialize.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/Blockly/blockly_compressed.js') }}"></script>
<script> window.BlockName = '{{$block->name}}' </script>
<script type="text/javascript" src="{{ URL::asset('js/Blockly/factory_base.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/Blockly/factory_blocks.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/Blockly/python.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/Blockly/de.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/Blockly/factory.js') }}"></script>
<script type="text/javascript" charset="utf-8" src="{{ URL::asset('js/Editor/ace.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/Editor/ext-language_tools.js') }}"></script>
<script>
    ace.require("ace/ext/language_tools");

    function Factory() {
        this.createEditor = function (id,type) {
            var editor = ace.edit(id);

            if(type === "javascript"){
                new JavascriptEditor(editor);
            } else if(type === "phyton"){
                new PhytonEditor(editor);
            }

            editor.setTheme("ace/theme/monokai");
            editor.setOptions({
                fontSize: "11pt",
                enableBasicAutocompletion: true,
                enableSnippets: true,
                enableLiveAutocompletion: false
            });
            return editor;
        }
    }

    var JavascriptEditor = function (e) {
        e.session.setMode("ace/mode/javascript");
    };

    var PhytonEditor = function (e) {
        e.session.setMode("ace/mode/python");
    };


</script>
@include('template/include_comments')
<script type="text/javascript">
    $(document).ready(function(){

        $('.collapsible').collapsible({
            accordion : false // A setting that changes the collapsible behavior to expandable instead of the default accordion style
        });

        $('form').submit(function(){
            //$('#sageCodeSave').val(encodeURI($('#sageCodeSave').val()));
            //$('#blockCodeSave').val(encodeURI($('#blockCodeSave').val()));

            var dom = Blockly.Xml.workspaceToDom(window.mainWorkspace);
            //$('#xmlhidden_input').val(encodeURI(Blockly.Xml.domToText(dom)));
            $('#xmlhidden_input').val('');
            $('#xmlhidden_input').val(Blockly.Xml.domToPrettyText(dom));

            $('#structure_hidden').val(window.Structeditor.getValue());
            $('#function_hidden').val(window.Codeeditor.getValue());
            return true;
        });


    var toolbox = document.getElementById('toolbox');
    var
            mainWorkspace = Blockly.inject('blockly',
                    {
                        collapse: false,
                        toolbox: toolbox,
                        media: '../../media/'
                    });
        window.mainWorkspace = mainWorkspace;
    // Create the root block.
        @if (empty($block->xml))
            var xml = '<xml><block type="factory_base" deletable="false" movable="false"></block></xml>';
        @else
            var xml = $('#xmlhidden_input').val();
        @endif

    Blockly.Xml.domToWorkspace(mainWorkspace, Blockly.Xml.textToDom(xml));

    mainWorkspace.clearUndo();

    mainWorkspace.addChangeListener(updateLanguage);});
</script>


</html>