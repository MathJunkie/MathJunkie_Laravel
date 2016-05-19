<!DOCTYPE html>
<html lang="de">
<head>
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="{{ URL::asset('css/materialize.min.css') }}"  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="{{ URL::asset('css/splitter.css') }}"  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="{{ URL::asset('css/jquery.webui-popover.min.css') }}"  media="screen,projection"/>
    <!--<link type="text/css" rel="stylesheet" href="{{ URL::asset('css/builder/builder.css') }}"  media="screen,projection"/>-->
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta charset="utf-8">
    <title>BlockBuilder</title>
</head>
<body style="overflow-y: hidden">

@include('template/header_builder')
        <!--top-->
<form action="{{Request::url()}}" method="post" style="position:absolute; left:0; top:64px; width: 100%; height: calc(100vh - 64px);">
    <div id="blocklyFactory" style="height: calc(100% - 200px)">
        <div id="blockly"></div>
        <div id="blockly_preview"></div>
    </div>
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
    <input type="hidden" name="function"  id="function_hidden">
    <input type="hidden" name="xml" id="xmlhidden_input" value="{{ $block->xml }}">
    <input type="hidden" name="_token" value="{{csrf_token()}}">
</form>
<!--down-->
<div id="settingsMenuBtn" class="btn btn-floating mdi-action-settings" style="position:absolute; right: 20px; top: calc(100vh + 84px);"></div>
<div style="position:absolute; top: calc(100vh + 64px); left: 0; width: 100%; height: calc(100vh - 64px);">
    <div id="editors" class="teal accent-2" style="height: 100%">
        <div>
            <h4 style="line-height: 10%">Structure Editor(Ctrl-I)</h4>
            <div id="editors-preview" style="height: 90%;">
                <div id="preview"></div>
                <pre id="blockCodeSave">{{ $block->structure }}</pre>
            </div>
        </div>
        <div>
            <h4 style="line-height: 10%">Code Editor(Ctrl-I)</h4>
            <div id="previewCode" class="green" style="padding:10px; height: 10%;"></div>
            <pre id="sageCodeSave" style="height: 80%;">{{ $block->function }}</pre>
        </div>
    </div>
</div>
@include('block/default_blocks')

<div id="settingsMenu" class="row">
    <div class="switch center">
        <label>
            <i style="color: black;">Preview generierten Block</i>
            <input id="selPreview" type="checkbox">
            <span class="lever"></span>
            <i style="color: black;">Preview code Block</i>
        </label>
    </div>

    @include('template/editor_themeSelector')

    <div class="input-field col s12">
        <input type="number" id="fontsize" value="13">
        <label for="fontsize">Font Size</label>
    </div>


</div>

<script type="text/javascript" src="{{ URL::asset('js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/slide.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/enhsplitter.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/jquery.webui-popover.min.js') }}"></script>
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
<script type="text/javascript" src="{{ URL::asset('js/Editor.js') }}"></script>
<script>
    var editorFactory = new Factory();

    var editor = editorFactory.createEditor("sageCodeSave","javascript");
    editor.commands.addCommand({
        name: "insertgenerated",
        bindKey: {
            mac:        "Command-I",
            win:        "Ctrl-I"
        },
        exec: function(editor) {
            editor.setValue(editor.getValue()+"\n"+$('#function_hidden').val()); }
    });
    window.Codeeditor = editor;

    editor = editorFactory.createEditor("blockCodeSave","javascript");
    editor.commands.addCommand({
        name: "insertgenerated",
        bindKey: {
            mac:        "Command-I",
            win:        "Ctrl-I"
        },
        exec: function(editor) {
            editor.setValue(editor.getValue()+"\n"+$('#structure_hidden').val()); }
    });

    window.Structeditor = editor;
</script>
@include('template/include_comments')
<script type="text/javascript">
    $(document).ready(function() {

        $('.collapsible').collapsible({
            accordion: false // A setting that changes the collapsible behavior to expandable instead of the default accordion style
        });

        $('form').submit(function () {
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

    Blockly.Xml.domToWorkspace(Blockly.Xml.textToDom(xml),mainWorkspace);

        mainWorkspace.clearUndo();

        mainWorkspace.addChangeListener(updateLanguage);

    });

    var slaveWorkspace = Blockly.inject('blockly_preview',
            {readOnly: true});

    jQuery(function ($) {
        $('#editors').enhsplitter({
            leftMinSize: 0,
            invisible: true,
            onDragEnd: function(){
                window.Codeeditor.resize();
                window.Structeditor.resize();
            }
        });
        $('#editors-preview').enhsplitter({
            position: 50,
            invisible: true,
            vertical:false,
            onDragEnd: function(){
                window.Codeeditor.resize();
                window.Structeditor.resize();
            }});
        $('#blocklyFactory').enhsplitter({
            position: '90%',
            invisible: false,
            onDragEnd: function(){
                window.Codeeditor.resize();
                window.Structeditor.resize();
            }});
    });

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
        window.Structeditor.setTheme($('.themeSelector').val());
    });
    $('#fontsize').change(function(){
        window.Codeeditor.setFontSize($(this).val()+"px");
        window.Structeditor.setFontSize($(this).val()+"px");
    });

</script>
@include('template/footer_main')
</body>
</html>