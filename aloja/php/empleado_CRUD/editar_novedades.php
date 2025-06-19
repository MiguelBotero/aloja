<?php include '../config/conexion.php'; // Asegúrate de que este archivo existe y se conecta correctamente

if (!isset($_GET['id'])) {
    echo "ID no especificado.";
    exit();
}

$id = $_GET['id'];

// Obtener datos actuales del empleado
$sql = "SELECT * FROM empleado WHERE id_empleado = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows == 0) {
    echo "Empleado no encontrado.";
    exit();
}

$empleado = $resultado->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre_completo'];
    $usuario = $_POST['usuario'];
    $password = $_POST['password']; // Podrías aplicar hash aquí si lo deseas

    $sql_update = "UPDATE empleados SET nombre_completo = ?, usuario = ?, password = ? WHERE id_empleado = ?";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param("sssi", $nombre, $usuario, $password, $id);

    if ($stmt_update->execute()) {
        echo "<script>alert('Empleado actualizado correctamente'); window.location.href='empleados_admin.php';</script>";
    } else {
        echo "Error al actualizar empleado.";
    }
}
?>


<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Agregar Estadía - Aloja</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/pagina5.css">
  <style>
   
   .titulo {
    background-color: rgba(0, 0, 0, 0.289);
    }

    .titulo h3{
        font-size: 105px;
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

    .form-container {
      background-color: rgba(127, 126, 126, 0.41);
      padding: 30px;
      border-radius: 15px;
      margin-top: 30px;
      height: 525px;
      margin-left: 50px;

    }


    .button{
      width: 200px;
      background-color: rgba(11, 59, 180, 0.5);
    }

    .filas label{
            font-size: 30px;
            color: aliceblue;
        }

        .filas input{
            width: 500px;
            margin: 0 auto;
            background-color: gray;


        }

        


  </style>
</head>
<body>
  <div class="text-center">

      
        <div class="row">
            <div class="col-12 titulo">
              <h3>Bienvenido a Aloja</h3>
              <h1>Administrador . . .</h1>
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
                  <li><a class="dropdown-item" href="../administrador/estadia_admin.php">estadia</a></li>
                  <li><a class="dropdown-item" href="#">empleado</a></li>
                  <li><a class="dropdown-item" href="../administrador/ver_tablas.php">Ver datos</a></li>
                  
                </ul>
              </li>


                
              <li class="nav-item">
                <a class="nav-link" href="galeria_admin.php">Galeria</a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="ubicacion_admin.php">Ubicación</a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="nosotros_admin.php">información del hotel</a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="contactos_admin.php">contacto y redes</a>
              </li>

              <li class="nav-item">
              <a href="../php/cerrar_sesion_admin.php">Cerrar sesión</a>
              </li>
            </ul>
          </div>


            <div class="col-12 col-lg-8 border border-1 rounded-2 shadow sm p-3 my-3 registro justify-content-center">
                <h2 class="text-center text-white">Actualizar un registro</h2>
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 bg-dark p-4 rounded shadow">

                    <h2 class="text-center mb-4 text-white">Editar Novedad</h2>
                    <form action="../php/actualizar_novedades.php" method="POST">

                        <input type="hidden" name="id_novedades" value="<?= $novedades['id_novedades'] ?>">
                        
                        <div class="mb-3">
                        <label class="form-label text-white" for="descripcion">Descripción</label>
                        <input type="text" class="form-control" name="descripcion" value="<?= $novedades['descripcion'] ?>" required>
                        </div>
                                                    
                        <div class="mb-3">
                        <label class="form-label text-white" for="id_estadia">ID Estadía</label>
                        <input type="text" class="form-control" name="id_estadia" value="<?= $novedades['id_estadia'] ?>" required>
                        </div>
                                                
                        <div class="mb-3">
                        <button type="submit" class="btn btn-dark">Actualizar novedad</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>

                        
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


