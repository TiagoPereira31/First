<?php
    require 'dbconn.php';

    $query = "SELECT * FROM colaboradores WHERE Ativado = 'S'";
    $result = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['nome'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>" . $row['telefone'] . "</td>";
        echo "<td>" . $row['morada'] . "</td>";
        echo "<td>" . $row['contribuinte'] . "</td>";
        echo "<td>" . $row['Ativado'] . "</td>";
        echo '<td><button id="' . $row['id'] . '">Editar</button></td>';
        echo "</tr>";
    }
?>