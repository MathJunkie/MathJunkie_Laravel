/**
 * Created by Bomberus on 12.04.2016.
 */
'use strict';

Blockly.Blocks['factory_base'] = {
    // Base of new block.
    init: function() {
        this.setColour(120);
        this.appendDummyInput()
            .appendField('name')
            .appendField(new Blockly.FieldTextInput(window.BlockName), 'NAME');
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