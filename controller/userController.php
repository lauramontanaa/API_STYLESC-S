<?php

class UserController{
    private $_method; //get, post, put.
    private $_complement; //get user 1 o 2.
    private $_data; // datos a insertar o actualizar

    function __construct($method,$complement,$data){
        //var_dump($data);
        $this->_method = $method;
        $this->_complement = $complement;
        $this->_data = $data !=0 ? $data : "";
    
    }

    public function index(){
        switch($this->_method){
            case "GET":
                switch($this->_complement){
                    case 0:
                        $user = UserModel::getUsers(0);
                        $result=[];
                        if (!empty($user)){
                            $result["users"] = $user;                          
                        }else{
                            $result["users"] = null;                            
                        }
                        echo json_encode($result);
                        return;
                    default:
                        $user = UserModel::getUsers($this->_complement);
                        if ($user==null) {
                            $result["users"] = null;                                   
                    }else{
                        $json = $user;
                       // var_export($json);
                        $result=[];
                            if (!empty($json)){
                                $result["users"] = $json;                              
                            }
                        }
                        echo json_encode($result);
                        return;
                }
            case "POST":
                $createUser = UserModel::createUser($this->generateSalting());
                $array = array("response" => $createUser);
                echo json_encode($array);
                return;
            case "PUT":
                $createUser = UserModel::update($this->_complement,$this->_data);
                $result=[];
                $result["users"] = $createUser;
                //$array = array("response"=>$createUser);
                echo json_encode($result);
                return;
            case "DELETE":
                $createUser = UserModel::delete($this->_complement);
                $json = array("response"=>$createUser);
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

    private function generateSalting(){
        $trimmed_data="";
        //var_dump($this->_data);
        $pattern = '/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,15}$/';
        if (preg_match($pattern, $this->_data['use_password'])) {
            if(($this->_data !="") || (!empty($this->_data))){
                $trimmed_data = array_map('trim', $this->_data);
                $trimmed_data['use_password'] = md5($trimmed_data['use_password']);
                //salting
                $identifier = str_replace("$", "y78", crypt($trimmed_data['use_email'], 'ser3478'));
                $key = str_replace("$", "ERT", crypt($trimmed_data['use_password'], '$uniempresarial2024'));
                $trimmed_data['use_identifier'] = $identifier;
                $trimmed_data['use_key'] = $key;
                return $trimmed_data;
            }
        } else {
            $message = "la clave no cuenta con los parametros requeridos";
            die($message);
        }
    }
}

?>
