<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Iniciar sesión - Aloja</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }

      body {
        background: linear-gradient(to bottom right, #0a0f1f, #1c1e2d, #0d1526);
        background-attachment: fixed;
      }
    </style>
  </head>
  <body class="min-h-screen flex items-center justify-center text-white relative">
    <div class="bg-gradient-to-br from-gray-950 via-indigo-950 to-blue-950 text-white shadow-2xl rounded-3xl p-10 w-full max-w-lg">
      <div class="text-center mb-8">
        <img src="img/aloja-removebg-preview.png" alt="Logo" class="w-24 h-24 p-2 mx-auto rounded-full border-4 border-white shadow-xl">
        <h1 class="text-3xl font-extrabold mt-4 bg-gradient-to-r from-zinc-100 via-indigo-200 to-blue-300 text-transparent bg-clip-text"> Bienvenido a Aloja</h1>
        <p class="text-sm text-indigo-300 mt-2">🔐 Inicia sesión para acceder a tu alojamiento ideal</p>
      </div>
      <form action="php/login.php" method="POST" class="space-y-5">
        <div>
          <label for="usuario" class="block text-sm font-semibold mb-1 text-white">👤 Usuario</label>
          <input type="text" name="usuario" id="usuario" placeholder="Ingresa tu usuario" class="w-full px-4 py-2 rounded-lg border border-gray-700 bg-gray-900 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-600">
        </div>
        <div>
          <label for="password" class="block text-sm font-semibold mb-1 text-white">🔑 Contraseña</label>
          <input type="password" name="password" id="password" placeholder="••••••" class="w-full px-4 py-2 rounded-lg border border-gray-700 bg-gray-900 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-600">
        </div>
        <div class="flex items-center justify-between">
          <a href="#" class="text-sm text-indigo-300 hover:underline">¿Olvidaste tu contraseña? 🧠</a>
        </div>
        <button type="submit" class="w-full py-2 px-4 bg-gradient-to-r from-zinc-200 via-indigo-400 to-blue-500 hover:from-blue-600 hover:to-zinc-300 text-gray-900 font-bold rounded-xl shadow-lg transition duration-300"> Iniciar sesión</button>
      </form>
      <p class="mt-6 text-center text-sm text-indigo-300">¿No tienes una cuenta? <a href="#" class="text-indigo-400 hover:underline">📝 Regístrate</a></p>
    </div>

    <script>
      document.addEventListener("DOMContentLoaded", () => {
        const form = document.querySelector("form");
        form.addEventListener("submit", (e) => {
          const usuario = document.querySelector("input[name='usuario']").value.trim();
          const password = document.querySelector("input[name='password']").value.trim();

          if (usuario === "" || password === "") {
            e.preventDefault();
            alert("Por favor, complete todos los campos.");
          } else if (usuario.length < 4) {
            e.preventDefault();
            alert("El usuario debe tener al menos 4 caracteres.");
          } else if (password.length < 6) {
            e.preventDefault();
            alert("La contraseña debe tener al menos 6 caracteres.");
          }
        });
      });
    </script>
  </body>
</html>
