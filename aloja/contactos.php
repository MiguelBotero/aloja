
<?php
include("config/conexion.php");

$sql = "SELECT * FROM contactos LIMIT 1";
$resultado = mysqli_query($conexion, $sql);
$datos = mysqli_fetch_assoc($resultado);
?>




<!doctype html>
<html lang="en">
  <head>
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
        
        .contactos{
            margin: 0 auto;
            background-color: rgba(243, 228, 228, 0.1);
            color: white;
            margin-top: 30px;
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
            <div class="col-lg-2 col-12">
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
                        <a class="nav-link" href="nosotros.php">Nosotros</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#">Contactos</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="sesion.php">Inicio de sesión</a>
                    </li>
                </ul>
            </div>

            <div class="col-lg-10 col-12">
        
            
                <div class="row">
                    <div class="col-lg-5 col-12 contactos">

                        <h3>teléfonos generales</h3>
                        <p>Recepción: <?= $datos['recepcion'] ?></p>
                        <p>Reservas: <?= $datos['telefono'] ?></p>
                        <p>Eventos y conferencias: <?= $datos['eventos'] ?></p>
                    </div>

                    <div class="col-12 col-lg-5 contactos">
                        <h3>Redes sociales</h3>
                        <p>Instagram: <?= $datos['instagram'] ?></p>
                        <p>Facebook: <?= $datos['facebook'] ?></p>
                        <p>Twitter / X: <?= $datos['twitter'] ?></p>
                        <p>Tik Tok: <?= $datos['tiktok'] ?></p>
                    </div>

                </div>

                <div class="row">
                    <div class="col-12 col-lg-5 contactos">
                        <h3>Email</h3>
                        <p>Gnereal: <?= $datos['email'] ?></p>
                        <p>Reservas: <?= $datos['reservas_email'] ?></p>
                        <p>Recursos: humanos <?= $datos['recursos_email'] ?></p>
                    </div>

                    <div class="col-12 col-lg-5 contactos">
                        <h3>whatsApp</h3>
                        <p>Atencion al cliente: <?= $datos['whatsapp'] ?></p>
                    </div>
                </div>







                

                    



            </div>
        </div>
       
       
    </div>

    



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
  </body>
</html>