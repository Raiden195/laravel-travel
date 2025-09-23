// Функция инициализации календаря выбора дат
function initCalendar() {
    // Проверяем, загружены ли необходимые библиотеки (jQuery, moment.js, daterangepicker)
    if (typeof $ === 'undefined' || typeof moment === 'undefined' || !$.fn.daterangepicker) {
        // Если библиотеки не загружены, повторяем попытку через 100 мс
        setTimeout(initCalendar, 100);
        return;
    }
    
    // Инициализируем daterangepicker для элемента с ID 'dateRangePickerHot'
    $('#dateRangePickerHot').daterangepicker({
        // Не обновлять поле ввода автоматически
        autoUpdateInput: false,
        // Настройки локализации (русский язык)
        locale: {
            cancelLabel: 'Очистить',
            applyLabel: 'Применить',
            fromLabel: 'С',
            toLabel: 'По',
            customRangeLabel: 'Произвольный',
            // Сокращенные названия дней недели
            daysOfWeek: ['Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб'],
            // Полные названия месяцев
            monthNames: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 
                        'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'],
            firstDay: 1 // Понедельник - первый день недели
        },
        minDate: moment(), // Минимальная дата - сегодня
        startDate: moment(), // Начальная дата - сегодня
        endDate: moment().add(7, 'days'), // Конечная дата - сегодня + 7 дней
        opens: 'center', // Открытие по центру относительно поля ввода
        drops: 'down' // Выпадающее меню открывается вниз
    }, function(start, end, label) {
        // Callback функция после выбора дат - добавляем тему оформления
        $('.daterangepicker').addClass('mint-theme');
    });
    
    // Обработчик события применения выбранного диапазона дат
    $('#dateRangePickerHot').on('apply.daterangepicker', function(ev, picker) {
        // Форматируем даты и устанавливаем значение в поле ввода
        $(this).val(picker.startDate.format('DD.MM.YYYY') + ' - ' + picker.endDate.format('DD.MM.YYYY'));
        // Применяем тему оформления
        $('.daterangepicker').addClass('mint-theme');
    });
    
    // Обработчик события отмены выбора
    $('#dateRangePickerHot').on('cancel.daterangepicker', function(ev, picker) {
        // Очищаем поле ввода
        $(this).val('');
    });
    
    // Обработчик события показа календаря
    $('#dateRangePickerHot').on('show.daterangepicker', function(ev, picker) {
        // Применяем тему оформления при открытии календаря
        $('.daterangepicker').addClass('mint-theme');
    });
}

// Проверяем состояние загрузки документа
if (document.readyState === 'loading') {
    // Если документ еще загружается, ждем события DOMContentLoaded
    document.addEventListener('DOMContentLoaded', initCalendar);
} else {
    // Если документ уже загружен, сразу инициализируем календарь
    initCalendar();
}