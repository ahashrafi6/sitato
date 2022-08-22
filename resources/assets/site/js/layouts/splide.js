import Splide from '@splidejs/splide';

const sliders = document.querySelectorAll('.splide-def')
sliders.forEach(item=> {

    new Splide(item, {
        type   : 'loop',
        perPage : item.getAttribute('data-col'),
        focus  : 'center',
        direction: 'rtl',
        autoplay: true,
        gap    : '1rem',
        pagination   : false,
        padding: '8px',
        breakpoints: {
          768: {
            perPage: 3,
              },
          640: {
            perPage: 2,
          },
          480: {
            perPage: 1,
          },
        },
    }).mount()
});

