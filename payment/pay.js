const moneys = document.querySelector(".moneys");
const colorOverlay = document.querySelector(".color_overlay");

let dollars = 100;
let cents = 0;

function updateMoneys(d, c) {
  cents++;
  if (cents > 99) {
    cents = 0;
    dollars++;
  }
  moneys.innerHTML = d;
  if (cents < 10) {
    moneys.setAttribute("data-cent", `.0${c}`);
  } else {
    moneys.setAttribute("data-cent", `.${c}`);
  }
}

let updateTimer = window.setInterval(() => {
  updateMoneys(dollars, cents);
}, 50);
