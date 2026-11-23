const searchInput = document.getElementById("search");
const searchForm = document.getElementById("search-form");
const results = document.getElementById("results");
const resultsHeading = document.getElementById("results-heading");
const resultsMessage = document.getElementById("results-message");

let searchController;

// Search database
async function searchDatabase(search) {
    if (searchController) {
        searchController.abort();
    }
    searchController=new AbortController();

    try {
        
        results.innerHTML = "";
        resultsMessage.textContent = "Searching...";
        const response = await fetch(
            "backend/search.php?search=" + encodeURIComponent(search),
            {
                signal: searchController.signal
            }
        );

        if (!response.ok) {
          throw new Error("Failed to retrieve search results");
        }

        const data = await response.text();
        
        resultsHeading.textContent = `Search Results for "${search}"`;
        results.innerHTML = data;
        resultsMessage.textContent = "";
        
        if (data.trim() === "") {
            resultsMessage.textContent = "No products found.";
        }

    } catch (error) {
        console.error("Search error:", error);
        resultsMessage.textContent = "Unable to retrieve products.";
    }
}

searchForm.addEventListener("submit", function(event) {

    event.preventDefault();

    const search = searchInput.value.trim();

    if (search === "") {

        results.innerHTML = "";

        resultsHeading.textContent = "Search Results";

        resultsMessage.textContent = "Please enter a search term.";

        return;
    }

    searchDatabase(search);
});

const params = new URLSearchParams(window.location.search);

const query = params.get("searchbar");

if (query && query.trim() !== "") {

    searchInput.value = query;

    searchDatabase(query);

}
