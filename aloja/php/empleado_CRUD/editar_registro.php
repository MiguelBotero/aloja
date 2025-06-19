<?php 
include "../config/conexion.php";
$id= $_GET['id'];

$sql = "SELECT * FROM huesped WHERE id_huesped= $id";
$resultado = mysqli_query($conexion,$sql);
$row = mysqli_fetch_assoc($resultado);
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

        .filas label{
            font-size: 20px;
        }

        .filas input{
            width: 500px;
            margin-left:250px ;
            background-color: gray;

        }

        

        .filas textarea{
            width: 500px;
            margin-left:250px ;
        }

        .filas span{
            width: 200px;
            margin-left:420px ;

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

        
            <div class="col-12 col-lg-8 border border-1 rounded-2 shadow  sm p-3 my-3 registro justify-content-center">
                <h2 class="text-center text-white">Actualizar un registro</h2>
                <form action="actualizar_registro.php" method="post">
                    
                    <div class="mb-2 text-white">
                    <input type="hidden" name="id_huesped" id="id_huesped" value="<?= $row['id_huesped'] ?>">
                    </div>

                    <div class="mb-2 text-white filas">
                        <label for="nombre_completo" class="form-label">nombre completo</label>
                        <input type="text" class="form-control" id="nombre_completo" name="nombre_completo" required >
                    </div>

                    <div class="mb-2 text-white filas">
                        <label for="tipo_documento" class="form-label">tipo documento</label>
                        <select name="tipo_documento" id="tipo_documento" required>
                            <option value="">Selecciona una opción</option>
                            <option value="cedula">cedula</option>
                            <option value="Pasaporte">Pasaporte</option>
                            <option value="Carnet de extranjería">Carnet de extranjería</option>
                            <option value="Otro">Otro</option>
                        </select>
                    </div>

                    <div class="mb-2 text-white filas">
                        <label for="numero_documento" class="form-label">número documento</label>
                        <input type="number" class="form-control" id="numero_documento" name="numero_documento" required>
                    </div>
                    
                    <div class="mb-2 text-white filas">
                        <label for="telefono_huesped" class="form-label">telefono huesped</label>
                        <input type="number" class="form-control" id="telefono_huesped" name="telefono_huesped" required>
                    </div>
                    
                    <div class="mb-2 text-white filas">
                        <label for="origen" class="form-label">origen</label>
                        <input type="text" class="form-control" id="origen" name="origen" required>
                    </div>
                    
                    <div class="mb-2 text-white filas">
                        <label for="nombre_contacto" class="form-label">nombre contacto</label>
                        <input type="text" class="form-control" id="nombre_contacto" name="nombre_contacto" required>
                    </div>
                    
                    <div class="mb-2 text-white filas">
                        <label for="telefono_contacto" class="form-label">telefono contacto</label>
                        <input type="number" class="form-control" id="telefono_contacto" name="telefono_contacto" required>
                    </div>
                    
                    <div class="mb-2 text-white filas">
                        <span class="input-group-text">observaciones</span>
                        <textarea name="observaciones" id="observaciones" class="form-control" aria-label="with textarea"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Actualizar</button>
                
                </form>
            </div>

        
    </div>
</div>
    



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>

</body>
</html>