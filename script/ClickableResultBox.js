function attachResultBoxListeners() {
    const resultBoxes = document.querySelectorAll('.result_box');

    resultBoxes.forEach(box => {
        box.addEventListener('click', () => {
            let type = box.dataset.type; // Exemple : "series", "saisons", "episodes"
            const id = box.dataset.id; // ID associé à l'élément cliqué

            // Si le type est "series", on le remplace par "saisons"
            if (type === 'series') type = 'saisons';
            // Si le type est "saisons", on le remplace par "episodes"
            else if (type === 'saisons') type = 'episodes';

            if (type && id) {
                // Redirige vers l'URL avec les bons paramètres
                window.location.href = `index.php?type=${type}&id=${id}`;
            } else if (type) {
                // Redirige uniquement avec le type
                window.location.href = `index.php?type=${type}`;
            }
        });
    });
}

function deleteItemEvents() {
    const deleteIcons = document.querySelectorAll('.delete-icon');

    deleteIcons.forEach(icon => {
        icon.addEventListener('click', (event) => {
            event.stopPropagation(); // Empêche la propagation de l'événement click

            const id = icon.dataset.id; // ID de l'élément à supprimer
            const type = icon.dataset.type; // Type de l'élément à supprimer

            if (confirm('Voulez-vous vraiment supprimer cet élément ?')) {
                fetch('deleteItem.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ id, type })
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
        });
    });
}

function reAttachEvents(){
    attachResultBoxListeners()
    deleteItemEvents()
}

document.addEventListener('DOMContentLoaded', () => {
    reAttachEvents()
});