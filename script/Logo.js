document.addEventListener("DOMContentLoaded", () => {
    const logo = document.getElementById("logo");

    if (logo) {
        logo.addEventListener("click", () => {
            window.location.href = "index.php";
            const searchInput = document.getElementById("search_tag");
            if (searchInput) {
                localStorage.removeItem("searchValue");
                searchInput.value = "";
            }
        });
    }
});