<php>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Registro - Abarrotes La Esquina</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- jQuery Validator -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
    <!-- Estilos CSS personalizados -->
    <style>
        body {
            background-image: url('../img/home-bg.png'); /* URL de la imagen de fondo */
            background-size: cover; /* Ajustar tamaño para cubrir todo el cuerpo */
            background-repeat: no-repeat; /* No repetir la imagen */
            background-position: center center; /* Centrar la imagen */
            padding: 20px; /* Espaciado alrededor del contenido */
        }
        form {
            background-color: rgba(250, 250, 250, 0.85); /* Fondo del formulario con transparencia */
            padding: 30px;
            border-radius: 10px; /* Bordes redondeados */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Sombra ligera */
        }
        h2 {
            color: white; /* Color del título */
            text-align: center; /* Centrar texto */
            margin-bottom: 30px; /* Espaciado inferior */
        }
        .message-container {
            margin-top: 20px;
        }
    </style>
    <!-- Archivo de validaciones personalizadas -->
    <script src="validaciones.js"></script>
</head>
<body>
 <!-- Navigation -->
       <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="logo mx-2">
                <img src="../img/logo.png" alt="Logo" class="img-fluid" style="max-width: 150px;">
            </div>
            <a class="navbar-brand p-2" href="../index.php">Prog Web</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                </ul>
            </div>
        </nav>
        
    <div class="container">
        <h2 class="mb-4 text-dark">Formulario de Registro</h2>
        <form id="formularioRegistro" action="data.php" method="post">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombres:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="mb-3">
                <label for="apellidos" class="form-label">Apellidos:</label>
                <input type="text" class="form-control" id="apellidos" name="apellidos" required>
            </div>
            <div class="mb-3">
                <label for="usuario" class="form-label">Usuario:</label>
                <input type="text" class="form-control" id="usuario" name="usuario" required>
            </div>
            <div class="mb-3">
                <label for="contra" class="form-label">Contraseña:</label>
                <input type="password" class="form-control" id="contra" name="contra" required>
            </div>
            <div class="mb-3">
                <label for="contra-confirm" class="form-label">Confirmar Contraseña:</label>
                <input type="password" class="form-control" id="contra-confirm" name="contra-confirm" required>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="rol" name="rol" value="admin">
                <label class="form-check-label" for="rol">Administrador</label>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Enviar</button>
            </div>
        </form>
    </div>
        <?php include('../footer.php'); //        ?>
</body>
</html>
