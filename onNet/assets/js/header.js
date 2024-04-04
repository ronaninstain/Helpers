const srsBody = document.querySelector("body");
const srsMenuBtn = document.querySelector(".menu-btn");
const srsMenuItems = document.querySelector(".menu-items");
const srsExpandBtn = document.querySelectorAll(".expand-btn");
const srsExpandBtn2 = document.querySelectorAll(".expand-btn2");
const srsExploreMoreDrop = document.querySelectorAll(".srs_explore_more_dropDown");
const srsMbOpenMega = document.querySelectorAll(".srs_mobile_mega");
const srsCross = document.querySelector(".srs_cross");

function toggle() {
  // add open class
  srsMenuBtn.classList.toggle("open");
  srsMenuItems.classList.toggle("open");
    
}

srsMenuBtn.addEventListener("click", () => {
  toggle();
});

window.onkeydown = function (event) {
  const key = event.key; // const {key} = event; in ES6+
  const active = srsMenuItems.classList.contains("open");
  if (key === "Escape" && active) {
    toggle();
  }
};

srsCross.addEventListener("click", (e) => {
  closeMega();
})
function closeMega(){
    srsMbOpenMega[0].classList.remove("open");
}

// mobile menu expand
srsExpandBtn.forEach((btn) => {
  btn.addEventListener("click", () => {
    srsMbOpenMega[0].classList.add("open");
    toggle();
    
    
  });
});
srsExpandBtn2.forEach((btn) => {
  btn.addEventListener("click", () =>{
    srsExploreMoreDrop[0].classList.toggle("dropOpen");
  });
})


const srsMega_first_item = document.querySelector(".srs_mega_menu_items li");
const srsMega_first_item_link = document.querySelector(".srs_mega_menu_items li a");
const srsMegaSingleItem = document.querySelectorAll('.srs_mega_menu_items li');
const srsBrandSec = document.querySelector('.srs_brand_sec');

function srsFirstClassAdd() {
  srsMega_first_item.classList.add("srs_first_active");
}

srsFirstClassAdd();

const srsMegaItemActive = document.querySelector(".srs_first_active");

srsMegaSingleItem.forEach(function(btn) {
  btn.addEventListener("mouseover", () => {
    if (srsMegaItemActive) {
      srsMegaItemActive.classList.remove("srs_first_active");

    }
  });

  btn.addEventListener("mouseout", () => {
    const child = btn.querySelector("ul");
    if (child) {

      srsMega_first_item.classList.add("srs_first_active");

    }
  });

  btn.addEventListener("mouseenter", () => {
    srsMega_first_item_link.style.backgroundColor = "";
    srsMega_first_item_link.style.color = "";

  });


  if (btn.textContent.trim() === "View All Courses") {
    btn.addEventListener("mouseover", () => {
      const siblingUl = srsMega_first_item_link.nextElementSibling;
      if (siblingUl) {
        siblingUl.style.display = "grid";

      }
    });

    btn.addEventListener("mouseout", () => {
      const siblingUl = srsMega_first_item_link.nextElementSibling;
      if (siblingUl) {
        siblingUl.style.display = "";


      }
    });
  }
});

srsBrandSec.addEventListener("mouseover", () => {
  srsMega_first_item.classList.add("srs_first_active");
  srsMega_first_item_link.style.backgroundColor = "#f5a033";
  srsMega_first_item_link.style.color = "white";

});

srsBrandSec.addEventListener("mouseout", () => {
  srsMega_first_item.classList.remove("srs_first_active");
  srsMega_first_item_link.style.backgroundColor = "";
  srsMega_first_item_link.style.color = "";

});