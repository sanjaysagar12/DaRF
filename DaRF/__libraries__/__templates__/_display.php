<?php

// load_cars only when user enter brand , it is implimented to check the input and display data
if(isset($_POST['brand']) and $_POST['brand']!='Select'){
  $brand = $_POST['brand'];
  $model = $_POST['model'];
  $year = $_POST['year'];
  $price = $_POST['price'];
  $arr_CarModel = json_decode(Xlsx::getModel($brand),true);

  $arr_Cars = json_decode(Xlsx::FilterData($brand,$price),true);
  if($_POST['model']!='Select'){
    $arr_Year = json_decode(Xlsx::getYear($brand,$model,$price=$price),true);
    $arr_Cars = json_decode(Xlsx::FilterData($brand,$price,$model),true);
  }

  if($_POST['year']!='Select'){
    $arr_Cars = json_decode(Xlsx::FilterData($brand,$price,$model,$year),true);
  }
  ?>
  
  <div class="album py-5 bg-light">
    <div class="container">
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
  
  <?
  $keys = array_keys($arr_Cars['brand']);
  foreach($keys as $key){
  ?>
        <div class="col">
          <div class="card shadow-sm">

            <img src="https://cdn.pixabay.com/photo/2016/04/01/12/16/car-1300629_1280.png" class="bd-placeholder-img card-img-top" width="100%" height="225">
              <div class="card-body">
                <h1 class="text-capitalize" ><?echo $arr_Cars['brand'][$key]?></h1>
                <p class="title" ><?echo "Model - ".$arr_Cars['model'][$key]?></p>
                <p><?echo $arr_Cars['year'][$key]?></p>
                <p><button>₹ <?echo $arr_Cars['price'][$key]?></button></p>
              
              </div>
          </div>
        </div>
<?
  }
}
?>
      </div>
    </div>
  </div>