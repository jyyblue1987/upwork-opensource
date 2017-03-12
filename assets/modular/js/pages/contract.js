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
        paymentUrl:      site_url + "pay/full_milestone/",
        modalPaymentId:    '#edit-payment',
        modalPaymentTransactionId:  '#payment-details-modal',
        method: 'makePayment'
    });
    
    $('._job_add_milestone').payment({
        paymentUrl:      site_url + "pay/add_milestone/",
        modalPaymentId:    '#edit-milestone',
        modalPaymentTransactionId:  '#milestone-details-modal',
        method: 'makePayment'
    })
    
});
