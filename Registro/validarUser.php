<?php
require_once('conexion.php');
require_once('Usuario.php');
require_once('usuarios.php');

$db = new Database();

$encontrado = $db->verificarDriver();

if($encontrado){
    $cnn = $db->getConnection();
    $usrModelo = new usuarios($cnn);
    $login = $_POST['usuario']; 
    $data = "login = '".$login."'";
    $usuario = $usrModelo->validaUser($data);
    if($usuario){
        require_once("Registro.php");
    }else{
        require_once("../login/formLogin.php");
    }
}
?>