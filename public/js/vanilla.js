$(function() {
    $('#menu_conta').popup({
        hoverable: true,
        lastResort: 'bottom center',
        target: '#menu_conta',
        delay: {
            show: 200,
            hide: 400
        }
    });

    $('#filtrar-estabelecimentos').on('click', function() {
        $('.ui.sidebar')
            .sidebar('transition', 'auto')
            .sidebar('toggle')
        ;
    });
});

$.extend($.fn.pickadate.defaults, {
    // Strings and translations
    monthsFull: [
        'Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho',
        'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
    weekdaysShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb'],
    // Buttons
    today: 'Hoje',
    clear: 'Limpar',
    close: 'Fechar',
    // Accessibility labels
    labelMonthNext: 'Next month',
    labelMonthPrev: 'Previous month',
    labelMonthSelect: 'Select a month',
    labelYearSelect: 'Select a year',
    // Formats
    format: 'dd/mm/yyyy',
    formatSubmit: 'dd-mm-yyyy',
    hiddenPrefix: '_submit',
    hiddenName: true,
    // Date limits
    min: new Date()
});

$(function() {
    $('#data-reserva').pickadate({
        onClose: limparHorarios
    });

    $('.ui.radio.checkbox').checkbox();

    $('.message .close').on('click', function() {
        $(this).closest('.message').transition('fade');
    });

    $('#verificar-horarios').on('click', function(e) {
        e.preventDefault();
        $('#verificar-horarios').hide();
       verificaReservas();
    });

    function limparHorarios() {
        $('.ui.error.message').remove();
        $('#horarios-disponiveis').empty();
        $('#verificar-horarios').show();
        $('button[type="submit"]').addClass('disabled');
    }

    function verificaReservas() {
        limparHorarios();

        const dataEscolhida = $('input[name="data"]').val();
        const estabelecimento = $('input[name="estabelecimento"]').val();
        const cardapio = $('input[name="cardapio"]').val();
        const token = $('input[name="_token"]').val();
        $.ajax({
            type: 'GET',
            dataType: 'json',
            url: '/api/estabelecimentos/' + estabelecimento + '/' + cardapio + '/reservas/' + dataEscolhida
        }).done(function(data) {
            $wrapper = $('#horarios-disponiveis');
            horarios = data[0];
            for (let key in horarios) {
                if (horarios.hasOwnProperty(key)) {
                    if (horarios[key] === true) {
                        $wrapper.append(
                            '<div class="field">' +
                                '<div class="ui radio checkbox">' +
                                    '<input type="radio" name="hora" tabindex="0" value="' + key + '" class="hidden">' +
                                    '<label>' + key + 'h</label>' +
                                '</div>' +
                            '</div>'
                        )
                    } else {
                        $wrapper.append(
                            '<div class="field">' +
                                '<div class="ui radio checkbox">' +
                                    '<input type="radio" name="hora" tabindex="0" value="' + key + '" class="hidden" disabled>' +
                                    '<label>' + key + 'h</label>' +
                                '</div>' +
                            '</div>'
                        )
                    }
                }
            }
            // Como os elementos foram criados agora, precisa chamar de novo a função
            $checkbox = $('.ui.radio.checkbox');
            $checkbox.checkbox();
            // Escondo o botão de verificar horário
            $('#verificar-horarios').hide();

            $checkbox.on('click', function() {
                $('button[type="submit"]').removeClass('disabled');
            });

        }).fail(function(data) {
            console.log(data);
        });
    }

    $('.ui.form')
        .form({
            fields: {
                name: ['minLength[3]', 'empty'],
                nome: ['minLength[3]', 'empty'],
                endereco: ['minLength[10]', 'empty'],
                telefone: ['minLength[8]', 'maxLength[14]', 'empty'],
                descricao: ['minLength[30]', 'maxLength[1024]', 'empty']
            }
        })
    ;
    /*
    $('#data-reserva').focusout(function (evt) {
        const valorDigitado = $(this).val().split('/');
        let dataIso;

        if (valorDigitado.length === 3) {
            // ISO Date - YYYY-MM-DD
            dataIso = valorDigitado[2] + '-' + valorDigitado[1] + '-' + valorDigitado[0];
            const data = new Date(dataIso);
            const dataAtual = new Date();
            console.log(data);

            if (dataAtual > data) {
                erroCampo($(this), 'A data informada deve ser igual ou superior à data atual');
            } else {
                limparErroCampo($(this));
                console.log('Chamada AJAX');
            }
        } else {
            // Deu algum erro, provavelmente com os índices de valorDigitado após o split se faltou digitar '/'
            dataIso = undefined;
            erroCampo($(this), 'Data inválida! Digite no formato DD/MM/YYYYY');
        }
    });

    function erroCampo (campo, mensagem) {
        const selector = '#erro-' + campo[0].id;
        if ($(selector).length === 0) {
            campo.after('<div class="ui message" id="erro-'+campo[0].id+'"></div>');
            $(selector).append('<div class="header"></div>').text(mensagem);
        } else {
            $(selector + ' > .header').text(mensagem);
        }
    }

    function limparErroCampo (campo) {
        const selector = '#erro-' + campo[0].id;
        $(selector).remove();
    }
    /*
    $('#data-reserva').keypress(function (evt) {
        const valorDigitado = $(this).val();
        try {
            const data = new Date(valorDigitado);
        } catch (err) {
            console.log(err);
        }
        console.log(evt);
        console.log($(this).val());
    });
    */
});

$(function() {
    $('.ui.modal').modal('attach events', '.cancelar.reserva', 'show');
    $('.cancelar.reserva').on('click', function(evt) {
        $('#horario-reserva').html($(this).data('horario'));
        $('#estabelecimento-reserva').html($(this).data('estabelecimento'));
        $('#cancelarReservaUsuario').attr('action', $(this).data('submit'));
    });

    $('#avaliacao-rating').rating();

    $('#avaliacaoForm').on('submit', function(evt) {
        const rating = ($('#avaliacao-rating').rating('get rating'));
        $('input[name="estrelas"]').val(rating);

        return true;
    });
});

$(function() {
    for($i = 1; $i <= 5; $i++) {
        $('#filtro-rating-' + $i).rating('disable').rating();
    }

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
