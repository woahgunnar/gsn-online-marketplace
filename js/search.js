const params = new URLSearchParams(window.location.search);
const query = params.get("searchbar");

if (query && query.trim()) {
  document.getElementById("search").value = query;

  document.getElementById("results-heading").textContent =
    `Search Results for "${query}"`;
}
