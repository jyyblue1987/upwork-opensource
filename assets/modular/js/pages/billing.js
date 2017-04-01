(function($){
    
    var $tabs = $('.tab-profile');
    $tabs.on('click', function(){
        
        var $context   = $(this);
        var $i         = $context.find('i');
        var $tab_items = $context.next('.tab-profile-links'); 
        
        if( $i.hasClass('fa-angle-down'))
        {
            $context.removeClass('faqopen');
            $i.removeClass('fa-angle-down');
            $i.addClass('fa-angle-right');
            $tab_items.slideUp("fast");
        }
        else
        {
            $context.addClass('faqopen');
            $i.removeClass('fa-angle-right');
            $i.addClass('fa-angle-down');
            $tab_items.slideDown("fast");
        }
    });
    
})(jQuery);


