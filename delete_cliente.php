<?php
require_once('ORM/Database.php');
require_once('ORM/orm.php');
require_once('ORM/clientes.php');

$db = new Database();
$encontrado = $db->verificarDriver();

if ($encontrado) {
    $cnn = $db->getConnection();
    if ($cnn === null) {
        die('Error: No se pudo establecer la conexión con la base de datos.');
    }

    $clientesModelo = new Cliente($cnn);

    $idCliente = isset($_GET['id']) ? $_GET['id'] : null;

    if ($idCliente) {
        try {
            if ($clientesModelo->deleteById($idCliente)) {
                header('Location: clientes.php');
                exit();
            } else {
                echo 'No existe un cliente con ese ID';
            }
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    } else {
        echo 'El ID del cliente no fue proporcionado';
    }
} else {
    echo 'El driver de MySQL no está disponible.';
}
?>
