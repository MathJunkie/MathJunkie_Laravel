/**
 * Created by Bomberus on 28.03.2016.
 */
var workspace = Blockly.inject('blockly',
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