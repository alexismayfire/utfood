$(function() {
    $('.ui.search')
        .search({
            type: 'category',
            /*
            fields: {
                results: 'estabelecimentos',
                title: 'nome',
                url: 'url'
            },
            */
            minCharacters: 3,
            apiSettings: {
                url: '/api/estabelecimentos/filtrar?nome={query}',
                onResponse: function(res) {
                    let response = {
                        results: {}
                    };

                    // Modifica os resultados para retornar resultados por categoria
                    $.each(res.estabelecimentos, function(index, item) {
                        console.log(item);
                        console.log(item.tipo_cozinha.titulo);
                        const cozinha = item.tipo_cozinha.titulo || '';
                        const maxResults = 10;

                        if (index >= maxResults) {
                            return false;
                        }

                        // Cria nova categoria
                        if (response.results[cozinha] === undefined) {
                            response.results[cozinha] = {
                                name: cozinha,
                                results: []
                            }
                        }

                        // Adiciona resultado à categoria
                        response.results[cozinha].results.push({
                            title: item.nome,
                            description: '',
                            url: item.url
                        });
                    });

                    return response;
                }
            }
        })
    ;
});
