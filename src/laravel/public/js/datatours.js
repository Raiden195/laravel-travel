// Функция инициализации календаря для поиска
function initCalendar() {
    // Проверяем загружены ли необходимые библиотеки: jQuery, moment.js и daterangepicker
    if (typeof $ === 'undefined' || typeof moment === 'undefined' || !$.fn.daterangepicker) {
        // Если библиотеки не загружены, повторяем попытку через 100 мс (рекурсивный вызов)
        setTimeout(initCalendar, 100);
        return;
    }
    
    // Инициализируем компонент выбора диапазона дат для элемента с ID 'dateRangePickerSearch'
    $('#dateRangePickerSearch').daterangepicker({
        // Не обновлять поле ввода автоматически (ручное управление значением)
        autoUpdateInput: false,
        // Настройки локализации для русского языка
        locale: {
            cancelLabel: 'Очистить',      // Текст кнопки отмены
            applyLabel: 'Применить',      // Текст кнопки применения
            fromLabel: 'С',               // Метка для начальной даты
            toLabel: 'По',                // Метка для конечной даты
            customRangeLabel: 'Произвольный', // Текст для произвольного диапазона
            // Сокращенные названия дней недели
            daysOfWeek: ['Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб'],
            // Полные названия месяцев
            monthNames: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 
                        'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'],
            firstDay: 1 // Понедельник как первый день недели
        },
        minDate: moment(), // Минимальная доступная дата - текущая дата (нельзя выбрать прошлое)
        startDate: moment(), // Начальная дата по умолчанию - сегодня
        endDate: moment().add(7, 'days'), // Конечная дата по умолчанию - сегодня + 7 дней
        opens: 'center', // Окно календаря открывается по центру относительно поля ввода
        drops: 'down'    // Окно открывается вниз (вместо up)
    }, function(start, end, label) {
        // Callback функция после выбора дат - применяем розовую тему
        $('.daterangepicker').addClass('rose-theme');
    });
    
    // Обработчик события применения выбранного диапазона дат
    $('#dateRangePickerSearch').on('apply.daterangepicker', function(ev, picker) {
        // Форматируем даты в формате ДД.ММ.ГГГГ и устанавливаем в поле ввода
        $(this).val(picker.startDate.format('DD.MM.YYYY') + ' - ' + picker.endDate.format('DD.MM.YYYY'));
        // Применяем розовую тему к календарю
        $('.daterangepicker').addClass('rose-theme');
    });
    
    // Обработчик события отмены выбора (кнопка "Очистить")
    $('#dateRangePickerSearch').on('cancel.daterangepicker', function(ev, picker) {
        // Очищаем поле ввода
        $(this).val('');
    });
    
    // Обработчик события показа календаря
    $('#dateRangePickerSearch').on('show.daterangepicker', function(ev, picker) {
        // При открытии календаря применяем розовую тему
        $('.daterangepicker').addClass('rose-theme');
    });
}

// Универсальная инициализация независимо от состояния загрузки документа
if (document.readyState === 'loading') {
    // Если документ еще загружается, ждем события полной загрузки DOM
    document.addEventListener('DOMContentLoaded', initCalendar);
} else {
    // Если документ уже загружен, инициализируем сразу
    initCalendar();
}