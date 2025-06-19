<?php
// Conexión a la base de datos
$conn = new mysqli("localhost", "root", "", "aloja");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $whatsapp = $_POST['whatsapp'];
    $telefono = $_POST['telefono'];
    $facebook = $_POST['facebook'];
    $instagram = $_POST['instagram'];
    $tiktok = $_POST['tiktok'];
    $recepcion = $_POST['recepcion'];
    $eventos = $_POST['eventos'];
    $reservas_email = $_POST['reservas_email'];
    $recursos_email = $_POST['recursos_email'];
    $twitter = $_POST['twitter'];
    $email = $_POST['email'];

    $conn->query("UPDATE contactos SET 
        whatsapp='$whatsapp',
        telefono='$telefono',
        facebook='$facebook',
        instagram='$instagram',
        tiktok='$tiktok',
        recepcion='$recepcion',
        eventos='$eventos',
        reservas_email='$reservas_email',
        recursos_email='$recursos_email',
        twitter='$twitter',
        email='$email'
        
        WHERE id=1
    ");
    echo "<script>alert('Datos actualizados correctamente'); location.href='contactos_admin.php';</script>";
}

$contacto = $conn->query("SELECT * FROM contactos LIMIT 1")->fetch_assoc();
?>

<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Panel Admin - Contactos</title>
  <link rel="stylesheet" href="../css/pagina5.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">

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

      .titulo {
          background-color: rgba(0, 0, 0, 0.289);
      }

      .titulo h2{
        font-size: 100px;
        color: white;
      }

      .titulo h3{
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
        <h3>Administrador . . .</h3>
      </div>
    </div>

    <div class="row">
        <div class="col-lg-2 col-12 ">
            <ul class="nav d-flex flex-row flex-lg-column navegador">

              <li class="nav-item">
                <img src="" alt="">
              </li>

              <li class="nav-item">
                <a class="nav-link" href="index_admin.php">inicio</a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="habitacion.php">gestión de habitaciones</a>
              </li>

              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Registro
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="registro_admin.php"> datos huesped</a></li>
                  <li><a class="dropdown-item" href="ver_tablas.php">Ver datos</a></li>
                  
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

        <div class="col-lg-10 col-12">
            <form method="post">
                <div class="row">
                    <h3 class="text-center text-white">Editar Contactos</h3>

                    <div class="col-lg-6 offset-lg-3">
                        <label class="text-white">WhatsApp:</label>
                        <input type="tel" name="whatsapp" class="form-control mb-2" value="<?= $contacto['whatsapp'] ?>">

                        <label class="text-white">Teléfono:</label>
                        <input type="tel" name="telefono" class="form-control mb-2" value="<?= $contacto['telefono'] ?>">

                        <label class="text-white">Facebook:</label>
                        <input type="text" name="facebook" class="form-control mb-2" value="<?= $contacto['facebook'] ?>">

                        <label class="text-white">Instagram:</label>
                        <input type="text" name="instagram" class="form-control mb-2" value="<?= $contacto['instagram'] ?>">

                        <label class="text-white">TikTok:</label>
                        <input type="text" name="tiktok" class="form-control mb-2" value="<?= $contacto['tiktok'] ?>">

                        <label class="text-white">recepcion:</label>
                        <input type="tel" name="recepcion" class="form-control mb-2" value="<?= $contacto['recepcion'] ?>">

                        <label class="text-white">eventos:</label>
                        <input type="text" name="eventos" class="form-control mb-2" value="<?= $contacto['eventos'] ?>">

                        <label class="text-white">reservas_email:</label>
                        <input type="text" name="reservas_email" class="form-control mb-2" value="<?= $contacto['reservas_email'] ?>">

                        <label class="text-white">recursos_email:</label>
                        <input type="text" name="recursos_email" class="form-control mb-2" value="<?= $contacto['recursos_email'] ?>">

                        <label class="text-white">twitter:</label>
                        <input type="text" name="twitter" class="form-control mb-2" value="<?= $contacto['twitter'] ?>">

                        <label class="text-white">email:</label>
                        <input type="text" name="email" class="form-control mb-2" value="<?= $contacto['email'] ?>">


                        <button class="btn btn-success mt-3" type="submit">Guardar cambios</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

