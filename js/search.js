const searchInput = document.getElementById("search");
const searchForm = document.getElementById("search-form");
const results = document.getElementById("results");
const resultsHeading = document.getElementById("results-heading");
const resultsMessage = document.getElementById("results-message");

console.log("Search Input:", searchInput);
console.log("Search Form:", searchForm);
console.log("Results:", results);
console.log("Results Heading:", resultsHeading);
console.log("Results Message:", resultsMessage);

// Search database
async function searchDatabase(search) {

    try {
        results.innerHTML = "";
        resultsMessage.textContent = "Searching...";
        const response = await fetch(
            "backend/search.php?search=" + encodeURIComponent(search)
        );

        if (!response.ok) {
          throw new Error("Failed to retrieve search results");
        }

        const data = await response.json();
        
        resultsHeading.textContent = `Search Results for "${search}"`;
        resultsMessage.textContent = "";
        
        
        if (data.length === 0) {
            resultsMessage.textContent = "No products found.";
            return;
        }

        data.forEach(item => {
          const productBox = document.createElement("li");
          productBox.classList.add("product-box");


          const productImage = document.createElement("img");
          productImage.src = item.image_url;
          productImage.alt = item.name;
          productImage.classList.add("product-image");


          const productName = document.createElement("h4");
          productName.textContent = item.name;


          const productDescription = document.createElement("p");
          productDescription.textContent = item.description;


          const productPrice = document.createElement("p");
          productPrice.textContent = "$" + Number(item.price).toFixed(2);
          productPrice.classList.add("product-price");


          productBox.appendChild(productImage);
          productBox.appendChild(productName);
          productBox.appendChild(productDescription);
          productBox.appendChild(productPrice);
          results.appendChild(productBox);
        });

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
