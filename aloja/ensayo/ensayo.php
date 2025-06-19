<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Selector de formularios</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">

  <div class="container mt-4">
    <label for="formSelect" class="form-label">Seleccione el formulario que deseas ver:</label>
    <select class="form-select" id="formSelect">
      <option value="">-- Seleccione --</option>
      <option value="huesped">Huésped</option>
      <option value="habitacion">Habitación</option>
      <option value="empleados">Empleados</option>
    </select>
  </div>

  <!-- Formulario Huésped -->
  <div id="huesped" class="formulario d-none container mt-4">
    <h4>Formulario de Huésped</h4>
    <input type="text" class="form-control mb-2" placeholder="Nombre del huésped">
  </div>

  <!-- Formulario Habitación -->
  <div id="habitacion" class="formulario d-none container mt-4">
    <h4>Formulario de Habitación</h4>
    <input type="text" class="form-control mb-2" placeholder="Número de habitación">
  </div>

  <!-- Formulario Empleados -->
  <div id="empleados" class="formulario d-none container mt-4">
    <h4>Formulario de Empleados</h4>
    <input type="text" class="form-control mb-2" placeholder="Nombre del empleado">
  </div>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const selector = document.getElementById("formSelect");
      const formularios = document.querySelectorAll(".formulario");

      selector.addEventListener("change", function () {
        // Ocultar todos
        formularios.forEach(f => f.classList.add("d-none"));

        // Mostrar el formulario seleccionado
        const seleccionado = selector.value;
        const formulario = document.getElementById(seleccionado);
        if (formulario) {
          formulario.classList.remove("d-none");
        }
      });
    });
  </script>

</body>
</html>
