$(function(){
	$('.datepicker').datepicker()
});

$(document).ready(function(){
$( function() {
    $( "#slider-range" ).slider({
      range: true,
      min: 0,
      max: 500,
      values: [ 75, 300 ],
      slide: function( event, ui ) {
        $( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
      }
    });
    $( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +
      " - $" + $( "#slider-range" ).slider( "values", 1 ) );
	  
	$(document).on("click","#bs-example-navbar-collapse-1 a", function(event){
		event.stopPropagation();
		if($(this).attr("data-toggle") == "dropdown"){
			$(this).closest("li").find(".dropdown-menu").show();
		}
	})  
	$(document).on("click", function(event){
		$(".dropdown-menu").hide();
	});
  
  });
});
