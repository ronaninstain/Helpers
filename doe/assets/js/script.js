
jQuery('.ar-slider-nav').slick({
    slidesToShow: 5,
    slidesToScroll: 1,
    infinite: false,
    dots: false,
    prevArrow: jQuery('.ar-prev'),
    nextArrow: jQuery('.ar-next'),
    responsive: [{
        breakpoint: 1024,
        settings: {
            slidesToShow: 3,
        }
    },
    {
        breakpoint: 767,
        settings: {
            slidesToShow: 1,
        }
    }
    ]
});

jQuery('.ar-course-slider').slick({
    slidesToShow: 4,
    slidesToScroll: 1,
    dots: false,
    prevArrow: jQuery('.ar-prv'),
    nextArrow: jQuery('.ar-nxt'),
    responsive: [{
        breakpoint: 1199,
        settings: {
            slidesToShow: 3,
        }
    },
    {
        breakpoint: 992,
        settings: {
            slidesToShow: 2,
        }
    },
    {
        breakpoint: 667,
        settings: {
            slidesToShow: 1,
        }
    }
    ]
});

jQuery("#course_search_submit").attr('value', 'sdsd');
jQuery("#search-course-form").append('<i class="fa fa-search"></i>');


(function ($) {
    let category = '';
    $(document).ready(function () {
        $(document).on('change', '#course-order-by', function (e) {
            $("#loader, .overlap").show();
            e.preventDefault();

            var selectVal = $(this).val();
            let selectKey = $('option:selected', this).attr('datakey');
            //console.log(selectKey);
            $.ajax({
                url: ajaxurl,
                data: {
                    action: 'sortingOnclick_john',
                    customData: selectVal,
                    catID: category,
                    keyword: selectKey
                },
                type: 'get',
                success: function (result) {
                    $("#loader, .overlap").hide();
                    $('.ar-grid').html(result);
                },
                error: function (result) {
                    console.warn(result);
                }
            });
        });
    });

})(jQuery);
