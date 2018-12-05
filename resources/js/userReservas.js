$(function() {
    $('.ui.modal').modal('attach events', '.cancelar.reserva', 'show');
    $('.cancelar.reserva').on('click', function(evt) {
        $('#horario-reserva').html($(this).data('horario'));
        $('#estabelecimento-reserva').html($(this).data('estabelecimento'));
        $('#cancelarReservaUsuario').attr('action', $(this).data('submit'));
    });
});
