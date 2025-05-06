function attachResultBoxListeners() {
    const resultBoxes = document.querySelectorAll('.result_box');

    resultBoxes.forEach(box => {
        box.addEventListener('click', () => {
            let type = box.dataset.type;
            const id = box.dataset.id;

            if (type === 'series') type = 'saisons';
            else if (type === 'saisons') type = 'episodes';

            if (type && id) {
                window.location.href = `index.php?type=${type}&id=${id}`;
            } else if (type) {
                window.location.href = `index.php?type=${type}`;
            }
        });
    });
}

function deleteItemEvents() {
    const deleteIcons = document.querySelectorAll('.delete-icon');

    deleteIcons.forEach(icon => {
        icon.removeEventListener('click', handleDeleteClick);
        icon.addEventListener('click', handleDeleteClick);
    });
}

function handleDeleteClick(event) {
    event.stopPropagation();

    const icon = event.currentTarget;
    const id = icon.getAttribute("data-id");
    const type = icon.getAttribute("data-type");

    if (confirm('Voulez-vous vraiment supprimer cet élément ?')) {
        fetch('deleteItem.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ type: type, id: id })
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert('Erreur lors de la suppression.');
                }
            })
            .catch(error => console.error('Erreur :', error));
    }
}

function reAttachEvents(){
    attachResultBoxListeners()
    deleteItemEvents()
}

document.addEventListener('DOMContentLoaded', () => {
    reAttachEvents()
});