<?php
$servername = "localhost"; // Nombre del servidor de la base de datos
$username = "root"; // Nombre de usuario de la base de datos
$password = ''; // Contraseña de la base de datos
$dbname = "ganaconos_bdusers_register"; // Nombre de la base de datos

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
} catch(PDOException $e) {
    // en caso de que haya un error en la conexión, se muestra un mensaje de error
    echo "Error de conexión: " . $e->getMessage();
    exit();
}

?>
