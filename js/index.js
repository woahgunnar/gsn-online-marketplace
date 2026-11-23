//Replaceable string list (meant to select items and columns from the database)
//Links to the products and images have temporary placeholders for now.
const recommended = [
  {
    name: "Goody gumdrops",
    link: "index.html",
    img: "images/product-placeholder.gif",
  },
  {
    name: "Goober guts",
    link: "index.html",
    img: "images/product-placeholder.gif",
  },
  {
    name: "Scooby Snacks",
    link: "index.html",
    img: "images/product-placeholder.gif",
  },
  {
    name: "Krabby patty",
    link: "index.html",
    img: "images/product-placeholder.gif",
  },
  {
    name: "Shrek bath water",
    link: "index.html",
    img: "images/product-placeholder.gif",
  },
  {
    name: "placeholder",
    link: "index.html",
    img: "images/product-placeholder.gif",
  },
];

const recommendeditems = document.querySelector(".browse-catalog");

//Dynamically resizing list reads from the string above and creates an individual <a></a> below line 26 of the .html
recommended.forEach((item) => {
  const link = document.createElement("a");
  const picture = document.createElement("img");
  link.textContent = item.name;
  link.href = item.link;
  picture.src = item.img;
  picture.width = 150;
  picture.height = 150;
  link.appendChild(picture);
  recommendeditems.appendChild(link);
});
