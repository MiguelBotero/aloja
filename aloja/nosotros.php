<?php
include("config/conexion.php");

$sql = "SELECT * FROM nosotros LIMIT 1";
$resultado = mysqli_query($conexion, $sql);
$datos = mysqli_fetch_assoc($resultado);
?>



<!doctype html>
<html lang="en">
  
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" 
    crossorigin="anonymous">

    <link rel="stylesheet" href="css/pagina5.css">

    <style>

        .titulo {
            background-color: rgba(0, 0, 0, 0.289);
        }

        .titulo h3{
            font-size: 105px;
            color: white;
        }

        .navegador{
            background-color: rgba(0, 0, 0, 0.289);
            height: 100%;
            
        }

        
        
        li{
            margin-left: 2px;
            margin-bottom: 70px;
        }

        .nav-link{
            color: rgb(255, 252, 246);
        }
        
        .nav-link:hover{
            background-color: rgba(55, 55, 230, 0.508);
            color: white;
        }

        
        .contenido-nosotros{
            background-color: rgba(243, 228, 228, 0.1);
            margin-top: 30px;
            margin-left: 60px;
            height: auto;
        }

      
        
    </style>
  </head>
  <body>
    <div class="text-center">

        <div class="row">
          <div class="col-12 titulo">
            <h3>Bienvenido a Aloja</h3>
          </div>
        </div>


        <div class="row">
            <div class="col-lg-2 col-12 ">
                <ul class="nav d-flex flex-row flex-lg-column navegador">

                    <li class="nav-item">
                        <img src="" alt="">
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="index.php">inicio</a>
                    </li>
                        
                    <li class="nav-item">
                        <a class="nav-link" href="galeria.php">Galeria</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="ubicacion.php">Ubicación</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#">Nosotros</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="contactos.php">Contactos</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="sesion.php">Inicio de sesión</a>
                    </li>
                </ul>
            </div>

            <div class="col-lg-10 col-12">
                <h3 class="text-white">Nosotros</h3>
                <div class="row">
                    

                    <div class="col-lg-3 col-12 contenido-nosotros text-center">
                        <h3 class="text-white">historia</h3>
                        <br>
                        <p class="text-white"><?php echo $datos['historia']; ?></p>
                       
                    </div>

                    <div class="col-lg-3 col-12 text-center  contenido-nosotros">
                        <h3 class="text-white">atencion personalizada</h3>
                        <br>
                        <p class="text-white"><?php echo $datos['atencion_personalizada']; ?></p>
                    </div>

                    <div class="col-lg-3 col-12 text-center  contenido-nosotros">
                        <h3 class="text-white">filosofia de servicio</h3>
                        <br>
                        <p class="text-white"><?php echo $datos['filosofia_servicio']; ?></p>
                    </div>
                </div>

                

                

                

            </div>

        </div>



    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
  </body>
</html>