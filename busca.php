<?php
    require "dbconn.php";

    if (isset($_POST['submit'])) {
        $busca = $_POST['busca'];
        $sql = "SELECT id, nome, email, morada, telefone, contribuinte, Ativado 
            FROM colaboradores 
            WHERE id LIKE '%$busca%' OR 
            nome LIKE '%$busca%' OR 
            email LIKE '%$busca%' OR 
            telefone LIKE '%$busca%' OR 
            morada LIKE '%$busca%' OR 
            contribuinte LIKE '%$busca'";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Telefone</th>
                    <th>Morada</th>
                    <th>Nº Contribuinte</th>
                    <th>Ativo</th>
                </tr>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>" . $row["id"] . "</td>
                    <td>" . $row["nome"] . "</td>
                    <td>" . $row["email"] . "</td>
                    <td>" . $row["telefone"] . "</td>
                    <td>" . $row["morada"] . "</td>
                    <td>" . $row["contribuinte"] . "</td>
                    <td>" . $row["Ativado"] . "</td>
                </tr>";
            }
            echo "</table>";
        } else {
            echo "Nenhum registro encontrado.";
        }
    } else {
        echo "Nenhum termo de busca foi inserido.";
    }
?>

<htm><head>
    <!--Estilo da tabela-->
    <style>
      table {
          border-collapse: collapse;
      }

      th, td {
        border: 1px solid black;
        padding: 8px;
      }

  </style>
  <!--Fim do estilo da Tabela-->

  <a href="index.php">Voltar</a>
</head></htm>