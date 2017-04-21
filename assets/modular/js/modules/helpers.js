define(function () {  
   

    var display_message = function(notif_container, addClass, removeClass, message){
        
        if(!notif_container || !notif_container.length) return;
                
        notif_container.text(message);
        notif_container
            .addClass(addClass)
            .removeClass(removeClass)
            .show()
            .delay(5000)
            .fadeOut("slow", function(){
                notif_container
                    .addClass(removeClass)   
                    .removeClass(addClass);
            });
    };
    
    var makeExpandingArea = function( container ){
        
        if(!container || !container.length) return;
        
        if ( window.opera && /Mac OS X/.test( navigator.appVersion ) ) {
            container
                .querySelector( 'pre' )
                .appendChild( document.createElement( 'br' ));
        }
        
        var area = container.querySelector('textarea');
        var span = container.querySelector('span');

        if (area.addEventListener) {
            area.addEventListener('input', function () {
                span.textContent = area.value;
            }, false);
            span.textContent = area.value;
        } else if (area.attachEvent) {
            // IE8 compatibility
            area.attachEvent('onpropertychange', function () {
                span.innerText = area.value;
            });
            span.innerText = area.value;
        }
        // Enable extra CSS
        container.className += ' active-textbox';
    };
    
    var resetExpandingArea = function( textbox ){
        
        if(!textbox || !textbox.length) return;
        
        //For IE
        fireEvent(textbox,'onpropertychange');
        //For others
        fireEvent(textbox, 'input');
    };
    
    var redirect = function( url ){
        window.location.replace( url );
    };
    
    var setFee = function($bid_amount, $bid_fee, $bid_earning) 
    {
        var myRate = parseInt($bid_amount.val());
        
        if ( ! isNaN( myRate ) ) 
        {
            $bid_fee.val( myRate / 10 );
            $bid_earning.val( myRate - ( myRate / 10 ) );
        } 
        else 
        {
            $bid_fee.val('');
            $bid_earning.val('');
        }
    }
    
    return {
        redirect: redirect,
        resetExpandingArea: resetExpandingArea,
        makeExpandingArea: makeExpandingArea,
        display_message: display_message,
        setFee: setFee
    };
});