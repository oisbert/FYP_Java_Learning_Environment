<!DOCTYPE html>
<html>
   <head>
      <title>
         Lesson Page Object and Classes
      </title>
      </link>
      <script src="https://cdn.jsdelivr.net/npm/animejs@3.0.1/lib/anime.min.js"></script>
   </head>
   <link rel="stylesheet" type="text/css" href="css/objectAndclasses.css?v=<?php echo time(); ?>">
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
               if (file_exists("{$userIDtoLetters}Car.java")){
                  //store file in a variable called file
                   $file = "{$userIDtoLetters}Car.java";
                   //get the contents of the file and store in current
                   $current = file_get_contents($file);
                   //echo what the file executes
                   echo shell_exec("javac {$userIDtoLetters}Car.java && java {$userIDtoLetters}Car");
                   //echo and log errors if code fails to compile
                   echo shell_exec("javac {$userIDtoLetters}Car.java > log.txt 2>&1");
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
         <form action="processCodeOC.php" method="post" >
             <!--load the data editor javascript onto the text box to syntax highlight the code-->
            <textarea data-editor = "java" rows="20" cols="55" name="comment-editor"  data-gutter="1" >
            <?php
            //load the current code into the editor 
               echo $current;
               ?>
            </textarea>
            <!--create submit button to execute the code and send it to processCodeOC.php-->
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
      <div class = "example-poly">
         <div class = "section-1">
            <p>During this sections we will be discussing classes and object. 
               Before we jump into these topics however we will look at an important sub-topic constructors.
               Every class has a constructor. If we do not explicitly state the constructor the java compiler builds a default one for that class.
               Each time an object is created at least one constructor will be invoked. 
               The main rule of thumb for constructors is that they “must have the same name as the class”.
            </p>
<textarea rows="11" cols="55" data-editor = "java" data-gutter="1">
public class Car {
   double engineSize;
public Car(String brand) {
   System.out.println("This car is a :" + brand );
      }
            </textarea>
            <p>
               As we can see we have created a class called Car and also a constructor with the same name Car. Within this constructor we can set the brand of Car. <br><br>
               Know that we have a bit more of an understanding of Constructors lets have a look at the key differences between a class and object.<br>
               A class is described as a blueprint from which individual objects are created. <br><br>
               A class can contain the following Variable types:<br>
               -	Local variables are variables that are specified within methods, constructors, or blocks. The variable will be defined and initialized within the method, and then deleted after the method is finished.<BR><BR>
               -	Instance variables are variables that exist within a class but are not part of any method. When the class is created, these variables are set to their default values. Instance variables can be accessed from within any of the class's methods, constructors, or blocks.<BR><BR>
               -	Class variables are variables defined with the static keyword within a class, outside of any method.<BR><br>

               A class can have many methods. In our example we have the methods setEngineSize(), getEngineSize() and Beep().

               
            </p>
            <textarea rows="3" cols="55" data-editor = "java" data-gutter="1">
            public class BCar {
   double engineSize;

   public BCar(String brand) {
      System.out.println("This car is a :" + brand );
   }

   public void setEngineSize(double size) {
      engineSize = size;
   }

   public double getEngineSize( ) {
      System.out.println("BCars engine size is :" + engineSize );
      return engineSize;
   }

   public void Beep(){
      System.out.println("Beep, Beep");
   }
         </textarea>
         <br>
            <p>As mentioned earlier an object is created from a class. In Java, the new keyword is used to create new objects.<br><br>
               There is three key steps we must remember when creating an object from a class in java.<br>
               -	Declaration − A variable declaration with a variable name with an object type.<br>
               -	Instantiation − The new keyword is used to create the object.<br>
               -	Initialization − The new keyword is followed by a call to a constructor. This call initializes the new object.<br><br>
               The below code is and example of creating an object:
            </p>
            <textarea rows="20" cols="55" data-editor = "java" data-gutter="1">
            public static void main(String []args) {
               Car myCar = new Car( "Audi" );

               myCar.setEngineSize(1.6);

               myCar.getEngineSize();
         </textarea>
         
         </div>
      </div>
      </div>
      
      <!--This is the area where the chalkboard is created loads lesson data from lessonID 2-->
      <div class ="lesson-area">
      <H1>Chalkboard Notes <H1>
         <?php
            $sql = "SELECT description
              FROM lessons 
              WHERE lessonID = 2;";
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
