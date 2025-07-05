


// Validación de formularios huesped
    document.getElementById("formHuesped").addEventListener("submit", function (event) { // Cambia "formHuesped" por el ID correcto
        const form = event.target;   
        let valido = true;   

        // Ocultar todos los errores previos
        document.querySelectorAll("p[id^='error-']").forEach(p => p.classList.add("hidden"));

        // Validar cada campo
        const campos = [     // Cambia la lista de campos según tus necesidades
            "nombre_completo", 
            "tipo_documento",
            "numero_documento",
            "telefono_huesped",
            "origen",
            "nombre_contacto",
            "telefono_contacto",
            "observaciones"
        ];

    
        
        
        campos.forEach(campo => {      
            const input = form[campo];    
            const errorP = document.getElementById("error-" + campo);   // Cambia el ID del error según tus necesidades
            if (input && !input.checkValidity()) {                      // Verifica si el campo es válido
                errorP.classList.remove("hidden");                      // Muestra el error
                valido = false;                                         // Marca el formulario como no válido
            }                                                           
        });

        if (!valido) {                                                                                    // Verifica si el formulario es válido  
            event.preventDefault();                                                                       // Evita el envío del formulario
            const notificacion = document.getElementById("notificacion");                                 // Cambia el ID de la notificación según tus necesidades
            notificacion.textContent = "❗ Por favor corrige los errores indicados en el formulario.";   // Cambia el texto de la notificación según tus necesidades
            notificacion.classList.remove("hidden");                                                     // Muestra la notificación
        }
    });



// Validación de formularios habitaciones
    document.getElementById("formHabitacion").addEventListener("submit", function (event) {
        const form = event.target;
        let valido = true;

        // Ocultar errores previos
        document.querySelectorAll("p[id^='error-']").forEach(p => p.classList.add("hidden"));

        // Validaciones
        const campos = [
            { id: "imagen", tipo: "file" },
            { id: "nombre" },
            { id: "dotacion" },
            { id: "precio", tipo: "numero" }
        ];

        campos.forEach(campo => {
            const input = document.getElementById(campo.id);
            const errorP = document.getElementById("error-" + campo.id);
            if (campo.tipo === "file") {
                if (!input.files || input.files.length === 0) {
                    errorP.classList.remove("hidden");
                    valido = false;
                }
            } else if (!input.checkValidity()) {
                errorP.classList.remove("hidden");
                valido = false;
            }
        });

        if (!valido) {
            event.preventDefault();
            const notificacion = document.getElementById("notificacion");
            notificacion.textContent = "❗ Por favor corrige los errores indicados en el formulario.";
            notificacion.classList.remove("hidden");
        }
    });



//validacion de formulario empleado
    document.getElementById("formEmpleado").addEventListener("submit", function (event) {
        const form = event.target;
        let valido = true;

        // Ocultar todos los errores primero
        document.querySelectorAll("div[id^='error-']").forEach(el => el.classList.add("hidden"));

        // Validar Nombre completo
        const nombre = document.getElementById("nombre_C");
        if (!nombre.checkValidity()) {
            document.getElementById("error-nombre_completo").classList.remove("hidden");
            valido = false;
        }

        // Validar Usuario
        const usuario = document.getElementById("usuario");
        if (!usuario.checkValidity()) {
            document.getElementById("error-usuario").classList.remove("hidden");
            valido = false;
        }

        // Validar Contraseña
        const password = document.getElementById("password");
        if (!password.checkValidity()) {
            document.getElementById("error-password").classList.remove("hidden");
            valido = false;
        }

        // Mostrar mensaje general si hay errores
        const notificacion = document.getElementById("notificacion");
        if (!valido) {
            event.preventDefault();
            notificacion.textContent = "❗ Por favor, corrige los errores en los campos resaltados.";
            notificacion.classList.remove("hidden");
        } else {
            notificacion.classList.add("hidden");
        }
    });



// validación de estadia
    document.getElementById("formEstadia").addEventListener("submit", function (event) {
        const form = event.target;
        let valido = true;

        // Ocultar todos los errores previos
        document.querySelectorAll("p[id^='error-']").forEach(p => p.classList.add("hidden"));

            // Lista de campos a validar
            const campos = [
                "fecha_inicio",
                "fecha_fin",
                "fecha_registro",
                "costo",
                "id_habitacion"
            ];

            // Validar cada campo
            campos.forEach(campo => {
                const input = form[campo];
                const errorP = document.getElementById("error-" + campo);
                if (input && !input.checkValidity()) {
                    errorP.classList.remove("hidden");
                    valido = false;
                }
            });

            // Validación lógica: fecha_fin no puede ser menor que fecha_inicio
            const fechaInicio = form["fecha_inicio"].value;
            const fechaFin = form["fecha_fin"].value;
            const errorFechaLogica = document.getElementById("error-fecha-logica");

            if (fechaInicio && fechaFin && fechaFin < fechaInicio) {
                errorFechaLogica.classList.remove("hidden");
                valido = false;
            }

            // Mostrar notificación general si hay errores
            if (!valido) {
                event.preventDefault();
                const notificacion = document.getElementById("notificacion");
                notificacion.textContent = "❗ Por favor corrige los errores indicados en el formulario.";
                notificacion.classList.remove("hidden");
            }
    });




//validacion de novedades


  document.getElementById("formNovedad").addEventListener("submit", function (event) {
    const form = event.target;
    let valido = true;

    // Ocultar errores anteriores
    document.querySelectorAll("p[id^='error-']").forEach(p => p.classList.add("hidden"));

    const campos = ["descripcion", "id_estadia"]; 

    campos.forEach(campo => {
      const input = form[campo];
      const errorP = document.getElementById("error-" + campo);
      if (input && !input.checkValidity()) {
        errorP.classList.remove("hidden");
        valido = false;
      }
    });

    if (!valido) {
      event.preventDefault();
      const notificacion = document.getElementById("notificacion");
      notificacion.textContent = "❗ Por favor corrige los errores indicados en el formulario.";
      notificacion.classList.remove("hidden");
    }
  });




//validacion de huesped has estado

    document.getElementById("formHuespedHasEstado").addEventListener("submit", function (event) {
    const form = event.target;
    let valido = true;

    // Ocultar errores anteriores
    document.querySelectorAll("p[id^='error-']").forEach(p => p.classList.add("hidden"));

    // Campos a validar
    const campos = ["id_huesped", "id_estadia"];

    campos.forEach(campo => {
        const input = document.getElementById(campo);
        const errorP = document.getElementById("error-" + campo);
        if (!input || !input.checkValidity()) {
        errorP.classList.remove("hidden");
        valido = false;
        }
    });

    if (!valido) {
        event.preventDefault();
        const notificacion = document.getElementById("notificacion");
        notificacion.textContent = "❗ Por favor corrige los errores antes de continuar.";
        notificacion.classList.remove("hidden");
    }
    });
    
//validacion de pagos
    
    document.getElementById("formPago").addEventListener("submit", function (event) {
        const form = event.target;
        let valido = true;
    
        // Ocultar errores anteriores
        document.querySelectorAll("p[id^='error-']").forEach(p => p.classList.add("hidden"));
    
        const campos = [
            "fecha_pago",
            "valor",
            "id_huesped2",
            "id_estadia2",
            "id_empleado2",
            "imagen2",
            "observacion"
        ];
    
        campos.forEach(campo => {
            const input = document.getElementById(campo);
            const errorP = document.getElementById("error-" + campo);
    
            if (input && !input.checkValidity()) {
            errorP.classList.remove("hidden");
            valido = false;
            }
        });
    
        if (!valido) {
            event.preventDefault();
            const notificacion = document.getElementById("notificacion");
            notificacion.textContent = "❗ Por favor corrige los errores en los campos resaltados.";
            notificacion.classList.remove("hidden");
        } else {
            document.getElementById("notificacion").classList.add("hidden");
        }
    });


//validacion de tarifas

    document.getElementById("formTarifas").addEventListener("submit", function (event) {
    const campos = ["dia", "semana", "quincena", "mensual", "id_habitacion2"];
    let valido = true;

    // Ocultar errores anteriores
    campos.forEach(id => {
        document.getElementById("error-" + id).classList.add("hidden");
    });

    // Validar cada campo
    campos.forEach(id => {
        const input = document.getElementById(id);
        if (!input.checkValidity() || input.value.trim() === "" || (input.type === "number" && parseInt(input.value) <= 0)) {
        document.getElementById("error-" + id).classList.remove("hidden");
        valido = false;
        }
    });

    // Mostrar notificación general si hay errores
    const noti = document.getElementById("notificacion");
    if (!valido) {
        event.preventDefault();
        noti.classList.remove("hidden");
    } else {
        noti.classList.add("hidden");
    }
    });


//validacion de otros ingresos




