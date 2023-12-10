<?php

class ClotheController{
    private $_method; //get, post, put.
    private $_complement; //get clothe 1 o 2.
    private $_data; // datos a insertar o actualizar

    function __construct($method,$complement,$data){
        $this->_method = $method;
        $this->_complement = $complement;
        $this->_data = $data !=0 ? $data : "";
    }

    public function index(){
        switch($this->_method){
            case "GET":
                switch($this->_complement){
                    case 0:
                        $clothe = ClotheModel::all(0);
                        $json = $clothe;
                        echo json_encode($json);
                        return;
                    default:
                        $clothe = ClotheModel::find($this->_complement);
                        if ($clothe==null)
                            $json = array("response: "=>"clothe not found");
                        else
                            $json = $clothe;
                        echo json_encode($json);
                        return;
                }
            case "POST":
                $createclothe = ClotheModel::create($this->_data);
                $json = array(
                    "response: "=>$createclothe
                );
                echo json_encode($json);
                return;
            case "PUT":
                $createclothe = ClotheModel::update($this->_complement,$this->_data);
                $json = array(
                    "response: "=>$createclothe
                );
                echo json_encode($json,true);
                return;
            default:
                $json = array(
                    "ruta: "=>"not found"
                );
                echo json_encode($json,true);
                return;
        }
    }
}
?>