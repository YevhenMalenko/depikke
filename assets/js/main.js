jQuery(document).ready(function () {

    function toggleMobileMenu() {
        jQuery('.menu-btn').on('click', function () {
            jQuery('.menu-btn').toggleClass('active');
            jQuery('.menu-wrapper').toggleClass('active');
            jQuery('body').toggleClass('lock');
            jQuery('.page-overlay').toggleClass('active');
        });

        jQuery('.menu').on('click', 'a', function () {
            if (jQuery(window).width() < 992) {
                jQuery('.menu-btn').removeClass('active');
                jQuery('.menu-wrapper').removeClass('active');
                jQuery('body').removeClass('lock');
                jQuery('.page-overlay').removeClass('active');
            }
        });
    }

    function stickyHeader() {
        const adminBar = jQuery('#wpadminbar');
        const adminBarHeight = adminBar.length > 0 ? adminBar.outerHeight() : 0;

        if (jQuery('.header').offset().top > 0 + adminBarHeight) {
            jQuery('.header').addClass('header-scroll');
            jQuery('.site').addClass('scroll');
        } else {
            jQuery('.header').removeClass('header-scroll');
            jQuery('.site').removeClass('scroll');
        }

        jQuery(window).scroll(function () {
            if (jQuery(window).scrollTop() > 0) {
                jQuery('.header').addClass('header-scroll');
                jQuery('.site').addClass('scroll');
            } else {
                jQuery('.header').removeClass('header-scroll');
                jQuery('.site').removeClass('scroll');
            }
        });
    }

    function toggleMenuItems() {
        jQuery('.sub-menu-toggle').on('click', function (event) {
            event.preventDefault();
            if (jQuery(window).width() < 1080) {
                let $this = jQuery(this);

                $this.toggleClass('active');
                $this.next().slideToggle();
            }
        });
    }

    function heroSlider() {
        jQuery('.hero-gallery-images').slick({
            dots: true,
            arrows: false,
            infinite: true,
            speed: 500,
            fade: true,
            cssEase: 'linear',
            autoplay: true,
            autoplaySpeed: 3000,
        });
    }

    function togglePopup() {
        
        jQuery('.latest-news-list').on('click', '.news-card a', function (event) {
            event.preventDefault();

            jQuery(this).parents('.news-card').find('.pop-up').fadeIn();
            jQuery('body').addClass('fixed');
        });

        jQuery('.latest-news-list').on('click', '.pop-up-close', function (event) {
            event.preventDefault();
            
            jQuery(this).parents('.pop-up').fadeOut();
            jQuery('body').removeClass('fixed');
        });

        jQuery('.latest-news-list').on('click', '.pop-up', function (event) {
            event.preventDefault();

            jQuery(this).fadeOut();
            jQuery('body').removeClass('fixed');
        });

        jQuery('.latest-news-list').on('click', '.pop-up-content', function (event) {
            event.stopPropagation();
        });
    }

    function logoCarousel() {
        jQuery('.logos-list').slick({
            infinite: true,
            dots: false,
            nextArrow: '<button type="button" class="slick-btn slick-next"></button>',
            prevArrow: '<button type="button" class="slick-btn slick-prev"></button>',
            slidesToShow: 3,
            slidesToScroll: 1,
            responsive: [{
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1,
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                    }
                },
            ]
        });
    }

    function loadMoreNews() {
        let page = 2;
        let postsPerPage = +jQuery('.news-list').attr('data-show');
        let totalPages = +jQuery('.news-list').attr('data-pages');

        jQuery('#load-more').on('click', function () {

            jQuery('#load-more').addClass('loading');
            jQuery('.news-list').addClass('loading');

            let data = {
                action: 'load_more_news',
                nonce: my_ajax_object.nonce,
                page: page,
                posts_per_page: postsPerPage,
            };

            jQuery.post(my_ajax_object.ajax_url, data, function (response) {

                if (page === totalPages) {
                    jQuery('#load-more').hide();
                }

                jQuery('.news-list').append(response);
                page++;

                jQuery('#load-more').removeClass('loading');
                jQuery('.news-list').removeClass('loading');

            });
        });
    } 
    
    function getTimeRemaining(endtime) {
        const t = Date.parse(endtime) - Date.parse(new Date()),
            days = Math.floor(t / (1000 * 60 * 60 * 24)),
            hours = Math.floor(t / (1000 * 60 * 60) % 24),
            minutes = Math.floor(t / 1000 / 60 % 60),
            seconds = Math.floor(t / 1000 % 60);
        return {
            'total': t,
            'days': days,
            'hours': hours,
            'minutes': minutes,
            'seconds': seconds
        };
    }

    function getZero(num) {
        if (num >= 0 && num < 10) {
            return `0${num}`;
        } else {
            return num;
        }
    }

    function setClock() {
        if (document.querySelector('.countdown_active')) {
        
            const endtime = document.querySelector('.countdown_active').getAttribute('data-end');
            const totalDays = document.querySelector('.countdown_active').getAttribute('data-days')
            const timer = document.querySelector('.countdown_active');
            const days = timer.querySelector('#days span');
            const hours = timer.querySelector('#hours span');
            const minutes = timer.querySelector('#minutes span');
            const seconds = timer.querySelector('#seconds span');
            const timeInterval = setInterval(updateClock, 1000);
            const daysBlocks = timer.querySelectorAll('#days g');
            const hoursBlocks = timer.querySelectorAll('#hours g');
            const minutesBlocks = timer.querySelectorAll('#minutes g');
            const secondsBlocks = timer.querySelectorAll('#seconds g');

            updateClock();

            function updateClock() {
                const t = getTimeRemaining(endtime);
                days.textContent = getZero(t.days);
                hours.textContent = getZero(t.hours);
                minutes.textContent = getZero(t.minutes);
                seconds.textContent = getZero(t.seconds);


                if (t.total <= 0) {
                    clearInterval(timeInterval);
                    days.textContent = '00';
                    hours.textContent = '00';
                    minutes.textContent = '00';
                    seconds.textContent = '00';
                } else {

                    function updateSecondsCircle() {
                        let seconds = getZero(t.seconds);
                        let percent = seconds * 100 / 60;
                        let endBlocks = 36 - (percent * 36 / 100);
            
                        if (seconds === '00') {
                            secondsBlocks.forEach(item => {
                                item.classList.remove('active')
                            });
                        } else {
                            for (let i = 0; i < endBlocks; i++) {
                                secondsBlocks[i].classList.add('active');
                            }
                        }
                    }

                    function updateMinutesCircle() {
                        let minutes = getZero(t.minutes);
                        let percent = minutes * 100 / 60;
                        let endBlocks = 36 - (percent * 36 / 100);
            
                        if (minutes === '00') {
                            minutesBlocks.forEach(item => {
                                item.classList.remove('active')
                            });
                        } else {
                            for (let i = 0; i < endBlocks; i++) {
                                minutesBlocks[i].classList.add('active');
                            }
                        }
                    }

                    function updateHoursCircle() {
                        let hours = getZero(t.hours);
                        let percent = hours * 100 / 24;
                        let endBlocks = 36 - (percent * 36 / 100);
            
                        if (hours === '00') {
                            hoursBlocks.forEach(item => {
                                item.classList.remove('active')
                            });
                        } else {
                            for (let i = 0; i < endBlocks; i++) {
                                hoursBlocks[i].classList.add('active');
                            }
                        }
                    }

                    function updateDaysCircle() {
                        let days = getZero(t.days);
                        let percent = days * 100 / totalDays;
                        let endBlocks = 36 - (percent * 36 / 100);
            
                        if (days === totalDays) {
                            daysBlocks.forEach(item => {
                                item.classList.remove('active')
                            });
                        } else {
                            for (let i = 0; i < endBlocks; i++) {
                                daysBlocks[i].classList.add('active');
                            }
                        }
                    }

                    updateSecondsCircle();
                    updateMinutesCircle();
                    updateHoursCircle();
                    updateDaysCircle();
                }

            }

        }
    }

    jQuery('a[href^=#]').on('click', function(e){
        e.preventDefault();
        let href = jQuery(this).attr('href');
        const adminBar = jQuery('#wpadminbar');
        const adminBarHeight = adminBar.length > 0 ? adminBar.outerHeight() : 0;
        const headerHeight = jQuery('.header').outerHeight();

        jQuery('html, body').animate({ 
            scrollTop:jQuery(href).offset().top - adminBarHeight - headerHeight
        },'slow');
    });

    jQuery('.scroll-next').on('click', function () {
        const windowHeight = jQuery(window).height();
        const headerHeight = jQuery('.header').height();
        const adminBar = jQuery('#wpadminbar');
        const adminBarHeight = adminBar.length > 0 ? adminBar.outerHeight() : 0;
        jQuery('body,html').animate({
            scrollTop: windowHeight - headerHeight - adminBarHeight
        }, 'slow');
        return false;
    });

    new WOW().init();
    toggleMobileMenu();
    toggleMenuItems();
    stickyHeader();
    togglePopup()
    logoCarousel();
    heroSlider();
    loadMoreNews();
    setClock();

});