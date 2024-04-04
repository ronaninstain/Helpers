/* Bottom nav js start */

jQuery("#S-Bottom-Navbar-id").on("click", "a", function () {
  jQuery("a").removeClass("active");
  jQuery(this).addClass("active"); // adding active class
});

jQuery(function () {
  jQuery(".S-Bottom-SearchLink").on("click", function (e) {
    jQuery(".searchform").toggleClass("open");
  });
});

/* Bottom nav js end */
