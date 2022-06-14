// click in the card to change the href to childe a
//------------------------------------------------
let cat_items = document.querySelectorAll(".cat-card .space");
cat_items.forEach((e) => {
  let href = e.children.item(1).children.item(0).href;
  e.addEventListener("click", (e) => {
    location.href = href;
  });
});
// -----------------------------------------------
// click in the card to change the href to childe a
//------------------------------------------------
let new_items = document.querySelectorAll(".new-item .card");
new_items.forEach((e) => {
  let href = e.children.item(1).children.item(0).children.item(0).href;
  e.addEventListener("click", () => {
    location.href = href;
  });
});
//------------------------------------------------
// Switch Between Login & Signup
let spanLoginPage = document.querySelectorAll(".login-page span");
let formLogin = document.querySelectorAll(".login-page form");

spanLoginPage.forEach((e) => {
  e.addEventListener("click", function () {
    for (let i = 0; i < spanLoginPage.length; i++) {
      spanLoginPage[i].classList.remove("selected");
      formLogin[i].style.display = "none";
    }
    e.classList.add("selected");
    document.querySelector("." + e.getAttribute("data-class")).style.display =
      "block";
  });
});
// -----------------------------------------------
