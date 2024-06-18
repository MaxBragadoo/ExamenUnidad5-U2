<?php
$dsn = 'mysql:host=localhost;dbname=automotriz';
$user = 'root';
$pass = '';

try {
    $conn = new PDO($dsn, $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
    exit;
}

function showMessageAndBack($message) {
    echo "<script type='text/javascript'>
            alert('$message');
            window.history.go(-1); // Regresar a la página anterior
          </script>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];

    // Validación en servidor
    if (empty($nombres) || empty($apellidos) || empty($telefono) || empty($correo)) {
        showMessageAndBack("Todos los campos son obligatorios. Por favor, complete todos los campos.");
    }

    if (!preg_match("/^[a-zA-Z ]+$/", $nombres)) {
        showMessageAndBack("El nombre solo debe contener letras. Por favor, corrija el campo de nombres.");
    }

    if (!preg_match("/^[a-zA-Z ]+$/", $apellidos)) {
        showMessageAndBack("El apellido solo debe contener letras. Por favor, corrija el campo de apellidos.");
    }

    if (!preg_match("/^[0-9]+$/", $telefono)) {
        showMessageAndBack("El número de teléfono solo debe contener números. Por favor, corrija el campo de teléfono.");
    }

    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        showMessageAndBack("El correo ingresado no es válido. Por favor, corrija el campo de correo.");
    }

    // Insertar con PDO
    $sql = "INSERT INTO Clientes (Nombre, Apellido, Telefono, Correo) 
            VALUES (:nombres, :apellidos, :telefono, :correo)";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':nombres', $nombres);
    $stmt->bindParam(':apellidos', $apellidos);
    $stmt->bindParam(':telefono', $telefono);
    $stmt->bindParam(':correo', $correo);

    try {
        $stmt->execute();
        // Redirigir después de la inserción exitosa
        echo "<script type='text/javascript'>
                alert('Cliente guardado correctamente');
                window.location.href = 'clientes.php';
              </script>";
        exit;
    } catch (PDOException $e) {
        showMessageAndBack('Error: ' . $e->getMessage());
    }
}
?>
