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
      $_SESSION['user'] = $userID;
      function num2alpha($n) {
         $r = '';
         for ($i = 1; $n >= 0 && $i < 10; $i++) {
         $r = chr(0x41 + ($n % pow(26, $i) / pow(26, $i - 1))) . $r;
         $n -= pow(26, $i);
         }
         return $r;
     }

     $userIDtoLetters = num2alpha($userID);
      ?>
      <br>
      <div class = "excution" >
         <div class = excutionOutput >
            <?php
               if (file_exists("{$userIDtoLetters}Polymorphism.java")){
                   $file = "{$userIDtoLetters}Polymorphism.java";
                   $current = file_get_contents($file);
                   echo shell_exec("javac {$userIDtoLetters}Polymorphism.java && java {$userIDtoLetters}Polymorphism");
                   echo shell_exec("javac {$userIDtoLetters}Polymorphism.java > log.txt 2>&1");
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
         <form action="processCode.php" method="post" >
            <textarea data-editor = "java" rows="20" cols="55" name="comment-editor"  data-gutter="1" >
            <?php
               echo $current;
               ?>
            </textarea>
            <input type="submit" value="Compile">
         </form>
      </div>

      <div class = 'button-wrapper'>
         <div class="buttons-holder">
            <a href="#" class="button play"  role="button">Play</a>
            <a href="#" class="button pause" role="button">Pause</a>
            <a href="#" class="button restart" role="button">Restart</a>
         </div>
         <!--/.buttons-holder -->
      </div>
      <div id = "square"></div>
      <script src="js/polymorphism.js"></script>
      <br>
      <div class = "lesson-heading">
      <h1>
      What is happening in the this Code
      <h1>
      </div>
      <div class = "example-poly">
         <div class = "section-1">
            <p>We will break down what in happening in the code above and explain the concept of polymorphism We will talk about what is regarded as two of the 4 pillars in OOP "INHERITANCE and POLYMORPHISM.<br>
               In the animation above we see a square transition into a circle, Lets explain what this is in programming terms.<br>
               We have a moving square that has shapeshifted into a circle. We can think of both of these shapes as a class.<br><br> 
               For example circle and square are instances of the classes: class square{} and class circle{}.<br>
               Here is a snippet of the square class:
            </p>
            <textarea rows="11" cols="55" data-editor = "java" data-gutter="1">
            class Square {	
               public void getArea(){		
                  System.out.println("24");
               }
               public void getColour(){
                  System.out.println("red");
               }
               public void name(){
                  System.out.println("square");
               }
            }
            </textarea>
            <p>So now that we have our square how do we morph our square into our circle. <br>
               We are going to introduce a concept known as inheritance. <br>
               There will be a more detailed lesson on inheritance in the future lessons but for now here’s a quick explanation. <br>
               It is a mechanism in which allows us to derive one class from another. The class inherited from another will share a set of attributes and methods.<br><br>
               Now lets get back to our example. Here the Circle class is extending the base class Square.<br><br>
            </p>
            <textarea rows="3" cols="55" data-editor = "java" data-gutter="1">
         class Circle extends Square{

           }
         </textarea>
         <br>
            <p>What is the point of this?<br>
               You might be thinking ok this is cool and all but what the hell is polymorphism for?<br>
               Well lets just say you wanted the Circle and the Square to both be red and have the same area. <br>
               However, when you print the names of the shapes you obviously would want the square to a square and the circle to be a circle. <br>
               This is where polymorphism comes in handy. <br>
               “We do not want to write duplicate code for two shapes if they are outputting the same properties.”<br>
               So how let’s go back to our example code now and see what this looks like. <br><br>
            </p>
            <textarea rows="20" cols="55" data-editor = "java" data-gutter="1">
         public class Polymorphism{		
            public static void main(String[] args){				
                Square s=new Square();		
                Square s1= new Circle();		
                s.getArea();		
                s1.getArea();	
                }	
             }
            class Square {	
                public void getArea(){		
                   System.out.println("24");
                }
	            public void getColour(){
                   System.out.println("red");
               }
            public void name(){
                   System.out.println("square");
               }		
             }
           }
         </textarea>
         <br>
            <p>
               Lets perform a polymorphic action known as overriding:
               What will happen here<BR>
               •	Area class will stay the same in circle class<BR>
               •	getColour will stay the same in circle class <BR>
               •	We are overriding our “inherited” method name() to change the name of the shape<BR>
            </p>
            <textarea rows="5" cols="55" data-editor = "java" data-gutter="1">
         class Circle extends Square{
            public void name(){
                   System.out.println("circle");
               }	
           }
         </textarea>
         <br>
            <p>
               Lets see Polymorphism in action in the driver class: <br>
               Here we make a two new references to objects. First we make our Square.<br>
               Then we make a circle but you can see we have created our reference using the keyword “Square” this is because of our inheritance earlier.<br> 
               This is where Polymorphism gets its name from. The word ‘poly’ meaning many and ‘morphs’ meaning forms. Our square has many forms as it can also be a circle.<br>
               Once we create this we can see Circle now inherits all of squares properties besides the name() method with we changed using a form of polymorphism known as overriding.
            </p>
            <br>
            <textarea rows="13" cols="55" data-editor = "java" data-gutter="1">
         public class Polymorphism {
            public static void main(String[] args) {
            Square s = new Square();
            Square s1 = new Circle();
            s.name();
            s1.name();
            s.getArea();
            s.getColour();
            s1.getArea();
            s1.getColour();
          }
         }
         </textarea>
         </div>
      </div>
      </div>
      

      <div class ="lesson-area">
      <H1>Chalkboard Notes <H1>
         <?php
            $sql = "SELECT description
              FROM lessons 
              WHERE lessonID = 1;";
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
   </body>
</html>

