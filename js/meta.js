//Fonts
WebFont.load({
  google: {
    families: ['Open+Sans:400,600', 'Quicksand:300,400,500,600']
  }
});

//Menus Dropdowns
jQuery(document).ready(function () {
  //Main Menus
  jQuery("#header .menu-item-has-children").mouseenter(function () {
    if (jQuery(window).width() >= 975) {
      jQuery(".sub-menu-wrap", this).stop().slideDown();
      jQuery(this).addClass('sub-menu-active')
    }
  });
  jQuery("#header .menu-item-has-children").mouseleave(function () {
    if (jQuery(window).width() >= 975) {
      jQuery(".sub-menu-wrap", this).stop().slideUp();
      jQuery(this).removeClass('sub-menu-active')
    }
  });
  // Mobile Nav
  jQuery("<span class='menu-drop'><i class='fa-solid fa-chevron-down'></i></span>").appendTo("#mobileNav .menu-item-has-children");
  //jQuery("#mobileNav .menu-item-has-children > a").on('click touch', function () {
  //  jQuery(this).next('.sub-menu').stop().toggle();
  //  jQuery(this).parent().toggleClass('sub-menu-active')
  //});
  jQuery("#mobileNav .menu-item-has-children .menu-drop").on('click touch', function () {
    jQuery(this).siblings(".sub-menu").stop().slideToggle(500);
    jQuery(this).toggleClass('sub-menu-active');
    jQuery(this).parent().toggleClass('menu-active');
  });
});
