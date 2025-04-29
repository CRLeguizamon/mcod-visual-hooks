jQuery(document).ready(function($) {
    // Función para actualizar el contador
    function updateVisitorsCounter() {
        $('.mcod-product-viewing').each(function() {
            var $counter = $(this);
            var currentCount = parseInt($counter.attr('data-customer-view'));
            var minCount = 1;
            var maxCount = 5;
            
            // Generar nuevo número aleatorio
            var newCount = Math.floor(Math.random() * (maxCount - minCount + 1)) + minCount;
            
            // Actualizar el atributo
            $counter.attr('data-customer-view', newCount);
            
            // Obtener el elemento del contador
            var $visitorCount = $counter.find('.visitor-count');
            
            // Crear efecto de deslizamiento
            $visitorCount
                .css('position', 'relative')
                .animate({ top: '20px', opacity: 0 }, 200, function() {
                    // Cambiar el número cuando el elemento está oculto
                    $(this).text(newCount);
                })
                .animate({ top: '0', opacity: 1 }, 200);
        });
    }

    // Obtener el intervalo de actualización (en milisegundos)
    var updateInterval = mcod_visitors.update_interval || 5000;

    // Actualizar cada X segundos según la configuración
    setInterval(updateVisitorsCounter, updateInterval);
}); 