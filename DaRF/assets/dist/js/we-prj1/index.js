//Removing Model and Year From Select Options
function RemoveModelAndYearData() {
  var Length = document.getElementById("SelectModel").length;
  for(i = 0; i <Length; i++) {
    $("#OptionModel").remove();
  }

  RemoveYearData()
}

//Removing year from Select Option
function RemoveYearData() {
  var Length = document.getElementById("SelectYear").length;
  for(i = 0; i <Length; i++) {
    $("#OptionYear").remove();
  }
}

function AjaxModel(){
  //this to remove all options in Year and add Related Year respect to Car Model
  RemoveYearData();
  $.ajax({ type :"post", url: "/DaRF/__libraries__/ajax.php",
    data:{
      //Send Car Brand to the ajax
      brand:$("#SelectBrand").val(),
      model:$("#SelectModel").val()
    },

    success: function(responce){
    
      if(!responce){
        return
      }

      data = JSON.parse(responce)
      

     //Adding New Optins to Select Year
      var select = document.getElementById("SelectYear");
      for(var i in data['year']){
        var option = document.createElement("option");
        option.setAttribute("id", "OptionYear");
        option.value = data['year'][i];
        option.innerHTML = data['year'][i];
        select.appendChild(option);
      }
  }});
}
function AjaxBrand(){
  //this to remove all options in Car Model , Year and add Related Models and Year respect to Car Brand

  RemoveModelAndYearData()
  $.ajax({ type :"post", url: "/DaRF/__libraries__/ajax.php",
    data:{
      //Send Car Brand to the ajax
      brand:$("#SelectBrand").val(),
      model:$("#SelectModel").val()
      
    }, 
    success: function(responce){
      
      if(!responce){
        return
      }

      data = JSON.parse(responce)
      //Adding New Models to Select Model
      var select = document.getElementById("SelectModel");
      for(var i in data['model']){
        var option = document.createElement("option");
        option.setAttribute("id", "OptionModel");
        option.value = data['model'][i];
        option.innerHTML = data['model'][i];
        select.appendChild(option);
      }

  }});
}