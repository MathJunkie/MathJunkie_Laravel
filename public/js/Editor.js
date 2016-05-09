/**
 * Created by Lolololarry on 09.05.16.
 */
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