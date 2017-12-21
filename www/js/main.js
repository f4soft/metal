;$(document).ready(function(){
    if($('#siteLang').length) {
        var lang = '/' + $('#siteLang').val();
    } else {
        var lang = '';
    }
    // var lang = '';


    jQuery(function ($) {
        $(".callback-form #phone").mask("(999)999-99-99");
        $("#footer-feedback-form #contactform-phone").mask("(999)999-99-99");
        $("#reg-form #phone").mask("(999)999-99-99");
        $(".resume-form [name*='phone']").mask("(999)999-99-99");
    });

    servicesTabClassChange();

    $('.popular-product-carousel').slick({
        dots: false,
        infinite: true,
        speed: 300,
        slidesToShow: 6,
        slidesToScroll: 1,
        responsive: [
            {
              breakpoint: 1200,
              settings: {
                slidesToShow: 4,
              }
            },
            {
              breakpoint: 768,
              settings: {
                slidesToShow: 2,
              }
            },
            {
              breakpoint: 414,
              settings: {
                slidesToShow: 1,
              }
            }
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
          ]
    });
    
    $('.special-offer-carousel').slick({
        dots: false,
        infinite: true,
        speed: 300,
        slidesToShow: 6,
        slidesToScroll: 1,
        responsive: [
            {
              breakpoint: 1200,
              settings: {
                slidesToShow: 4,
              }
            },
            {
              breakpoint: 768,
              settings: {
                slidesToShow: 2,
              }
            },
            {
              breakpoint: 414,
              settings: {
                slidesToShow: 1,
              }
            }
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
          ]
    });
    
    $('.related-product-carousel').slick({
        dots: false,
        infinite: true,
        speed: 300,
        slidesToShow: 5,
        slidesToScroll: 1,
        responsive: [
             {
              breakpoint: 991,
              settings: {
                slidesToShow: 4,
              }
            },
            {
              breakpoint: 768,
              settings: {
                slidesToShow: 1,
              }
            }
        ]
    });

    $('.our-history-carousel').slick({
        dots: true,
        infinite: true,
        speed: 300,
        slidesToShow: 2,
        slidesToScroll: 1,
        swipe: false,
        customPaging: function(slider,i){
            var year = $(slider.$slides[i]).attr('year');
            return '<span> '+year+' </span>';
        },
        responsive: [
            {
              breakpoint: 768,
              settings: {
                slidesToShow: 1,
              }
            }
        ]
    });

    $('.our-employee-carousel').slick({
        dots: false,
        infinite: true,
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 1
    });

    // $('.interactive-map .city-sticker').on('click', function(e){
    //     e.preventDefault();
    //     $('.interactive-map .city-item').removeClass('visible');
    //     $(this).parent().addClass('visible');
    // });

    $(document).mouseup(function (e) {
        var container = $(".interactive-map .city-sticker");

        if (!container.is(e.target) // if the target of the click isn't the container...
            && container.has(e.target).length === 0) // ... nor a descendant of the container
        {
            $('.interactive-map .city-item').removeClass('visible');
        }
    });

    // show more seo text
    $('.seo-content .show-more').on('click', function(e){
        e.preventDefault();
        $(this).parent().addClass('full-description');
    });

    // file uploader input cusom styles
    (function() {

        'use strict';

        $('.input-file').each(function() {
            var $input = $(this),
                $label = $input.next('.js-labelFile'),
                labelVal = $label.html();

            $input.on('change', function(element) {
                var fileName = '';
                if (element.target.value) fileName = element.target.value.split('\\').pop();
                fileName ? $label.addClass('has-file').find('.js-fileName').html(fileName) : $label.removeClass('has-file').html(labelVal);
            });
        });

    })();

    function servicesTabClassChange() {
        $('.our-services-tabs-block .service-item').on('click', function(e){
            $('.our-services-tabs-block .service-item').removeClass('active');
            $(this).addClass('active');
        });
    };

    $('.customer-type > a').on('click', function(e){
        e.preventDefault();
        console.log('clicked on link');
        $('.customer-type').removeClass('active').addClass('non-active');
        $(this).parent().removeClass('non-active').addClass('active')
    });

    $('.our-values-block .value-item a').on('click', function (e) {
        e.preventDefault();
    });

    $(".vacancy-block-header form select").select2({
        dropdownParent: $('.vacancy-block-header form .select-wrapper')
    });

    $(".order-checkout-block .form select ").select2();
    $(".main-description .feedback-form .select-wrapper select ").select2({
        placeholder: {
            id: '-1', // the value of the option
            text: 'Select an option'
        }
    });
    $(".extra-top-navbar .select.choose-city").select2({
        dropdownParent: $('.extra-top-navbar .city-wrapper')
    });
    $(".extra-top-navbar .select.choose-lang").select2({
        dropdownParent: $('.extra-top-navbar .lang-wrapper')
    });


    (function(){
        $('.order-checkout-block .form select').on('change', function(){
            var target = $('.order-checkout-block .order-forms-col .form-inner.yur-fiz-form .label');
            if ($(this).val() === 'fiz' ) {
                $('.order-checkout-block .order-forms-col .form-inner.yur-fiz-form .label.fiz-fileds').removeClass('hidden').addClass('visible');
                $('.order-checkout-block .order-forms-col .form-inner.yur-fiz-form .label.yur-fileds').removeClass('visible').addClass('hidden');
            }
            else if ($(this).val() === 'yur' ) {
                $('.order-checkout-block .order-forms-col .form-inner.yur-fiz-form .label.yur-fileds').removeClass('hidden').addClass('visible');
                $('.order-checkout-block .order-forms-col .form-inner.yur-fiz-form .label.fiz-fileds').removeClass('visible').addClass('hidden');
            }
        })
    })();

    $('.departments-select').on('change', function (e) {
        e.preventDefault();
        $('#offices-form').hide();
        $('.current-department-item').hide();
        if($(this).find(':selected').val() != 0) {
            $('.di-' + $(this).val()).toggle();
            var email = $('.di-' + $(this).val() + " .email > span > span").text();
            $('#officescontactform-email_to').val(email);
            $('#offices-form').show();
        }
    });

    if(location.pathname.indexOf('services') !== -1 && location.hash !== ''){
        $('.our-services-tabs-block .service-item').removeClass('active');
        $(".service-item.item" + location.hash.substr(-1)).addClass('active');
    }


    $('.add-to-cart').on('click', function (e) {
        e.preventDefault();
        var selector = $(this).data('selector'),
            form;
        if (selector) {
            form = $('#' + selector);
        } else {
            form = $('.add-to-cart-form');
        }
        var count = parseInt(form.find('input[name*="count"]').val());
        if (!(isNaN(count))&&(count>0)) {
            $.ajax({
                url: form.attr('action'),
                type: 'post',
                data: form.serialize(),
                success: function (response) {
                    if (response.success) {
                        $('#success-order').modal('toggle');
                        $(".cart-count").html(response.count);
                        $(".cart-word").html(response.word);
                    }
                }
            });
        }
    });

    $(".h-cart").on('click', function (e) {
        e.preventDefault();
        if ($(".cart-count").html() > 0) {
            $.ajax({
                url: lang + '/cart/get-cart-html',
                type: 'post',
                data: {},
                success: function (response) {
                    if (response.success) {
                        $('#cart-popup .modal-content').html(response.html);
                        $('#cart-popup').modal('toggle');
                        $('#cart-popup .table-calc tr.product-row').each(function () {
                            var quantity =  $(this).find('.count').val();
                            checkUnit(this, quantity);
                        });                       
                        
                        setTimeout(function(){ 

                            $('.recommend-carousel').slick({
                                dots: false,
                                infinite: true,
                                speed: 300,
                                slidesToShow: 6,
                                slidesToScroll: 1,
                                responsive: [
                                    {
                                      breakpoint: 1200,
                                      settings: {
                                        slidesToShow: 4,
                                      }
                                    },
                                    {
                                      breakpoint: 768,
                                      settings: {
                                        slidesToShow: 2,
                                      }
                                    },
                                    {
                                      breakpoint: 414,
                                      settings: {
                                        slidesToShow: 1,
                                      }
                                    }
                                    // You can unslick at a given breakpoint now by adding:
                                    // settings: "unslick"
                                    // instead of a settings object
                                  ]
                            });

                        }, 300);                        
                    }
                }
            });
        }
    })
    
    function updateCartTotal() {
        var $cartTr = $('#cart-popup .modal-content tr.product-row'),
            $cartTotal = $('#cart-popup .modal-content tr.summary-row .price-summary'),
            total = 0;
        $cartTr.each(function () {
            total += parseFloat($(this).find('.price').html());
        });
        $cartTotal.html(total.toFixed(2));
    }

    $("#cart-popup").on('click', 'a.remove-from-cart', function (e) {
        e.preventDefault();
        $.ajax({
            url: lang + '/cart/delete-from-cart',
            type: 'post',
            data: {
                'delete_id': $(this).data('id')
            },
            success: function (response) {
                if (response.success) {
                    $(".cart-count").html(response.count);
                    $('#cart-popup .modal-content').html(response.html);
                    if (response.count == 0) {
                        $('#cart-popup').modal('toggle');
                    }

                    setTimeout(function(){ 

                        $('.recommend-carousel').slick({
                            dots: false,
                            infinite: true,
                            speed: 300,
                            slidesToShow: 6,
                            slidesToScroll: 1,
                            responsive: [
                                {
                                  breakpoint: 1200,
                                  settings: {
                                    slidesToShow: 4,
                                  }
                                },
                                {
                                  breakpoint: 768,
                                  settings: {
                                    slidesToShow: 2,
                                  }
                                },
                                {
                                  breakpoint: 414,
                                  settings: {
                                    slidesToShow: 1,
                                  }
                                }
                                // You can unslick at a given breakpoint now by adding:
                                // settings: "unslick"
                                // instead of a settings object
                              ]
                        });

                        }, 300); 
                }
            }
        });
    })

    $(".registration-btn").on('click', function (e) {
        e.preventDefault();
        $('.order-checkout-block .form select').val($(this).data('type')).change();
        $(".registration-btn").fadeToggle(400, 'swing', function () {
            $("#reg-form").show({'duration':400, 'easing': 'swing'});
        });
    })

    $(".order-confirm").on('click', function (e) {
        e.preventDefault();
        //remove all errors if any
        $('.order-checkout-block .form span.form-error').remove();

        var user_type = $('.order-checkout-block .form .select-type-user').val(),
            data = {'type': user_type};
        //find all necessary values       
        $('.order-checkout-block .form .'+ user_type).each(function (i,el) {
            var $el = $(el),
                name = $el.attr('name');
            if (name != 'subscribe'){
                data[name] = $el.val();
            } else {
                if ($el.is(':checked')) {
                    data[name] = 'on';
                }
            }
        });       
        $.ajax({
            url: lang + '/checkout/order',
            type: 'post',
            data: data,
            success: function (response) {
                if (response.success) {
                    $('#success-checkout').modal('toggle');
                    setTimeout(function () {
                        window.location.replace('/');
                    }, 2000);
                } else {
                    for (var input in response.errors) {
                        var $e = $("#reg-form #" + input),
                            span = '<span class="form-error" style="color: red">' + response.errors[input][0] + '</span>';
                        $e.after(span);
                    }
                }
            }
        });
    })

    $("#oldUser #login-btn").on('click', function (e) {
        e.preventDefault();
        //remove all errors if any
        $('#log-form span.form-error').remove();
        $.ajax({
            url: lang + '/checkout/order',
            type: 'post',
            data: $(this).parent('form').serialize(),
            success: function (response) {
                if (response.success) {
                    $('#success-checkout').modal('toggle');
                    setTimeout(function () {
                        window.location.replace('/');
                    }, 2000);
                } else {
                    for (var input in response.errors) {
                        var $e = $("#log-form #" + input),
                            span = '<span class="form-error" style="color: red">' + response.errors[input][0] + '</span>';
                        $e.after(span);
                    }
                }
            }
        });
    })

    //stop propogation click event on callback dropdown content
    $('.callback-form-block').on('click', function (e) {
        e.stopPropagation();
    });

    $('#header-contact-form .submit').on('click', function (e) {
        e.preventDefault();
        e.stopPropagation();
        //remove all errors if any
        // $('#header-contact-form p.form-error').remove();
        var form = $(this).parent('form');
        if (form.find('.has-error').length) {
            return false;
        }
        $.ajax({
            url: lang+'/site/callback',
            type: 'post',
            data: form.serialize(),
            success: function (response) {
                if (response.success) {
                    $('.call-us-btn').click();
                    $('#success-offices').modal('toggle');
                    form.find("input[type=text], textarea").val("");
                }
                else {
                    for (var input in response.errors) {
                        var $e = $("#header-contact-form #callbackform-" + input),
                            p = '<p class="form-error" style="color: red">' + response.errors[input][0] + '</p>';
                        if(!$("#header-contact-form #callbackform-" + input + " + p.form-error").length) {
                            $e.after(p);
                        }
                    }
                }
            }
        });
        return false;
    });

    //polls form
    $('.oprosnik-block .oprosnik-form button').on('click', function (e) {
        e.preventDefault();
        e.stopPropagation();
        $('.oprosnik-block .oprosnik-form p.form-error').remove();
        var email = $('.oprosnik-block .oprosnik-form #email');
        if (!email.val()) {
            email.after(
                '<p class="form-error" style="color: red;clear: both;">Это поле обязятельно</p>'
            );
        } else {
            $.ajax({
                url: lang + '/about/pool-answers',
                type: 'post',
                data: $(this).parent('form').serialize(),
                success: function (response) {
                    if (response.success) {
                        $('.oprosnik-block .oprosnik-content').html(response.html);
                    } else {
                        email.after(
                            '<p class="form-error" style="color: red;clear: both;">' +
                            response.error + '</p>'
                        );
                    }
                }
            });
        }
    });

    function isFunction(name) {
        return typeof window[name] == "function";
    }
    /**
     *
     * @param t - цена в тоннах
     * @param coefficient
     * @param quantity
     * @returns {number}
     */
    function oneSizeFromTtoM(coefficient, quantity) {
        return parseFloat(((quantity*1000)/coefficient)).toFixed(2);
    }

    function oneSizeFromTtoSht(coefficient, length, quantity) {
        return parseFloat((quantity*1000)/(coefficient*length)).toFixed(2);
    }

    function oneSizeFromKgtoM(kg, coefficient, length, quantity) {
        return parseFloat(((kg/coefficient) * quantity), 2);
    }

    function oneSizeFromKGtoSht(kg, coefficient, length, quantity) {
        return (kg/(coefficient*length)) * quantity;
    }
    
    function checkUnit(obj, quantity) {
        var opt = $(obj).find('.unit option:selected'),
            weight = 0;
        quantity = parseInt(quantity);
        /*Cart form*/
        var form = $(obj).find('form');
        /*форма на карточке товара*/
        form = form.length ? form : $(obj).parents('form.add-to-cart-form');
        if (opt.length) {
            var select = $(obj).find('.unit'),
                units = select.data('units').split(','),
                base = select.data('unit'),
                price = opt.data('price'),
                coef = opt.data('coefficient'),
                lenght = opt.data('length'),
                width = opt.data('width'),
                baseCoef = opt.data('base'),
                curentUnit = opt.data('unit'),
                twoDim = ((typeof(width) != "undefined") && (width != 0));
            // var baseQty = curentUnit != base ? quantity * baseCoef : quantity;
            if (units && units.length) {
                for (var i = 0, l = units.length; i < l; i++) {
                    var unitClass = '',
                        unitQty = quantity;
                    if (curentUnit != units[i]) {
                        /*Найти коеффициент для текущего юнита*/
                        var curCoef = select.find('option[value="' + units[i] + '"]').data('base');
                        if (base != curentUnit) {
                            /*высчитать кол-во через базовое значение*/
                            unitQty = ((quantity / baseCoef) * curCoef);
                        } else {
                            unitQty = (quantity*curCoef);
                        }
                    }
                    if (units[i] == 't' ) {
                        weight = unitQty;
                        unitClass = '.kg';
                        unitQty = (unitQty*1000);
                    } else {
                        unitClass = '.'+ units[i];
                        if (units[i] == 'kg'){
                            weight = unitQty/1000;
                        }
                    }
                    $(obj).find('td' + unitClass).text(unitQty.toFixed(2));
                }
            }
        } else {
        //    ничего не пересчитываем если это не тонны
        //    только обновляем нужную колонку
            var span = $(obj).find('td span.unit'),
                curentUnit = span.data('unit'),
                price = parseFloat(span.data('price'));
           if (curentUnit == 't') {
               weight = unitQty;
               $(obj).find('td.kg').text(quantity * 1000);
           }
           if (curentUnit == 'kg') {
               weight = unitQty/1000;
           }
           $(obj).find('td.'+curentUnit).text(quantity);
        }

        var total = (price * quantity).toFixed(2);
        /*Update price, units and amounts*/
        $(obj).find('td.price').text(total);
        form.find('[name="CartProducts[price]"]').val(total);
        form.find('[name="CartProducts[count]"]').val(quantity);
        form.find('[name="CartProducts[unit]"]').val(curentUnit);
        if (weight) {
            form.find('[name="CartProducts[weight]"]').val(weight);
        }
    }
    function recalcQty(opt,base,to, qty, twoDim) {
        var res = 0,
            width = opt.data('width'),
            length = opt.data('length'),
            coef = opt.data('coefficient');
        if (twoDim) {
            switch (base) {
                case 't':
                    switch (to) {
                        case 'm2':
                            res = (qty * width * length) / (coef * 1000);
                            break;
                        case 'list':
                            res = qty / (coef * 1000);
                            break;
                        case 'kg':
                            res = qty*1000;
                            break;
                    }
                     break;
                case 'kg':
                    switch (to) {
                        case 'm2':
                            res = (qty * width * length * $coef);
                            break;
                        case 'list':
                            res = qty / coef;
                            break;
                    }
                    break;
            }
        } else {
            switch (base) {
                case 't':
                    switch (to) {
                        case 'm':
                            res = qty * 1000 / coef;
                            break;
                        case 'sht':
                            res = qty / (coef * 1000);
                            break;
                        case 'kg':
                            res = qty * 1000;
                            break;
                    }
                    break;
                case 'kg':
                    switch (to) {
                        case 'm':
                            res = qty / coef;
                            break;
                        case 'sht':
                            res = qty / (coef * 1000);
                            break;
                    }
                    break;
                case 'm':
                    switch (to) {
                        case 'sht':
                            res = qty / (coef * length);
                            break;
                        case 'kg':
                            res = qty * coef;
                            break;
                    }
                    break;
            }
        }
         return res.toFixed(4);
    }

    function calc(quantity) {
        $('.table-calc tr.product-row').each(function () {
            quantity = typeof quantity !== 'undefined' ? quantity : $(this).find('.count').val();
            checkUnit(this, quantity);
        })
    }
    calc();

    $('td .count').bind('input', function () {
        var val = $(this).val(),
            quantity = parseInt(val),
            that = $(this).parents('tr');
        if(quantity == '' || isNaN(quantity) ) {
            $(this).val('');
            checkUnit(that, 0);
            return false;
        }
        if (val != quantity) {
            $(this).val(quantity);
        }
        if (quantity<0) {
            quantity = Math.abs(quantity);
            $(this).val(quantity);
        }
        checkUnit(that, quantity);
    });

    $('td .unit').on('change', function () {
        var tr = $(this).parents().closest('tr.product-row'),
            quantity = tr.find('.count').val();
        checkUnit(tr, quantity);
    });

    $('#cart-popup .modal-content').on('input', 'td .count', {}, function () {
        var val = $(this).val(),
            quantity = parseInt(val),
            that = $(this).parents('tr');
        if (quantity == '' || isNaN(quantity)) {
            $(this).val('');
            checkUnit(that, 0);
            return false;
        }
        if (val != quantity) {
            $(this).val(quantity);
        }
        if (quantity < 0) {
            quantity = Math.abs(quantity);
            $(this).val(quantity);
        }
        checkUnit(that, quantity);
        updateCartTotal();
        updateCartServer(that);
    });

    $('#cart-popup .modal-content').on('change', '.summary-row input[type="checkbox"]', {}, function () {
        var input = $(this);
        updateCartOptions(input);
    });

    $('.order-table input[type="checkbox"]').on('change', function () {
        var input = $(this);
        updateCartOptions(input);
    });

    function updateCartOptions (input) {
        var data = {
                name: input.attr('name'),
                check: input.is(':checked')
            };
        $.ajax({
            url: lang + '/cart/update-cart-options',
            type: 'post',
            data: data
        });
    }

    $('#cart-popup .modal-content').on('change', 'td .unit', {}, function () {
        var tr = $(this).parents().closest('tr.product-row'),
            quantity = tr.find('.count').val();
        checkUnit(tr, quantity);
        updateCartTotal();
        updateCartServer(tr);
    });

    function updateCartServer($obj) {
        var data = {
                'id': $obj.find('a.remove-from-cart').data('id'),
                'count': $obj.find('input.count').val(),
                'unit': $obj.find('.unit option:selected').data('unit'),
                'price': $obj.find('td.price').html(),
                'weight' : parseFloat($obj.find('td.kg').html())/1000
            };
        $.ajax({
            url: lang + '/cart/update-cart',
            type: 'post',
            data: data
        });
    }

    if($('.table-calc tr').hasClass('hidden')) {         
        var rowHidden = $('.table-calc tr.hidden').size();
        $('.show-more-items span').text('('+rowHidden+')');
        $('.show-more-items').show();        
    } else{
        $('.show-more-items').hide();               
    }

    $('.show-more-items').on('click', function (e) {
        e.preventDefault();
        $('.table-calc tr.hidden').each(function (index, value) {
            $(value).removeClass('hidden');
        });
        if(!$('.table-calc tr').hasClass('hidden')) {
            $('.show-more-items span').text('');
            $('.show-more-items').hide();
            $('.select-show-row').val(5000);
        }
    });
    
    var lastScrollTop = 300;    
    $(window).scroll(function(event){
        var st = $(this).scrollTop();
        if (st > lastScrollTop){
            $('.arrow-page-up').show('400');
            lastScrollTop = st; 
        } else if(st < 300) {
            $('.arrow-page-up').hide('400');
            lastScrollTop = 300;
        }        
    });   
    
    $('.arrow-page-up').on('click', function (e) {
        $('html, body').animate({
            scrollTop: $(".extra-top-navbar").offset().top
        }, 400);
    });
 
    if(window.location.hash.includes('service')) {
        var hash = window.location.hash;
        var selector = "a[href='" + hash + "']";
        $(selector).click();
        window.location.hash = hash;
    };
    if ( $(window).width() < 1200 )  {
        $('.header-block .navbar-main-block .navbar-nav li.dropdown > a').on('click', function(e){
            e.preventDefault();
            $(this).toggleClass('active');
        });
    };

    $('.our-services-tabs-wrapper .wrapper-mask').on('init', function(event, slick ){
        currentHash = window.location.hash;
        currentSlideIndex = $(this).find('a[href="' + currentHash + '"]').parent().attr('data-slick-index');
        if ( $(window).width() <= 767 )  {
            slick.slickGoTo(currentSlideIndex);
        }
    })

    $('.our-services-tabs-wrapper .wrapper-mask').slick({
        dots: false,
        infinite: true,
        slide: '.service-item',
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 0,
        swipe: false,
        responsive: [
            {
              breakpoint: 768,
              settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                swipe: false,
                infinite: false
              }
            }
        ]
    });

    $('.our-services-tabs-wrapper .wrapper-mask').on('afterChange', function(slick, currentSlide){
        $('.our-services-tabs-wrapper .wrapper-mask .service-item').removeClass('active');
        $('.our-services-tabs-wrapper .wrapper-mask .service-item.slick-current').addClass('active');
        setTimeout( function(){
            $('.our-services-tabs-wrapper .wrapper-mask .slick-current a').click();
        }, 15);
        // console.log($('.slick-current'));
    });
    $('#reset_link').on('click', function (e) {
        e.preventDefault();
        $('form#log-form p.form-error').remove();
        var $email = $(this).parents('form#log-form').find('input#login');
        var email = $email.val();
        if (!email) {
            var mess = '', suc = '';
            switch ($('#siteLang').val()){
                case 'ua':
                    mess = 'Введіть email';
                    suc = 'Пароль відправлений';
                    break;
                case 'en':
                    mess = 'Enter email';
                    suc = 'Password send';
                    break;
                default:
                    mess = 'Введите email';
                    suc = 'Пароль отправлен';
                    break;
            }
            $email.after(
                '<p class="form-error" style="color: red;clear: both;">' +
                mess + '</p>'
            );
            return false;
        }
        $.ajax({
            url: lang + '/checkout/reset',
            type: 'post',
            data: {'email': email},
            success: function (response) {
                $('form#log-form p.form-error').remove();
                if (response.success) {
                    $email.after(
                        '<p class="form-error" style="color: darkgreen;clear: both;">' +
                        window.suc + '</p>'
                    );
                } else {
                    $email.after(
                        '<p class="form-error" style="color: red;clear: both;">' +
                        response.error + '</p>'
                    );
                }
            }
        });
    });
});