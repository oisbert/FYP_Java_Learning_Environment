<html>
   <head>
      <title>
         Embedding an online compiler 
         into a website
      </title>
      </link>
      <script src="https://cdn.jsdelivr.net/npm/animejs@3.0.1/lib/anime.min.js"></script>
   </head>
   <link rel="stylesheet" type="text/css" href="css/checker.css?v=<?php echo time(); ?>">
   <body>

<?php
$file1 = "Staticpolymorphism.java";
//$file2 = "AnswerStaticpolymorphism.java";

$file1trim = trim($file1, ".java");
echo "<br>{$file1trim}<br>";
//$file2trim = trim($file2, ".java");
echo shell_exec("javac {$file1trim}.java && java {$file1trim}");
echo shell_exec("javac {$file1trim}.java > outputchecker.txt 2>&1");
echo nl2br(file_get_contents( "outputchecker.txt" ));
?>

</body>
</html>