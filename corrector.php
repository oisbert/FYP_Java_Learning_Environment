<form action="#" method="post"> 
<input type = "checkbox" id = "check1" value = "code needs to be indented properly" name = "checkbox[]" value="1"/>
<label for="check1">code needs to be indented properly</label><br>
<input type = "checkbox" id = "check2" value = "class starts with capital letter" name = "checkbox[]" value="2"/>
<label for="check2">class starts with capital letter</label><br>
<input type = "checkbox" id = "check3" value = "methods must be declared static" name = "checkbox[]" value="3"/> 
<label for="check3">methods must be declared static</label><br>
<input type = "checkbox" id = "check4" value = "return type incorrect" name = "checkbox[]" value="4"/> 
<label for="check4">return type incorrect</label><br>
<input type = "checkbox" id = "check5" value = "method invoked incorrectly" name = "checkbox[]" value="5"/> 
<label for="check5">method invoked incorrectly</label><br>
<input type = "checkbox" id = "check6" value = "return type missing" name = "checkbox[]" value="6"/> 
<label for="check6">return type missing</label><br>
<input type = "checkbox" id = "check7" value = "method doesn’t perform calculation correctly" name = "checkbox[]" value="7"/> 
<label for="check7">method doesn’t perform calculation correctly</label><br>
<input type = "checkbox" id = "check8" value = "methods must start with lowercase letter" name = "checkbox[]" value="8"/> 
<label for="check8">methods must start with lowercase letter</label><br>
<input type = "checkbox" id = "check9" value = "output not formatted correctly" name = "checkbox[]" value="9"/> 
<label for="check9">output not formatted correctly</label><br>

<input type="submit" value="Submit">
</form> 

<?php 
foreach($_POST['checkbox'] as $value)
{
    echo $value."<br>";
}
?> 