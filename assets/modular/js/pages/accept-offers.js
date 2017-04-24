define(function (require) {
    
    /**
     * LOAD DEPENDENCIES
     */
    var $           = require('jquery'),
        Utils       = require('helper'), 
        bootstrap   = require('bootstrap');
        
    var $accept_btn  = $('#accept_offer');
    var $form        = $("#offerconfirmed");
    var $notes       = $('#confo_notes');
    var $terms       = $('#terms');
    var is_accepting = false;
    
    var $notif_container = $('#notif-container');
    $accept_btn.on('click', function(event){
        event.preventDefault();
        
        var message = $.trim($notes.val());
        if( message.length == 0 ){
            Utils.display_message($notif_container, 'alert-danger', 'hide', 'Please enter a message');
            return false;
        }

        if (!$terms.is(":checked")) {
            Utils.display_message($notif_container, 'alert-danger', 'hide', 'Please accept the user agreement');
            return false;
        }
        
        if(is_accepting) return;
        
        is_accepting = true;
        
        var jqXhr = $.post(site_url + "jobs/offers/accept", { form: $form.serialize() }, $.noop, 'json');
        
        jqXhr.done(function(data) {
            
            if(data.status == 'success')
            {
                $form[0].reset();
                Utils.display_message($notif_container, 'alert-success', 'hide', data.message);
            }
            else if(data.message)
            {
                Utils.display_message($notif_container, 'alert-danger', 'hide', data.message);
            }
            
            if(data.redirect && data.redirect_url)
                setTimeout(function(){ Utils.redirect(data.redirect_url); }, 1000);
            
        });
        
        jqXhr.always(function(){
            is_accepting = false;
        });
    });    
});
