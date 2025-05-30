/**
 * Adds an event listener to the button with id "addButton".
 *
 * This function fetches a form from the server when the button is clicked.
 *
 * @author Charles
 */
document.getElementById("addButton").addEventListener("click", function() {
    const urlParams = new URLSearchParams(window.location.search);
    const type = urlParams.get('type');
    const id = urlParams.get('id');

    fetch('add_handler.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ type: type, id: id })
    })
        .then(response => response.text())
        .then(html => {
            const formContainer = document.getElementById("formContainer");
            formContainer.innerHTML = html;
        })
        .catch(error => console.error('Erreur:', error));
});