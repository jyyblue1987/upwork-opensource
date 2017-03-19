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
    
    // PRIVATE FUNCTION (IT SHOULD ME INTO A HELPER MODULE
    //====================================================
    
    String.prototype.aContainsB = function (b) {
        return this.indexOf(b) >= 0;
    }
    
    Payment.prototype.init = function (type, element, options) {
        this.enabled   = true
        this.type      = type
        this.$element  = $(element)
        this.$modal    = this.$element.find( this.options.modalPaymentTransactionId )
        this.options   = options
        this.bindEventsUI()
    }
    
    Payment.prototype.bindEventsUI  = function(){        
        this.$element.on('click.wj.' + this.type, $.proxy(this.openPaymentModal, this))
        $(this.options.modalPaymentTransactionId).on('submit.wj.' + this.type, this.options.modalPaymentForm , $.proxy(this.makePayment, this))
    }
    
    Payment.prototype.makePayment  = function( event ){
        event.preventDefault();
        
        //TODO: add a good friendly visual for client
        $('#hr_btnpay').prop('disabled', true);
        
        var response = "";
        
        //sent request 
        var jqxhr = $.ajax({
            type        : 'POST',
            url         : this.options.paymentUrl,
            data        : $(this.options.modalPaymentForm).serialize() + '&csrf_test_name=' + csrf_token ,
        });
        
        var query = $.param({fmJob: this.options.econtractid }); 
        var that  = this
        
        //Handle response 
        jqxhr.done(function(res) {
            if(res.aContainsB('done')){
              window.location.replace( that.options.redirectPatternUrl + '?' + query);
            }else {
              $('#hr_msg').text(res);
              $('#hr_btnpay').prop('disabled', false);
            }
        });
    }
    
    Payment.prototype.openPaymentModal  = function(){        
       
       var paymentDatas = {
           key: null, 
           buser_id: this.options.buserid, 
           fuser_id: this.options.fuserid, 
           job_id: this.options.jobid,
           csrf_test_name: csrf_token
       }
       
       var that = this
       
       var paymentModal = $(this.options.modalPaymentId)
       
       $.ajax({
            url: this.options.paymentUrl + this.options.id,
            data: paymentDatas,
            dataType: "html",
            type: "post",
            success: function (response) {
                paymentModal.find( that.options.modalPaymentTransactionId ).html(response.trim());
                paymentModal.modal('show');
            },
            error: function (status, error, textStatus) {
                alert(error);
            }
        });
    }
    
    
    
  // PAYMENT PLUGIN DEFINITION
  // =======================
 
  function Plugin(option) {
    console.log('Initialized payment')
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