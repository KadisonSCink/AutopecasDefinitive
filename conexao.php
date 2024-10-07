<?php
    try {
        $conn = new PDO("mysql:localhost=localhost;dbname=lojadeautopecas", "root", "");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo 'Conexão falhou: ' . $e->getMessage();
    }
?>