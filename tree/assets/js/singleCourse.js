jQuery.noConflict();

jQuery(document).ready(function ($) {
  var navPosition,
    sidePosition,
    lastSectionOffset,
    SideBarSectionOffset,
    isMobile;

  $(window).on("load resize", function () {
    isMobile = $(window).width() <= 768;

    // Recalculate values on load and resize
    navPosition = $(".a2n_c-menu").offset().top;
    sidePosition = $(".a2n_c-sidebar").offset().top;
    lastSectionOffset = $("#a2n_faq").offset().top;
    SideBarSectionOffset = $("#a2n_faq").offset().top - 800;
  });

  $('a[href^="#"]').click(function () {
    $("html,body").animate(
      {
        scrollTop: $($(this).attr("href")).offset().top - 100,
      },
      "slow",
      "swing"
    );
    return false;
  });

  function onePageNav(switchName) {
    const navSwitch = $(switchName);
    const deductHeight = 250;
    let navArr = [];

    navSwitch.each(function (i) {
      let navSwitchHref = $(this).attr("href");
      let tgtOff = $(navSwitchHref).offset().top - deductHeight;
      navArr.push([]);
      navArr[i].switch = $(this);
      navArr[i].tgtOff = tgtOff;
    });

    $(window).scroll(function () {
      let scroll = $(window).scrollTop();

      if (isMobile) {
        // Mobile behavior
        if (scroll >= navPosition) {
          $(".a2n_c-menu").addClass("fixed");
          $(".a2n_c-menu").addClass("a2n_sticky-top");
          if (scroll <= lastSectionOffset) {
            $(".a2n_c-menu").removeClass("a2n_sticky-top");
          } else {
            $(".a2n_c-menu").removeClass("fixed");
          }
        } else {
          $(".a2n_c-menu").removeClass("fixed");
        }
        for (let i = 0; i < navArr.length; i++) {
          let tgtKey = navArr[i];
          let tgtSwitch = tgtKey.switch;
          let tgtOff = tgtKey.tgtOff;
          if (scroll >= tgtOff) {
            navSwitch.removeClass("a2n_active");
            tgtSwitch.addClass("a2n_active");
          } else {
            tgtSwitch.removeClass("a2n_active");
          }
        }
      } else {
        // Desktop behavior

        if (scroll >= sidePosition) {
          $(".a2n_c-sidebar").addClass("a2n_sticky-top");
          $(".a2n_c-sidebar").addClass("fixed-sidebar");
          if (scroll <= SideBarSectionOffset) {
            $(".a2n_c-sidebar").removeClass("a2n_sticky-top");
          } else {
            $(".a2n_c-sidebar").removeClass("fixed-sidebar");
          }
        } else {
          $(".a2n_c-sidebar").removeClass("fixed-sidebar");
        }

        if (scroll >= navPosition) {
          $(".a2n_c-menu").addClass("fixed");
          $(".a2n_c-menu").addClass("a2n_sticky-top");
          if (scroll <= lastSectionOffset) {
            $(".a2n_c-menu").removeClass("a2n_sticky-top");
          } else {
            $(".a2n_c-menu").removeClass("fixed");
          }
        } else {
          $(".a2n_c-menu").removeClass("fixed");
        }

        for (let i = 0; i < navArr.length; i++) {
          let tgtKey = navArr[i];
          let tgtSwitch = tgtKey.switch;
          let tgtOff = tgtKey.tgtOff;
          if (scroll >= tgtOff) {
            navSwitch.removeClass("a2n_active");
            tgtSwitch.addClass("a2n_active");
          } else {
            tgtSwitch.removeClass("a2n_active");
          }
        }
      }
    });
  }

  $(window).on("load resize", function () {
    isMobile = $(window).width() <= 768;
    onePageNav(".a2n_switch");
  });

  $(window).scroll(function () {
    var topPos = $(this).scrollTop();
    // scroll hide video
    if (topPos > 250) {
      $(".video-content a").css("display", "none");
    } else {
      $(".video-content a").css("display", "block");
    }
  });

  // Example AJAX call
  $.ajax({
    // AJAX configurations
    // ...
  });
});

function handleClass(node, className, action = "add") {
  node.classList[action](className);
}

const accordions = document.querySelectorAll(".a2n-accordion");

accordions.forEach(function (accordion, index) {
  const heading = accordion.querySelector(".a2n-accordion_head");
  const accordionContentWrap = accordion.querySelector(
    ".a2n-accordion__content-wrap"
  );
  const originalHeight = accordionContentWrap.offsetHeight;

  if (index === 0) {
    handleClass(accordion, "a2n-accordion__active");
    accordionContentWrap.style.height = originalHeight + "px";
  } else {
    accordionContentWrap.style.height = 0;
  }

  let accordionActiveClass = "a2n-accordion__active";

  heading.addEventListener("click", function () {
    if (this.parentNode.classList.contains(accordionActiveClass)) {
      handleClass(this.parentNode, accordionActiveClass, "remove");
      accordionContentWrap.style.height = 0 + "px";
    } else {
      accordions.forEach(function (otherAccordion, otherIndex) {
        if (
          otherIndex !== index &&
          otherAccordion.classList.contains(accordionActiveClass)
        ) {
          handleClass(otherAccordion, accordionActiveClass, "remove");
          otherAccordion.querySelector(
            ".a2n-accordion__content-wrap"
          ).style.height = 0 + "px";
        }
      });

      handleClass(this.parentNode, accordionActiveClass);
      accordionContentWrap.style.height = originalHeight + "px";
    }
  });
});
