<?php
    require 'dbconn.php';
    
    //Receber os dados do formulario
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $telefone = $_POST["telefone"];
    $morada = $_POST["morada"];
    $contribuinte = $_POST["contribuinte"];
    
    //Verificar se a checkbox esta marcada
    if (isset($_POST["Ativado"])) {
        $ativado = 'S';
    } else {
        $ativado = 'N';
    }
    
    //Inserir os dados
    $sql = "INSERT INTO colaboradores (nome, email, telefone, morada, contribuinte, Ativado) VALUES ('$nome', '$email', '$telefone', '$morada', '$contribuinte', '$ativado')";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $nome, $email, $telefone, $morada, $contribuinte, $ativado);
    
    if ($stmt->execute()) {
        header('Location: index.php');
    } else {
        echo "Erro ao adicionar colaborador: " . $stmt->error;
    }
?>