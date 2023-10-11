<?php
session_start();

// Verificar si se enviaron datos de inicio de sesión
if (isset($_POST['usuario']) && isset($_POST['contrasena'])) {
     $usuario = $_POST['usuario'];
     $contrasena = $_POST['contrasena'];

     // Verificar las credenciales (en un sistema real, esto debería ser más seguro)
     if ($usuario === 'usuario' && $contrasena === 'contrasena') {
          $_SESSION['usuario'] = $usuario; // Iniciar sesión

          // Guardar el nombre de usuario en una cookie
          setcookie('usuario', $usuario, time() + 3600 * 24 * 7); // Validez de una semana

          header('Location: index.php'); // Redirigir al usuario a la página principal
     } else {
          echo "Credenciales incorrectas. Por favor, inténtelo de nuevo.";
     }
} else {
     echo "Por favor, complete todos los campos.";
}

