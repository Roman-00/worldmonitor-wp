document.addEventListener('DOMContentLoaded', () => {
    'use strict';

    const contacts = document.querySelector('.contacts');

    // Функция котора отвечает за скрытие и показ поиска
    const searchFunc = () => {
        const headerSearchBox = document.querySelector('.header__search--box'), 
            headerSearchBtn = document.querySelector('.header__search--btn'),
            headerSearchCancel = document.querySelector('.header__search--cancel'),
            headerSearchInput = document.querySelector('.header__search--input'); 

            headerSearchBtn.addEventListener('click', () => {
                headerSearchBox.classList.add('header__search--box-active');
                headerSearchInput.classList.add('header__search--input-active');
                headerSearchBtn.classList.add('header__search--btn-active');
                headerSearchCancel.style.display = 'block';
            });

            headerSearchCancel.addEventListener('click', () => {
                headerSearchBox.classList.remove('header__search--box-active');
                headerSearchInput.classList.remove('header__search--input-active');
                headerSearchBtn.classList.remove('header__search--btn-active');
                headerSearchCancel.style.display = 'none';
            });
    };

    const swiper = new Swiper('.swiper-container', {
        // Optional parameters
        direction: 'horizontal',
        loop: true,
        slidesPerView: 1,
        autoplay: {
            delay: 2500,
            disableOnInteraction: false,
        },
        breakpoints: {
            645: {
                slidesPerView: 2,
            },
            575: {
              slidesPerView: 1,
            },
          }
    });

    const swiperMb = new Swiper('.article--swiper-mb', {
        // Optional parameters
        direction: 'horizontal',
        loop: true,
        slidesPerView: 1,
        autoplay: {
            delay: 2500,
            disableOnInteraction: false,
        }
    });

    const yaMaps = () => {
        if(contacts) {
            // Функция ymaps.ready() будет вызвана, когда
            // загрузятся все компоненты API, а также когда будет готово DOM-дерево.
            ymaps.ready(init);
            function init(){
                // Создание карты.
                var myMap = new ymaps.Map("map", {
                    // Координаты центра карты.
                    // Порядок по умолчанию: «широта, долгота».
                    // Чтобы не определять координаты центра карты вручную,
                    // воспользуйтесь инструментом Определение координат.
                    center: [43.235790, 76.940437],
                    // Уровень масштабирования. Допустимые значения:
                    // от 0 (весь мир) до 19.
                    zoom: 15
                });
            }
        }
    };


    /* Инициализируем все функции скриптов */
    const init = () => {
        searchFunc();
        yaMaps();
    };

    init();


});

$(document).ready(function () {
    $('#cssmenu li.has-sub > a').on('click', function(){
        $(this).removeAttr('href');
        var element = $(this).parent('li');
        if (element.hasClass('open')) {
            element.removeClass('open');
            element.find('li').removeClass('open');
            element.find('ul').slideUp();
        }
        else {
            element.addClass('open');
            element.children('ul').slideDown();
            element.siblings('li').children('ul').slideUp();
            element.siblings('li').removeClass('open');
            element.siblings('li').find('li').removeClass('open');
            element.siblings('li').find('ul').slideUp();
        }
    });
 
    $('#cssmenu>ul>li.has-sub>a').append('<span class="holder"></span>');

    $('.submenu__item--select').on('click', function() {
        $('.submenu__item--select').siblings('.nav__item--submenu-2').slideToggle();
    });
});