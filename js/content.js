var grid = window.top.document.querySelector(".grid-layout");
var grid_aside = window.top.document.querySelector(".grid-layout__aside");
var icon_toggle = window.top.document.querySelector(".aside__icon-toggle")

var open_aside = document.querySelectorAll("#open_aside");
var close_aside = document.querySelectorAll("#close_aside");
var btn_new = document.querySelectorAll("#btn_new");
var btn_mod = document.querySelectorAll("#btn_mod");
var btn_info = document.querySelectorAll("#btn_info");
var btn_form_cancel = document.querySelectorAll("#btn-form-cancel");
var btn_form_submit = document.querySelectorAll("#btn-form-submit");

for (let i = 0; i < open_aside.length; i++) {
  open_aside[i].addEventListener("click", OpenAside);
}
for (let i = 0; i < close_aside.length; i++) {
  close_aside[i].addEventListener("click", CloseAside);
}
for (let i = 0; i < btn_new.length; i++) {
  btn_new[i].addEventListener("click", OpenAside);
}
for (let i = 0; i < btn_mod.length; i++) {
  btn_mod[i].addEventListener("click", OpenAside);
}
for (let i = 0; i < btn_info.length; i++) {
  btn_info[i].addEventListener("click", OpenAside);
}
for (let i = 0; i < btn_form_cancel.length; i++) {
  btn_form_cancel[i].addEventListener("click", CloseAside);
}
for (let i = 0; i < btn_form_submit.length; i++) {
  btn_form_submit[i].addEventListener("click", CloseAside);
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
function ReloadMain() {
  window.top.frames['iframe_main'].location.reload();
}
