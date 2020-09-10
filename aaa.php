<?php

  $handle = fopen("routine.txt", "r");

  for ($i = 0; $row = fgetcsv($handle ); ++$i) {
          
          $date = getdate(strtodate($row[3]));
          $date = $date['mday']." ".$date['mday'].", ".$date['year']." তারিখ ".$date['']
          
          $verb = "নিবেন";
          echo $row[2]." ক্লাস ".$row[3]." ঘটিকায় ".$row[4]." ".$verb."। <br/>";
  }

  fclose($handle);

?>