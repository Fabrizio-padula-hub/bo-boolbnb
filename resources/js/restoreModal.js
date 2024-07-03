const allRestoreButtons = document.querySelectorAll('.ms-js-restore-btn');
allRestoreButtons.forEach((restoreButton) => {
    restoreButton.addEventListener('click', function (event) {
        event.preventDefault();
        const deleteModal = document.getElementById('ms-confirmRestoreModal');
        const apartmentTitle = this.dataset.apartmentTitle;
        deleteModal.querySelector('.ms-modal-body').innerHTML = `Sei sicuro di voler ripristinare ${apartmentTitle}?`;

        deleteModal.classList.remove('hidden');
        deleteModal.classList.add('flex');


        const modalCancelDeletionBtn = document.getElementById('ms-modal-cancel-restoration');
        modalCancelDeletionBtn.addEventListener('click', function () {
            event.preventDefault();
            deleteModal.classList.remove('flex');
            deleteModal.classList.add('hidden');
        });
    });
});