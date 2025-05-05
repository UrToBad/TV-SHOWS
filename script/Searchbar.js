document.addEventListener("DOMContentLoaded", () => {
    const searchInput = document.getElementById("search_tag");

    // Restaurer la valeur de l'input depuis localStorage
    const savedValue = localStorage.getItem("searchValue");
    if (savedValue) {
        searchInput.value = savedValue;
    }

    searchInput.addEventListener("keypress", (event) => {
        if (event.key === "Enter") { // Détecte la touche Entrée
            event.preventDefault();
            const query = searchInput.value.trim();

            localStorage.setItem("searchValue", query);

            // Récupère le type actuel depuis l'URL
            const urlParams = new URLSearchParams(window.location.search);
            const type = urlParams.get("type") || "series"; // Par défaut "series" si aucun type n'est défini
            const id = urlParams.get("id"); // Récupère l'id s'il existe

            // Met à jour l'URI sans recharger la page
            let newUrl = `index.php?type=${type}&search="${encodeURIComponent(query)}"`;
            if (id) {
                newUrl += `&id=${id}`;
            }
            history.pushState(null, "", newUrl);
            location.reload();

            //Remettre la value de l'input car il est reset au reload
        }
    });
});