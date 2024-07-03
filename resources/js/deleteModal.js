const allDeleteButtons = document.querySelectorAll('.ms-js-delete-btn');
allDeleteButtons.forEach((deleteButton) => {
    deleteButton.addEventListener('click', function (event) {
        event.preventDefault();
        const deleteModal = document.getElementById('ms-confirmDeleteModal');
        const apartmentTitle = this.dataset.apartmentTitle;
        deleteModal.querySelector('.ms-modal-body').innerHTML = `Sei sicuro di voler eliminare ${apartmentTitle}?`;

        deleteModal.classList.remove('hidden');
        deleteModal.classList.add('flex');


        const modalCancelDeletionBtn = document.getElementById('ms-modal-cancel-deletion');
        modalCancelDeletionBtn.addEventListener('click', function () {
            event.preventDefault();
            deleteModal.classList.remove('flex');
            deleteModal.classList.add('hidden');
        });


        const modalConfirmDeletionBtn = document.getElementById('ms-modal-confirm-deletion');
        modalConfirmDeletionBtn.addEventListener('click', function () {
            deleteButton.parentElement.submit();
        });
    });
});