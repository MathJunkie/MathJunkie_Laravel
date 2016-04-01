<!DOCTYPE html>
<html lang="de">
<head>
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="{{ URL::asset('css/materialize.min.css') }}"  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="{{ URL::asset('css/builder/builder.css') }}"  media="screen,projection"/>

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta charset="utf-8">
    <title>BlockBuilder</title>
</head>
<body class="grey darken-2">
    <div class="blue darken-3 center" height="50px" width="100%">
        <img height="50px" src="{{URL::asset('images/Icon.png')}}" style="vertical-align: middle;" class="brand-logo center" alt="Logo"/>
        <span class="center-align shadow-text">MathJunkie - Who said Math has to be difficult and ugly?</span>
    </div>
    <div class="mainContent">
       <div class="row">
           <div id="blockly" class="sidebar red col s6"></div>
           <div class="col s6">
               <div class="switch white">
                   <label>
                       Generierten
                       <input id="selPreview" type="checkbox">
                       <span class="lever"></span>
                       Gespeicherten
                   </label>
               </div>
               <div id="preview" class="blue" ></div>
                   <div>
                       <ul class="tabs">
                           <li class="tab col s6"><a href="#tabBlockCode">Generated</a> </li>
                           <li class="tab col s6"><a href="#tabBlockCodeSave">Saved</a> </li>
                       </ul>
                   </div>
                   <div id="tabBlockCode">
                       <textarea readonly id="blockCode" class="yellow" ></textarea>
                       <div id="btnBlockCode" class="btn waves-effect btn-flat green">Copy to Saved</div>
                   </div>
                   <div id="tabBlockCodeSave"><textarea id="blockCodeSave" class="yellow" ></textarea></div>
                   <div>
                       <ul class="tabs">
                           <li class="tab col s6"><a href="#tabSageCode">Generated</a> </li>
                           <li class="tab col s6"><a href="#tabSageCodeSave">Saved</a> </li>
                       </ul>
                   </div>
                   <div id="tabSageCode">
                       <textarea readonly id="sageCode" class="blue" ></textarea>
                       <div id="btnSageCode" class="btn waves-effect btn-flat green">Copy to Saved</div>
                   </div>
                   <div id="tabSageCodeSave"><textarea id="sageCodeSave" class="blue" ></textarea></div>
           </div>
       </div>
       <div class="row"></div>
    </div>
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
<script type="text/javascript" src="{{ URL::asset('js/Blockly/factory_blocks.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/Blockly/python.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/Blockly/de.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/Blockly/factory.js') }}"></script>
@foreach ($errors->all() as $error)
    <script>Materialize.toast("{{$error}}",3000)</script>
@endforeach


</html>