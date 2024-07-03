const allRestoreButtons = document.querySelectorAll('.ms-js-restore-btn');
allRestoreButtons.forEach((restoreButton) => {
    restoreButton.addEventListener('click', function (event) {
        event.preventDefault();
        const restoreModal = document.getElementById('ms-confirmRestoreModal');
        const apartmentSlug = this.dataset.apartmentSlug;
        const apartmentTitle = this.dataset.apartmentTitle;
        restoreModal.querySelector('.ms-modal-body').innerHTML = `Sei sicuro di voler ripristinare ${apartmentTitle}?`;

        restoreModal.classList.remove('hidden');
        restoreModal.classList.add('flex');

        const modalCancelRestorationBtn = document.getElementById('ms-modal-cancel-restoration');
        modalCancelRestorationBtn.addEventListener('click', function () {
            event.preventDefault();
            restoreModal.classList.remove('flex');
            restoreModal.classList.add('hidden');
        });

        const modalConfiRestorationBtn = document.getElementById('ms-modal-confirm-restoration');
        modalConfiRestorationBtn.addEventListener('click', function () {
            this.setAttribute('href', `restore/${apartmentSlug}`)
        });
    });
});