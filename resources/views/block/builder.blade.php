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
                    <a type="submit" class="teal accent-4 btn col s4" style="position: relative; top: 15px;">Save</a>
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
    
    <xml id="toolbox" style="display: none">
        <category name="Input">
            <block type="input_value">
                <value name="TYPE">
                    <shadow type="type_null"></shadow>
                </value>
            </block>
            <block type="input_statement">
                <value name="TYPE">
                    <shadow type="type_null"></shadow>
                </value>
            </block>
            <block type="input_dummy"></block>
        </category>
        <category name="Field">
            <block type="field_static"></block>
            <block type="field_input"></block>
            <block type="field_angle"></block>
            <block type="field_dropdown"></block>
            <block type="field_checkbox"></block>
            <block type="field_colour"></block>
            <!--
            Date picker commented out since it increases footprint by 60%.
            Add it only if you need it.  See also goog.require in blockly.js.
            <block type="field_date"></block>
            -->
            <block type="field_variable"></block>
            <block type="field_image"></block>
        </category>
        <category name="Type">
            <block type="type_group"></block>
            <block type="type_null"></block>
            <block type="type_boolean"></block>
            <block type="type_number"></block>
            <block type="type_string"></block>
            <block type="type_list"></block>
            <block type="type_other"></block>
        </category>
        <category name="Colour" id="colourCategory">
            <block type="colour_hue"><mutation colour="20"></mutation><field name="HUE">20</field></block>
            <block type="colour_hue"><mutation colour="65"></mutation><field name="HUE">65</field></block>
            <block type="colour_hue"><mutation colour="120"></mutation><field name="HUE">120</field></block>
            <block type="colour_hue"><mutation colour="160"></mutation><field name="HUE">160</field></block>
            <block type="colour_hue"><mutation colour="210"></mutation><field name="HUE">210</field></block>
            <block type="colour_hue"><mutation colour="230"></mutation><field name="HUE">230</field></block>
            <block type="colour_hue"><mutation colour="260"></mutation><field name="HUE">260</field></block>
            <block type="colour_hue"><mutation colour="290"></mutation><field name="HUE">290</field></block>
            <block type="colour_hue"><mutation colour="330"></mutation><field name="HUE">330</field></block>
        </category>
    </xml>
</body>
<script type="text/javascript" src="{{ URL::asset('js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/materialize.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/Blockly/blockly_compressed.js') }}"></script>
<script type="text/javascript">
    'use strict';

    Blockly.Blocks['factory_base'] = {
        // Base of new block.
        init: function() {
            this.setColour(120);
            this.appendDummyInput()
                    .appendField('name')
                    .appendField(new Blockly.FieldTextInput('{{ $block->name  }}'), 'NAME');
            this.appendStatementInput('INPUTS')
                    .setCheck('Input')
                    .appendField('inputs');
            var dropdown = new Blockly.FieldDropdown([
                ['automatic inputs', 'AUTO'],
                ['external inputs', 'EXT'],
                ['inline inputs', 'INT']]);
            this.appendDummyInput()
                    .appendField(dropdown, 'INLINE');
            dropdown = new Blockly.FieldDropdown([
                        ['no connections', 'NONE'],
                        ['← left output', 'LEFT'],
                        ['↕ top+bottom connections', 'BOTH'],
                        ['↑ top connection', 'TOP'],
                        ['↓ bottom connection', 'BOTTOM']],
                    function(option) {
                        this.sourceBlock_.updateShape_(option);
                    });
            this.appendDummyInput()
                    .appendField(dropdown, 'CONNECTIONS');
            this.appendValueInput('COLOUR')
                    .setCheck('Colour')
                    .appendField('colour');
            this.setTooltip('Build a custom block by plugging\n' +
                    'fields, inputs and other blocks here.');
            this.setHelpUrl(
                    'https://developers.google.com/blockly/custom-blocks/block-factory');
        },
        mutationToDom: function() {
            var container = document.createElement('mutation');
            container.setAttribute('connections', this.getFieldValue('CONNECTIONS'));
            return container;
        },
        domToMutation: function(xmlElement) {
            var connections = xmlElement.getAttribute('connections');
            this.updateShape_(connections);
        },
        updateShape_: function(option) {
            var outputExists = this.getInput('OUTPUTTYPE');
            var topExists = this.getInput('TOPTYPE');
            var bottomExists = this.getInput('BOTTOMTYPE');
            if (option == 'LEFT') {
                if (!outputExists) {
                    this.appendValueInput('OUTPUTTYPE')
                            .setCheck('Type')
                            .appendField('output type');
                    this.moveInputBefore('OUTPUTTYPE', 'COLOUR');
                }
            } else if (outputExists) {
                this.removeInput('OUTPUTTYPE');
            }
            if (option == 'TOP' || option == 'BOTH') {
                if (!topExists) {
                    this.appendValueInput('TOPTYPE')
                            .setCheck('Type')
                            .appendField('top type');
                    this.moveInputBefore('TOPTYPE', 'COLOUR');
                }
            } else if (topExists) {
                this.removeInput('TOPTYPE');
            }
            if (option == 'BOTTOM' || option == 'BOTH') {
                if (!bottomExists) {
                    this.appendValueInput('BOTTOMTYPE')
                            .setCheck('Type')
                            .appendField('bottom type');
                    this.moveInputBefore('BOTTOMTYPE', 'COLOUR');
                }
            } else if (bottomExists) {
                this.removeInput('BOTTOMTYPE');
            }
        }
    };
</script>
<script type="text/javascript" src="{{ URL::asset('js/Blockly/factory_blocks.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/Blockly/python.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/Blockly/de.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/Blockly/factory.js') }}"></script>
<script type="text/javascript">
    function reload_comment(){
        $('#navBar').load("{{Request::root()}}/comment/{{$block->id}}/block_list", function(){
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
                        'idScript' : '{{$block->id}}'
                    },
                    success: function(result){
                        reload_comment();
                    }
                });
            });
        });
    }

    $(document).ready(function(){


        $('form').submit(function(){
            //$('#sageCodeSave').val(encodeURI($('#sageCodeSave').val()));
            //$('#blockCodeSave').val(encodeURI($('#blockCodeSave').val()));

            var dom = Blockly.Xml.workspaceToDom(Blockly.getMainWorkspace());
            //$('#xmlhidden_input').val(encodeURI(Blockly.Xml.domToText(dom)));
            $('#xmlhidden_input').val('');
            $('#xmlhidden_input').val(Blockly.Xml.domToPrettyText(dom));
            return true;
        });

        //Comment
        reload_comment();

    var toolbox = document.getElementById('toolbox');
    var
            mainWorkspace = Blockly.inject('blockly',
                    {
                        collapse: false,
                        toolbox: toolbox,
                        media: '../../media/'
                    });

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
@foreach ($errors->all() as $error)
    <script>Materialize.toast("{{$error}}",3000)</script>
@endforeach


</html>