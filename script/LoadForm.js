document.getElementById("addButton").addEventListener("click", function() {
    console.log("Button clicked, loading form...");
    fetch('form_handler.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({  })
    })
        .then(response => response.text())
        .then(html => {
            // Je veux rajouter le contenu HTML dans le body
            const formContainer = document.getElementById("formContainer");
            formContainer.innerHTML = html;
        })
        .catch(error => console.error('Erreur:', error));
});