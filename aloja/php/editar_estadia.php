<?php
include "../config/conexion.php";

// Verificar si se recibió el ID por GET
if (!isset($_GET['id'])) {
    echo "ID de estadía no proporcionado.";
    exit();
}

$id = $_GET['id'];

// Obtener datos actuales
$sql = "SELECT * FROM estadia WHERE id_estadia = $id";
$resultado = mysqli_query($conexion, $sql);
$estadia = mysqli_fetch_assoc($resultado);

if (!$estadia) {
    echo "Estadía no encontrada.";
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">

   <link rel="stylesheet" href="../css/pagina5.css">


   <style>
    

    .titulo {
            background-color: rgba(0, 0, 0, 0.289);
         }
 
        .titulo h3{
         font-size: 100px;
         color: white;
        }
 
        .titulo h1{
           color: gray;
           margin-left: 325px;
           text-align: left;
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


        .contenedor{
            background-color: rgba(0, 0, 0, 0.289);
            margin: 0 auto;
            height: 500px;
        }

        .filas label{
            font-size: 20px;
            color: aliceblue;
        }

        .filas input{
            width: 400px;
            margin-left:30px ;
            background-color: rgba(83, 83, 83, 0.63);
            color: aliceblue;

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
            <a class="nav-link" href="../administrador/index_admin.php">inicio</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="../administrador/habitacion.php">gestión de habitaciones</a>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Registro
            </a>

            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="../administrador/registro_admin.php"> datos huesped</a></li>
              <li><a class="dropdown-item" href="../administrador/ver_registros.php">Ver datos</a></li>
              <li><a class="dropdown-item" href="../administrador/ver_registros.php">hacer registro</a></li>
                  
            </ul>
          </li>
                
          <li class="nav-item">
            <a class="nav-link" href="../administrador/galeria_admin.php">Galeria</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="../administrador/ubicacion_admin.php">Ubicación</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="../administrador/nosotros_admin.php">información del hotel</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="../administrador/contactos_admin.php">contacto y redes</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="../index.php">Inicio de sesión</a>
          </li>
        </ul>
      </div>

        
      <div class="col-lg-10 col-12 mt-5">
       
        <!-- Formulario -->
        <h3 class="text-center text-white">Editar Estadía</h3>
        <div class="col-md-9 form-container contenedor">

       
            <form method="POST" action="actualizar_estadia.php">

                <input type="hidden" name="id_estadia" value="<?= $estadia['id_estadia'] ?>">

                <div class="filas  text-center">
                    <label>Fecha Inicio:</label><br>
                    <input type="date" name="fecha_inicio" value="<?= $estadia['fecha_inicio'] ?>" required><br><br>
                </div>

                <div class="filas  text-center">
                    <label>Fecha Fin:</label><br>
                    <input type="date" name="fecha_fin" value="<?= $estadia['fecha_fin'] ?>" required><br><br>
                </div>

                <div class="filas  text-center">
                    <label>Fecha Registro:</label><br>
                    <input type="datetime" name="fecha_registro" value="<?= $estadia['fecha_registro'] ?>" required><br><br>
                </div>
                
                <div class="filas  text-center">
                    <label>Costo:</label><br>
                    <input type="number" name="costo" value="<?= $estadia['costo'] ?>" required><br><br>
                </div>

                <div class="filas  text-center">
                    <label>ID Habitación:</label><br>
                    <input type="number" name="id_habitacion" value="<?= $estadia['id_habitacion'] ?>" required><br><br>
                </div>

                <button type="submit">Actualizar</button>
               
            </form>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>

</body>
</html>

