var grid = document.querySelector(".grid-layout");
var grid_aside = document.querySelector(".grid-layout__aside");
var icon_toggle = document.querySelector(".aside__icon-toggle")

var btn_toggle = document.getElementById("btn-toggle");
var btn_account = document.getElementById("btn-account");
var btn_notify = document.getElementById("btn-notify");
var btn_help = document.getElementById("btn-help");
var btn_content  = document.querySelectorAll("#btn-content");

btn_toggle.addEventListener("click", ToggleAside);
btn_account.addEventListener("click", OpenAside);
btn_notify.addEventListener("click", OpenAside);
btn_help.addEventListener("click", OpenAside);

for (let i = 0; i < btn_content.length; i++) {
  btn_content[i].addEventListener("click", CloseAside);
}

function ToggleAside() {
  grid.classList.toggle("active");
  grid_aside.classList.toggle("active")
  icon_toggle.classList.toggle("active")
  icon_toggle.classList.toggle("fa-caret-right");
  icon_toggle.classList.toggle("fa-caret-left");
}
function OpenAside() {
  if (grid.classList[1] == "active") {
    grid.classList.remove("active");
    grid_aside.classList.remove("active")
    icon_toggle.classList.remove("active")
    icon_toggle.classList.add("fa-caret-right");
    icon_toggle.classList.remove("fa-caret-left");
  }
}
function CloseAside() {
  if (grid.classList[1] != "active") {
    grid.classList.add("active");
    grid_aside.classList.add("active")
    icon_toggle.classList.add("active")
    icon_toggle.classList.remove("fa-caret-right");
    icon_toggle.classList.add("fa-caret-left");
  }
}
