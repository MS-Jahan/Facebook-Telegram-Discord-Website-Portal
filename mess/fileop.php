<?php

$myfile = fopen("file.txt", "r") or die("Unable to open file!");
$lines = file("file.txt", FILE_IGNORE_NEW_LINES);
echo sizeof($lines);
$i = 0;
for($i = 0; $i < sizeof($lines); $i++){

    echo $lines[$i];
    echo "\n\n";

}