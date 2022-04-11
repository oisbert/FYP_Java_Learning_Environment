$(function() {
    $('textarea[data-editor]').each(function() { //if a text area had the tag data editor apply this function
      var textarea = $(this); //apply this function to text area store in variable
      var mode = textarea.data('editor'); //set the mode of the text editor using "editor "
      var editDiv = $('<div>', { //edit the css for the hidden text box 
        position: 'absolute',
        width: textarea.width(),
        height: textarea.height(), //edit the current div settings 
      }).insertBefore(textarea); //insert this before the text editor
      textarea.css('display', 'none'); //hide the text area
      var editor = ace.edit(editDiv[0]);
  
      //render compiler settings
      editor.renderer.setShowGutter(textarea.data('gutter'));
      editor.getSession().setValue(textarea.val()); //load the text value content into ace.js
      editor.getSession().setMode("ace/mode/" + mode);
      editor.setTheme("ace/theme/monokai");
  
      // copy back to textarea on form submit...
      textarea.closest('form').submit(function() { //copies contents to the closest form e.g. the hidden one 
      textarea.val(editor.getSession().getValue()); 
      })
    });
  });