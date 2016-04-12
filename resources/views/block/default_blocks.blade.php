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