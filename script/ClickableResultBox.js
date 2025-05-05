function attachClickEvents() {
    document.querySelectorAll(".result_box").forEach(box => {
        box.addEventListener("click", () => {
            const id = box.getAttribute("data-id");
            const type = box.getAttribute("data-type");

            let endpoint = "";
            if (type === "series") endpoint = "getSeasons.php";
            if (type === "saisons") endpoint = "getEpisodes.php";

            if (endpoint === "") return;

            fetch(endpoint, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({ id: id })
            })
            .then(response => response.text())
            .then(data => {
                document.getElementById("content").innerHTML = data;

                history.pushState({ id, type }, "", `?type=${type}&id=${id}`);

                attachClickEvents();
                deleteItemEvents();
            })
            .catch(error => console.error("Erreur :", error));
        });
    });
}

function deleteItemEvents() {
    document.querySelectorAll(".delete-icon").forEach(icon => {
        icon.addEventListener("click", (event) => {
            event.stopPropagation(); // Empêche la propagation de l'événement click

            const id = icon.getAttribute("data-id");
            const type = icon.getAttribute("data-type");

            if (confirm("Voulez-vous vraiment supprimer cet élément ?")) {
                fetch("deleteItem.php", {
                    method: "POST",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify({ id, type })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const endpoint = type === "saisons" ? "getSeasons.php" : type === "episodes" ? "getEpisodes.php" : "";

                        if (!endpoint) return;

                        fetch(endpoint, {
                            method: "POST",
                            headers: { "Content-Type": "application/json" },
                            body: JSON.stringify({ id })
                        }).then(response => response.text())
                            .then(data => {
                                document.getElementById("content").innerHTML = data;
                                attachClickEvents(); // Réattache les événements
                                deleteItemEvents(); // Réattache les événements
                            })
                            .catch(error => console.error("Erreur lors du rechargement :", error));
                    } else {
                        alert("Erreur lors de la suppression.");
                    }
                });
            }
        });
    });
}

window.addEventListener("popstate", (event) => {
    if (event.state) {
        const { id, type } = event.state;

        let endpoint = "";
        if (type === "series") endpoint = "getSeasons.php";
        if (type === "saisons") endpoint = "getEpisodes.php";

        if (endpoint === "") return;

        fetch(endpoint, {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({ id: id })
        })
        .then(response => response.text())
        .then(data => {
            document.getElementById("content").innerHTML = data;
            attachClickEvents();
            deleteItemEvents();
        })
        .catch(error => console.error("Erreur :", error));
    }
});

document.addEventListener("DOMContentLoaded", () => {
    attachClickEvents();
    deleteItemEvents();
});