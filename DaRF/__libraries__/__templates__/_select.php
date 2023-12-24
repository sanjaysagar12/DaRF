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

<form method="post" action="<?echo basename($_SERVER['PHP_SELF'])?>">
<div class="dropdown"><br>
    <select class="select1" name="brand" id="SelectBrand" onchange="AjaxBrand()">
      <option selected>Select</option>
        
      <?for($i=0;$i<count($arr_CarBrand);$i++){
        /*
          1st php is to set values for opetion
          2nd php is to check the element is selected or not and add seleced tag 
          3rd php is to add element in option
        */?>
        <option id="<?echo $arr_CarBrand[$i][0]?>" value="<?echo $arr_CarBrand[$i][0]?>" <?(isset($_POST['brand'])and !empty($_POST['brand'] and $_POST['brand']==$arr_CarBrand[$i][0]))?print("Selected"):print("");?>> <?echo ucfirst($arr_CarBrand[$i][0])?> </option>
      <?}?>

  </select><hr><hr>
</div>
<div class="dropdown" id="dropdownCarModel"><br>
    <select class="select1" name="model" id="SelectModel" onchange="AjaxModel()">
      <option selected>Select</option><hr>
      
      <?if(!empty($arr_CarModel)){
        for($i=0;$i<count($arr_CarModel['model']);$i++){?>
        
        <option id="OptionModel" value="<?echo $arr_CarModel['model'][$i]?>" <?(isset($_POST['model'])and !empty($_POST['model'] and $_POST['model']==$arr_CarModel['model'][$i]))?print("Selected"):print("");?>> <?echo $arr_CarModel['model'][$i]?> </option>
        <?}
      }?>
    
  </select><hr><hr>
  </div>

  <div class="dropdown">
    <select class="select1" name="year" id="SelectYear">
      <option selected>Select</option>

      <?if(!empty($arr_Year)){
        for($i=0;$i<count($arr_Year['year']);$i++){?>
        
        <option id="OptionYear" value="<?echo $arr_Year['year'][$i]?>" <?(isset($_POST['year'])and !empty($_POST['year'] and $_POST['year']==$arr_Year['year'][$i]))?print("Selected"):print("");?>> <?echo $arr_Year['year'][$i]?> </option>
        <?}
      }?>

  </select><hr><hr>
  </div>

  <div class="ranges">
  <input name = "price" type = "range" min = "500000" max = "100000000" step = "5000" onInput = "changeValue(this.value)" onchange = "changeValue(this.value)">
     <div id = "output"> </div>
     <script>
        let output = document.getElementById('output');
        function changeValue(newVal) {
           output.innerHTML = newVal;
        }
     </script>
<input type="submit" value="Search"/>
</form>
