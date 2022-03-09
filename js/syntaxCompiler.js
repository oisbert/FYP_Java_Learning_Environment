$(function() {
    $('textarea[data-editor]').each(function() {
      var textarea = $(this);
      var mode = textarea.data('editor');
      var editDiv = $('<div>', {
        position: 'absolute',
        width: textarea.width(),
        height: textarea.height(), //edit the current div settings 
      }).insertBefore(textarea);
      textarea.css('display', 'none'); //edit text area on function
      var editor = ace.edit(editDiv[0]);
  
      //render compiler settings
      editor.renderer.setShowGutter(textarea.data('gutter'));
      editor.getSession().setValue(textarea.val()); //load the text value content into ace.js
      editor.getSession().setMode("ace/mode/" + mode);
      editor.setTheme("ace/theme/monokai");
  
      // copy back to textarea on form submit...
      textarea.closest('form').submit(function() {
      textarea.val(editor.getSession().getValue());
      })
    });
  });