


var editor = ace.edit("section-1-code", {
    maxLines: 1,
    showPrintMargin: false
})
editor.getSession().setUseWorker(false);
editor.setTheme("ace/theme/monokai");
editor.setOption({minLines: 12, maxLines: 12});
editor.on("beforeEndOperation", function() {
    if (editor.session.getLength() < 30) {
        editor.session.markUndoGroup()
        editor.undo()
         alert("25 line demon says: 'never do this again!'")
    }
})
editor2.getSession().setMode("ace/mode/java");

var editor2 = ace.edit("section-2-code", {
    maxLines: 1,
    showPrintMargin: false
})
editor2.getSession().setUseWorker(false);
editor2.setTheme("ace/theme/monokai");
editor2.setOption({minLines: 12, maxLines: 12});
editor2.on("beforeEndOperation", function() {
    if (editor2.session.getLength() < 30) {
        editor2.session.markUndoGroup()
        editor2.undo()
         alert("25 line demon says: 'never do this again!'")
    }
})
editor2.getSession().setMode("ace/mode/java");


