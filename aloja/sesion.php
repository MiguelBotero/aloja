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
            
            .formulario{
                background-color: rgba(243, 228, 228, 0.1);
                width: 400px;
                height: 400px;
                margin: 0 auto;
                margin-top: 15px;
                padding: 0 auto;
                border: 1px solid white;
                border-radius: 20px;

            }

            .formulario h3{
                margin-top: 20px;
            }

            .formulario label{
                margin-top: 30px;
            }

            .formulario input{
                width: 355px;
                height: 30px;
                margin-left: 20px;
                margin-right: 20px;
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
                        <a class="nav-link" href="nosotros.php">Nosotros</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="contactos.php">Contactos</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#">Inicio de sesión</a>
                    </li>
                </ul>
            </div>

                <div class="col-lg-10 col-12">
                    
                    <div class="formulario text-center text-white">
                        <h3>Inicio Sesión</h3>
                        <form action="php/login.php" method="POST">
                            <div class="mb-1">
                                <label for="usuario" class="form-label">Usuario</label>
                                <input type="usuario" class="form-control " id="email" name="usuario" aria-describedby="email">
                                
                            </div>

                            <div class="mb-2">
                                <label for="Password" class="form-label">Password</label>
                                <input type="password" class="form-control p-3" id="Password" name="password">
                            </div>
                        
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            

        </div>

        <div class="row"></div>


    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>

    <script>

        
        document.addEventListener("DOMContentLoaded", () => {
            const form = document.querySelector("form");
            form.addEventListener("submit", (e) => {
                const usuario = document.querySelector("input[name='usuario']").value.trim();
                const password = document.querySelector("input[name='password']").value.trim();

                if (usuario === "" || password === "") {
                    e.preventDefault(); // Evita el envío
                    alert("Por favor, complete todos los campos.");
                }

                else if (usuario.length < 4) {
                    e.preventDefault();
                    alert("El usuario debe tener al menos 4 caracteres.");
                }   
                
                else if (password.length < 6) {
                    e.preventDefault();
                    alert("La contraseña debe tener al menos 6 caracteres.");
                }
            });
        });

    </script>

  </body>
</html>