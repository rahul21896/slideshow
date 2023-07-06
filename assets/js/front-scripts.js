jQuery(document).ready(function(){
  let slideshow_sliders = jQuery('.slideshow_slider');
  if(slideshow_sliders.length > 0){
    jQuery(slideshow_sliders).each(function(){
      // get slide to show attributes.
      let show_desktop = jQuery(this).attr('data-show_desktop');
      let show_tab = jQuery(this).attr('data-show_tab');
      let show_mobile = jQuery(this).attr('data-show_mobile');

      // get slide to scroll attributes.
      let scroll_desktop = jQuery(this).attr('data-scroll_desktop');
      let scroll_tab = jQuery(this).attr('data-scroll_tab');
      let scroll_mobile = jQuery(this).attr('data-scroll_mobile');

      // get navigation attributes.
      let arrows = jQuery(this).attr('data-arrows');
      let dots = jQuery(this).attr('data-dots');
      let infinite = jQuery(this).attr('data-infinite');
      let slider_id = jQuery(this).attr('id');
      slider_id = '#'+slider_id;

      dots = dots === 'on' ? true : false;
      arrows = arrows === 'on' ? true : false;
      infinite = infinite === 'on' ? true : false;

      let settings = {
        dots: dots,
        infinite: infinite,
        arrows: arrows,
        speed: 300,
        slidesToShow: parseInt(show_desktop),
        slidesToScroll: parseInt(scroll_desktop),
        responsive: [
          {
            breakpoint: 1367,
            settings: {
              slidesToShow: parseInt(show_desktop),
              slidesToScroll: parseInt(scroll_desktop),
              dots: dots,
              infinite: infinite,
              arrows: arrows,
            }
          },
          {
            breakpoint: 850,
            settings: {
              slidesToShow: parseInt(show_tab),
              slidesToScroll: parseInt(scroll_tab),
              dots: dots,
              infinite: infinite,
              arrows: arrows,
            }
          },
          {
            breakpoint: 480,
            settings: {
              slidesToShow: parseInt(show_mobile),
              slidesToScroll: parseInt(scroll_mobile),
              dots: dots,
              infinite: infinite,
              arrows: arrows,
            }
          }
        ]
      };
      jQuery(slider_id).slick(settings);
    });
  }
});
