
//Replaceable string list (meant to select items and columns from the database)
//Links to the products and images have temporary placeholders for now.
const recommended = [
    {name: "Goody gumdrops:", link: "https://youtu.be/5SZYz7lZRRI?si=UeXtj2f7TKmv_wX2", img: "ProductImage.gif"},
    {name: "Goober guts:", link: "https://youtu.be/5SZYz7lZRRI?si=UeXtj2f7TKmv_wX2", img: "ProductImage.gif"},
    {name: "Scooby Snacks:", link: "https://youtu.be/5SZYz7lZRRI?si=UeXtj2f7TKmv_wX2", img: "ProductImage.gif"},
    {name: "Krabby patty:", link: "https://youtu.be/5SZYz7lZRRI?si=UeXtj2f7TKmv_wX2", img: "ProductImage.gif"},
    {name: "Shrek bath water:", link: "https://youtu.be/5SZYz7lZRRI?si=UeXtj2f7TKmv_wX2", img: "ProductImage.gif"},
];

const recommendeditems = document.querySelector(".browse-catalog");

//Dynamically resizing list reads from the string above and creates an individual <a></a> below line 26 of the .html
recommended.forEach(item => {
    const link = document.createElement("a");
    const picture = document.createElement("img")
    link.textContent = item.name;
    link.href = item.link;
    picture.src = item.img;
    picture.width = 150;
    picture.height = 150;
    link.appendChild(picture)
    recommendeditems.appendChild(link)
})