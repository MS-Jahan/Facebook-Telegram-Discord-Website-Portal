<?php
        session_start();

        //create an variable $response
        //Use GET instead of POST since you are sending data in GET method
        if (isset($_GET['id']))
        {
            if($_GET['id'] == "Hello"){
                
                $lines = file("groupposts/gList.txt", FILE_IGNORE_NEW_LINES);
                
                //print_r($lines);
                
                //echo "<br><br><br>";
    
                
                $i = 0;
                
                
                //echo gettype($lines)."<br>";
                //echo sizeof($lines);
                
                $file_strings = array();
                
                for($i = 0; $i < sizeof($lines); $i++){
                    $file = file_get_contents("groupposts/posttxt/".$lines[$i]);
                    //print_r(nl2br($file."<br> <hr style='height:2px;border-width:0;color:gray;background-color:gray'> <br>"));
                    array_push($file_strings, $file);
                }
    
                $response= $file_strings;
                
            }
            else{
                $response="Failed";

            }
            
            echo json_encode($response);
                
        }