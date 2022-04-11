<?php

include("methodChecker.php");
include("checkMethodDeclaration.php");
include("javaClassNameChecker.php");

class test extends \PHPUnit\Framework\TestCase {
    
    public function test_checkForStatic(){

        //load in sample test code to test functions
        $myfile = file_get_contents("testFiles/test.java", "r");
        $myfile2 = file_get_contents("testFiles/testtwo.java", "r");
        $lines = explode("\n", $myfile );
        $lines2 = explode("\n", $myfile2 );

        /*
            Unit test 1:
            Test the functionality of the checkForStatic
        */

        //if all lines correct return true
        foreach($lines as $word) {
            $this->assertTrue( checkForStatic( $word ) ==true);
        }

        foreach($lines2 as $word) {

            $result = checkForStatic( $word );
        }
        if ($result == false){ //if method finds a non-static is should return false
            $this->assertEquals( false,$result);
        }
    }

    public function test_checkMethodName(){
        /*
            Unit test 2:
            Test the functionality of the checkMethodName
        */

        $this->assertTrue( checkMethodName( "testFiles/test.java", "test" ) ==true);

        $this->assertFalse( checkMethodName( "testFiles/testtwo.java", "testtwo" ) ==true);
        
    }

    public function test_checkCap(){
        /*
            Unit test 3:
            Test the functionality of the checkCap
        */
        $myfile = file_get_contents("testFiles/testtwo.java", "r");
        $myfile2 = file_get_contents("testFiles/TestThree.java", "r");
        $this->assertTrue( checkCap( $myfile2 ) ==true);
        $this->assertFalse( checkCap( $myfile ) ==true);

    }


    
}

        