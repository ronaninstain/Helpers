// Sidebar Toggle For Large Display
const button  = document.querySelector('#sidebar-toggle');
const wrapper = document.querySelector('#wrapper');

button.addEventListener('click', (e) => {
  e.preventDefault();
  wrapper.classList.toggle('toggled');
});


// Sidebar Toggle For Small And Medium Display
// (function($) {
//   $(document).ready(function($){
//     $('#closeid').click(function(){
//       $(this).toggleClass('open');
//       $("#mySidenav").toggleClass("sideopen");
//       $("body").toggleClass("fixed-position");
//     });

//   });
// })(jQuery);


// jQuery(document).ready(function(){
//   jQuery('#closeid').click(function(){
//     jQuery(this).toggleClass('open');
//     jQuery("#mySidenav").toggleClass("sideopen");
//     jQuery("body").toggleClass("fixed-position");
//   });
// });

// Sidebar Toggle For Small And Medium Display
// (function() {
//   jQuery(document).ready(function(){
//     jQuery('#closeid').click(function(){
//       jQuery(this).toggleClass('open');
//       jQuery("#mySidenav").toggleClass("sideopen");
//       jQuery("body").toggleClass("fixed-position");
//     });

//   });
// })(jQuery);

// Sidebar close when menu item click
// (function() {
//   jQuery(document).ready(function(){
//     jQuery('.ar-tavClose').click(function(){
//       jQuery("#mySidenav").removeClass("sideopen");
//       jQuery("#closeid").removeClass("open");
//       jQuery("body").toggleClass("fixed-position");
//     });
//   });
// })(jQuery);

// Counter in Dashboard
function makesvg(percentage, inner_text=""){

  var abs_percentage = Math.abs(percentage).toString();
  var percentage_str = percentage.toString();
  var classes = ""

  if(percentage < 0){
    classes = "danger-stroke circle-chart__circle--negative";
  } else if(percentage > 0 && percentage <= 30){
    classes = "warning-stroke";
  } else{
    classes = "success-stroke";
  }

 var svg = '<svg class="circle-chart" viewbox="0 0 33.83098862 33.83098862" xmlns="http://www.w3.org/2000/svg">'
     + '<circle class="circle-chart__background" cx="16.9" cy="16.9" r="15.9" />'
     + '<circle class="circle-chart__circle '+classes+'"'
     + 'stroke-dasharray="'+ abs_percentage+',100"    cx="16.9" cy="16.9" r="15.9" />'
     + '<g class="circle-chart__info">'
     + '   <text class="circle-chart__percent" x="17.9" y="15.5">'+percentage_str+'%</text>';

  if(inner_text){
    svg += '<text class="circle-chart__subline" x="16.91549431" y="22">'+inner_text+'</text>'
  }
  
  svg += ' </g></svg>';
  
  return svg
}

(function( jQuery ) {

  jQuery.fn.circlechart = function() {
        this.each(function() {
            var percentage = jQuery(this).data("percentage");
            var inner_text = jQuery(this).text();
            jQuery(this).html(makesvg(percentage, inner_text));
        });
        return this;
    };

}( jQuery ));

jQuery(function () {
  jQuery('.circlechart').circlechart();
});


/* ACCORDION/Tabs TOGGLE ICONS in Support > FAQ */
function toggleIcon(e) {
  jQuery(e.target)
      .prev('.panel-heading')
      .find(".more-less")
      .toggleClass('glyphicon-plus glyphicon-minus');
}
jQuery('.panel-group').on('hidden.bs.collapse', toggleIcon);
jQuery('.panel-group').on('shown.bs.collapse', toggleIcon);


// Slider 

(function() {
  jQuery('.carousel-multiItem  .item').each(function() {
    var itemToClone = jQuery(this);
    /*
    .....number  of item show  in slide  !
    */
    for (var i = 1; i < 3; i++) {
      /* 
        ..... go to the  next  item  in curasol 
      */
      itemToClone = itemToClone.next();

      /*  ....
        when that  item is last  item  in cauarsol-item  do this choos first sibling item and 
         go to do  add it , clone, add class, and add to collection
      */

      /*    else..... 
            skip this  condition and go to  add item content  and  clone it ....
      */

      if (!itemToClone.length) {
        itemToClone = jQuery(this).siblings(':first');
      }

      /* 
        .... show the first-child in item class  " this div contain the content inside in" 
        ... then clone this selector "clearly meaning copy the data"
        ...  and give  it tha css style 
        ...  then add it  to collection in slide 
      */
      itemToClone.children(':first-child').clone()
        .addClass("cloneditem-" + (i))
        .appendTo(jQuery(this));

        jQuery(".carousel-multiItem ").find(".item").css("transition", "   500ms ease-in-out all  ").css("transition", "  500ms ease-in-out all").css("backface-visibility", "visible").css("transform", "none!important")

      /*
       .... you  can  use  bootstrap function  if you used bootstrap CDN 
       .... but iam used  always  bootstrap.min.js   so  i do  this 
      
       .... @media all and (min-width: 768px) and (transform-3d),
           all and (min-width: 768px) and (-webkit-transform-3d)
      
      */

    }
  });
}());


// Add tab id name in url
var url = document.URL;
var hash = url.substring(url.indexOf('#'));
jQuery(".ar-menu-list").find("li a").each(function(key, val) {
    if (hash == jQuery(val).attr('href')) {
      jQuery(val).click();
    }
    
    jQuery(val).click(function(ky, vl) {
        location.hash = jQuery(this).attr('href');
    });
});

//Keep the Current Tab Active on Page Reload
jQuery(document).ready(function(){
  jQuery('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
    localStorage.setItem('activeTab', jQuery(e.target).attr('href'));
  });
  var activeTab = localStorage.getItem('activeTab');
  if(activeTab){
    jQuery('#idforactive a[href="' + activeTab + '"]').tab('show');
  }
});

// for filtering menu
jQuery(document).ready(function () {
  jQuery('.ar-allfltr').isotope({
    itemSelector: '.ar-element-item',
    layoutMode: 'fitRows'
  });
  jQuery('.ar-iso-nav a').click(function () {
    //ACTIVE CLASS
    jQuery('.iso-nav a').removeClass('custom_active');
    jQuery(this).addClass('custom_active');
    var selector = jQuery(this).attr('data-filter');
    jQuery('.ar-mycrses').isotope({
      filter: selector
    });
    return false;
  })
});


// Search Form in My Courses
function MSearchInstant() {

  var input, filter, ul, li, course, nocourse, a, i, txtValue;
  input = document.getElementById("AR-myInput");
  filter = input.value.toUpperCase();
  ul = document.getElementById("ar-for-filter");
  li = ul.getElementsByTagName("h5");
  course = document.getElementsByClassName("category-box");
  nocourse = document.getElementsByClassName("btm-srch-ttl2");

  for (i = 0; i < li.length; i++) {

      a = li[i].getElementsByTagName("span")[0];
      txtValue = a.textContent || a.innerText;

      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        course[i].style.display = "";
        
        // var element = document.getElementById("idforfiltersh");
        // element.classList.add("displayhideshow");
      } 
      
      else {
        course[i].style.display = "none";
        // var element = document.getElementById("idforfiltersh");
        // element.classList.remove("displayhideshow");
      }

  }
}


// filter of js by arif
const filters = document.querySelectorAll('.filter');

filters.forEach(filter1 => { 

  filter1.addEventListener('click', function() {

    filters.forEach(f => {
      f.classList.remove('active');
    });
    // Add "active" class to the clicked button
    this.classList.add('active');



    let selectedFilter = filter1.getAttribute('data-filter');
    let itemsToHide = document.querySelectorAll(`.projects .project:not([data-filter='${selectedFilter}'])`);
    let itemsToShow = document.querySelectorAll(`.projects [data-filter='${selectedFilter}']`);

    if (selectedFilter == 'all') {
      itemsToHide = [];
      itemsToShow = document.querySelectorAll('.projects [data-filter]');

      itemsToShow.forEach(e => {
        e.classList.remove('activeCourse');
        e.classList.remove('completeCourse');
      });

    }else if(selectedFilter == 'activeCourse'){
      let otherElement = document.querySelectorAll('.projects [data-filter="activeCourse"]');
      otherElement.forEach(e => {
        e.classList.add('activeCourse');
      });
    }else if(selectedFilter == 'completeCourse'){
      let otherElement = document.querySelectorAll('.projects [data-filter="completeCourse"]');
      otherElement.forEach(e => {
        e.classList.add('completeCourse');
      });
    }

    itemsToHide.forEach(el => {
      el.classList.add('hide');
      el.classList.remove('show');
    });

    itemsToShow.forEach(el => {
      el.classList.remove('hide');
      el.classList.add('show'); 
    });

  });
});




