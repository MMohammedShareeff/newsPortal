let txt = document.getElementById("main-text");
let incBtn = document.getElementById("inc-btn");
let decBtn = document.getElementById("dec-btn");

incBtn.onclick = () => {
  let size = parseInt(window.getComputedStyle(txt).fontSize);
  if(size < 28){
      txt.style.fontSize = size + 2 + "px";
  }
};

decBtn.onclick = () => {
    let size = parseInt(window.getComputedStyle(txt).fontSize);
    if(size > 10){
        txt.style.fontSize = size - 2 + "px";
    }
};