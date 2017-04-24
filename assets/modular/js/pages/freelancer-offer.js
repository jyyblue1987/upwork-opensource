define(function (require) {
    
    /**
     * LOAD DEPENDENCIES
     */
    var $           = require('jquery'),
        bootstrap   = require('bootstrap'),
        Utils       = require('helper'), 
        chatBox     = require('chatbox');
        
    $('._job_btn_message').chatbox({
        sendto:      site_url + "jobconvrsation/add_conversetion",
        receivefrom: site_url + "jobconvrsation/message_from_superhero",
        boxModal:    '#message_convertionModal' 
    });
    
    var $notif_container = $('#notif-container');
    $('#_btn_decline_offer').on('click', function(event){
        event.preventDefault();
        
        var jqXhr = $.post(site_url + "jobs/offers/decline", { bid_id: $(this).data('bid') }, $.noop, 'json');
        
        jqXhr.done(function(data) {
			
            if(data.status == 'success')
            {
                Utils.display_message($notif_container, 'alert-success', 'hide', data.message);
            }
            else if(data.message)
            {
                Utils.display_message($notif_container, 'alert-danger', 'hide', data.message);
            }
            
            if(data.redirect && data.redirect_url)
                setTimeout(function(){ Utils.redirect(data.redirect_url); }, 1000);
        });
    }); 
});
