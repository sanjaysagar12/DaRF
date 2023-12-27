<?php 

class DBMongo{
    public static $conn = null;
    public static function getConnection(){
        if(DBMongo::$conn == null){
            try{
                phpinfo() ;
            $conn = new MongoClient('mongodb://localhost:27017');
            print("New Connection Established");
            DBMongo::$conn = $conn;
            }catch (Exception $e) {
                
                echo 'Failed to connect to MongoDB, is the service intalled and running?<br /><br />';
		echo $e->getMessage();
		exit();
            }
            return DBMongo::conn;
        }else{
            print("Returning Exesting Connection");
            return DBMongo::$conn;
        }
        
    }
}