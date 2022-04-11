<!DOCTYPE html>
<html>
   <head>
      <!--The following is the lessons page for Interfaces-->
      <title>
        Lesson Page Interfaces
      </title>
      </link>
      <script src="https://cdn.jsdelivr.net/npm/animejs@3.0.1/lib/anime.min.js"></script>
   </head>
   <link rel="stylesheet" type="text/css" href="css/interface.css?v=<?php echo time(); ?>">
   <body>
      <?php
      include ("header.html");
      include ("validateLoggedIn.php");
      include ("serverConfig.php");
      include ("IDtoLetter.php");
      $_SESSION['user'] = $userID;
      //convert userID to letters needed later
     $userIDtoLetters = num2alpha($userID);
      ?>
      <br>
      <div class = "excution" >
         <div class = excutionOutput >
            <?php
               //check is the file has been generated
               if (file_exists("{$userIDtoLetters}Interfaces.java")){
                  //store file in a variable called file
                   $file = "{$userIDtoLetters}Interfaces.java";
                   //get the contents of the file and store in current
                   $current = file_get_contents($file);
                   echo shell_exec("javac {$userIDtoLetters}Interfaces.java && java {$userIDtoLetters}Interfaces");
                   //echo and log errors if code fails to compile
                   echo shell_exec("javac {$userIDtoLetters}Interfaces.java > log.txt 2>&1");
                   echo nl2br(file_get_contents( "log.txt" ));
               } 
               ?>
         </div>
      </div>
      <?php 
          //gather the lesson data from database for the chalkboard 
         function getLessonData($uID) {
            include ("serverConfig.php");
            $conn = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
            if ($conn -> connect_error) {
                die("Connection failed:" .$conn -> connect_error);
            }
            //select all from lessons where lessonID is this lessons
            $sql = "select * from lessons where lessonID =\"{$uID}%\";";
            $result = $conn -> query($sql);
            $conn->close();
         
            return $result->fetch_assoc();
         }
         ?>
         <br>
         <br>
       <!--create the compiler box-->
      <div class = "compiler">
         <!--create the compiler form to execute the code-->
         <form action="processCodeInterfaces.php" method="post" >
             <!--load the data editor javascript onto the text box to syntax highlight the code-->
            <textarea data-editor = "java" rows="20" cols="55" name="comment-editor"  data-gutter="1" >
            <?php
               //load the current code into the editor 
               echo $current;
               ?>
            </textarea>
            <!--create submit button to execute the code and send it to processCode.php-->
            <input type="submit" value="Compile">
         </form>
      </div>
      <br>
      <!--The following is the body of the lesson (explanation of what is happening in the code)-->
      <div class = "lesson-heading">
      <h1>
      What is happening in the Code
      <h1>
      </div>
      <div class = "example-Interface">
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
      
<!--This is the area where the chalkboard is created loads lesson data from lessonID 3-->
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
      <script src="js/syntaxCompiler.js" type="text/javascript"></script>
      <script src="js/animatePolyLesson" type="text/javascript"></script>
   </body>
</html>
