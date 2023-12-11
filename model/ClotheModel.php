<?php

require_once "ConDB.php";

class ClotheModel {

    public static function all(){
        $query = "SELECT * FROM clothes";
        $statement = Connection::connection()->prepare($query);
        $statement->execute();
        $clothes = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $clothes;
    }

    public static function find($id){
        $query = "SELECT * FROM clothes WHERE clo_id = $id";
        $statement = Connection::connection()->prepare($query);
        $statement->execute();
        $clothe = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $clothe;
    }

    public static function create($data){
        $query = "INSERT INTO `clothes`(`clo_name`, `clo_price`, `clo_stock`, `clo_details`) VALUES ('".$data['clo_name']."','".$data['clo_price']."','".$data['clo_stock']."','".$data['clo_details']."')";
        return $query;
        $statement = Connection::connection()->prepare($query);
        $statement->execute();
        $message = array("Clothe created successfully");
        return $message;
    }

    public static function update($id,$data){
        $query = "UPDATE `clothes` SET `clo_name`='".$data['clo_name']."',`clo_price`='".$data['clo_price']."',`clo_stock`='".$data['clo_stock']."',`clo_details`='".$data['clo_details']."' WHERE clo_id = $id";
        $statement = Connection::connection()->prepare($query);
        $statement->execute();
        $message = array("clothe updated successfully");
        return $message;
    }

    public static function getPrice($id){
        $query = "SELECT clo_price FROM clothes WHERE clo_id = $id";
        $statement = Connection::connection()->prepare($query);
        $statement->execute();
        $clothe = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $clothe[0]['clo_price'];
    }
}
?>