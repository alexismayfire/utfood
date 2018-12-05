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
