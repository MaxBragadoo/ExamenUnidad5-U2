<!DOCTYPE html>
<html lang="en">
<head>

<script>
        function mostrarAlerta() {
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has('success')) {
                alert("Inicio como Usuario Exitoso");
            } else if (urlParams.has('error')) {
                const error = urlParams.get('error');
                if (error === 'user_not_found') {
                    alert("Nombre de usuario no encontrado.");
                } else if (error === 'incorrect_password') {
                    alert("Contraseña incorrecta.");
                }
            }
        }
    </script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/font-awesome@6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .navbar {
            background-color: #000;
            color: #fff;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 999;
            height: 50px;
        }

        .navbar-brand {
            font-size: 1em;
            font-weight: bold;
        }

        .navbar-nav li a {
            color: #fff;
            padding: 5px 20px;
            text-decoration: none;
        }

        .navbar-brand img {
            height: 30px;
        }

        .navbar-nav li a.active {
            background-color: #fff;
            color: #000;
        }

        body {
            background-color: lightblue;
        }

        .h1 {
            font-size: 3em;
            color: black;
            background-color: whitesmoke;
            padding: 10px 20px;
            border-radius: 10px;
            text-transform: uppercase;
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease-in-out;
            margin-top: 60px;
        }

        .table {
            margin-top: 10px;
            border-color: black;
        }

        .table th {
            background-color: orange;
            color: white;
        }

        .btn-agregar {
            background-color: green;
            border-color: black;
            color: white;
        }

        .btn-agregar:hover {
            background-color: darkgreen;
            border-color: black;
            color: white;
        }

        .btn-info {
            background-color: blue;
            border-color: black;
        }

        .btn-info:hover {
            background-color: darkblue;
            border-color: black;
        }

        .btn-primary {
            background-color: blue;
            border-color: black;
        }

        .btn-primary:hover {
            background-color: darkblue;
            border-color: black;
        }

        .btn-danger {
            background-color: red;
            border-color: black;
        }

        .btn-danger:hover {
            background-color: darkred;
            border-color: black;
        }

        body {
            background-size: cover;
            background-image: url("Img/Carro2.jpg");
        }
    </style>
</head>
<body onload="mostrarAlerta()">
    <nav class="navbar">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="Img/Cliente.png" alt="Logo">
                Programación web
            </a>
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Bienvenido Usuario</a>
                </li>
            </ul>
        </div>
    </nav>

    <h1 class="h1 text-center">Clientes</h1>

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">

                <!-- Tabla de clientes -->
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombres</th>
                            <th>Apellidos</th>
                            <th>Teléfono</th>
                            <th>Correo</th>
                            <th>Detalles</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Configuración de conexión a la base de datos
                        $dsn = 'mysql:host=localhost;dbname=automotriz';
                        $user = 'root';
                        $pass = '';

                        try {
                            $conn = new PDO($dsn, $user, $pass);
                            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                            // Función para generar la tabla de clientes
                            function generarTablaClientes($conn)
                            {
                                $output = '';

                                $sql = "SELECT ID_Cliente, Nombre, Apellido, Telefono, Correo FROM Clientes";
                                $stmt = $conn->query($sql);

                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    $output .= "<tr>";
                                    $output .= "<td>{$row['ID_Cliente']}</td>";
                                    $output .= "<td>{$row['Nombre']}</td>";
                                    $output .= "<td>{$row['Apellido']}</td>";
                                    $output .= "<td>{$row['Telefono']}</td>";
                                    $output .= "<td>{$row['Correo']}</td>";
                                    $output .= "<td><a href='get_cliente.php?id={$row['ID_Cliente']}' class='btn btn-secondary'><i class='fas fa-eye'></i> Info</a></td>";
                                    $output .= "</tr>";
                                }

                                return $output;
                            }

                            echo generarTablaClientes($conn);
                        } catch (PDOException $e) {
                            echo 'Error: ' . $e->getMessage();
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>