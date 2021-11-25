<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>testing</title>
  <style type="text/css" media="screen">
    body {
      background-color: #ffff;
      color: #333;
      margin: 0;
      padding: 0;
    }

    .editor_container {
      text-align: center;
      width: 80%;
    }

    .editor_container form {
      margin: 45px;
      width: 80%;
      border: thin #333;
      border-radius: 8px;
      text-align: center;
    }

    .ace_gutter-cell {
      color: white;
      !important
    }
  </style>
</head>

<body>

<?php

if (file_exists("Hello.java")){
    $file = "Hello.java";
    $current = file_get_contents($file);
} 

?>
  <div class="editor_container">
    <h1>Ace Editor</h1>
    <form action="processCodecopy" method="post" id="myForm">  <!-- ID added here -->
      <input name="comment" type="text" hidden id="editortext"> <!-- hidden text field here added here-->
      <h2>Edit the CSS file</h2>
      <div id="editor" title="css edit:" style="height: 600px; width: 40%; float: left;">

      <?php
        echo $current;
        ?>
      </div>
      <br><br>
      <input type="submit" value="Submit">
    </form>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.3.3/ace.js" type="text/javascript" charset="utf-8"></script>
  <script>
    var editor = ace.edit("editor");
    editor.setTheme("ace/theme/ambiance");
    editor.session.setMode("ace/mode/java");
    document.getElementById('editor').style.fontSize = '1vw';

    // added event handler
    document.getElementById("myForm").onsubmit = function(evt) {
      document.getElementById("editortext").value = editor.getValue();
    }
  </script>

<?php
    echo exec("javac Hello.java && java Hello");
    echo shell_exec("javac Hello.java > log.txt 2>&1");
    echo nl2br(file_get_contents( "log.txt" ));
    ?>
</body>

</html>