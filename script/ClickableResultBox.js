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
                attachClickEvents();
            })
            .catch(error => console.error("Erreur :", error));
        });
    });
}

document.addEventListener("DOMContentLoaded", () => {
    attachClickEvents();
});