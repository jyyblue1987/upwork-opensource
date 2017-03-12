define(function (require) {
    
    /**
     * LOAD DEPENDENCIES
     */
    var $           = require('jquery'),
        bootstrap   = require('bootstrap'), 
        chatBox     = require('chatbox');
        
    $('._job_btn_message').chatbox({
        sendto:      site_url + "jobconvrsation/add_conversetion",
        receivefrom: site_url + "jobconvrsation/message_from_superhero",
        boxModal:    '#message_convertionModal' 
    });
});
