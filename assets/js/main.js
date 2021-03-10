document.addEventListener('DOMContentLoaded', () => {
    'use strict';

    const contacts = document.querySelector('.contacts');
    // Раскрытие search box

    const searchBtn = document.querySelector('.search-btn');
    const cancelBtn = document.querySelector('.cancel-btn');
    const searchBox = document.querySelector('.search-box');
    const searchInput = document.querySelector('.search-box input');
    const searchBtnBtn = document.querySelector('.search-btn-btn');


    searchBtnBtn.addEventListener('click', () => {
        searchInput.style.display = 'block';
        searchBtn.style.display = 'flex';
        searchBtnBtn.style.display = 'none';
        cancelBtn.style.display = 'block';
        searchBox.classList.add('active-box');
        searchInput.classList.add('active-s-i');
        searchBtn.classList.add('active-s-b');
    });
    cancelBtn.addEventListener('click', () => {
        searchBox.classList.remove('active-box');
        searchInput.classList.remove('active-s-i');
        searchBtn.classList.remove('active-s-b');
        searchBtnBtn.style.display = 'block';
        searchInput.style.display = 'none';
        searchBtn.style.display = 'none';
        cancelBtn.style.display = 'none';
        searchInput.value = '';
    });

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

    const modalShow = () => {
        const home = document.querySelector('.home');
        const showModal = document.querySelector('.modal_show');
        const modalShowNo = document.querySelector('.modal_show-no');

        showModal.style.opacity = '0';
        showModal.classList.add('animated');
        if(home) {
            setTimeout(() => {
                showModal.style.opacity = '1';
                showModal.classList.add('fadeInDown');
            }, 5000);
        } else {
            showModal.classList.remove('fadeInDown');
        }

        modalShowNo.addEventListener('click', () => {
            showModal.style.opacity = '0';
            showModal.classList.remove('fadeInDown');
        });

    }

    const togglePopUp = () => {
        const popup = document.querySelector('.popup'),
            popupContent = document.querySelector('.popup-content'),
            popupBtn = document.querySelectorAll('.popup-btn');

        popupBtn.forEach(item => {
            item.addEventListener('click', () => popup.style.display = 'block');
            popup.classList.add('fadeInDown');
        })

        popup.addEventListener('click', (e) => {
            let target = e.target;
            if(target.classList.contains('popup-close')) {
                popup.style.display = 'none';
                popup.classList.remove('fadeInDown');
            } else {
                target = target.closest('.popup-content');
                if(!target) {
                    popup.style.display = 'none';
                    popup.classList.remove('fadeInDown');
                }
            }
        });
    }

    const formRemove = () => {
        const form = document.getElementById('form3');
        let popupFormInput = document.querySelectorAll('.popup_form-input').value();
        const formBtn = document.querySelector('.form-btn');

        if(formBtn.clicked == true) {
            popupFormInput.value = '';
        } else {
            return;
        }
    }

    /* Инициализируем все функции скриптов */
    const init = () => {
        modalShow();
        togglePopUp();
        formRemove();
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

    /*$('#menu-header_menu .menu-item a').on('click', function (e) {
        if($(this).siblings().hasClass('sub-menu')){
            e.preventDefault()
        }
        $(this).siblings('.sub-menu').slideToggle();
    });*/

    $('#menu-header_menu .menu-item a').on('click', function(e) {
        var ul = $(this).next();
        var childrens = ul.find('ul');

        ul.toggleClass('open');
        childrens.removeClass('open');

        if ($(this).parent().siblings().length) {
            $(this).parent().siblings().find('ul').removeClass('open');
        }

        if($($(this)).siblings().hasClass('sub-menu')) {
            e.preventDefault();
        }
    });

    if($('#menu-header_menu .menu-item a').siblings().hasClass('sub-menu')) {
        $('#menu-header_menu .menu-item-has-children').addClass('arr');
    }


    $(document).on('click', function(e) {
        let container = $('#menu-header_menu')[0];
        if (!$.contains(container, e.target)) {
            $('#menu-header_menu').find('ul').removeClass('open');
        }
    });

});