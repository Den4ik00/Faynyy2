// Додаємо функціонал для клікабельного меню
document.querySelectorAll('.dropdown > a').forEach(dropdownToggle => {
    dropdownToggle.addEventListener('click', function (e) {
        e.preventDefault(); // Запобігаємо переходу за посиланням
        const dropdown = this.parentElement;

        // Закриваємо інші відкриті меню
        document.querySelectorAll('.dropdown').forEach(item => {
            if (item !== dropdown) {
                item.classList.remove('open');
            }
        });

        // Перемикаємо стан цього меню
        dropdown.classList.toggle('open');
    });
});

// Закриття меню при кліку поза ними
document.addEventListener('click', function (e) {
    if (!e.target.closest('.menu')) {
        document.querySelectorAll('.dropdown').forEach(dropdown => {
            dropdown.classList.remove('open');
        });
    }
});

document.getElementById('menu-toggle').addEventListener('click', function () {
    const menu = document.querySelector('.menu');
    menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
});
