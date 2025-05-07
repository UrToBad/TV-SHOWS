/**
 * Attaches click event listeners to result boxes.
 *
 * @author Charles
 */
function attachResultBoxListeners() {
    const resultBoxes = document.querySelectorAll('.result_box');

    resultBoxes.forEach(box => {
        box.addEventListener('click', () => {
            let type = box.dataset.type;
            const id = box.dataset.id;

            if(type === 'episodes') return;

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

/**
 * Attaches click event listeners to delete icons.
 *
 * @author Charles
 */
function deleteItemEvents() {
    const deleteIcons = document.querySelectorAll('.delete-icon');

    deleteIcons.forEach(icon => {
        icon.removeEventListener('click', handleDeleteClick);
        icon.addEventListener('click', handleDeleteClick);
    });
}

/**
 * Handles the click event for delete icons.
 * @param event - The click event.
 *
 * @author Charles
 */
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

/**
 * Attaches click event listeners to edit icons.
 *
 * @author Charles
 */
function editItemEvents() {
    const editIcons = document.querySelectorAll('.edit-icon');

    editIcons.forEach(icon => {
        icon.removeEventListener('click', handleEditClick);
        icon.addEventListener('click', handleEditClick);
    });
}

/**
 * Handles the click event for edit icons.
 * @param event - The click event.
 *
 * @author Charles
 */
function handleEditClick(event) {
    event.stopPropagation();

    const icon = event.currentTarget;
    const id = icon.getAttribute("data-id");
    const type = icon.getAttribute("data-type");

    fetch('editItem.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ type: type, id: id })
    })
        .then(response => response.text())
        .then(html => {
            const formContainer = document.getElementById("formContainer");
            formContainer.innerHTML = html;
        })
        .catch(error => console.error('Erreur :', error));
}

/**
 * Re-attaches event listeners to result boxes and delete icons.
 *
 * @author Charles
 */
function reAttachEvents(){
    attachResultBoxListeners()
    deleteItemEvents()
    editItemEvents()
}

/**
 * Initializes the event listeners when the DOM is fully loaded.
 *
 * @author Charles
 */
document.addEventListener('DOMContentLoaded', () => {
    reAttachEvents()
});