// Находим форму логина по ID и добавляем обработчик события отправки формы
document.getElementById('loginForm').addEventListener('submit', function(e) {
    // Предотвращаем стандартную отправку формы (перезагрузку страницы)
    e.preventDefault();
    
    // Создаем объект FormData из формы - автоматически собирает все данные input'ов
    const formData = new FormData(this);
    
    // Отправляем AJAX-запрос на сервер
    fetch('{{ route(login) }}', {  // URL для авторизации (генерируется шаблонизатором)
        method: 'POST',  // Метод HTTP-запроса
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',  // Защита от CSRF-атак
            'Accept': 'application/json'  // Ожидаем ответ в формате JSON
        },
        body: formData  // Передаем данные формы
    })
    // Преобразуем ответ сервера в JSON
    .then(response => response.json())
    // Обрабатываем полученные данные
    .then(data => {
        // Проверяем успешность авторизации
        if (data.success) {
            // Если успешно - перенаправляем на главную страницу
            window.location.href = '{{ route(main) }}';
        } else {
            // Если ошибка - показываем сообщение об ошибке
            alert(data.message || 'Ошибка авторизации');
        }
    })
    // Обрабатываем ошибки сети или сервера
    .catch(error => {
        console.error('Error:', error);  // Логируем ошибку в консоль
        alert('Произошла ошибка');  // Показываем общее сообщение об ошибке
    });
});