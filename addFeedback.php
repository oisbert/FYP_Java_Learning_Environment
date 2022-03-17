<html>
   <!-- 
         Add Feedback.php allows the teacher 
         to post feedback to the student
      -->
<head>
       <!-- 
         Links and cdn code
      -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/addFeedback.css?v=<?php echo time(); ?>">
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />

    <title>Add Post</title>
</head>

   <!-- 
         cdn for the latest version of jquery
      -->
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
    crossorigin="anonymous"></script>


<script type="text/javascript">

    //function which allows to move the checked box item to the text area
    $(document).ready(function() {
        $('.checkboxClass').click(function() {
            var text = "";
            $('.checkboxClass:checked').each(function() {
                text += $(this).val() + ',' + '\n';
            });
            text = text.substring(0, text.length - 1);
            $("#description").val(text); //add the value to the text area 
        });
    });
</script>

<body>

    <?php
    include("validateLoggedIn.php");
    include("headerTeacher.html");
    ?>

    <div class="description-container">
        <div class="bio-description">
            <?php

            //get the TaskID of the user
            //get the userID of the user
            $taskID = $_GET['taskID'];
            $userID = $_GET['userID'];


            //SQL query to get filePath and taskTitle
            /*
              *Inner join taskstatus and tasks by the taskID
              *Select items where the taskID and userID is the current user task
            */
            $sql = "SELECT a.filePathUser, b.taskTitle 
            FROM taskstatus a 
            INNER JOIN tasks b 
            ON a.taskID = b.taskID 
            WHERE $taskID = a.taskID AND $userID = a.userID";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // output data of each row
                while ($row = $result->fetch_assoc()) {
                    $file =  $row['filePathUser'];
                    $Path =  $row['taskTitle'];
                }
            }

            //collect the contents of the file uploaded by the user

            $fileHolder = file_get_contents("taskUploads/{$Path}/{$userID}/{$file}", true);

            $data1 = array('taskID' => $taskID);
            $data2 = array('userID' => $userID);
            ?>

               <!-- 
                    Text area to the display the contents of the user file to the teacher for grading
                -->

            <textarea rows="20" cols="55" data-editor="java" data-gutter="1"><?php echo $fileHolder ?> </textarea>

                   <!-- 
                        create a form and checkboxes which the teacher can quick select for fast feedback
                        When form is submitted it carries out the addFeedbackfunction.php. This function submits the
                        feedback to the data base
                    -->
            <form method="post" name="confirmationForm"
                action="addFeedbackfunction.php?<?php echo http_build_query($data1) ?>&<?php echo http_build_query($data2) ?>">
                <h3 id='desc'>Add quick feedback</h3>
                <input type="checkbox" id="check1" class='checkboxClass' value="code needs to be indented properly"
                    name="checkbox[]" value="1" />
                <label for="check1">•code needs to be indented properly</label><br>
                <input type="checkbox" id="check2" class='checkboxClass' value="class starts with capital letter"
                    name="checkbox[]" value="2" />
                <label for="check2">•class starts with capital letter</label><br>
                <input type="checkbox" id="check3" class='checkboxClass' value="methods must be declared static"
                    name="checkbox[]" value="3" />
                <label for="check3">•methods must be declared static</label><br>
                <input type="checkbox" id="check4" class='checkboxClass' value="return type incorrect" name="checkbox[]"
                    value="4" />
                <label for="check4">•return type incorrect</label><br>
                <input type="checkbox" id="check5" class='checkboxClass' value="method invoked incorrectly"
                    name="checkbox[]" value="5" />
                <label for="check5">•method invoked incorrectly</label><br>
                <input type="checkbox" id="check6" class='checkboxClass' value="return type missing" name="checkbox[]"
                    value="6" />
                <label for="check6">•return type missing</label><br>
                <input type="checkbox" id="check7" class='checkboxClass'
                    value="method doesn’t perform calculation correctly" name="checkbox[]" value="7" />
                <label for="check7">•method doesn’t perform calculation correctly</label><br>
                <input type="checkbox" id="check8" class='checkboxClass'
                    value="methods must start with lowercase letter" name="checkbox[]" value="8" />
                <label for="check8">•methods must start with lowercase letter</label><br>
                <input type="checkbox" id="check9" class='checkboxClass' value="output not formatted correctly"
                    name="checkbox[]" value="9" />
                <label for="check9">•output not formatted correctly</label><br>
                <h3 id='desc'>Post Description:</h3>


                <!-- 
                        Content that is quick selected is passed to this text-area and it 
                        can be edited by the teacher for personal feedback.
                        Submit carries out the addFeedbackfunction.php action.
                    -->
                <textarea id='description' name='query' class='description-textarea' rows=20 cols=70 required>
                    </textarea>

                <br>

                <input type="submit" name="submit">
            </form>
        </div>
    </div>
         <!-- 
            Scripts to load the ace.js compiler library and the sytaxCompiler text-area styling file
          -->    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.2.6/ace.js" type="text/javascript" charset="utf-8"></script>
    <script src="js/syntaxCompiler.js" type="text/javascript"></script>

</body>
</body>

</html>