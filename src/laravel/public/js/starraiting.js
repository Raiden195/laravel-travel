




 document.addEventListener('DOMContentLoaded', function() {
    const stars = document.querySelectorAll('.star');
    let currentRating = 0; // Переменная для хранения текущего рейтинга

    function updateStars(rating) {
        stars.forEach(s => {
            if (parseInt(s.getAttribute('data-rating')) <= rating) {
                s.classList.add('checked');
            } else {
                s.classList.remove('checked');
            }
        });
    }

    stars.forEach(star => {
        star.addEventListener('click', function() {
            const rating = parseInt(this.getAttribute('data-rating'));

            if (rating === currentRating) {
                // Если кликнули на уже выбранную звезду, то сбрасываем рейтинг
                currentRating = 0;
                updateStars(0);
            } else {
                // Если кликнули на другую звезду, то устанавливаем новый рейтинг
                currentRating = rating;
                updateStars(rating);
            }

            // Здесь нужно добавить код для фильтрации туров
            console.log("Выбранный рейтинг:", currentRating);
        });
    });
});