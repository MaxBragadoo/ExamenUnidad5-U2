
<!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Manejo de Proyectos</title>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

        <style>
            .jumbotron-custom {
                background: url('/img/nav-bg.png') no-repeat center center;
                background-size: cover;
            }

            .home-bg {
                background: url('/img/home-bg.png') no-repeat center center;
                height: 500px;
            }

            .navbar-dark .navbar-nav .nav-link {
                color: rgba(255, 255, 255, .75);
            }

            .navbar-dark .navbar-nav .nav-link:hover {
                color: white;
            }
        </style>
    </head>

    <body>
        <!-- Jumbotron -->
        <div class="jumbotron mb-0 jumbotron-fluid jumbotron-custom">

            <div class="container text-center">
                <h1 class="display-4 text-dark text-shadow-sm">Empieza pequeño pero soñando en grande</h1>
            </div>
        </div>

        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="pb-3">
                <img src="/img/logo.png" alt="Logo" class="img-fluid p-2" style="max-width: 150px;">
            </div>
            <a class="navbar-brand" href="#">Prog Web</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="# ">Acceder</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-primary text-white" href="/Registro/registro.php">Registrarse</a>
                    </li>
                </ul>
            </div>
        </nav>


        <!-- Registration Section -->
        <div class=" text-center home-bg">
            <div class="pt-5">
            <h2>Registra tu Cliente</h2>
            <p>Para entrar al mundo laboral hay que practicar. Registra el proyecto con el que vas a participar</p>
            <a href="/Registro/registro.php">
                <button class="btn btn-primary">Registrarse</button>
            </a>
            </div>

        </div>

        <?php include('footer.php'); //        
        ?>


    </body>

    </html>