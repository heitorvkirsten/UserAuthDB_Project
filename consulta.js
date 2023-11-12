$(document).ready(function() {
    // Função para buscar e exibir os resultados na tabela
    function buscarUsuarios() {
        $.ajax({
            url: 'consulta.php',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                // Exibindo os dados na tabela
                exibirTabela(data);
            },
            error: function(error) {
                console.error('Erro na requisição AJAX:', error);
            }
        });
    }

    // Função para exibir os resultados na tabela
    function exibirTabela(data) {
        // Lógica para processar e exibir os resultados na tabela
        var tabela = $('<table>').addClass('resultado-table');
        var cabecalho = $('<tr>');

        // Adiciona os cabeçalhos das colunas
        for (var campo in data[0]) {
            cabecalho.append('<th>' + campo + '</th>');
        }

    } 












    
    // Chama a função para buscar e exibir os resultados na inicialização
    buscarUsuarios();

    // Função para filtrar a tabela com base nos valores dos campos de pesquisa
    $('#consultaForm :input').on('input', function() {
        // Criar um objeto com os valores dos campos de pesquisa
        var filtro = {};
        $('#consultaForm :input').each(function() {
            filtro[this.id] = $(this).val().toLowerCase();
        });

        // Filtrar os resultados com base nos valores dos campos
        $.ajax({
            url: 'consulta.php',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                // Filtrar os resultados com base nos valores dos campos
                var resultadosFiltrados = data.filter(function(usuario) {
                    for (var campo in filtro) {
                        if (usuario[campo] && usuario[campo].toLowerCase().indexOf(filtro[campo]) === -1) {
                            return false;
                        }
                    }
                    return true;
                });

                // Exibir os resultados filtrados na tabela
                exibirTabela(resultadosFiltrados);
            },
            error: function(error) {
                console.error('Erro na requisição AJAX:', error);
            }
        });
    });
});
