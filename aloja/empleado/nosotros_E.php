<?php
// Conexión a la base de datos
$conn = new mysqli("localhost", "root", "", "aloja");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $historia = $_POST['historia'];
    $atencion_personalizada = $_POST['atencion_personalizada'];
    $filosofia_servicio = $_POST['filosofia_servicio'];

    $conn->query("UPDATE nosotros SET 
        historia='$historia',
        atencion_personalizada='$atencion_personalizada',
        filosofia_servicio='$filosofia_servicio'
        WHERE id=1
    ");
    echo "<script>alert('Datos actualizados correctamente'); location.href='nosotros_admin.php';</script>";
}

$nosotros = $conn->query("SELECT * FROM nosotros LIMIT 1")->fetch_assoc();


//iniciar sesion
session_start();

// Verificar sesión antes de hacer consultas
if (!isset($_SESSION['usuario'])) {
    echo "Sesión no iniciada";
    exit();
}

// Conectar a la base de datos
include('../config/conexion.php');

// Obtener datos del empleado que ha iniciado sesión
$usuario = $_SESSION['usuario'];
$sql = "SELECT usuario FROM empleado WHERE usuario = '$usuario'";
$resultado = mysqli_query($conexion, $sql);
$empleado = mysqli_fetch_assoc($resultado); // <-- aquí sí obtienes el nombre


?>


<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Nosotros</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/pagina5.css">
       <style>



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
            margin-bottom: 25px;
            height: auto;
            border: 1px solid white;
            border-radius: 10px;

        }

        .contenido{
            background-color: rgba(243, 228, 228, 0.1);
            width: 95%;
            height: 90%;
            margin-top: 30px;
            margin-left: 10px;
            padding-left: 30px;
            padding-top: 30px;
        }


        .boton{
            height: 50px;
            width: 100px;
            margin-top: 10px;
            margin-right: 30px;
            
        }

        .titulo {
          background-color: rgba(0, 0, 0, 0.289);
        }

        .titulo h2{
        font-size: 100px;
        color: white;
      }

        .titulo h1{
          color: gray;
          margin-left: 325px;
          text-align: left;
        }

       


    </style>
</head>
<body>
<div class="text-center">

    <div class="row">
      <div class="col-12 titulo">
        <h2>Bienvenidos a Aloja</h2>
        <h3>Empleado . . .</h3>
      </div>
    </div>

    <div class="row ">
        <div class="col-lg-2 col-12 ">
            <ul class="nav d-flex flex-row flex-lg-column navegador">

              <li class="nav-item text-white">
                <img src="../img/perfil.jpg" alt="">
                <p><?php echo $empleado['usuario'];?></p>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="index_E.php">inicio</a>
              </li>


              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Registro
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="formulario.php">registro</a></li>
                  <li><a class="dropdown-item" href="ver_tablas.php">Ver datos</a></li>
                </ul>
              </li>


                
              <li class="nav-item">
                <a class="nav-link" href="galeria_E.php">Galeria</a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="ubicacion_E.php">Ubicación</a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="nosotros_E.php">información del hotel</a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="contacto_E.php">contacto y redes</a>
              </li>

              <li class="nav-item">
              <a href="../php/cerrar_sesion_admin.php">Cerrar sesión</a>
              </li>
            </ul>
        </div>


        <div class="col-lg-10 col-12">
            
                <div class="row contenido">
                    
                    <div class="col-lg-3 col-12 contenido-nosotros text-center">
                        <h3 class="text-white">historia</h3>
                        <br>
                        <p class="text-white"><?php echo $nosotros['historia']; ?></p>
                       
                    </div>

                    <div class="col-lg-3 col-12 text-center  contenido-nosotros">
                        <h3 class="text-white">atencion personalizada</h3>
                        <br>
                        <p class="text-white"><?php echo $nosotros['atencion_personalizada']; ?></p>
                    </div>

                    <div class="col-lg-3 col-12 text-center  contenido-nosotros">
                        <h3 class="text-white">filosofia de servicio</h3>
                        <br>
                        <p class="text-white"><?php echo $nosotros['filosofia_servicio']; ?></p>
                    </div>

                    <button class="btn btn-primary boton" data-bs-toggle="modal" data-bs-target="#modal20">Editar</button> 

                </div>
                
        </div>
            <div class="modal fade" id="modal20" tabindex="-1" aria-labelledby="modal20Label" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-fullscreen-sm-down">
              <div class="modal-content">
                
                <div class="modal-header">
                  <h5 class="modal-title" id="modal20Label">información</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">

                         <form method="post">
                            <div class="row">
                                <h3 class="text-center text-white">Editar nosotros</h3>

                                <div class="col-lg-6 offset-lg-3">
                                    <label class="text-white">historia:</label>
                                    <input type="text" name="historia" class="form-control mb-2" value="<?= $nosotros['historia'] ?>">

                                    <label class="text-white">atencion personalizada:</label>
                                    <input type="text" name="atencion_personalizada" id="atencion_personalizada" class="form-control mb-2" value="<?= $nosotros['atencion_personalizada'] ?>">

                                    <label class="text-white">filosofia servicio</label>
                                    <input type="text" name="filosofia_servicio" id="filosofia_servicio" class="form-control mb-2" value="<?= $nosotros['filosofia_servicio'] ?>">


                                    <button class="btn btn-success mt-3" type="submit">Guardar cambios</button>
                                </div>
                            </div>
                        </form>
    
                     
                        </div>
                    </div>
                </div>

                
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
            </div>
          </div>

        
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>

</div>
</body>
</html>