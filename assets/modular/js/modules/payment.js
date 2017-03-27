define(['jquery', 'bootstrap'], function ($) {
    
    // APP PAYMENT CLASS DEFINITION
    // =========================
    
    var Payment = function (element, options) {
        
        this.type       = null
        this.options    = null
        this.enabled    = null
        this.$element   = null
        this.$modal     = null
        this.options    = options
        
        this.init('payment', element, options)
    }
    
    Payment.VERSION  = '0.0.1';

    Payment.DEFAULTS = {
        
    }
    
    // PRIVATE FUNCTION (IT SHOULD BE INTO A HELPER MODULE
    //====================================================
    
    String.prototype.aContainsB = function (b) {
        return this.indexOf(b) >= 0;
    }
    
    function displayMessage(container, message, state){
        
        var $alert = $(container).find(".alert");
        
        if(state == 'success')
        {
            $alert.removeClass('alert-danger hide').addClass('alert-success')
        }
        else
        {
            $alert.removeClass('alert-success hide').addClass('alert-danger')
        }
        
        $alert.find('.content').text( message )
    }
    
    function closeModal(event){
        event.preventDefault()
        this.$modal.find('.alert').addClass('hide')
    }
    
    Payment.prototype.init = function (type, element, options) {
        this.enabled   = true
        this.isLoadedModal = false
        this.isProceedPayment = false
        this.type      = type
        this.$element  = $(element)
        this.$modal    = $( this.options.modalPaymentTransactionId )
        this.$form     = $( this.options.modalPaymentForm )
        this.options   = options
        this.bindEventsUI()
    }
    
    Payment.prototype.bindEventsUI  = function(){        
        this.$element.on('click.wj.' + this.type, $.proxy(this.openPaymentModal, this))
        this.$modal.on('submit.wj.' + this.type, this.options.modalPaymentForm , $.proxy(this.makePayment, this))
        this.$modal.find('.alert .close').on('click.wj.' + this.type, $.proxy(closeModal, this) )
    }
    
    Payment.prototype.makePayment  = function( event ){
        event.preventDefault();
        
        if(this.isProceedPayment) return; 
        
        var amount = parseFloat(this.$modal.find('input.amount').val());
        
        if( isNaN(amount) || amount <= 0 ){
            displayMessage(this.$modal, 'Please enter a valid amount.', 'error');
            return;
        }
        
        var $submit = this.$form.find('button.big_mass_active');
        var $loader = $submit.find('.form-loader');
       
        $submit.prop('disabled', true);
        this.isProceedPayment = true;
        $loader.addClass('fa-spin').removeClass('hide');
        
        var post_datas = $.param({contract_id: this.options.econtractid, csrf_test_name: csrf_token, amount: amount, action: this.options.action});
        
        //sent request 
        var jqxhr = $.ajax({
            type        : 'POST',
            url         : this.options.paymentUrl,
            data        : post_datas,
            dataType    : "json"
        });
        
        var query = $.param({fmJob: this.options.econtractid }); 
        var that  = this
        
        //Handle response 
        jqxhr.done(function(res) {
            if(res.status == 'success'){
              
              displayMessage(that.$modal, res.message, 'success');
              
              setTimeout(function(){
                window.location.replace( that.options.redirectPatternUrl + '?' + query);
              }, 1000);
              
            }else {
              displayMessage(that.$modal, res.message, 'error');
            }
        });
        
        jqxhr.always(function(){
            $loader.addClass('hide').removeClass('fa-spin');
            that.isProceedPayment = false
            $submit.prop('disabled', false);
        });
    }
    
    Payment.prototype.openPaymentModal  = function(){        
       
        if(this.isLoadedModal) return;
       
       this.isLoadedModal = true;
       
       var paymentDatas = { 
           fmJob: this.options.econtractid,
           csrf_test_name: csrf_token
       }
       
       var that         = this
       var paymentModal = $(this.options.modalPaymentId)
       var $submit      = $('#hr_btnpay')
       
       if(this.options.action == 'payment'){
           
           var loader = this.$element.parent().find('.form-loader');
           
           loader.addClass('fa-spin').removeClass('hide');
           var jqXhr = $.ajax({
                            url: this.options.remainToPaidUrl,
                            data: paymentDatas,
                            dataType: "json",
                            type: "get",
                            success: function (response) {
                                if(response.status == 'success'){
                                    $submit.prop('disabled', false);
                                    paymentModal.find('input.amount').val( response.remaining );
                                    paymentModal.find('.modal-header h4').show();
                                    paymentModal.find('.modal-header h4 span').text( response.title );
                                    paymentModal.modal('show');
                                }else{
                                    paymentModal.find('.modal-header h4').hide();
                                    displayMessage(that.$modal, response.message, 'error');
                                    paymentModal.modal('show');
                                    $submit.prop('disabled', true);
                                }
                            },
                            error: function (status, error, textStatus) {
                                //TODO: sent this error to sentry
                            }
                        });
                        
            jqXhr.always(function(){
                loader.addClass('hide').removeClass('fa-spin');
                that.isLoadedModal = false;
            });
       }else{
           paymentModal.find('.modal-header h4 span').text( this.options.title );
           paymentModal.modal('show');
           this.isLoadedModal = false;
       }
       
    }
    
    
    
  // PAYMENT PLUGIN DEFINITION
  // =======================
 
  function Plugin(option) {
    return this.each(function () {
        var data    = $(this).data('wj.payment')
        var options = $.extend({}, Payment.DEFAULTS, $(this).data(), typeof option == 'object' && option)
        
        if (!data){
          $(this).data('wj.payment', (data = new Payment(this, options)))  
        }else{
            data.makePayment();
        } 
    });
  }
    
   var old = $.fn.payment

   $.fn.payment             = Plugin
   $.fn.payment.Constructor = Payment


   // PAYMENT NO CONFLICT
   // ===============

   $.fn.payment.noConflict = function () {
     $.fn.payment = old
     return this
   }
    
    
  // PAYMENT DATA-API
  // ==============

  $(document).on('click.wj.payment.data-api', '[data-make="payment"]', function (e) {
    Plugin.call(this, $(this).data())
  })
});