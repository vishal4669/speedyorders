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
            if (!$(this).hasClass(".anchor-menu-title"))
                $(this).text(activePage).append('<i class="fa fa-caret-down"></i>');

            $(this).on("click", function () {
                $(this).toggleClass("open").siblings().slideToggle();
            });
        });

        var magrinTop = $(".main-header").outerHeight();
        if ($(window).width() < 768)
            var magrinTop = $(".main-header").outerHeight() + $(".anchor-menu-title").outerHeight() + 30;
        else
            var magrinTop = $(".main-header").outerHeight() + 30;

        $(".side-menu a[href^='#']").on("click", function (event) {

            var target = $(this.getAttribute("href"));

            if (target.length) {
                event.preventDefault();
                $("html, body").stop().animate({
                    scrollTop: target.offset().top - magrinTop
                }, 1000);
                $(".side-menu a.active").removeClass("active");
                $(this).addClass("active");
            }

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

    // == Side Filters == 
    $(".filter-title").each(function () {
        $(this).on("click", function () {
            $(this).toggleClass("open").siblings().slideToggle();
        });
    });

    $(".filter-list li").children("ul").parent().addClass("has-sub-category");
    $(".has-sub-category>a").on("click", function() {
        $(this).toggleClass("active");
        $(this).siblings("ul").slideToggle();
        return false;
    });

    // range slider
    $( "#slider-range" ).slider({
        range: true, 
        min: 0,
        max: 500,
        values: [ 0, 500 ],
        slide: function( event, ui ) {
          $( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
        }
      });
      $( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) + " - $" + $( "#slider-range" ).slider( "values", 1 ) );


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
