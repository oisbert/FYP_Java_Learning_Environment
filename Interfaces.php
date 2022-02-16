<!DOCTYPE html>
<html>
   <head>
      <title>
         Embedding an online compiler 
         into a website
      </title>
      </link>
      <script src="https://cdn.jsdelivr.net/npm/animejs@3.0.1/lib/anime.min.js"></script>
   </head>
   <link rel="stylesheet" type="text/css" href="css/polymorphism.css?v=<?php echo time(); ?>">
   <body>
      <?php
      include ("header.html");
      include ("validateLoggedIn.php");
      include ("serverConfig.php");
      include ("IDtoLetter.php");
      $_SESSION['user'] = $userID;
   
     $userIDtoLetters = num2alpha($userID);
      ?>
      <br>
      <div class = "excution" >
         <div class = excutionOutput >
            <?php
               if (file_exists("{$userIDtoLetters}Interfaces.java")){
                   $file = "{$userIDtoLetters}Interfaces.java";
                   $current = file_get_contents($file);
                   echo shell_exec("javac {$userIDtoLetters}Interfaces.java && java {$userIDtoLetters}Interfaces");
                   echo shell_exec("javac {$userIDtoLetters}Interfaces.java > log.txt 2>&1");
                   echo nl2br(file_get_contents( "log.txt" ));
               } 
               ?>
         </div>
      </div>
      <?php 
         function getLessonData($uID) {
            include ("serverConfig.php");
            $conn = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
            if ($conn -> connect_error) {
                die("Connection failed:" .$conn -> connect_error);
            }
         
            $sql = "select * from lessons where lessonID =\"{$uID}%\";";
            $result = $conn -> query($sql);
            $conn->close();
         
            return $result->fetch_assoc();
         }
         ?>
         <br>
         <br>
      <div class = "compiler">
         <form action="processCodeInterfaces.php" method="post" >
            <textarea data-editor = "java" rows="20" cols="55" name="comment-editor"  data-gutter="1" >
            <?php
               echo $current;
               ?>
            </textarea>
            <input type="submit" value="Compile">
         </form>
      </div>
      <br>
      <div class = "lesson-heading">
      <h1>
      What is happening in the Code
      <h1>
      </div>
      <div class = "example-poly">
         <div class = "section-1">
            <p>
               In this lesson we will look at a concept called Interfaces. An interface is an "abstract class" that groups related<br>
               methods together. The methods implemented in these in the abstract class "do not have an implementation".<br>
            </p>
            <textarea rows="11" cols="55" data-editor = "java" data-gutter="1">
            // Interface
            interface Animal {
               public void animalSound(); 
               public void NumberOfLegs(); 
            }
            </textarea>
            <p><br>The next step is to implement our interface with another class. This will allow us to access these methods in the class<br>
               On implementation of the interface we must overide all its methods<br>
            </p>
            <textarea rows="7" cols="55" data-editor = "java" data-gutter="1">
            class Lion implements Animal {
               public void animalSound() {
                  System.out.println("Rawr");
            }
               public void NumberOfLegs() {
                  System.out.println("4");
            }
         }
         </textarea>
         <br>
            <p><br>
               <br>Lets put it all together in our main class and check the output<br>
               We need to create of the class object then simply call the method<br>
            <br><br>
            </p>
            <textarea rows="20" cols="55" data-editor = "java" data-gutter="1">
            public class Interfaces {
               public static void main(String[] args) {
                  Lion myLion = new Lion();
                  Duck myDuck = new Duck();  
                  myLion.animalSound();
                  myLion.NumberOfLegs();
                  myDuck.animalSound();
                  myDuck.NumberOfLegs();
            }
         }
         </textarea>
         <br>
         <br>
         <h2>notes on Interfaces</h2>
            <p>
            
            •	Interfaces cannot be used to construct objects <br>
            (in the example above, it is not possible to create an "Animal" object in the MyMainClass)<br><br>
            •	Interface methods do not have a body - the body is provided by the "implement" class<br><br>
            •	When implementing an interface you must override all of its methods<br><br>
            •	Interfaces cannot contain constructors <br>

              
            </p>
            <br>
         </div>
      </div>
      </div>
      

      <div class ="lesson-area">
      <H1>Chalkboard Notes <H1>
         <?php
            $sql = "SELECT description
              FROM lessons 
              WHERE lessonID = 3;";
            $result =  $conn->query($sql);
            
            if($row = $result->fetch_assoc()) {
              print "<p class='userDetails text-left'>{$row['description']}</p>";
            } else {
              print "<p class='text-left'>No notes here.</p>";
            }
            ?>
      </div>    
      <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.2.6/ace.js" type="text/javascript" charset="utf-8"></script>
      <script src="js/syntax.js" type="text/javascript"></script>
      <script src="js/mode-java" type="text/javascript"></script>
      <script src="js/animatePolyLesson" type="text/javascript"></script>
   </body>
</html>
