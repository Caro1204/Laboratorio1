<?php

function getDB(){
    try {
        $db = new PDO('mysql:host=localhost;dbname=db_deudas;charset=utf8', 'root', ''); 
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
        exit;
    }
}
function getPagos(){
    $db = getDB();
    $sentencia = $db->prepare("SELECT * FROM pagos");
    $sentencia->execute();
    return $sentencia->fetchAll(PDO::FETCH_OBJ);
}
function addPago($deudor, $cuota, $cuota_capital, $fecha_pago){
    $db = getDB();
    $sentencia = $db->prepare("INSERT INTO pagos (deudor, cuota, cuota_capital, fecha_pago) VALUES (?, ?, ?, ?)");
    $sentencia->execute([$deudor, $cuota, $cuota_capital, $fecha_pago]);
}

?>
