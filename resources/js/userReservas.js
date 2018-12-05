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
