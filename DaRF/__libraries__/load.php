<?php
include_once $_SERVER['CONTEXT_DOCUMENT_ROOT']."/DaRF/__libraries__/__include__/Xlsx.class.php";
include_once $_SERVER['CONTEXT_DOCUMENT_ROOT']."/DaRF/__libraries__/__include__/DBMongo.class.php";





function load_template($template){
    include $_SERVER['DOCUMENT_ROOT']."/DaRF/__libraries__/__templates__/$template";
  }
?>