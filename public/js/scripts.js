/* ~~~~~~~~ Scroll animation ~~~~~~ */
function onEntry(entry) {
    entry.forEach(change => {
        if (change.isIntersecting) {
            change.target.classList.add('scroll-animation__show');
        }
    });
    }
    let options = { threshold: [0.6] };
    let observer = new IntersectionObserver(onEntry, options);
    let elements = document.querySelectorAll('.scroll-animation');
    for (let elm of elements) {
    observer.observe(elm);
}



/* ~~~~~~~~~~ Modal window ~~~~~~~~ */
document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('myModal');
    const modalBtns = document.querySelectorAll('.modal-btn');
    const closeModalBtn = document.getElementById('closeModal');
    const form = document.querySelector('.modal__content form');

    modalBtns.forEach(function (btn) {
        btn.addEventListener('click', function (event) {
            event.preventDefault();

            // Отримання значень id, title та description з атрибутів кнопки
            const id = this.getAttribute('data-id');
            const title = this.getAttribute('data-title');
            const description = this.getAttribute('data-description');

            // Вставлення значень в форму
            form.action = `/app/edit_todo.php?id=${id}`;
            form.querySelector('[name="title"]').value = title;
            form.querySelector('[name="description"]').value = description;

            modal.style.display = 'block';
        });
    });

    closeModalBtn.addEventListener('click', function () {
        modal.style.display = 'none';
    });

    window.addEventListener('click', function (event) {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });
});