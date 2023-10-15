<?php
    $conn = mysqli_connect("localhost", "root", "", "colaboradores");

    if ($conn->connect_error) {
        die("Falha na conexão: " . $conn->connect_error);
    }
?>
