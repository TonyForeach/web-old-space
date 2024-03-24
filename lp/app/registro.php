<?php
require_once '../config/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $doc_type = $_POST['doc_type'];
    $doc_number = $_POST['doc_number'];

    // Validación de campos con jQuery Validator
    if (!isset($doc_type) || $doc_type == '') {
        http_response_code(400);
        die(json_encode(array('error' => 'Por favor seleccione un tipo de documento.')));
    }

    if ($doc_type == 'dni' && (!isset($doc_number) || $doc_number == '' || strlen($doc_number) < 8 || strlen($doc_number) > 8)) {
        http_response_code(400);
        die(json_encode(array('error' => 'Por favor ingrese un número de DNI válido.')));
    }

    if ($doc_type == 'Carnet de Extranjería' && (!isset($doc_number) || $doc_number == '' || strlen($doc_number) < 8 || strlen($doc_number) > 12)) {
        http_response_code(400);
        die(json_encode(array('error' => 'Por favor ingrese un número de carnet de extranjería válido.')));
    }

    // Verificar si el DNI ya está registrado
    $stmt = $pdo->prepare("SELECT * FROM users WHERE document_number = ?");
    $stmt->execute([$doc_number]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        http_response_code(400);
        die(json_encode(array('error' => 'El nro. de documento ya ha sido registrado anteriormente.')));
    }

    // Insertar usuario en la base de datos
    $stmt = $pdo->prepare("INSERT INTO users (full_name, document_type, document_number) VALUES (?, ?, ?)");
    $stmt->execute([$name, $doc_type, $doc_number]);

    die(json_encode(array('success' => '¡Usuario registrado con éxito!')));
}
?>