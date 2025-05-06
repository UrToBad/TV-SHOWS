/**
 * Add a click event listener to the logo element
 *
 * This function redirects the user to the index page and clears the search input value.
 *
 * @author Charles
 */
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