  document.addEventListener('DOMContentLoaded', function() {
            const dropdownToggle = document.querySelector('.user-dropdown-toggle');
            const dropdown = document.querySelector('.user-dropdown');
            
            if (dropdownToggle) {
                dropdownToggle.addEventListener('click', function(e) {
                    e.stopPropagation();
                    dropdown.classList.toggle('active');
                });
                
                // Закрытие при клике вне меню
                document.addEventListener('click', function(e) {
                    if (!dropdown.contains(e.target)) {
                        dropdown.classList.remove('active');
                    }
                });
                
                // Закрытие при клике на пункты меню
                document.querySelectorAll('.dropdown-item, .logout-btn').forEach(item => {
                    item.addEventListener('click', function() {
                        dropdown.classList.remove('active');
                    });
                });
                
                // Закрытие при нажатии Escape
                document.addEventListener('keydown', function(e) {
                    if (e.key === 'Escape') {
                        dropdown.classList.remove('active');
                    }
                });
            }
        });