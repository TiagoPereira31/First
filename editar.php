<?php
    require 'dbconn.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        //Receber os dados do formulario de edicao
        $id = $_POST['editId'];
        $nome = $_POST['editNome'];
        $email = $_POST['editEmail'];
        $telefone = $_POST['editTelefone'];
        $morada = $_POST['editMorada'];
        $contribuinte = $_POST['editContribuinte'];
    
        //Verificar se a checkbox esta marcada
        $ativado = isset($_POST['editAtivado']) ? 'S' : 'N';
    
        //Atualizar os dados do colaborador na base de dados
        $sql = "UPDATE colaboradores SET nome = ?, email = ?, telefone = ?, morada = ?, contribuinte = ?, Ativado = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssssssi', $nome, $email, $telefone, $morada, $contribuinte, $ativado, $id);
    
        if ($stmt->execute()) {
            //Redirecionar para pagina inicial
            header('Location: index.php');
            exit();
        } else {
            echo "Erro ao editar colaborador: " . $stmt->error;
        }
    } else {
        header('Location: index.php');
        exit();
    }
?>