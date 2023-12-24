<?php
include_once $_SERVER['CONTEXT_DOCUMENT_ROOT']."/DaRF/__libraries__/__include__/Xlsx.class.php";


global $__site_config;
$__site_config = file_get_contents('/var/www/DBconfig.json');
Session::start();

function get_config($key){
  global $__site_config;
  $array = json_decode($__site_config,true);
  if(isset($array[$key])){
    return $array[$key];
  }else{
    return null;
  }
}

function load_template($template){
    include $_SERVER['DOCUMENT_ROOT']."/DaRF/__libraries__/__templates__/$template";
  }
?>