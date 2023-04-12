jQuery(document).ready(function() {
    "use strict"; 
    
    
     

    var sync1 = $("#sync1");
    var sync2 = $("#sync2");
    var slidesPerPage = 5; //globaly define number of elements per page
    var syncedSecondary = true;

    sync1.owlCarousel({
        items: 1,
        slideSpeed: 2000,
        nav: true,
        autoplay: false, 
        dots: false,
        loop: true,
                navText:["<div class='arrow arrow_left'></div>","<div class='arrow arrow_right'></div>"], 
     
    }).on('changed.owl.carousel', syncPosition);

    sync2
        .on('initialized.owl.carousel', function() {
            sync2.find(".owl-item").eq(0).addClass("current");
        })
        .owlCarousel({
            items: slidesPerPage,
            dots: false,
            nav: false,
            smartSpeed: 200,
            slideSpeed: 500,
            slideBy: slidesPerPage, //alternatively you can slide by 1, this way the active slide will stick to the first item in the second carousel
            responsiveRefreshRate: 200,
                    responsive:{
        0:{items:3},
        600:{items:3}, 
        800:{items:4},
        1024:{items:4},
        1300:{items:5},
        1310:{items:5}
        },
        }).on('changed.owl.carousel', syncPosition2);

    function syncPosition(el) {
        //if you set loop to false, you have to restore this next line
        //var current = el.item.index;

        //if you disable loop you have to comment this block
        var count = el.item.count - 1;
        var current = Math.round(el.item.index - (el.item.count / 2) - .5);

        if (current < 0) {
            current = count;
        }
        if (current > count) {
            current = 0;
        }

        //end block

        sync2
            .find(".owl-item")
            .removeClass("current")
            .eq(current)
            .addClass("current");
        var onscreen = sync2.find('.owl-item.active').length - 1;
        var start = sync2.find('.owl-item.active').first().index();
        var end = sync2.find('.owl-item.active').last().index();

        if (current > end) {
            sync2.data('owl.carousel').to(current, 100, true);
        }
        if (current < start) {
            sync2.data('owl.carousel').to(current - onscreen, 100, true);
        }
    }

    function syncPosition2(el) {
        if (syncedSecondary) {
            var number = el.item.index;
            sync1.data('owl.carousel').to(number, 100, true);
        }
    }

    sync2.on("click", ".owl-item", function(e) {
        e.preventDefault();
        var number = $(this).index();
        sync1.data('owl.carousel').to(number, 300, true);
    });
 
    
    
    
     var sync3 = $("#sync3");
    var sync4 = $("#sync4");
    var slidesPerPage2 = 5; // define the number of elements per page
    
    sync3.owlCarousel({
      items: 1,
      slideSpeed: 2000,
      nav: true,
      autoplay: false, 
      dots: false,
      loop: true,
      navText:["<div class='arrow arrow_left'></div>","<div class='arrow arrow_right'></div>"]
    }).on('changed.owl.carousel', syncPosition3);
    
    sync4
      .on('initialized.owl.carousel', function() {
        sync4.find(".owl-item").eq(0).addClass("current");
      })
      .owlCarousel({
        items: slidesPerPage2,
        dots: false,
        nav: false,
        smartSpeed: 200,
        slideSpeed: 500,
        slideBy: slidesPerPage2,
        responsiveRefreshRate: 200,
        responsive:{
        0:{items:3},
        600:{items:3}, 
        800:{items:4},
        1024:{items:4},
        1300:{items:5},
        1310:{items:5}
        },
      }).on('changed.owl.carousel', syncPosition4);
    
    function syncPosition3(el) {
      var count = el.item.count - 1;
      var current = Math.round(el.item.index - (el.item.count / 2) - .5);
    
      if (current < 0) {
        current = count;
      }
      if (current > count) {
        current = 0;
      }
    
      sync4
        .find(".owl-item")
        .removeClass("current")
        .eq(current)
        .addClass("current");
      var onscreen = sync4.find('.owl-item.active').length - 1;
      var start = sync4.find('.owl-item.active').first().index();
      var end = sync4.find('.owl-item.active').last().index();
    
      if (current > end) {
        sync4.data('owl.carousel').to(current, 100, true);
      }
      if (current < start) {
        sync4.data('owl.carousel').to(current - onscreen, 100, true);
      }
    }
    
    function syncPosition4(el) {
      if (syncedSecondary) {
        var number = el.item.index;
        sync3.data('owl.carousel').to(number, 100, true);
      }
    }
    
    sync4.on("click", ".owl-item", function(e) {
      e.preventDefault();
      var number = $(this).index();
      sync3.data('owl.carousel').to(number, 300, true);
    });
     
    
    
    
    
    
    
    
const input = document.querySelector("#phone");
if (input) {
  const iti = window.intlTelInput(input, {
    preferredCountries: ["ru", "ua"],
    defaultCountry: "ru",
    utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/js/utils.js",
  }); 
  
  // Обновляем placeholder в соответствии с выбранной страной
  const updatePlaceholder = () => {
    const countryData = iti.getSelectedCountryData();
    const countryCode = countryData.dialCode;
    const countryName = countryData.name;
    input.placeholder = `+${countryCode} (${countryName})`;
  };
  
  // Обновляем placeholder при изменении выбранной страны
  input.addEventListener("countrychange", updatePlaceholder);
  
  // Обновляем placeholder в первый раз при инициализации
  updatePlaceholder();
};
                                                                   
    // popup
    $(document).ready(function() {
        // При клике на кнопку открытия всплывающего окна
        $(".open_popup").click(function() {
            // Показываем затемнение фона и всплывающее окно
            $("body").append('<div class="popup_overlay"></div>');
            $(".open_popup_content").animate({ opacity: 1, top: '50%' }, 100).fadeIn(100);

            // Обработчик клика за пределами всплывающего окна
            $(".popup_overlay").click(function() {
                // Скрываем затемнение фона и всплывающее окно
                $(".open_popup_content").animate({ opacity: 0, top: '45%' }, 100).fadeOut(100, function() {
                    $(".popup_overlay").remove();
                });
            });
        });

        // При клике на кнопку закрытия всплывающего окна
        $(".open_popup_content_close").click(function() {
            // Скрываем затемнение фона и всплывающее окно
            $(".popup_overlay").remove();
            $(".open_popup_content").animate({ opacity: 0, top: '45%' }, 100).fadeOut(100);
        });
    });

    
    //  Back to top
    if (jQuery('#back-to-top').length) {
        var scrollTrigger = 100, // px
            backToTop = function () {
                var scrollTop = jQuery(window).scrollTop();
                if (scrollTop > scrollTrigger) {
                    jQuery('#back-to-top').addClass('show');
                } else {
                    jQuery('#back-to-top').removeClass('show');
                }
            };
        backToTop();
        jQuery(window).on('scroll', function () {
            backToTop(); 
        });
        jQuery('#back-to-top').on('click', function (e) {
            e.preventDefault();
            jQuery('html,body').animate({
                scrollTop: 0
            }, 700);
        });
    } ; 
    
    
     // play video
    $(document).ready(function() {
      $('.play-button').click(function() {
        var video = $('#video-iframe')[0];
        video.src += '?autoplay=1';
        $(this).hide();
        $('.video-placeholder').hide();
        $('.overlay').hide();
        video.contentWindow.postMessage('{"event":"command","func":"' + 'playVideo' + '","args":""}', '*');
      });
    });
    
    //learn_more text
    $(document).ready(function() {
      $(".learn_morebtn_text").click(function(event) {
        event.preventDefault();
        if ($(this).hasClass("close")) {
          $(this).removeClass("close").text("Показать еще");
          $(this).closest(".learn_more_text").prev(".more_text").css("max-height", "337px");
        } else {
          $(this).addClass("close").text("Закрыть");
          $(this).closest(".learn_more_text").prev(".more_text").css("max-height", "none");
        }
      });
    });
    
    
    //learn_morebtn_text_litle text
    $(document).ready(function() {
      $(".learn_morebtn_text_litle").click(function(event) {
        event.preventDefault();
        if ($(this).hasClass("close")) {
          $(this).removeClass("close").text("Показать еще");
          $(this).closest(".learn_more_text_litle").prev(".more_text_litle").css("max-height", "225px");
        } else {
          $(this).addClass("close").text("Закрыть");
          $(this).closest(".learn_more_text_litle").prev(".more_text_litle").css("max-height", "none");
        }
      });
    });
    
    //learn_more block
    $(document).ready(function() {
      // Количество видимых элементов по умолчанию
      var defaultItemsCount = 6;
    
      // Количество элементов, которые будут подгружаться при каждом клике
      var loadMoreCount = 3;
    
      // Находим все блоки object_item
      var items = $('.object_item');
    
      // Скрываем все блоки, кроме первых defaultItemsCount
      items.slice(defaultItemsCount).hide();
    
      // Обработчик клика на кнопку "Показать еще"
      $('.learn_morebtn').on('click', function(e) {
        e.preventDefault();
        
        // Находим скрытые блоки object_item
        var hiddenItems = items.filter(':hidden');
    
        // Если больше нет скрытых блоков, скрываем кнопку "Показать еще"
        if (hiddenItems.length === 0) {
          $('.learn_more').hide();
          return;
        }
    
        // Показываем следующие loadMoreCount скрытых блоков с анимацией
        hiddenItems.slice(0, loadMoreCount).slideDown('slow');
      });
    });
        
        
        
    //learn_more block
    $(document).ready(function() {
      // Количество видимых элементов по умолчанию
      var defaultItemsCount = 12;
    
      // Количество элементов, которые будут подгружаться при каждом клике
      var loadMoreCount = 6;
    
      // Находим все блоки object_item
      var items = $('.object_cat_item');
    
      // Скрываем все блоки, кроме первых defaultItemsCount
      items.slice(defaultItemsCount).hide();
    
      // Обработчик клика на кнопку "Показать еще"
      $('.learn_morebtn').on('click', function(e) {
        e.preventDefault();
         
        // Находим скрытые блоки object_item
        var hiddenItems = items.filter(':hidden');
    
        // Если больше нет скрытых блоков, скрываем кнопку "Показать еще"
        if (hiddenItems.length === 0) {
          $('.learn_more_cat').hide();
          return;
        }
    
        // Показываем следующие loadMoreCount скрытых блоков с анимацией
        hiddenItems.slice(0, loadMoreCount).slideDown('slow');
      });
    });
        
        
    // выпадалка для валюты
    $(document).ready(function () {
      $(".base-currency__btn").click(function () {
        $(".base-currency__dropdown").toggle();
        $(this).toggleClass("btn_active");
      });
    
      $(".base-currency__dropdown-item").click(function () {
        $(".base-currency__dropdown-item").removeClass("active");
        $(this).addClass("active");
        $(".base-currency__btn").text($(this).text());
        $(".base-currency__dropdown").hide();
        $(".base-currency__btn").removeClass("btn_active");
      });
    });
        
     
     
        
     // home dropdown
    $(document).ready(function() {
      $('.dropdown-toggle').each(function() {
        const dropdownToggle = $(this);
        const dropdownMenu = dropdownToggle.siblings('.dropdown-menu');
        const checkboxes = dropdownMenu.find('input[type="checkbox"]');
        const searchInput = dropdownMenu.find('input[type="text"]');
    
        dropdownToggle.on('click', function() {
          $('.dropdown-menu.show').not(dropdownMenu).removeClass('show');
          $('.dropdown-toggle.active').not(dropdownToggle).removeClass('active');
          dropdownMenu.toggleClass('show');
          dropdownToggle.toggleClass('active');
        });
    
        dropdownMenu.on('click', function(event) {
          event.stopPropagation();
        });
    
        $(document).on('click', function(event) {
          if (!$(event.target).closest('.dropdown').length) {
            dropdownMenu.removeClass('show');
            dropdownToggle.removeClass('active');
          }
        });
    
        function updateDropdownToggle() {
          const selectedOptions = [];
        
          checkboxes.each(function() {
            if ($(this).prop('checked')) {
              selectedOptions.push($(this).val());
            }
          });
        
          const dropdownToggleText = dropdownToggle.html();
          const newDropdownToggleText = selectedOptions.length ? selectedOptions.join(', ') : dropdownToggleText;
          dropdownToggle.html(newDropdownToggleText);
        }
    
        checkboxes.on('change', function() {
          updateDropdownToggle();
        });
    
        searchInput.on('input', function() {
          const query = $(this).val().toLowerCase();
    
          checkboxes.parent().filter(function() {
            return $(this).text().toLowerCase().indexOf(query) < 0;
          }).addClass('d-none');
    
          checkboxes.parent().filter(function() {
            return $(this).text().toLowerCase().indexOf(query) >= 0;
          }).removeClass('d-none');
    
          const visibleCheckboxes = checkboxes.filter(':visible');
          if (visibleCheckboxes.length === 0) {
            dropdownMenu.addClass('d-none');
          } else {
            dropdownMenu.removeClass('d-none');
          }
        });
    
        updateDropdownToggle();
      });
    });

    

     // home tabs 
     (function($){               
         $.fn.lightTabs = function(options){
                var createTabs = function(){
                var tabs = this;
                var i = 0;
                var prevIndex = 0;
    
                var showPage = function(i){
                    $(tabs).children("div").children("div").hide();
                    $(tabs).children("div").children("div").eq(i).show();
                    $(tabs).children("ul").children("li").removeClass("tabactive");
                    $(tabs).children("ul").children("li").eq(i).addClass("tabactive");
                    $(tabs).children("ul").children("li").eq(prevIndex).removeClass("prev");
                    $(tabs).children("ul").children("li").eq(i - 1).addClass("prev");
                    prevIndex = i - 1;
                } 
                showPage(0);
                $(tabs).children("ul").children("li").eq(0).addClass("prev");
    
                $(tabs).children("ul").children("li").each(function(index, element){
                    $(element).attr("data-page", i);
                    i++;                        
                });
    
                $(tabs).children("ul").children("li").click(function(){
                    var currentIndex = parseInt($(this).attr("data-page"));
                    showPage(currentIndex);
                });                
            }; 
            return this.each(createTabs);
        };  
    })(jQuery);
    
    $(document).ready(function(){
        $(".tabs").lightTabs();
    });
    
    
      // mobile_short
    jQuery(".mobile_short a.block_button").click(function() {
      jQuery(this).toggleClass("active"); // add or remove the "active" class
      jQuery('.big').toggle("fast");
    });
    
    jQuery(document).on('click', function(e) {
      if (!jQuery(e.target).closest(".mobile_short").length) {
        jQuery('.big').hide();
        jQuery(".mobile_short a.block_button").removeClass("active"); // remove the "active" class
      }
      e.stopPropagation();
    });
    
 
    // mobile_menu_btn  
    jQuery(".mobile_menu_btn").on('click', function(){
        jQuery(this).next(".header_nav").toggle("fast")
    }); 
 
     if (jQuery(window).width()  < 879) {
        jQuery(document).on('click', function(e) { 
          if (!jQuery(e.target).closest(".mobile_menu_btn").length) {
            jQuery('.header_nav').hide();
          } 
          e.stopPropagation();
        })
        } ; 
    
    jQuery(".mobile_menu_btn").on('click', function(){
         jQuery(this).toggleClass('open');
    }); 
    
    jQuery(document).on('click', function(e) { 
      if (!jQuery(e.target).closest(".open").length) {
        jQuery('.open').toggleClass('open');
      } 
      e.stopPropagation();
    });

 
    // text_hide
     var token = 1;
    jQuery(".di-read-more input").on("click", function() {
        var jQuerylink = jQuery(this);
        var jQuerycontent = jQuerylink.parent().prev("div.text_hide");
        jQuerycontent.toggleClass("full-text");
        if(token == 1)
        {jQuery(this).val("Скрыть");token = 0; }
        else
        {jQuery(this).val("Читать подробнее");token = 1;}
        return false;
    }); 
    
    // See All teg
    jQuery(".seeall").on('click', function(){
        jQuery(this).next(".seeall_vn").toggle("fast")
    });
    jQuery(".seeall_close").on('click', function(){
        jQuery(this).parents(".seeall_vn:first").hide("fast")
    });   

    jQuery("#slider").slider({
      min: 0,
      max: 1000,
      values: [0,1000],
      range: true,
      stop: function(event, ui) {
        jQuery("input#minCost").val(jQuery("#slider").slider("values",0));
        jQuery("input#maxCost").val(jQuery("#slider").slider("values",1));
        },
        slide: function(event, ui){
        jQuery("input#minCost").val(jQuery("#slider").slider("values",0));
        jQuery("input#maxCost").val(jQuery("#slider").slider("values",1));
        }
    });

 

   // Load More jQuery   
    jQuery(".more .col_4_di").slice(0, 8).css("display", "block");
    jQuery(".more2 .cat_item").slice(0, 4).css("display", "block");
    
    jQuery("#loadMore").on('click', function (e) {
        e.preventDefault(); 
        jQuery(".more .col_4_di:hidden").slice(0, 8).slideDown();
        
        jQuery(".more2 .cat_item:hidden").slice(0, 4).slideDown();
        
        if (jQuery(".more2 .cat_item").length == 0) {
            jQuery("#load").fadeOut('slow');
        }  
        
        if (jQuery(".cat_item:hidden").length == 0) {
            jQuery("#load").fadeOut('slow');
        }  
    }); 

 
    
    // Убавляем кол-во по клику
        jQuery('.quantity_inner .bt_minus').click(function() {
        let jQueryinput = jQuery(this).parent().find('.quantity');
        let count = parseInt(jQueryinput.val()) - 1;
        count = count < 1 ? 1 : count;
        jQueryinput.val(count);
    });
    // Прибавляем кол-во по клику
    jQuery('.quantity_inner .bt_plus').click(function() {
        let jQueryinput = jQuery(this).parent().find('.quantity');
        let count = parseInt(jQueryinput.val()) + 1;
        count = count > parseInt(jQueryinput.data('max-count')) ? parseInt(jQueryinput.data('max-count')) : count;
        jQueryinput.val(parseInt(count));
    }); 
    // Убираем все лишнее и невозможное при изменении поля
    jQuery('.quantity_inner .quantity').bind("change keyup input click", function() {
        if (this.value.match(/[^0-9]/g)) {
            this.value = this.value.replace(/[^0-9]/g, '');
        }
        if (this.value == "") {
            this.value = 1;
        }
        if (this.value > parseInt(jQuery(this).data('max-count'))) {
            this.value = parseInt(jQuery(this).data('max-count'));
        }    
    });    
        
        
    // Accordeon FAQ - что бы скрыть, добавить вконце после .stop() - .hide();
    jQuery(document).ready(function($){
       jQuery('#accordion-js').find('.heading').click(function($){
           jQuery(this).toggleClass('accord_active').next().stop().slideToggle(); 
       }).next().stop();
    });
   
 
    // Sticky Header 
    function stickyHeader(headerSelector){

        //hide right header menu when sticky header is inited
        var mainHeader = jQuery(headerSelector),
            headerHeight = mainHeader.height();

        //set scrolling variables
        var scrolling = false,
            previousTop = 0,
            currentTop = 0,
            scrollDelta = 10,
            scrollOffset = 60;

        mainHeader.addClass('autohide');

        jQuery(window).on('scroll', function(){
            if( !scrolling ) {
                scrolling = true;
                (!window.requestAnimationFrame)
                    ? setTimeout(autoHideHeader, 250)
                    : requestAnimationFrame(autoHideHeader);
            }
        });

        jQuery(window).on('resize', function(){
            headerHeight = mainHeader.height();
        });

        function autoHideHeader() {
            var currentTop = jQuery(window).scrollTop();

            checkSimpleNavigation(currentTop);
            previousTop = currentTop;
            scrolling = false;

            // add class when pass offset
            if (jQuery(window).scrollTop() > scrollOffset) {
                mainHeader.addClass('fixed');
            } else {
                mainHeader.removeClass('fixed');
            }
        }

        function checkSimpleNavigation(currentTop) {
            //there's no secondary nav or secondary nav is below primary nav
            if (previousTop - currentTop > scrollDelta) {
                //if scrolling up...
                mainHeader.removeClass('is-hidden');
            } else if( currentTop - previousTop > scrollDelta && currentTop > scrollOffset) {
                //if scrolling down...
                mainHeader.addClass('is-hidden');
            }
        }
    }
    if (jQuery(window).width() > 991) {stickyHeader('#site-header.sticky');} 


    //  Back to top
    if (jQuery('#back-to-top').length) {
        var scrollTrigger = 100, // px
            backToTop = function () {
                var scrollTop = jQuery(window).scrollTop();
                if (scrollTop > scrollTrigger) {
                    jQuery('#back-to-top').addClass('show');
                } else {
                    jQuery('#back-to-top').removeClass('show');
                }
            };
        backToTop();
        jQuery(window).on('scroll', function () {
            backToTop(); 
        });
        jQuery('#back-to-top').on('click', function (e) {
            e.preventDefault();
            jQuery('html,body').animate({
                scrollTop: 0
            }, 700);
        });
    }
     

    // sidebar
    jQuery(".sidebar_btn").on('click', function(){
        jQuery(this).toggleClass("close_minus")
    }); 
    
    jQuery(".sidebar_btn").on('click', function(){
        jQuery(this).next(".sidebar").toggle("fast")
    });
    
    jQuery(".open_popup_content_close").on('click', function(){
        jQuery(this).parents(".sidebar:first").hide("fast")
    });

    
    // top list
    jQuery('.owl_top_list').owlCarousel({
        loop:true, 
        autoWidth:false,
        // stagePadding: 100,                
        margin:20,
        dots:false,
        navText:["<div class='arrow arrow_left'></div>","<div class='arrow arrow_right'></div>"], 
        navContainer: '.owl_top_list_navigation',  
        nav:true,
        startPosition:1,
        responsiveRefreshRate:1000,
        responsive:{
        0:{items:1, margin:5},
        600:{items:1,margin:5}, 
        800:{items:2, margin:20},
        1024:{items:3},
        1300:{items:4},
        1310:{items:4}
        }
    });  
 
    
    // list_view_2
    jQuery('.list_view_2').owlCarousel({
        loop:true, 
        autoWidth:false,
        // stagePadding: 100,                
        margin:20,
        string: 'item',  
        dots:false,
        navText:["<div class='arrow arrow_left'></div>","<div class='arrow arrow_right'></div>"], 
        navContainer: '.owl_nav_2',  
        nav:true, 
        startPosition:1,
        responsiveRefreshRate:1000,
        responsive:{
        0:{items:1, margin:5},
        600:{items:1,margin:5}, 
        800:{items:2, margin:20},
        1024:{items:3},
        1300:{items:3},
        1310:{items:3}
        }
    });

 
    
    // list_view
    jQuery('.list_view').owlCarousel({
        loop:true, 
        autoWidth:false,
        // stagePadding: 100,                
        margin:20,
        string: 'item',  
        dots:false,
        navText:["<div class='arrow arrow_left'></div>","<div class='arrow arrow_right'></div>"], 
        navContainer: '.owl_nav_1',  
        nav:true, 
        startPosition:1,
        responsiveRefreshRate:1000,
        responsive:{
        0:{items:1, margin:5},
        600:{items:1,margin:5}, 
        800:{items:2, margin:20},
        1024:{items:3},
        1300:{items:3},
        1310:{items:3}
        }
    });

 
     // arhi_carousel
    jQuery('#arhi_carousel').owlCarousel({
        loop:true, 
        items:1,
        autoWidth:false,
        // stagePadding: 100,                
        margin:20,
        string: 'item',  
        dots:true,
        navText:["<div class='arrow arrow_left'></div>","<div class='arrow arrow_right'></div>"],  
        nav:true, 
        startPosition:1,
        responsiveRefreshRate:1000
    });


    // list_view_3
    jQuery('.list_view_3').owlCarousel({
        loop:true, 
        autoWidth:false,
        // stagePadding: 100,                
        margin:20,
        string: 'item',  
        dots:false,
        navText:["<div class='arrow arrow_left'></div>","<div class='arrow arrow_right'></div>"], 
        navContainer: '.owl_nav_3',  
        nav:true, 
        startPosition:1,
        responsiveRefreshRate:1000,
        responsive:{
        0:{items:1, margin:5},
        600:{items:2,margin:10}, 
        800:{items:3, margin:20},
        1024:{items:4},
        1300:{items:4},
        1310:{items:4}
        }
    });
 
 
 
 
 
});