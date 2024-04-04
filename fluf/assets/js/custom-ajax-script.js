jQuery(document).ready(function ($) {
  function sendAjaxRequest(product_id) {
    var data = {
      action: "add_to_cart_ajax",
      product_id: product_id,
    };
    $.ajax({
      url: ajaxurl,
      type: "POST",
      data: data,
      beforeSend: function () {},
      success: function (response) {
        handleProperties();
        window.location.reload();
      },
      complete: function () {},
      error: function (jqXHR, textStatus, errorThrown) {
        console.error("AJAX Error:", textStatus, errorThrown);
      },
    });
  }
  function handleProperties() {
    button.prop("disabled", false).html("Add to Cart with Other Products");
    // $(".fa-shopping-basket em").html(currentCount + 1);
    var toaster = $("#customToaster");
    toaster
      .addClass("success")
      .html("Course added to cart successfully!")
      .fadeIn();
    setTimeout(function () {
      toaster.fadeOut();
    }, 3000);
  }
  // Event listener
  $(document).on("click", ".add-to-cart_single", function (e) {
    var product_id = this.getAttribute("data-product-id");
    button = $(this);
    button
      .prop("disabled", true)
      .html('<i class="fa fa-spinner fa-spin"></i> Adding to Cart...');

    // var currentCount = parseInt($(".fa-shopping-basket em").text(), 10);
    // $(".fa-shopping-basket em").html('<i class="fa fa-spinner fa-spin"></i>');

    sendAjaxRequest(product_id);
  });
});
