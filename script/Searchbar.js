document.addEventListener("DOMContentLoaded", () => {
    const searchInput = document.getElementById("search_tag");

    const savedValue = localStorage.getItem("searchValue");
    if (savedValue) {
        searchInput.value = savedValue;
    }

    searchInput.addEventListener("keypress", (event) => {
        if (event.key === "Enter") {
            event.preventDefault();
            const query = searchInput.value.trim();

            localStorage.setItem("searchValue", query);

            const urlParams = new URLSearchParams(window.location.search);
            const type = urlParams.get("type") || "series";
            const id = urlParams.get("id");

            let newUrl = `index.php?type=${type}&search="${encodeURIComponent(query)}"`;
            if (id) {
                newUrl += `&id=${id}`;
            }
            history.pushState(null, "", newUrl);
            location.reload();
        }
    });
});