<?php
    require 'dbconn.php';
    
    //Mostrar os colaboradores que estao desativados
    $mostrarDesativados = isset($_GET['mostrarDesativados']) && $_GET['mostrarDesativados'] == "1";
    
    $query = "SELECT * FROM colaboradores";
    if (!$mostrarDesativados) {
      $query .= " WHERE Ativado = 'S'";
    }
    
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
      echo '<td><button id="' . $row['id'] . '" class="btn btn-primary">Editar</button></td>';
      echo "</tr>";
    }
?>