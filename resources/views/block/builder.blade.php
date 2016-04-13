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
<body>
    @include('template/header_builder')

    <form class="mainContent" action="{{Request::url()}}" method="post">
        <div style="position: relative; width: 100%; height: 100%;">
            <!--left-->
            <div style="position: relative; width: 50%; height: 100%; float: left;">
                <div id="blockly" style="position: relative; height: calc(100vh - 240px)"></div>
                <div class="row white" style="position: relative; bottom: 0px; left: 0px; width: 100%; height: 150px;">
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
            </div>
            <!--right-->
            <div class="teal accent-2" style="position: relative; width: 50%; height: 100%; float: right;">
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
                <ul class="tabs">
                    <li class="tab col s6 red accent-2"><a href="#tabBlockCode" style="color: white;">Generated</a> </li>
                    <li class="tab col s6 teal darken-1"><a href="#tabBlockCodeSave" style="color: white;">Saved</a> </li>
                </ul>
                <div id="tabBlockCode" style="position: relative; height: 28vh;">
                    <textarea readonly id="blockCode" class="white" style="position: relative; height:100%;"></textarea>
                </div>
                <div id="tabBlockCodeSave" style="position: relative; height: 28vh;">
                    <textarea name="structure" id="blockCodeSave" class="white" style="position: relative; height:100%;">{{ $block->structure }}</textarea>
                </div>
                <ul style="position: relative; bottom: 8px;">
                    <li><a id="btnBlockCode" class="btn waves-effect btn-flat teal accent-3 left">Copy to Saved</a></li>
                    <li><a id="btnSageCode" class="btn waves-effect btn-flat teal accent-3 right">Copy to Saved</a></li>
                </ul>
                <ul class="tabs">
                    <li class="tab col s6 red accent-2"><a href="#tabSageCode" style="color: white;">Generated</a> </li>
                    <li class="tab col s6 teal darken-1"><a href="#tabSageCodeSave" style="color: white;">Saved</a> </li>
                </ul>
                <div id="tabSageCode" style="position: relative; height: 28vh;">
                    <textarea readonly id="sageCode" class="white" style="position: relative; height: 100%;"></textarea>
                </div>
                <div id="tabSageCodeSave" style="position: relative; height: 28vh;">
                    <textarea name="function" id="sageCodeSave" class="white" style="position: relative; height: 100%;">{{ $block->function }}</textarea>
                </div>

                <!--Necessary to save the xml data of the builder and we need to generate a token for the laravel framework-->
                <input type="hidden" name="xml" id="xmlhidden_input" value="{{ $block->xml }}">
                <input type="hidden" name="_token" value="{{csrf_token()}}">

            </div>
        </div>
    </form>

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
@include('template/include_comments')
<script type="text/javascript">
    $(document).ready(function(){

        $('form').submit(function(){
            //$('#sageCodeSave').val(encodeURI($('#sageCodeSave').val()));
            //$('#blockCodeSave').val(encodeURI($('#blockCodeSave').val()));

            var dom = Blockly.Xml.workspaceToDom(window.mainWorkspace);
            //$('#xmlhidden_input').val(encodeURI(Blockly.Xml.domToText(dom)));
            $('#xmlhidden_input').val('');
            $('#xmlhidden_input').val(Blockly.Xml.domToPrettyText(dom));
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