<?php
$arr_CarBrand = Xlsx::GetField("brand");

//GetField is used to get Perticulat Distinct field
$arr_CarModel = [];
$arr_Year = [];

if(isset($_POST['brand']) and $_POST['brand']!='Select'){
    $brand = $_POST['brand'];
    $model = $_POST['model'];
    $year = $_POST['year'];
    $price = $_POST['price'];
    $arr_CarModel = json_decode(Xlsx::getModel($brand),true);
  
    if($_POST['model']!='Select'){
      $arr_Year = json_decode(Xlsx::getYear($brand,$model,$price=$price),true);
    }
}
?>
<section class="p-5 text-center">
  <form method="post" action="<?echo basename($_SERVER['PHP_SELF'])?>">
  <div class="d-flex mt-auto mb-4 justify-content-center align-items-center">

    <div class="dropdown-center p-5" ><br>
    <h3>Car brand</h3>
        <select class="form-select" name="brand" id="SelectBrand" onchange="AjaxBrand()">
          <option selected>Select</option>
            
          <?for($i=0;$i<count($arr_CarBrand);$i++){
            /*
              1st php is to set values for opetion
              2nd php is to check the element is selected or not and add seleced tag 
              3rd php is to add element in option
            */?>
            <option id="<?echo $arr_CarBrand[$i][0]?>" value="<?echo $arr_CarBrand[$i][0]?>" <?(isset($_POST['brand'])and !empty($_POST['brand'] and $_POST['brand']==$arr_CarBrand[$i][0]))?print("Selected"):print("");?>> <?echo ucfirst($arr_CarBrand[$i][0])?> </option>
          <?}?>

        </select>
    </div>
    <div class="dropdown-center p-5" id="dropdownCarModel"><br>
    <h3>Car Model</h3>
        <select class="form-select" name="model" id="SelectModel" onchange="AjaxModel()">
          <option selected>Select</option><hr>
          
          <?if(!empty($arr_CarModel)){
            for($i=0;$i<count($arr_CarModel['model']);$i++){?>
            
            <option id="OptionModel" value="<?echo $arr_CarModel['model'][$i]?>" <?(isset($_POST['model'])and !empty($_POST['model'] and $_POST['model']==$arr_CarModel['model'][$i]))?print("Selected"):print("");?>> <?echo $arr_CarModel['model'][$i]?> </option>
            <?}
          }?>
        
        </select>
      </div>

      <div class="dropdown-center p-5"><br>
      <h3>Year</h3>
        <select class="form-select" name="year" id="SelectYear">
          <option selected>Select</option>

          <?if(!empty($arr_Year)){
            for($i=0;$i<count($arr_Year['year']);$i++){?>
            
            <option id="OptionYear" value="<?echo $arr_Year['year'][$i]?>" <?(isset($_POST['year'])and !empty($_POST['year'] and $_POST['year']==$arr_Year['year'][$i]))?print("Selected"):print("");?>> <?echo $arr_Year['year'][$i]?> </option>
            <?}
          }?>

        </select>
      </div>
        </div>
        <div class="d-flex mt-auto mb-4 justify-content-center align-items-center">

  <div class="align-items-center">
  <div class="container">
  <label for="range" style="font-family: cursive;"><b> <h5 class="blockquote">Select a range:</h5></b></label>
  <input type="range" id="range" name = "price" step = "5000"min="500000" max="100000000" value="<?isset($_POST['price'])?print( $_POST['price']):print(70000000)?>" step="1">
  
  <p class="align-items-center">
    <span id="maxValue" style="padding-inline-end:50vh;"></span>10,00,00,000
    <span id="minValue" style="padding-inline-end:12vh;display:none;"></span>
  </p>
 
  
  <script>
    // Update the displayed values when the range slider is moved
    var range = document.getElementById("range");
    var minValue = document.getElementById("minValue");
    var maxValue = document.getElementById("maxValue");

    minValue.innerHTML = range.min;
    maxValue.innerHTML = range.value;

    range.oninput = function() {
        minValue.innerHTML = range.min;
        maxValue.innerHTML = this.value;
    };



  </script>
    <div class="input-group">
      <button type="submit" class="btn btn-outline-primary" data-mdb-ripple-init>search</button>
    </div>
  </div>
  </div>
      <footer class="mt-auto text-dark-50 "></footer>

  </div>
  </section>
  </form>

<style>

input[type="range"] {
  width:100%;
}
h5{
  font-family: Monospace ;
}
</style>