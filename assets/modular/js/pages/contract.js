define(function (require) {
    
    /**
     * LOAD DEPENDENCIES
     */
    var $           = require('jquery'),
        bootstrap   = require('bootstrap'), 
        chatBox     = require('chatbox'),
        payment     = require('payment');
        
    $('._job_btn_message').chatbox({
        sendto:      site_url + "jobconvrsation/add_conversetion",
        receivefrom: site_url + "jobconvrsation/message_from_superhero",
        boxModal:    '#message_convertionModal' 
    });
    
    $('._job_btn_payment').payment({
        paymentUrl:      site_url + "pay/contract",
        remainToPaidUrl: site_url + "pay/remaining",
        modalPaymentId:    '#edit-payment',
        modalPaymentTransactionId:  '#payment-details-modal',
        modalPaymentForm : '#hr_fullMilestone',
        redirectPatternUrl: site_url + "contracts",
        method: 'makePayment',
        action: 'payment'
    });
    
    $('._job_add_milestone').payment({
        paymentUrl:      site_url + "pay/contract",
        modalPaymentId:    '#edit-milestone',
        modalPaymentTransactionId:  '#milestone-details-modal',
        modalPaymentForm : '#hr_addMilestone',
        redirectPatternUrl: site_url + "contracts",
        method: 'makePayment',
        action: 'add_milestone'
    });
    
    $('._js_form_end').on('submit', function( event ){
        
        event.preventDefault();
        
        var res = confirm("Do you really want to end this contract?");
        
        if( res == true ){
            this.submit();
        }
    });
});