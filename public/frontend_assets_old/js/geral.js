$(function () {

    // == MENU ==

    $(".header-item-menu").on("click", function () {

        $(this).toggleClass("active");
        $(".header-bottom-bar").slideToggle();

    });

    $(".search-filter-dropdown > .dropdown-menu a").on("click", function () {

        var searchFilter = $(this).text();
        $(".search-filter-dropdown > .dropdown-toggle").text(searchFilter);
        $("#searchFilterBtn").dropdown('toggle');
        return false;

    });

    $(".currency-dropdown > .dropdown-menu a").on("click", function () {

        var currency = $(this).text();
        $(".currency-dropdown > .dropdown-toggle").text(currency);

    });

    // == SLIDERS ==

    $('.intro-block-slider').slick({
        fade: true,
        //autoplay: true,
        autoplaySpeed: 2000,
        prevArrow: '<button type="button" class="btn slick-prev"><i class="fa fa-angle-left"></i></button>',
        nextArrow: '<button type="button" class="btn slick-next"><i class="fa fa-angle-right"></i></button>',
        responsive: [
            {
                breakpoint: 767,
                settings: {
                    arrows: false,
                    dots: true
                }
            }
        ]
    });

    // == SIDE MENU ==

    if ($(".side-menu-wrapper").length) {

        $(".side-menu-title").each(function () {
            var activePage = $(this).siblings().find(".active").text();
            $(this).text(activePage).append('<i class="fa fa-caret-down"></i>');

            $(this).on("click", function () {
                $(this).toggleClass("open").siblings().slideToggle();
            });
        });

    };

    // == ACCOUNT MENU
    if ($(".account-side-info-wrapper").length) {

        $(".account-side-title").each(function () {

            $(this).on("click", function () {
                $(this).toggleClass("open").siblings().slideToggle();
            });
        });

    };

    // == DROPDOWN EFFECT ==
    $('.dropdown').on('show.bs.dropdown', function (e) {
        $(this).find('.dropdown-menu').first().stop(true, true).fadeIn(300);
    });

    $('.dropdown').on('hide.bs.dropdown', function (e) {
        $(this).find('.dropdown-menu').first().stop(true, true).fadeOut(200);
    });

    // == QTD Inputs ==
    // detalhe qtd
    function quantityButtons(el, amount) {
        const input = el.closest(".custom-qtd-input").find("input");
        var value = input.val();
        if (!isNaN(value)) {
            value = parseInt(value) + amount;
            if (value > 0) {
                input.val(value);
            }
        }
    }

    $(".custom-qtd-input .qtd-more").on("click", function (event) {
        event.preventDefault();
        quantityButtons($(this), 1);
    });

    $(".custom-qtd-input .qtd-less").on("click", function (event) {
        event.preventDefault();
        quantityButtons($(this), -1);
    });

    // == ACTIVE TAB - CENTER MOBILE == 
    var tabChildren = 0,
        menu = $(".menu-dark-pills"),
        linkActive = $('.menu-dark-pills a.active');

    menu.children().each(function () {
        tabChildren = tabChildren + $(this).width();
    });

    if (tabChildren > $(window).width() - 30) {

        var myScrollPos = linkActive.offset().left + linkActive.outerWidth(true) / 2 + menu.scrollLeft() - menu.width() / 2;
        menu.scrollLeft(myScrollPos).show();

    };

    // == COUNTDOWN ==
    $('[data-countdown]').each(function (index) {
        $(this).attr('id', 'countdown-' + (index + 1));
        var date = $(this).data('countdown'),
            thisId = $(this).attr("id");

        // Set the date we're counting down to
        var countDownDate = new Date(date).getTime();

        // Update the count down every 1 second
        var x = setInterval(function () {

            // Get today's date and time
            var now = new Date().getTime();

            // Find the distance between now and the count down date
            var distance = countDownDate - now;

            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            hours = hours < 10 ? '0' + hours : hours;
            minutes = minutes < 10 ? '0' + minutes : minutes;
            seconds = seconds < 10 ? '0' + seconds : seconds;

            // Output the result in an element with id="demo"
            document.getElementById(thisId).innerHTML = days + "days " + hours + ":"
                + minutes + ":" + seconds;

            // If the count down is over, write some text 
            if (distance < 0) {
                clearInterval(x);
                document.getElementById(thisId).parentElement.classList.add("countdown-expired");
                document.getElementById(thisId).innerHTML = "EXPIRED";
            }
        }, 1000);

    });

    // == PROD DETAIL ==
    // options
    $(".prod-detail-steps-wrapper .step-options > .block, .prod-detail-steps-wrapper .step-options > .date-block").on("click", function () {
        $(this).addClass("active");
        $(this).siblings().removeClass("active");
    });
    $(".prod-detail-steps-wrapper .step-content .grid-price-options>a").on("click", function () {
        $(this).addClass("active");
        $(this).siblings().removeClass("active");

        if ($(this).is("#grid-with-tva")) {
            $(this).parents(".step-content").addClass("prices-with-tva");
        } else {
            $(this).parents(".step-content").removeClass("prices-with-tva");
        };

    });
    //mobile summary
    if ($(".prod-detail-summary").length > 0 && $(window).width() < 768) {

        var bottom = $(".prod-detail-summary").outerHeight();
        $(".btn-footer-chat").css("bottom", bottom);

        $(".prod-detail-summary > .title").on("click", function () {
            $(this).toggleClass("active").siblings(".content").toggleClass("open");
        });

    };
    // sliders
    $('.prod-detail-img-wrapper').slick({
        mobileFirst: true,
        dots: true,
        arrows: false,
        responsive: [
            {
                breakpoint: 992,
                settings: {
                    dots: false,
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    fade: true,
                    asNavFor: '.prod-detail-thumbs-wrapper'
                }
            }
        ]
    });

    $('.prod-detail-thumbs-wrapper').slick({
        mobileFirst: true,
        slidesToShow: 5,
        slidesToScroll: 5,
        arrows: true,
        prevArrow: '<button type="button" class="slick-prev"><i class="fa fa-angle-left"></i></button>',
        nextArrow: '<button type="button" class="slick-next"><i class="fa fa-angle-right"></i></button>',
        responsive: [
            {
                breakpoint: 992,
                settings: {
                    slidesToScroll: 1,
                    centerMode: true,
                    asNavFor: '.prod-detail-img-wrapper',
                    focusOnSelect: true
                }
            }
        ]
    });
    
    
    

});






$('body').on('hidden.bs.modal', function () {
    if($('.modal.in').length > 0)
    {
        $('body').addClass('modal-open');
    }
});

function removeFromCart(productId){

var url = '/removefromcart';

$.ajax({
    url: url,
    type: 'post',
    data: {
        "_token": $('meta[name="_token"]').attr('content'),
        "product_id": productId
    },
    dataType: 'JSON',
    success: function(data) {
       location.reload();           
    }
});
}




  function deliveryTimePrice(productId, deliveryTimeId){
    var url = '/deliverytimeprice';
    $.ajax({
        url: url,
        type: 'post',
        data: {
            "_token": $('meta[name="_token"]').attr('content'),
            "product_id": productId,
            "delivery_time_id": deliveryTimeId
        },
        dataType: 'JSON',
        success: function(data) {
             var span_data = data ;
             $("#deliveryprice_"+productId).text(span_data);


             var product_price = $("#price_product_"+productId).text();
             var product_qty = $("#qty_product_"+productId).text();

             var total_p = parseFloat(product_price) * parseInt(product_qty);

             $("#shipping_price_"+productId).text(data.toFixed(2));

             var total_price = parseFloat(total_p) + parseFloat(data);
             $("#total_"+productId).text(total_price.toFixed(2));


              var sum = 0;
              $('.product-subtotal').each(function(){

                  sum += parseFloat($(this).text());
              });

              $("#grand_total").text(" $" + sum.toFixed(2));
        }
    });
  }







