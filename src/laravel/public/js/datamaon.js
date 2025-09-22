function initCalendar() {
    if (typeof $ === 'undefined' || typeof moment === 'undefined' || !$.fn.daterangepicker) {
        setTimeout(initCalendar, 100);
        return;
    }
    
    $('#dateRangePickerHome').daterangepicker({
        autoUpdateInput: false,
        locale: {
            cancelLabel: 'Очистить',
            applyLabel: 'Применить',
            fromLabel: 'С',
            toLabel: 'По',
            customRangeLabel: 'Произвольный',
            daysOfWeek: ['Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб'],
            monthNames: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 
                        'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'],
            firstDay: 1
        },
        minDate: moment(),
        startDate: moment(),
        endDate: moment().add(7, 'days'),
        opens: 'center',
        drops: 'down'
    }, function(start, end, label) {
        // Добавляем класс для темы
        $('.daterangepicker').addClass('rose-theme');
    });
    
    $('#dateRangePickerHome').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('DD.MM.YYYY') + ' - ' + picker.endDate.format('DD.MM.YYYY'));
        $('.daterangepicker').addClass('rose-theme');
    });
    
    $('#dateRangePickerHome').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
    });
    
    // Добавляем класс при открытии календаря
    $('#dateRangePickerHome').on('show.daterangepicker', function(ev, picker) {
        $('.daterangepicker').addClass('rose-theme');
    });
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initCalendar);
} else {
    initCalendar();
}