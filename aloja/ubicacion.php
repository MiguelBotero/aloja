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

        li{
            list-style-type: none;
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

        .mapa{
            background-color: rgba(243, 228, 228, 0.1);
            margin-top: 20px;
            border: 1px solid white;
            height: 500px;
            width: 100%;
        }
        .direccion{
            margin-top: 20px;
            background-color: rgba(243, 228, 228, 0.1);
            height: 500px;
            border: 1px solid white;
            
        }

        .contenedor{
            background-color: rgba(243, 228, 228, 0.1);
            margin-top: 30px;
            height: 100%;
        }

    </style>
  </head>
  <body>
    <div class="">

        <div class="row">
          <div class="col-12 titulo">
            <h3 class="text-center">Bienvenido a Aloja</h3>
          </div>
        </div>


        <div class="row">
            <div class="col-lg-2 col-12 ">
                <ul class="nav d-flex flex-row flex-lg-column navegador text-center">

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
                        <a class="nav-link" href="#">Ubicación</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="nosotros.php">Nosotros</a>
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
                <div class="row contenedor">
                    

                        <div class="col-5">
                            <div class=" text-white direccion">
                                <img src="img/foto-hotel.jpg" alt="" style="width: 100%; height: 450px;">
                            </div>
                        </div>
                    
                        <div class="col-5 ">
                            <div  class="mapa">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3811.176182717322!2d-75.56854100031241!3d6.250283055282282!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e4428f8c95aa461%3A0xf5680e5fb8a4b8e8!2sParque%20Berr%C3%ADo!5e1!3m2!1ses!2sco!4v1745466284358!5m2!1ses!2sco" 
                                    width="100%" 
                                    height="450" 
                                    style="border:0;" 
                                    allowfullscreen="" 
                                    loading="lazy" 
                                    referrerpolicy="no-referrer-when-downgrade" >
                                </iframe>
                            </div>
                        </div>
                    


                </div>
            </div>

        </div>

        
        


    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
  </body>
</html>