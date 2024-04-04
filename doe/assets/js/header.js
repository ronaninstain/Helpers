// New js

jQuery(document).ready(function($) {
    function foyFunction() {
      const navSearch = $(this).closest('#foy-search-suggestion');
      const suggestionBox = navSearch.find('.foy-suggestion-box');
      let loader = navSearch.find('#foy-loading');
      const keyword = $(this).val();
      if (keyword.length < 4) {
        if (suggestionBox) {
          suggestionBox.remove();
        }
        if (loader) {
          loader.remove();
        }
      } else {
        if (!suggestionBox.length) {
          navSearch.append('<div class="foy-suggestion-box" id="foy-suggestion-box"><!-- course suggestion --></div>');
        }
        if (!loader.length) {
          const input = navSearch.find('input[name="s"]');
          loader = $('<div>', {
              id: 'foy-loading',
              class: 'spinner-border',
              role: 'status'
            })
            .html('<img src="https://uk.hfonline.org/wp-content/uploads/2024/03/loader-2.webp" alt="search loader">');
          input.after(loader);
        }
        loader.show();
        $.ajax({
          url: ajaxurl,
          type: 'get',
          data: {
            action: 'data_fetch_new',
            keyword: keyword
          },
          success: function(data) {
            const suggestionBox = navSearch.find('.foy-suggestion-box');
            suggestionBox.html(data).show();
            loader.hide();
          }
        });
      }
    }
    $('#foy-search-suggestion input[name="s"]').on('keyup', foyFunction);
  });
  document.addEventListener('click', function(event) {
    var suggestionBox = document.querySelector('.foy-suggestion-box');
    if (suggestionBox) {
      let loader = document.querySelector('#foy-loading');
      var isClickedInside = suggestionBox.contains(event.target);
      if (!isClickedInside) {
        suggestionBox.remove();
        if (loader) {
          loader.remove();
        }
      }
    }
  });





  const srsMega_first_item = document.querySelector(".srs_mega_menu_items li");
  const srsMega_first_item_link = document.querySelector(".srs_mega_menu_items li a");
  const srsMegaSingleItem = document.querySelectorAll('.srs_mega_menu_items li');
  const srsBrandSec = document.querySelector('.srs_brand_sec');
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
});

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
    srsMega_first_item_link.style.backgroundColor = "#FF7235";
    srsMega_first_item_link.style.color = "white";

  });

  srsBrandSec.addEventListener("mouseout", () => {
    srsMega_first_item.classList.remove("srs_first_active");
    srsMega_first_item_link.style.backgroundColor = "";
    srsMega_first_item_link.style.color = "";

  });


//   new js end






// function foyFunction() {
//     jQuery('#foy-suggestion-box-1').css('display', 'none');
//     jQuery('#foy-loading').css('display', 'block');
//     const input = document.querySelector('.nav_search input[name="s"]');
//     var keyword = input.value;
//     if (keyword.length < 4) {
//         jQuery('#foy-suggestion-box').html("");
//         jQuery('#foy-suggestion-box').css('display', 'none');
//         jQuery('#foy-loading').css('display', 'none');
//     }
//     else {
//         jQuery.ajax({
//             url: ajaxurl,
            //url: "/janets/wp-admin/admin-ajax.php",
//             type: 'get',
//             data: {
//                 action: 'data_fetch',
//                 keyword: keyword
//             },
//             success: function(data) {
//                 jQuery('#foy-suggestion-box').html(data);
//                 jQuery('#foy-suggestion-box').css('display', 'block');
//                 jQuery('#foy-loading').css('display', 'none');
//             }
//         });
//     }
// }
// Add the suggestion box below the form
// const navSearch = document.querySelector('.nav_search');
// navSearch.insertAdjacentHTML('beforeend', '<div class="foy-suggestion-box" id="foy-suggestion-box"><!-- course suggestion --></div>');

// Get the input element
// const input = document.querySelector('.nav_search input[name="s"]');
// const spinner = document.createElement('div');
// spinner.id = 'foy-loading';
// spinner.className = 'spinner-border';
// spinner.setAttribute('role', 'status');
// spinner.innerHTML = '<img src="https://www.johnacademy.co.uk/wp-content/uploads/2024/03/loader-1.webp" alt="search loader">';
// input.after(spinner);

// Add the event listener
// input.addEventListener('keyup', foyFunction);







// function foyFunction1() {
//     jQuery('#foy-suggestion-box').css('display', 'none');
//     jQuery('#foy-loading-1').css('display', 'block');
//     const input_1 = document.querySelector('.ar-searchContainer input[name="s"]');
//     var keyword_1 = input_1.value;
//     if (keyword_1.length < 4) {
//         jQuery('#foy-suggestion-box-1').html("");
//         jQuery('#foy-suggestion-box-1').css('display', 'none');
//         jQuery('#foy-loading-1').css('display', 'none');
//     }
//     else {
//         jQuery.ajax({
//             url: ajaxurl,
            //url: "/janets/wp-admin/admin-ajax.php",
//             type: 'get',
//             data: {
//                 action: 'data_fetch',
//                 keyword: keyword_1
//             },
//             success: function(data) {
//                 jQuery('#foy-suggestion-box-1').html(data);
//                 jQuery('#foy-suggestion-box-1').css('display', 'block');
//                 jQuery('#foy-loading-1').css('display', 'none');
//             }
//         });
//     }
// }


// Add the suggestion box below the form
// const navSearch_1 = document.querySelector('.ar-searchContainer');
//console.log(navSearch_1);
// navSearch_1.insertAdjacentHTML('afterend', '<div class="foy-suggestion-box-1" id="foy-suggestion-box-1"><!-- course suggestion --></div>');

// Get the input element
// const input_1 = document.querySelector('.ar-searchContainer input[name="s"]');
// const spinner_1 = document.createElement('div');
// spinner_1.id = 'foy-loading-1';
// spinner_1.className = 'spinner-border';
// spinner_1.setAttribute('role', 'status');
// spinner_1.innerHTML = '<img src="https://www.johnacademy.co.uk/wp-content/uploads/2024/03/loader-1.webp" alt="search loader">';
// input_1.after(spinner_1);

// Add the event listener
// input_1.addEventListener('keyup', foyFunction1);




// let searchIc = document.querySelector('#submit-for-header-search');
// let searchFrm = document.querySelector('.nav_search form');
// searchFrm.append(searchIc);


