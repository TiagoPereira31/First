//Atualizar tabela
$(document).ready(function() {
    atualizarTabela();
  
    //Funcao para atualizar a tabela
    function atualizarTabela() {
      $.ajax({
        url: 'atualizarTabela.php',
        type: 'GET',
        success: function(data) {
          $('#colaboradoresBody').html(data);
        },
        error: function() {
          alert('Erro ao atualizar a tabela.');
        }
      });
    }
});
//Fim de atualizar tabela

//Adicionar botoes de editar a cada linha da tabela apos a atualizacao dos dados
$('#colaboradoresBody tr').each(function() {
    var id = $(this).find('td:first').text(); // Obtem o ID da linha
    var editButton = '<button id="' + id + '" class="btn btn-primary">Editar</button>';
    $(this).append('<td>' + editButton + '</td>');
});

//Editar colaboradores
function mostrarFormularioDeEdicao(id) {
    var formularioDeEdicao = document.getElementById("formularioDeEdicao");
    formularioDeEdicao.style.display = "block"; // Mostrar o formulario

    //Preencher os campos do formulario com os dados do colaborador a ser editado
    var colaboradoresBody = document.getElementById("colaboradoresBody");
    var rows = colaboradoresBody.getElementsByTagName("tr");

    for (var i = 0; i < rows.length; i++) {
        var row = rows[i];
        var rowId = row.getElementsByTagName("td")[0].innerText;

        if (rowId == id) {
            var campos = row.getElementsByTagName("td");
            var nome = campos[1].innerText;
            var email = campos[2].innerText;
            var telefone = campos[3].innerText;
            var morada = campos[4].innerText;
            var contribuinte = campos[5].innerText;

            //Preencher os campos do formulario de edicao
            document.getElementById("editId").value = id;
            document.getElementById("editNome").value = nome;
            document.getElementById("editEmail").value = email;
            document.getElementById("editTelefone").value = telefone;
            document.getElementById("editMorada").value = morada;
            document.getElementById("editContribuinte").value = contribuinte;
        }
    }
}

//Funcao para ocultar o formulario de edicao
function fecharFormularioDeEdicao() {
    var formularioDeEdicao = document.getElementById("formularioDeEdicao");
    formularioDeEdicao.style.display = "none"; // Ocultar o formulario
}