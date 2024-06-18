<?php
require_once('ORM/Database.php');
require_once('ORM/orm.php');
require_once('ORM/clientes.php');

function showMessageAndBack($message) {
    echo "<script type='text/javascript'>
            alert('$message');
            window.history.go(-1); // Regresar a la página anterior
          </script>";
    exit;
}

function validarDatos($nombres, $apellidos, $telefono, $correo) {
    // Validar que nombre y apellidos no contengan números
    if (preg_match('/\d/', $nombres) || preg_match('/\d/', $apellidos)) {
        return 'El nombre y los apellidos no deben contener números.';
    }
    
    // Validar que el teléfono solo contenga números
    if (!preg_match('/^\d+$/', $telefono)) {
        return 'El teléfono solo debe contener números.';
    }
    
    // Validar que el correo contenga un "@"
    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        return 'El correo debe ser válido y contener un "@"';
    }
    
    return '';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = new Database();
    $cnn = $db->getConnection();

    if ($cnn) {
        $clienteModelo = new Cliente($cnn);

        $id = $_POST['id'] ?? '';
        $nombres = $_POST['nombres'] ?? '';
        $apellidos = $_POST['apellidos'] ?? '';
        $telefono = $_POST['telefono'] ?? '';
        $correo = $_POST['correo'] ?? '';

        $error = validarDatos($nombres, $apellidos, $telefono, $correo);

        if (!empty($error)) {
            echo $error;
        } elseif (!empty($id) && !empty($nombres) && !empty($apellidos) && !empty($telefono) && !empty($correo)) {

            $datosActualizacion = [
                'Nombre' => $nombres,
                'Apellido' => $apellidos,
                'Telefono' => $telefono,
                'Correo' => $correo,
            ];

            if ($clienteModelo->updateById($id, $datosActualizacion)) {
                echo 'Datos actualizados correctamente.';
                echo '<script>
                        setTimeout(function(){
                            window.location.href = "clientes.php";
                        }, 2000);
                      </script>';
                exit();
            } else {
                echo 'Existe un error al actualizar datos.';
            }
        } else {
            echo 'Por favor, completa todos los campos del formulario.';
        }
    }
} else {
    $db = new Database();
    $cnn = $db->getConnection();

    if ($cnn) {
        $clienteModelo = new Cliente($cnn);

        $id = $_GET['id'] ?? '';

        if (!empty($id)) {
            $cliente = $clienteModelo->getById($id);

            if ($cliente) {
                $id = $cliente['ID_Cliente'];
                $nombres = $cliente['Nombre'];
                $apellidos = $cliente['Apellido'];
                $telefono = $cliente['Telefono'];
                $correo = $cliente['Correo'];
            } else {
                echo 'No existe cliente con dicho ID';
                exit();
            }
        } else {
            echo 'El ID del cliente no fue proporcionado';
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualización de clientes</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <style>
        .container {
            margin-top: 50px;
        }

        #contenedorTablaFormulario {
            min-height: 500px;
        }

        .hidden {
            display: none;
        }
    </style>
</head>
<body>

    <div class="container mt-3" id="contenedorTablaFormulario">
        <?php if ($_SERVER['REQUEST_METHOD'] !== 'POST') { ?>
            <form action="" method="post" id="formActualizacion" onsubmit="return validarFormulario();">
                
                <input type="hidden" name="id" value="<?php echo $id ?? ''; ?>">

                <div class="mb-3">
                    <label for="nombres" class="form-label">Nombres:</label>
                    <input type="text" class="form-control" name="nombres" value="<?php echo $nombres ?? ''; ?>" required>
                </div>

                <div class="mb-3">
                    <label for="apellidos" class="form-label">Apellidos:</label>
                    <input type="text" class="form-control" name="apellidos" value="<?php echo $apellidos ?? ''; ?>" required>
                </div>

                <div class="mb-3">
                    <label for="telefono" class="form-label">Teléfono:</label>
                    <input type="text" class="form-control" name="telefono" value="<?php echo $telefono ?? ''; ?>" required>
                </div>

                <div class="mb-3">
                    <label for="correo" class="form-label">Correo:</label>
                    <input type="text" class="form-control" name="correo" value="<?php echo $correo ?? ''; ?>" required>
                </div>
                <button type="submit" class="btn btn-primary" id="btnActualizar">Actualizar</button>
            </form>
        </div>
        <?php } ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        function validarFormulario() {
            const nombres = document.forms["formActualizacion"]["nombres"].value;
            const apellidos = document.forms["formActualizacion"]["apellidos"].value;
            const telefono = document.forms["formActualizacion"]["telefono"].value;
            const correo = document.forms["formActualizacion"]["correo"].value;

            const nombreRegex = /\d/;
            const telefonoRegex = /^\d+$/;
            const correoRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (nombreRegex.test(nombres)) {
                alert("El nombre no debe contener números.");
                return false;
            }

            if (nombreRegex.test(apellidos)) {
                alert("El apellido no debe contener números.");
                return false;
            }

            if (!telefonoRegex.test(telefono)) {
                alert("El teléfono solo debe contener números.");
                return false;
            }

            if (!correoRegex.test(correo)) {
                alert("El correo debe ser válido y contener un '@'.");
                return false;
            }

            return true;
        }

        $(document).ready(function() {
            $('#btnActualizar').click(function() {
                $('#formActualizacion').submit();
            });
        });
    </script>

</body>
</html>
