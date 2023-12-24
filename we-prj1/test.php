<?php
$name = <<< EOD
"
  Geeks 
  \tFor 
  Geeks" 
EOD; 
$name = preg_replace("/[^a-zA-Z0-9]+/","", $name);
print($name);