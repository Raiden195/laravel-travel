// Ждем полной загрузки DOM перед выполнением скрипта
document.addEventListener('DOMContentLoaded', function() {
    // Находим все карточки туров на странице
    const tourCards = document.querySelectorAll('.tour-card');
    // Находим модальное окно для бронирования
    const modal = document.getElementById('bookingModal');
    // Находим кнопку закрытия модального окна
    const closeButton = document.querySelector('.close-button');

    // Добавляем обработчик клика для каждой карточки тура
    tourCards.forEach(card => {
        card.addEventListener('click', function(event) {
            // Проверяем, был ли клик именно по кнопке выбора (а не по всей карточке)
            if (event.target.classList.contains('select-button')) {
                // Если да, показываем модальное окно
                modal.style.display = 'block';
            }
        });
    });

});