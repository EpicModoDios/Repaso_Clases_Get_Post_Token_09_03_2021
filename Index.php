<?php
    // header("Content-Type: application/json");
    $_POST["Saludar"] = "Bienvenido!"; 
    // print_r($_POST);
    interface opciones{
        const opc = ["+" => "Suma", "-" => "Resta", "*" => "Multiplicacion", "/" => "Division"];
    }
    class Calculadora implements opciones{
        protected $data;
        protected $res;
        protected function Suma(){
            return $this->data[0] + $this->data[1];
        }
        protected function Resta(){
            return $this->data[0] - $this->data[1];
        }
        protected function Multiplicacion(){
            return $this->data[0] * $this->data[1];
        }
        protected function Division(){
            return $this->data[0] / $this->data[1];
        }
    }
    class Operaciones extends Calculadora{
        private function respuesta(){
            return $this->res;
        }
        public function setrespuesta(string $opc, array $num){
            $this->data = $num;
            $this->res = call_user_func_array(array($this, self::opc[$opc]), [null]);
        }
        public function getrespuesta(){
            return $this->respuesta();
        }
        static function validarGet(){
            if(isset($_GET["num1"]) && isset($_GET["num2"]) && isset($_GET["opc"])){
                $obj = new Operaciones();
                print_r([$obj, "setrespuesta"]($_GET["opc"], [(int) $_GET["num1"],(int) $_GET["num2"]]));
                print_r(call_user_func_array(array($obj, "getrespuesta"), [null]));
                return true; 
            }else{
                print_r("Envie los datos por la url las variables son num1 - num2");
                print_r("<br>opc:<br> + = %2B <br> - = - <br> * = %2A <br> / = %2F");
                return false; 
            }
        }
    }


    // $opciones = [
    //     'cost' => 5,
    // ];
    // $mardaAgua = (string) $_SERVER["REQUEST_TIME"];
    // $incriptar = (string) crypt($mardaAgua, $mardaAgua);
    // $cadena = (string) $_SERVER["HTTP_REFERER"];
    // print_r($incriptar);
    // echo "\n";
    // header("Marca-Agua: ".password_hash($incriptar, PASSWORD_BCRYPT , $opciones));

    // if (password_verify($incriptar, get_headers($cadena, 1)["Marca-Agua"])) {
    //     echo '¡La contraseña es válida!';
    // } else {
    //     echo 'La contraseña no es válida.';
    // }
    Operaciones::validarGet();
    

?>