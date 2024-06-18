<?php
require_once('conexion.php');
require_once('Usuario.php');
require_once('usuarios.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellidos'];
    $login = $_POST['usuario'];
    $pwd = sha1($_POST["contra"]);
    $rol = isset($_POST['rol']) ? $_POST['rol'] : 'cliente';

    $db = new Database();
    $encontrado = $db->verificarDriver();

    if ($encontrado) {
        $cnn = $db->getConnection();
        $productoModelo = new usuarios($cnn);
        $data = "login = '{$login}'";
        $usuario = $productoModelo->validaUser($data);

        if ($usuario) {
            echo "<div style='background-color: #FF0000; color: white; padding: 10px; text-align: center;'>¡El usuario ya existe!</div>";
            echo "<br><a href='registro.php' style='display: block; text-align: center; margin-top: 10px; font-size: 18px;'>Regresar al Registro</a>";
        } else {
            $insertar = [
                'nombre' => $nombre,
                'apellidos' => $apellido,
                'login' => $login,
                'pwd' => $pwd,
                'rol' => $rol
            ];

            if ($productoModelo->insert($insertar)) {
                echo "<div style='background-color: #4CAF50; color: white; padding: 10px; text-align: center;'>¡Usuario agregado exitosamente!</div>";
                echo "<br><a href='../index.php' style='display: block; text-align: center; margin-top: 10px; font-size: 18px;'>Regresar al inicio</a>";
            } else {
                echo "<div style='background-color: #FF0000; color: white; padding: 10px; text-align: center;'>Error al agregar el usuario.</div>";
            }
        }
    } else {
        echo "Driver MySQL no disponible.";
    }
} else {
    echo "Método no permitido.";
}
?>
