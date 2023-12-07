<?php

require_once "controller/UserController.php";
//require_once "controller/CategoryController.php";
require_once "controller/ClotheController.php";
//require_once "controller/PaymentMethodController.php";
require_once "controller/routesController.php";
require_once "controller/LoginController.php";
require_once "model/UserModel.php";
//require_once "model/CategoryModel.php";
require_once "model/ClotheModel.php";
//+require_once "model/PaymentMethodModel.php";

header('Access-Control-Allow-Headers: Content-Type');
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
header('Access-Control-Allow-Headers: Authorization');
//$rutasArray = $_SERVER['REQUEST_URI'];

$rutasArray = explode("/", $_SERVER['REQUEST_URI']);
$endPoint = (array_filter($rutasArray)[2]); 
    $routes = new RoutesController();
    $routes->index();    

?>