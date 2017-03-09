define(function (require) {
    
    var $         = require('jquery'),
        bootstrap = require('bootstrap'), 
        helper    = require('./helpers');
        
    var message_modal = $('#message_convertionModal');
    
    //TODO: refactory these two function and place them into the helpers so that it can be called from others pages.
    var editClickedMilestone = function(clicked_id, buser_id_value, fuser_id_value, job_id_value) {

        var key = $(this).attr('accesskey');
     
        $.ajax({
            url: site_url + "pay/add_milestone/" + clicked_id,
            data: ({key: key, buser_id: buser_id_value, fuser_id: fuser_id_value, job_id: job_id_value}),
            dataType: "html",
            type: "post",
            success: function (response) {
                $('#milestone-details-modal').html(response.trim());
                $('#edit-milestone').modal('show');
            },
            error: function (status, error, textStatus) {
                alert(error);
            }
        });
        $('#edit-milestone').modal('show');
    }; 
    
    var editClickedPayment = function(clicked_id, buser_id_value, fuser_id_value, job_id_value) {
        var key = $(this).attr('accesskey');

        $.ajax({
            url: site_url + "pay/full_milestone/" + clicked_id,
            data: ({key: key, buser_id: buser_id_value, fuser_id: fuser_id_value, job_id: job_id_value}),
            dataType: "html",
            type: "post",
            success: function (response) {
                $('#payment-details-modal').html(response.trim());
                $('#edit-payment').modal('show');
            },
            error: function (status, error, textStatus) {
                alert(error);
            }
        });
        $('#edit-payment').modal('show');
    };
    
    var message_from_superhero_url = site_url + "jobconvrsation/message_from_superhero",
        callback = function (data) {
                      $('.message_lists').html(data.html);
                   };
    
    helper.autoLoadMessage(message_from_superhero_url, '#job_id', '#bid_id', '#receiver_id', callback );
    
    
    var loadMessageCallback = function (data, b_id, u_id, j_id) {
        
            $('.message_lists').html(data.html);
            $('#job_id').val(j_id);
            $('#bid_id').val(b_id);
            $('#receiver_id').val(u_id);
            message_modal.show();
            
            helper.autoLoadMessage(message_from_superhero_url, '#job_id', '#bid_id', '#receiver_id', callback );
        };
        
    var conversation_callback = function( form ){
        
        if ($('#usermsg').val().trim().length > 0) {
            
            $.post(site_url + "jobconvrsation/add_conversetion", {form: $(form).serialize()}, function (data) {
                if (data.success) {
                    
                    $(form)[0].reset();
                    helper.loadmessage($('#bid_id').val(), $('#receiver_id').val(), $('#job_id').val(), message_from_superhero_url, loadMessageCallback);
                    
                } else {
                    alert('Opps!! Something went wrong.');
                }
            }, 'json');
        }
        
    }; 
    
    helper.listenConversationSubmission("#conversion_message", conversation_callback);
    
    var btn_milestone = $('._job_add_milestone');
    btn_milestone.on('click', function(){
        editClickedMilestone(btn_milestone.attr('id'), btn_milestone.data('buserid'), btn_milestone.data('fuserid'), btn_milestone.data('jobid'));
    });
    
    var btn_payment = $('._job_btn_payment');
    btn_payment.on('click', function(){
        editClickedPayment(btn_payment.attr('id'), btn_payment.data('buserid'), btn_payment.data('fuserid'), btn_payment.data('jobid'));
    });
    
    var btn_message = $('._job_btn_message');
    btn_message.on('click', function(){
        helper.onClickMessageBtn(btn_message, message_from_superhero_url, loadMessageCallback);
    }); 
    
    var btn_modal_close = $('._js_modal_close');
    btn_modal_close.on('click', function(){
        helper.hideMessagePopup( message_modal );   
    });
});
