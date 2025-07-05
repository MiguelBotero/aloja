document.addEventListener("DOMContentLoaded", function () {
    const formSelect = document.getElementById("formSelect");
    const formContainers = document.querySelectorAll(".form-container");
                
    //SCRIPTS PARA SELECCIONAR LOS FORMULARIOS 
    function mostrarFormulario(id) {
      formContainers.forEach(container => {
        container.classList.add("d-none");
      });

      const selectedForm = document.getElementById(id);
      if (selectedForm) {
        selectedForm.classList.remove("d-none");
      }
    }

    // Cambiar formulario al seleccionar
    formSelect.addEventListener("change", function () {
      mostrarFormulario(this.value);
    });

    // Mostrar formulario inicial (por defecto)
    mostrarFormulario(formSelect.value);
  });




      //SCRIPTS PARA EL FORMULARIO DE LA HABITACIÓN (IMAGENES)


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
        } else {
        preview.style.display = "none";
        }
    });



      //SCRIPTS PARA LA DISPONIBILIDAD

    const switchInput = document.getElementById("disponibilidad");
    const dispoLabel = document.getElementById("dispo-label");

    function actualizarSwitchColor() {
        if (switchInput.checked) {
        switchInput.style.backgroundColor = "#28a745"; // verde
        dispoLabel.textContent = "Disponible";
        } else {
        switchInput.style.backgroundColor = "#dc3545"; // rojo
        dispoLabel.textContent = "No disponible";
        }
    }

    // Escucha cambios
    switchInput.addEventListener("change", actualizarSwitchColor);

    // Carga inicial
    window.addEventListener("DOMContentLoaded", actualizarSwitchColor);