<?php
if (isset($_SESSION['usuario'])) {
     // El usuario ya ha iniciado sesión
     echo "Bienvenido, " . $_SESSION['usuario'] . "!<br>";
     echo "<a href='cerrar_sesion.php'>Cerrar Sesión</a>";
} else {
     // El usuario no ha iniciado sesión
     echo "Por favor, inicie sesión:<br>";
     echo "<form method='post' action='login.php'>";
     $usuario = isset($_COOKIE['usuario']) ? $_COOKIE['usuario'] : '';
     echo "Usuario: <input type='text' name='usuario' value='$usuario'><br>";
     echo "Contraseña: <input type='password' name='contrasena'><br>";
     echo "<input type='submit' value='Iniciar Sesión'>";
     echo "</form>";
}
