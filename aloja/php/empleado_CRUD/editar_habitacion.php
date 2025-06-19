<?php 
include "../config/conexion.php";
$id= $_GET['id'];

$sql = "SELECT * FROM habitacion WHERE id_habitacion= $id";
$resultado = mysqli_query($conexion,$sql);
$habitacion = mysqli_fetch_assoc($resultado);

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
     .form-habitacion {
        max-width: 900px;
        margin: 30px auto;
        padding: 20px;
        background-color: rgba(255,255,255,0.1);
        color: white;
        border-radius: 15px;
    }
    .form-control {
        margin-bottom: 15px;
    }
    .btn-guardar {
        background-color: #ccc;
        border: none;
        padding: 8px 25px;
        border-radius: 10px;
    }

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
            margin: 0 auto;

        }

        .filas input{
            width: 500px;
            margin: 0 auto;
            background-color: gray;

        }

        .filas select{
          width: 500px;
          margin: 0 auto;
        }

        .filas textarea{
            width: 500px;
            margin: 0 auto;
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

        
      <div class="col-lg-9 col-12 mt-5">
        <div class="row justify-content-center">
          <div class="col-md-9 p-4" style="background-color: rgba(0,0,0,0.5); border-radius: 20px; color: white;">
            <div class="row">

            
             
                            
              <!-- Formulario a la derecha -->
              <div class="col-md-8">
                <form action="actualizar_habitacion.php" method="POST" enctype="multipart/form-data" class="text-center">

                <div class="mb-3 text-center filas">
                  <label class="form-label">Imagen actual</label><br>
                  <img id="preview" src="../img/<?php echo file_exists('../img/' . $habitacion['imagen']) ? $habitacion['imagen'] : 'default.jpg'; ?>" alt="Imagen habitación" class="img-fluid rounded mb-3" style="max-height: 300px;">
                  <input type="file" id="imagen" name="imagen" class="form-control" style="max-width: 300px; margin: auto;">
                </div>
                               
                  <input type="hidden" name="id" value="<?php echo $habitacion['id_habitacion']; ?>">
                  <div class="mb-3 filas">
                    <label class="form-label">Nombre habitación</label>
                    <input type="text" name="nombre" class="form-control" value="<?php echo $habitacion['nombre']; ?>" required>
                  </div>

                  <div class="mb-3 filas">
                    <label class="form-label">Descripción</label>
                    <textarea name="dotacion" class="form-control" rows="4" required><?php echo $habitacion['dotacion']; ?></textarea>
                  </div>

                  <div class="mb-3 filas">
                    <label class="form-label">telefono encargado</label>
                    <input type="tel" name="telefono_encargado" class="form-control" value="<?php echo $habitacion['telefono_encargado']; ?>" required>
                  </div>

                  <div class="mb-3 filas">
                    <label class="form-label">Precio</label>
                    <input type="number" name="precio" class="form-control" value="<?php echo $habitacion['precio']; ?>" min="0" required>
                  </div>

                  <div class="mb-3 filas">
                    <label class="form-label">disponibilidad</label>
                    <select name="disponibilidad" class="form-control" required>
                      <option value="1" <?php echo $habitacion['disponibilidad'] == 1 ? 'selected' : ''; ?>>Disponible</option>
                      <option value="0" <?php echo $habitacion['disponibilidad'] == 0 ? 'selected' : ''; ?>>No disponible</option>
                    </select>
                  </div>

                  <input type="hidden" name="imagen_actual" value="<?php echo $habitacion['imagen']; ?>">
                  <button type="submit" class="btn btn-light" >actualizar</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

    



  <script>
    document.getElementById("imagen").addEventListener("change", function(event) {
      const file = event.target.files[0];
      const preview = document.getElementById("preview");

      if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
          preview.src = e.target.result;
          preview.style.display = "block";
        };
        reader.readAsDataURL(file);
      } 
      else {
        preview.src = "../img/<?php echo $habitacion['imagen']; ?>";
      }
    });
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>

</body>
</html>