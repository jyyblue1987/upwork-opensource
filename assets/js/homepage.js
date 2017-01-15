
		jQuery("#layerslider").layerSlider({
			responsive: false,
			responsiveUnder: 1280,
			layersContainer: 1280,
			skin: 'noskin',
			hoverPrevNext: false,
		});
		
		$(document).ready(function() {
 
  $("#sliderBox").owlCarousel({
      items : 5,
      itemsDesktop : [1000,3],
      itemsDesktopSmall : [900,2],
      itemsTablet: [600,1], 
      itemsMobile : true
  });
 
  $("#testimonialbox").owlCarousel({
 
      slideSpeed : 300,
      paginationSpeed : 400,
      singleItem:true,
      itemsMobile : true
 
  });
  
  var owl =$("#ouBlogBox");
 
  owl.owlCarousel({
 
      items : 4,
      itemsDesktop : [1200,3],
      itemsDesktopSmall : [1000,2],
      itemsTablet: [750,1], 
      itemsMobile : true
 
  });
  
   $(".next").click(function(){
    owl.trigger('owl.next');
  });
  $(".prev").click(function(){
    owl.trigger('owl.prev');
  });
  
});
 