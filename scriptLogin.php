<?php
session_start();


$servername = "localhost";
$username_db = "root"; 
$password_db = ""; 
$dbname = "automotriz";

$user = $_POST['username'];
$pass = $_POST['password'];

try {

    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username_db, $password_db);
    
   
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Consulta preparada para verificar las credenciales del usuario
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE nombre = :username");
    $stmt->bindParam(':username', $user);
    $stmt->execute();
    
   
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
     // Establecer el modo de error de PDO a excepciones
    if ($row) {
        if (password_verify($pass, $row['pwd'])) {


            $_SESSION['nombre'] = $user;

            $sql = "UPDATE usuarios SET login = :sesion WHERE id = :id";

            $stmt = $conn->prepare($sql);
            $login = 'activo';
            $id = $row['id'];
            
            $stmt->bindParam(':sesion', $login);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            if($row['rol']=='admin'){
                header("Location: clientes.php?success=1"); //Tiene que mandar a la pagina de administradores
                exit();
            }else{
                header("Location: clientesUsuario.php?success=1"); //Tiene que mandar a la pagina de usuarios
                exit();
            }
        
           

        } else {
            // Contraseña incorrecta
            header("Location: login.html?error=incorrect_password"); //Regresa a la misma pagina de login si la contraseña es incorrecta
            exit();
        }
    } else {
        // Usuario no encontrado
        header("Location: login.html?error=user_not_found"); //Regresa a la misma pagina de login si no se encontro el usuario
        exit();
    }
} catch(PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}

// Cerrar la conexión
$conn = null;
?>