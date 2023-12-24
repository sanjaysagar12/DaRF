<?php 

class Xlsx{

    /*getData fetch the entire data from the XL
    [Warning] it May Slow Down the Process
    */
    public static function getData(){
        $path = $_SERVER['CONTEXT_DOCUMENT_ROOT'].'/DaRF/__libraries__/__py__/Xlxs.py';
        $command = "python3 $path --field '*'";
        $output = shell_exec($command);
        print_r($output);
        return $output;
    }
    /*GetField is used to get Perticulat Distinct field 
    [Warning] this function is not sutable of getting model or perticular brand, it return all distinct brand
    for getting perticular model of a brand use getModel()
    */
    public static function GetField($field,$type="array"){
        $field = preg_replace("/[^a-zA-Z0-9]+/","", $field);

        $path = $_SERVER['CONTEXT_DOCUMENT_ROOT'].'/DaRF/__libraries__/__py__/Xlxs.py';
        $command = "python3 $path -f '$field'";
        $output = shell_exec($command);
        if($type=="array"){
            return json_decode($output,true);
        }else{
            return $output;
        }
    }

    /*Filter Data With Respect To Given Data 
    [Warning] Data is not Distinct
    [Usage] this Method can be used in process in getting 
    */
    public static function FilterData($brand, $price="None",$model="None",$year="None"){
        $brand = preg_replace("/[^a-zA-Z0-9]+/","", $brand);
        $price = preg_replace("/[^a-zA-Z0-9]+/","", $price);
        $model = preg_replace("/[^a-zA-Z0-9 ]+/","", $model);
        $year = preg_replace("/[^a-zA-Z0-9]+/","", $year);

        $path = $_SERVER['CONTEXT_DOCUMENT_ROOT'].'/DaRF/__libraries__/__py__/Xlxs.py';
        $command = "python3 $path -f '*' -b '$brand' -m '$model' -y $year -p $price";
        $output = shell_exec($command);
        return $output;
    }

    public static function getModel($brand){
        $brand = preg_replace("/[^a-zA-Z0-9]+/","", $brand);

        $path = $_SERVER['CONTEXT_DOCUMENT_ROOT'].'/DaRF/__libraries__/__py__/Xlxs.py';
        $command = "python3 $path -f '*' -b '$brand' -d model";
        $output = shell_exec($command);
        return $output;
    }

    public static function getYear($brand,$model){
        $brand = preg_replace("/[^a-zA-Z0-9]+/","", $brand);
        $model = preg_replace("/[^a-zA-Z0-9 ]+/","", $model);

        $path = $_SERVER['CONTEXT_DOCUMENT_ROOT'].'/DaRF/__libraries__/__py__/Xlxs.py';
        $command = "python3 $path -f '*' -b '$brand' -m '$model' -d year";
        $output = shell_exec($command);
        return $output;
    }

}
?>