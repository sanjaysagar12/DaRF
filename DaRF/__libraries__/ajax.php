<?php
include "load.php";
$brand = $_POST['brand'];
$model = $_POST['model'];
if($brand!="Select" and $model!="Select"){
    echo Xlsx::getYear($brand,$model);
}
elseif($brand!="Select"){
    echo Xlsx::getModel($brand);
}
else{
    return false;
}
?>