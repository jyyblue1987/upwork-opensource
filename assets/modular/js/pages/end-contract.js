define(function (require) {
    
    /**
     * LOAD DEPENDENCIES
     */
    var $           = require('jquery'),
        bootstrap   = require('bootstrap'),
        rating      = require('rating');
    
    $(document).ready(function(){
        
        $("input[name='optradio']").on('click', function(){
            var $end_pay = $('#end-pay-container'),
                $input   = $(this);

            if( ! $input.is(':checked') ) return;

            if($input.val() == 2){
               $end_pay.removeClass('hide'); 
            }else{
               $end_pay.addClass('hide'); 
            }

        });
        
        var rating_input = $('.rating-fa'),
            form         = $('#end_contact_form');
        
        rating_input.rating({
            hoverOnClear: false,
            showCaption: false,
            filledStar: '<i class="fa fa-star"></i>',
            emptyStar: '<i class="fa fa-star fa-star-grey"></i>'
        });
        
        rating_input.on('rating.change', function() {
            var score = 0.00;
            rating_input.each(function(){
               score += parseFloat($(this).val()); 
            });
            $('#score').val( ( score / 5 ) );
        });
        
        form.on('submit', function( event ){
            
            event.preventDefault();
            
            var classError  = 'has-error',
                $that       =  $(this);
                $loading    =  $that.find('.form-loader'),
                $reporting  =  $('#action-reporting'),
                $comment    =  $that.find('.comment-error'),
                $alert      =  $reporting.find('.alert'),
                $csrf       = $that.find('input[name="csrf_test_name"]');
                confo_notes = $that.find('#Comment').val().trim();
            
            if( confo_notes === "") {
                $comment.parent().parent().addClass( classError );
                $comment.text("Please provide a comment to help us provide to you the best freelancer.");
                return false;
            }
            
            $comment.parent().parent().removeClass( classError );
            $loading.addClass('fa-spin').show();
            
            var action = $that.attr('action');
                   
            var jqXhr = $.post(action, { form: $that.serialize(), csrf_test_name: $csrf.val() },  $.noop, 'json');
            
            jqXhr.done(function( data ){                
                if(data.success){
                    $reporting.removeClass('hide');
                    if(data.success == "insufficient"){
                        
                        $alert.removeClass('alert-success').addClass('.alert-danger');
                        $alert.append('Failed payment for Insufficient funds');
                        
                    }else{
                        
                        $that.find('#end-contract-container-fields').remove();
                        $loading.hide();
                        
                        $alert.removeClass('alert-danger').addClass('alert-success');
                        $alert.append('You have successfully ended this contract.');
                        
                        setTimeout(function(){ 
                            window.location = $that.data('redirect'); }, 
                        5000);
                    }
		}else{
                    //TODO: We whould sent messages on sentry.
                }
            });
            
            jqXhr.fail(function(error){
                //TODO: we whould sent message on Sentry.
            });
            
            jqXhr.always(function(){
                $loading.removeClass('fa-spin').hide();
            });
            
        });
        
    });
});
