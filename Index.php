<!DOCTYPE html>
<html>
<head>
    <title>Tabela de Colaboradores</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&family=Montserrat:wght@400;700&display=swap" rel="stylesheet">

    <!--Estilo da tabela e fontes-->
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
        }

        h1 {
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        #adicionarForm {
            display: none;
            margin-top: 20px;
        }

        .btn {
            padding: 10px 20px;
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        #adicionarBtn {
            background-color: #28A745;
        }

        .box-search {
            margin-top: 20px;
        }
    </style>
    <!--Fim do estilo da tabela e fontes-->
</head>
<body>
<h1>Colaboradores</h1>

<!--Barra de pesquisa-->
<form method="POST" action="busca.php">
    <input type="text" name="busca" placeholder="Procurar" class="form-control w-25">
    <button type="submit" name="submit" class="btn btn-primary">
        <i class="bi bi-search"></i> Procurar
    </button>
</form>
<!--Fim da Barra de pesquisa-->

<!--Adicionar colaboradores-->
<button type="button" onclick="adicionar()" class="btn" id="adicionarBtn">Adicionar Colaborador</button>
<!--Formulario para adicionar um novo colaborador (inicialmente oculto)-->
<div id="adicionarForm">
    <h2>Adicionar Novo Colaborador</h2>
    <form method="post" action="adicionar.php">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" required><br>

        <label for="telefone">Telefone:</label>
        <input type="text" name="telefone" required><br>

        <label for="morada">Morada:</label>
        <input type="text" name="morada" required><br>

        <label for="contribuinte">Nº Contribuinte:</label>
        <input type="text" name="contribuinte" required><br>

        <input type="checkbox" id="ativado" name="Ativado" value="S" checked>
        <label for="ativado">Ativar</label>

        <input type="submit" value="Adicionar" class="btn">
    </form>
</div>
<!--Fim adicionar colaboradores-->

<!--Checkbox mostrar colaboradores desativados-->
<form method="GET" action="mostrarDesativados.php">
    <label>
        <input type="checkbox" id="mostrarDesativados" name="mostrarDesativados" value="1">Mostrar colaboradores não ativos
    </label>
</form>
<!--Fim checkbox mostrar colaboradores desativados-->

<br>

<!--Inicio do codigo da tabela-->
<table id="colaboradores">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Telefone</th>
            <th>Morada</th>
            <th>Nº Contribuinte</th>
            <th>Ativo</th>
        </tr>
    </thead>
    <tbody id="colaboradoresBody">
        <!--Mostrar os colaboradores na tabela-->
        <?php
          require 'dbconn.php';
          $query = "SELECT * FROM colaboradores WHERE Ativado = 'S'";
          $result = mysqli_query($conn, $query);

          if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
              echo "<tr>";
              echo "<td>" . $row['id'] . "</td>";
              echo "<td>" . $row['nome'] . "</td>";
              echo "<td>" . $row['email'] . "</td>";
              echo "<td>" . $row['telefone'] . "</td>";
              echo "<td>" . $row['morada'] . "</td>";
              echo "<td>" . $row['contribuinte'] . "</td>";
              echo "<td>" . $row['Ativado'] . "</td>";
              echo '<td><button class="btn btn-primary" onclick="mostrarFormularioDeEdicao(' . $row['id'] . ')">Editar</button></td>';
              echo "</tr>";
            }
          }else {
            echo '<tr><td colspan="7">Nenhum colaborador encontrado</td></tr>';
          }
        ?>
        <!--Fim do codigo de mostrar colaboradores na tabela-->
    </tbody>
</table>
<!--Fim do codigo da tabela-->

<!--Formulario de edicao de colaborador-->
<div id="formularioDeEdicao" style="display: none;">
    <h2>Editar Colaborador</h2>
    <form method="post" action="editar.php">
        <input type="hidden" id="editId" name="editId">
        <label for="editNome">Nome:</label>
        <input type="text" id="editNome" name="editNome" required><br>

        <label for="editEmail">Email:</label>
        <input type="email" id="editEmail" name="editEmail" required><br>

        <label for="editTelefone">Telefone:</label>
        <input type="text" id="editTelefone" name="editTelefone" required><br>

        <label for="editMorada">Morada:</label>
        <input type="text" id="editMorada" name="editMorada" required><br>

        <label for="editContribuinte">Nº Contribuinte:</label>
        <input type="text" id="editContribuinte" name="editContribuinte" required><br>

        <input type="checkbox" id="editAtivado" name="editAtivado" value="S" checked>
        <label for="editAtivado">Ativar</label>

        <input type="submit" value="Editar" class="btn">
        <button type="button" onclick="fecharFormularioDeEdicao()" class="btn">Cancelar</button>
    </form>
</div>
<!--Fim do formulario de edicao-->

<script src="main.js"></script>

<!--Mostrar o formulario para adicionar colaboradores (inicialmente oculto)-->
<script>
    function adicionar() {
        var adicionarForm = document.getElementById("adicionarForm");
        if (adicionarForm.style.display === "none" || adicionarForm.style.display === "") {
            adicionarForm.style.display = "block"; //Mostrar o formulario
        } else {
            adicionarForm.style.display = "none"; //Ocultar o formulario
        }
    }
</script>

<!--Mostrar os colaboradores que estao desativados-->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        //Adicionar um evento quando a checkbox é clicada
        var checkbox = document.getElementById("mostrarDesativados");
        checkbox.addEventListener("click", function () {
            var isChecked = checkbox.checked;

            //Fazer uma solicitacao AJAX para buscar os colaboradores desativados
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "mostrarDesativados.php?mostrarDesativados=" + (isChecked ? "1" : "0"), true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // Atualizar a tabela com os dados retornados pela solicitacao AJAX
                    var colaboradoresBody = document.getElementById("colaboradoresBody");
                    colaboradoresBody.innerHTML = xhr.responseText;
                }
            };
            xhr.send();
        });
    });
</script>
</body>
</html>
