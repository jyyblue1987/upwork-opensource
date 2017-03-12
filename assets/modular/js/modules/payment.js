define(['jquery', 'bootstrap'], function ($) {
    
    // APP PAYMENT CLASS DEFINITION
    // =========================
    
    var Payment = function (element, options) {
        
        this.type       = null
        this.options    = null
        this.enabled    = null
        this.$element   = null
        this.options    = options
        
        this.init('payment', element, options)
    }
    
    Payment.VERSION  = '0.0.1';

    Payment.DEFAULTS = {
        
    }
    
    Payment.prototype.init = function (type, element, options) {
        this.enabled   = true
        this.type      = type
        this.$element  = $(element)
        this.options   = options
        this.bindEventsUI()
    }
    
    Payment.prototype.bindEventsUI  = function(){        
        this.$element.on('click.wj.' + this.type, $.proxy(this.makePayment, this))
    }
    
    Payment.prototype.makePayment  = function(){        
       
       var paymentDatas = {
           key: null, 
           buser_id: this.options.buserid, 
           fuser_id: this.options.fuserid, 
           job_id: this.options.jobid
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